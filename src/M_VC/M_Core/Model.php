<?php

/**
 * This class handles all communicaiton with the database
 */

namespace App\M_Core;

abstract class Model {
			
    public $conn;
    
    /**
     *	Constructor that opens a new database connection
    */
    function __construct() {
        $this->conn = Database::connect();
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
    
    protected function SELECT($strSql, $arrSql, $fetchNow = false, $singleRow = true, $stmt = 'stmt') {
        
        $defined{$stmt}[0] = $this->conn->prepare($strSql);
        $defined{$stmt}[0]->execute($arrSql);
        
        if ($fetchNow) {
            if ($singleRow) {
                return $defined{$stmt}[0]->fetch(\PDO::FETCH_ASSOC);
            } else {
                $rows = array();
                while ($row = $defined{$stmt}[0]->fetch(\PDO::FETCH_ASSOC)) {
                    $rows[] = $row;
                }
                return $rows;
            }
        } else {
            return $defined{$stmt}[0];
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
    protected function MODIFY($strSql, $arrSql) {
        $stmt = $this->conn->prepare($strSql);
        
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
    protected function QUERY($strSql, $arrSql) {
        $stmt = $this->conn->prepare($strSql);
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
    function ROW_COUNT($strSql, $arrSql) {
        $stmt = $this->conn->prepare($strSql);
        $stmt->execute($arrSql);
        return $stmt->rowCount();
    }
    
    /**
     *	Returns the last inserted record's Primary Key value from the database
    *
    *	@return int - Last inserted record primary key
    */
    protected function GET_LAST_INSERT() {
        $stmt = $this->conn->query("SELECT LAST_INSERT_ID()");
        return $stmt->fetchColumn();
    }

    /**
     *	Returns the remaining size of the database
    *
    *	@return int - remaining size
    */
    protected function FREE_SPACE() {
        $stmt = $this->conn->query("SELECT 
                                    COUNT(TABLE_SCHEMA) AS Total_Tables, 
                                    ROUND(SUM(data_length + index_length) / 1024 / 1024) AS DBSize_MB,
                                    ROUND(SUM(data_free) / 1024 / 1024) AS FreeSpace_MB
                                    FROM information_schema.TABLES 
                                    WHERE TABLE_SCHEMA = 'QNoFines'
                                    GROUP BY TABLE_SCHEMA;");
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
