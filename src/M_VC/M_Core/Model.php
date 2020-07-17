<?php

/**
 * This class handles all communication with the database and all it's functions are inherited by - 
 * it's sub classes.
 * 
 * @author Hebron Ncabane <muzi.hebron@gmail.com>
 * @github www.github.com/hebronOnline
 * @package M_VC 
 * @version 1.0.3
 * @copyright (c) 2020, www.hebronOnline.co.za 
 */

namespace App\M_Core;

abstract class Model
{
    public $conn;

    /**
     *	Constructor that opens a new database connection
     */
    function __construct()
    {
        $this->conn = Database::connect();
    }

    /**
     *	Quickly and easily insert a record to a table by passing key value pairs of the table object.
     *
     *	@param string $table - The name of the table to insert into
     *	@param array $obj - The DataObject / array of key value pairs of the table column structure
     *
     *	@return bool - True if successful, False if unsuccessful
     */
    protected function quick_insert($table, $obj)
    {
        $strSql = "INSERT INTO $table (";
        $arrSql = [];
        foreach ($obj as $column => $value) {
            $strSql .= "$column, ";
        }
        $strSql = \rtrim($strSql, ', ') . ") VALUES (";
        foreach ($obj as $column => $value) {
            $strSql .= ":$column, ";
            $arrSql[":$column"] = $value;
        }
        $strSql = \rtrim($strSql, ', ') . ");";

        return $this->modify($strSql, $arrSql);
    }

    /**
     *	Quickly and easily update a record in a table by passing key value pairs of the table object.
     *
     *	@param string $table - The name of the table to insert into
     *	@param int $id - the value of the primary key for this table
     *	@param array $obj - The DataObject / array of key value pairs of the table column structure
     *
     *	@return bool - True if successful, False if unsuccessful
     */
    protected function quick_update($table, $id, $obj)
    {
        $TableData     = $this->select("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'", null, true, true);
        $PrimaryKey = $TableData['Column_name'];

        $strSql = "UPDATE $table SET ";
        $arrSql = [];
        foreach ($obj as $column => $value) {
            $strSql .= "$column = :$column, ";
            $arrSql[":$column"] = $value;
        }
        $strSql = \rtrim($strSql, ', ') . " WHERE $PrimaryKey = $id";

        return $this->modify($strSql, $arrSql);
    }

    /**
     *	This function can either select a single row, multiple rows or just create a statement to be used with fetch later.
     *
     *	@param string $strSql - The SQL String \PDO format
     *	@param array $arrSql - The SQL \PDO Execute array
     *	@param string $stmt - Identifier for your statement, useful for inner SQL commands. Defaults to stmt
     *	@param bool $fetchNow - If true, record(s) returned immediately. Defaults to false
     *	@param bool $singleRow - Used together with $fetchNow. If true, the response is known to be a single row, otherwise it will be multiple rows
     *
     *	@return SQLStatement - The statement to be used with fetch.
     *	@return array - Single row from database or multiple rows from database
     */
    protected function select($strSql, $arrSql, $fetchNow = false, $singleRow = true, $stmt = 'stmt')
    {
        $defined[$stmt][0] = $this->_conn->prepare($strSql);
        $defined[$stmt][0]->execute($arrSql);

        if ($fetchNow) {
            if ($singleRow) {
                return $defined[$stmt][0]->fetch(\PDO::FETCH_ASSOC);
            } else {
                $rows = array();
                while ($row = $defined[$stmt][0]->fetch(\PDO::FETCH_ASSOC)) {
                    $rows[] = $row;
                }
                return $rows;
            }
        } else {
            return $defined[$stmt][0];
        }
    }

    /**
     *	This function will update, insert or delete records.
     *
     *	@param string $strSql - The SQL String \PDO format
     *	@param array $arrSql - The SQL \PDO Execute array
     *
     *	@return bool - True if successful, False if unsuccessful
     */
    protected function modify($strSql, $arrSql)
    {
        $stmt = $this->_conn->prepare($strSql);

        if ($stmt->execute($arrSql)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *	This function is used to select a single column from the database
     *
     *	@param string $strSql - The SQL String \PDO format
     *	@param array $arrSql - The SQL \PDO Execute array
     *
     *	@return any Database column
     */
    protected function query($strSql, $arrSql)
    {
        $stmt = $this->_conn->prepare($strSql);
        $stmt->execute($arrSql);
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchColumn();
        } else {
            return null;
        }
    }

    /**
     *	This function is used to get the row count of a query
     *
     *	@param string $strSql - The SQL String \PDO format
     *	@param array $arrSql - The SQL \PDO Execute array
     *
     *	@return int Row Count
     */
    protected function rowCount($strSql, $arrSql)
    {
        $stmt = $this->_conn->prepare($strSql);
        $stmt->execute($arrSql);
        return $stmt->rowCount();
    }

    /**
     *	Returns the last inserted record's Primary Key value from the database
     *
     *	@return int - Last inserted record primary key
     */
    protected function lastInsertId()
    {
        $stmt = $this->_conn->query("SELECT LAST_INSERT_ID()");
        return $stmt->fetchColumn();
    }
}
