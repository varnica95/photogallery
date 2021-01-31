<?php


namespace App\Core;


use App\Maps\TableMap;
use PDO;

class Model
{
    /**
     * @var
     */
    protected static $connection;

    /**
     * @return PDO
     */
    protected static function connection()
    {
        return Database::getInstance()->testConnection();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public static function create(array $data)
    {
        self::$connection = self::connection();

        $table = TableMap::resolve(get_called_class());
        $fields = implode(', ', array_keys($data)); // field1, field2...
        $values = ':' . implode(', :', array_keys($data)); // :value1, :value2...

        $sql = 'INSERT INTO ' . $table . ' (' . $fields . ') VALUES (' . $values . ')';
        $statement = self::$connection->prepare($sql);

        foreach ($data as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }

        $statement->execute();

        return self::getLastInsertedRow($table, self::connection()->lastInsertId());
    }

    /**
     * @param array $data
     * @return mixed
     */
    public static function createHash(array $data)
    {
        self::$connection = self::connection();

        $sql = "INSERT INTO remembers (user_id, hash) VALUES (:user_id, :hash)";
        $statement = self::$connection->prepare($sql);

        foreach ($data as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }

        $statement->execute();

        return self::getLastInsertedRow('remembers', self::connection()->lastInsertId());
    }

    /**
     * @param $value
     * @return mixed
     */
    public static function getHash($value)
    {
        $sql = "SELECT * FROM remembers WHERE user_id = '{$value}' OR hash = '{$value}'";
        $statement = self::connection()->query($sql);

        $statement->setFetchMode(PDO::FETCH_OBJ);

        return $statement->fetch();
    }


    /**
     * @param $fields
     * @param $table
     * @param $field
     * @param $value
     * @return mixed
     */
    public static function get($fields, $table, $field, $value)
    {
        self::$connection = self::connection();

        if (is_array($fields) && count($fields) > 1){
            $fields = implode(', ', $fields);
        }

        $sql = "SELECT {$fields} FROM {$table} WHERE {$field} = '$value'";
        $statement = self::$connection->query($sql);

        $statement->setFetchMode(PDO::FETCH_CLASS, TableMap::getClass($table));

        return $statement->fetch();
    }

    /**
     * @return array
     */
    public static function all()
    {
        self::$connection = self::connection();

        $table = TableMap::resolve(get_called_class());

        $sql = "SELECT * FROM {$table}";
        $statement = self::$connection->query($sql);

        $statement->execute();

        $statement->setFetchMode(PDO::FETCH_CLASS, TableMap::getClass($table));

        return $statement->fetchAll();

    }

    /**
     * @param int $id
     * @return mixed
     */
    public static function find($id)
    {
        self::$connection = self::connection();

        $table = TableMap::resolve(get_called_class());

        $sql = "SELECT * FROM {$table} WHERE id = '$id'";
        $statement = self::$connection->query($sql);

        $statement->setFetchMode(PDO::FETCH_CLASS, TableMap::getClass($table));

        return $statement->fetch();
    }

    /**
     * @param array $data
     * @param int $id
     */
    public static function update(array $data, $id)
    {
        self::$connection = self::connection();
        $table = TableMap::resolve(get_called_class());

        $fields = '';
        foreach ($data as $key => $value) {
            $fields .= $key . ' = :' . $key . ', ';
        }

        $fields = trim($fields, ', ');

        $sql = "UPDATE {$table} SET {$fields} WHERE id = '$id'";
        $statement = self::$connection->prepare($sql);

        foreach ($data as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }

        $statement->execute();
    }
    /**
     * @param $table
     * @param $id
     * @return mixed
     */
    protected static function getLastInsertedRow($table, $id)
    {
        $sql = 'SELECT * FROM ' . $table . ' WHERE id = ' . $id;
        $statement = self::$connection->query($sql);

        if ($table === 'remembers'){
            return $statement->fetch(PDO::FETCH_OBJ);
        }

        $statement->setFetchMode(PDO::FETCH_CLASS, TableMap::getClass($table));
        return $statement->fetch();
    }

    /**
     * @param array $data
     * @param $left
     * @param $keyword
     * @param $right
     * @return array
     */
    public static function join($left, $keyword, $right, string $localKey, string $foreignKey, int $id = null, array $data = [])
    {
        self::$connection = self::connection();

        $left = TableMap::resolve($left);
        $right = TableMap::resolve($right);

        $fields = $left . '.*';
        if (! empty($data)){
            $fields = implode(', ', $data);
        }

        $sql = "SELECT {$fields} FROM {$left} {$keyword} JOIN {$right} ON {$left}.{$localKey} = {$right}.{$foreignKey}";

        if (! is_null($id)){
            $sql .= " WHERE {$right}.{$foreignKey} IN ('{$id}')";
        }

        $statement = self::$connection->query($sql);

        $statement->setFetchMode(PDO::FETCH_OBJ);

        return $statement->fetchAll();
    }

    /**
     * @param array $data
     * @param $left
     * @param $keyword
     * @param $right
     * @return array
     */
    public static function joinOne($left, $keyword, $right, string $localKey, string $foreignKey, int $id = null, array $data = [])
    {
        self::$connection = self::connection();

        $left = TableMap::resolve($left);
        $right = TableMap::resolve($right);

        $fields = $left . '.*';
        if (! empty($data)){
            $fields = implode(', ', $data);
        }

        $sql = "SELECT {$fields} FROM {$left} {$keyword} JOIN {$right} ON {$left}.{$localKey} = {$right}.{$foreignKey}";

        if (! is_null($id)){
            $sql .= " WHERE {$right}.{$foreignKey} IN ('{$id}')";
        }

        $statement = self::$connection->query($sql);

        $statement->setFetchMode(PDO::FETCH_OBJ);

        return $statement->fetch();
    }

    /**
     * @param array $data
     * @param $left
     * @param $keyword
     * @param $right
     * @return array
     */
    public static function joinThrough($through, $left, $right, $firstKeyword, $secondKeyword, string $localKey, string $localForeignKey, string $throughLocalKey, string $foreignKey, int $id = null, array $data = []): array
    {
        self::$connection = self::connection();

        $left = TableMap::resolve($left);
        $through = TableMap::resolve($through);
        $right = TableMap::resolve($right);

        $fields = '';
        if (! empty($data)){
            $fields .= $left . "." . implode(', ', $data);
        }else{
            $fields = $left . '.*';
        }

        $sql = "SELECT {$fields} FROM {$left} {$firstKeyword} JOIN {$through} ON {$left}.{$localKey} = {$through}.{$localForeignKey} {$secondKeyword} JOIN {$right} ON {$through}.{$throughLocalKey} = {$right}.{$foreignKey}";

        if (! is_null($id)){
            $sql .= " WHERE {$right}.{$foreignKey} IN ('{$id}')";
        }

        $statement = self::$connection->query($sql);

        $statement->setFetchMode(PDO::FETCH_OBJ);

        return $statement->fetchAll();
    }

    /**
     * @param $id
     * @return bool
     */
    public static function delete($id)
    {
        self::$connection = self::connection();
        $table = TableMap::resolve(get_called_class());

        $sql = "DELETE FROM {$table} WHERE id = :id";

        $statement = self::$connection->prepare($sql);

        $statement->bindValue(':id', $id);

        return $statement->execute();
    }

    /**
     * @param $id
     * @return bool
     */
    public static function deleteHash($id)
    {
        self::$connection = self::connection();

        $sql = "DELETE FROM remembers WHERE user_id = {$id}";

        $statement = self::$connection->query($sql);

        return $statement->execute();
    }
}