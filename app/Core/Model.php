<?php


namespace App\Core;


use App\Maps\TableMap;
use PDO;

class Model
{
    protected static $connection;

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
            if ($key === 'password'){
                $value = password_hash($value, PASSWORD_DEFAULT);
            }

            $statement->bindValue(':' . $key, $value);
        }

        $statement->execute();

        return self::getLastInsertedRow($table, self::connection()->lastInsertId());
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