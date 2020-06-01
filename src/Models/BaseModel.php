<?php

namespace App\Models;

use Framework\Database\Connection;

class BaseModel extends Connection
{
    protected $conn;
    protected $table = '';
    protected $query;
    protected $fillable = [];
    protected $data = [];

    /**
     * BaseModel constructor.
     * Comunication database
     */
    public function __construct()
    {

    }

    /**
     * @return array
     * Method get all record and return array record
     *
     **/
    public function all()
    {
        $this->query = 'SELECT * FROM '.$this->table ;
        $tableList = array();
        $this->data = $this->query($this->query);
        while ($row = $this->data->fetch_assoc()) {
            array_push($tableList, $row);
        }
        return $tableList;
    }
    public function GetLimit($start,$recordinPage)
    {
        $this->query = "SELECT * FROM $this->table  LIMIT $start,$recordinPage" ;
        $tableList = array();
        $this->data = $this->query($this->query);
        while ($row = $this->data->fetch_assoc()) {
            array_push($tableList, $row);
        }
        return $tableList;
    }
    public  function getPage()
    {
        $this->query = 'SELECT * FROM' .$this->table;
        $this->data = $this->query($this->query);
        $total =mysqli_num_rows($this->data);


    }

    /**
     * Method to search data by id
     *
     * @param $condition
     *
     * @return $this
     */
    public function find($id)
    {
        $this->query = "SELECT * FROM " . $this->table . " where id=" . $id;
        $this->data = $this->query($this->query);
        return $this;
    }

    /**
     * Method count number record by id
     * @param $id
     * @return $this
     */

    public function count($id)
    {
        $this->query = "SELECT COUNT('id') FROM" . $this->table;
        return $this;
    }

    /**
     * Method get all record by Condition
     * @param array $condition
     * @return $this
     */
    public function where(array $condition)
    {
        $where = '';
        $this->query = 'SELECT * FROM ' . $this->table . ' WHERE ';
        foreach ($condition as $key => $value) {
            $where .= $key . " ='" . $value . "' AND ";
        }
        $where = rtrim($where, 'AND ');
        $this->query = $this->query . $where;

        $this->data = $this->query($this->query);
        return $this;
    }

    /**
     * Method create a record with arr[$data]
     * @param array $data
     */

    public function create(array $data)
    {

        $firstQuery = 'INSERT INTO ' . $this->table . ' (' . implode(',', $this->fillable) . ')';

        $data = $this->sortDataWithColumns($data);

        $insertQuery = $firstQuery . ' VALUES (' . implode(',', $data) . ')';
        $this->data = $this->query($insertQuery);

        /*If create was successly then get the new record is inserted*/
        $this->where(['id' => $this->data]);

        $this->query = $insertQuery;

        return $this;

    }

    /**
     * @param array $data
     * @param $id
     * @return $this
     */
    public function update(array $data, $id)
    {
        // add update_at
        $data["updated_at"] = date('Y-m-d H:i:s');
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key='$value',";
        }

        $set = substr($set, 0, -1);
        $query = "UPDATE $this->table SET $set WHERE id = $id";

        $this->query($query);
        return $this;
    }

    /**
     * @param $name
     * @return array
     */

    public function search($name)
    {
        $this->query = "SELECT * FROM " . $this->table . " WHERE name LIKE '%$name%'";
        $this->data = $this->query($this->query);
        $tableList = array();
        while ($row = $this->data->fetch_assoc()) {
            array_push($tableList, $row);
        }
        return $tableList;
    }

    /**
     * @param $id
     * @return $this
     */
    public function delete($id)
    {
        $this->query = 'DELETE FROM ' . $this->table . ' WHERE id =' . $id;
        $this->query($this->query);
        return $this;
    }

    /**
     * @param $column
     * @param array $paramArray
     * @return $this
     */

    public function destroy($column, array $paramArray)
    {
        $this->query = 'DELETE FROM ' . $this->table . ' WHERE ' . $column . ' IN (\'' . implode('\',\'', $paramArray) . '\')';
        $this->data = $this->query($this->query);
        return $this;
    }


    /**
     * Method to get data from object
     * Return array data in object
     *
     **/
    public function get()
    {
        return $this->data->fetch_assoc();
    }

    /**
     * Method to get data from aray(object)
     * Return array data in object
     * @return array
     */

    public function getarr()
    {
        $tableList = [];
        while ($row = $this->data->fetch_assoc()) {
            array_push($tableList, $row);
        }
        return $tableList;
    }

    /**
     * @param $columns
     * @param string $sort
     * @return $this
     */
    public function getAllOrderBy($columns, $sort = 'ASC')
    {
        if (!is_array($columns)) {
            $columns = [$columns];
        }
        $this->query = "SELECT * FROM `$this->table`ORDER BY " . implode(',', $columns) . ' ' . $sort;

        $this->data = $this->query($this->query);
        return $this;
    }

    /**
     * @param array $data
     * @return array
     */
    public function sortDataWithColumns(array $data)
    {
        $newArray = [];
        foreach ($this->fillable as $key => $value)
        {
            if (empty($data[$value]))
            {
                $newArray[$value] = 'null';
            } else {
                $newArray[$value] = "'".$data[$value]."'";
            }
        }
        return $newArray;
    }
}