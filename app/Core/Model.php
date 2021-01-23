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
     * @param int $id
     * @return mixed
     */
    public static function find(int $id)
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
    public static function update(array $data, int $id)
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

        $statement->setFetchMode(PDO::FETCH_CLASS, TableMap::getClass($table));
        return $statement->fetch();
    }
}