<?php

namespace Framework\Database;

use mysql_xdevapi\Exception;

class Connection
{
    const HOST = "localhost";
    const USER = "admins";
    const PASSWORD = "admin";
    const DATABASE_NAME = "SideProject";
    private $conn;

    /**
     * Method connect database
     * @return false|\mysqli
     */
    final private function connect()
    {
        try {

            $this->conn = mysqli_connect(self::HOST, self::USER, self::PASSWORD, self::DATABASE_NAME);
            mysqli_set_charset($this->conn, 'utf-8');

            if ($this->conn->connect_error) {
                throw new Exception('The connection is failed');
            }
            return $this->conn;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * Method  disconnect database
     * @return bool
     */

    final private function disConnect()
    {
        if (is_null($this->conn)) {
            die("The connection is not defined.");
        }
        return mysqli_close($this->conn);
    }

    /**
     * Method base query
     * @param $query
     * @return bool|mysqli_result
     */
    public function query($query)
    {

        $this->connect();


        $result = mysqli_query($this->conn, $query);
        /*If insert record then get new insert id*/
        if ($result === true) {
            $result = $this->conn->insert_id;
        }

        try {
            if (is_null($result)) {
                throw new \Exception($this->conn->error . "<br/>SQL(" . $query . ")", 1);
            }
        } catch (\Exception $e) {
            die($e->getMessage());
        }


        $this->disConnect();

        return $result;
    }
}