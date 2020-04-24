<?php

declare(strict_types=1);

class DB
{
    protected static ?PDO $instance = null;

    protected function __construct() {}
    protected function __clone() {}

    public static function instance()
    {
        if (self::$instance === null)
        {
            $opt  = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => FALSE,
            );
            $dsn = 'mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'].';charset='.$_ENV['DB_CHAR'];
            self::$instance = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], $opt);
        }
        return self::$instance;
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(self::instance(), $method), $args);
    }

    public static function run($sql, $args = [])
    {
        if (!$args)
        {
            return self::instance()->query($sql);
        }
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    public static function escape_mysql($field)
    {
        return "`".str_replace("`", "``", $field)."`";
    }

    public static function insert($table, $data)
    {
        $keys = array_keys($data);
        //$keys = array_map(array(self::instance(),'escape_mysql'), $keys);
        $fields = implode(",", $keys);
        //$table = self::instance()->escape_mysql($table);
        $placeholders = str_repeat('?,', count($keys) - 1) . '?';
        $sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
        self::instance()->prepare($sql)->execute(array_values($data));
    }
}
