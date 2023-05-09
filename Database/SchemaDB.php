<?php

class SchemaDB
{
    const  SERVER_NAME = "localhost";
    const  USERNAME = "root";
    const  PASSWORD = "";
    const  DB_NAME = "scandi_test";
    protected $conn;

    public function databaseConnection()
    {
        $this->conn = new \mysqli(self::SERVER_NAME, self::USERNAME, self::PASSWORD, self::DB_NAME);

        if ($this->conn->connect_error) {
            return (['error_message' => 'Connection failed: ' . $this->conn->connect_error]);
        }
        return $this->conn;
    }


}