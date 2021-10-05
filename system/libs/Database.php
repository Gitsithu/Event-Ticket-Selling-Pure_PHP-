<?php

/**
 * @desc Database Class For PDO 
 * @desc Main Database 
 */

class Database extends PDO {

    // Constructor Function Make Connect Database
    function __construct($dsn, $user, $pass) {
        try { 
            parent::__construct($dsn, $user, $pass);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    /**
     * @param sql Example "SELECT * FROM TableName" 
     * @param fetchStyle mean Out Style Associated Arr, Numeric Arr
     * @param data mean selector Data for Binding
     * @example [
     *              ":id" => 1
     *          ]
     */
    public function select ($sql, $data = array(), $fetchStyle = parent::FETCH_ASSOC) {
        
        $stmt = $this->prepare($sql);

        $stmt->execute($data);
        return $stmt->fetchAll($fetchStyle);
    }

    /**
     * @param table "TableName"
     * @param data Example "INSERT INTO TableName('name','title') VALUES (':name',':title')"
     * @example Given Parmas [
     *              "name" => $_POST['name'],
     *              "title" => $_POST['title']
     *          ]
     * @example first Array for Keys        "name, title"
     *          Second Array for Values     ":name, :title"
     */
    public function insert($table, $data) {

        // name, value
        $keys = implode(", ", array_keys($data));
        // :name :value
        $values = ":". implode(", :", array_keys($data));
        
        // $stmt->bindParam(":name", $data["name"]);
        // $stmt->bindParam(":title", $data["title"]);
       

        $sql = "INSERT INTO $table( $keys ) VALUES( $values )";
        $stmt = $this->prepare($sql);
        $arr =[];
        foreach($data as $key => $value) {
            $arr[":$key"]= $value;
        }
        // die($sql);

        // die(print_r($arr));
        // die("table ${table}");
        $result = $stmt->execute($arr);
        if($result) {
            $data["id"] = $this->lastInsertId();
            return [
                "status"=> true,
                "data"=> $data
            ];
        } else {
            return [
                "status"=> false,
            ];
        }
    }

    /**
     * @param table "TableName"
     * @param cond Mean Condition 
     * @example WHERE id = 1 ??
     * @param data Example "UPDATE TableName SET name=:name, title=:title WHERE cond "
     * @example Given Parmas [
     *              "name" => $_POST['name'],
     *              "title" => $_POST['title']
     *          ]
     * @example toChange name=:name, title=:title
     */

    public function update($table, $data, $cond) {

        $updateKeys = NULL;
        // to Get name=:name,
        foreach($data as $key => $value) {
            $updateKeys .= "${key}=:${key},";
        };
        /**
         *  if name=:name, password=:password, 
         *  We DOn't Need Last Comma **,**
         */        
        $updateKeys = rtrim($updateKeys, ',');

        $sql = "UPDATE ${table} SET ${updateKeys} WHERE ${cond}";
        $stmt = $this->prepare($sql);
        $arr = [];
        foreach($data as $key => $value) {
            $arr[":$key"]= $value;
            // $stmt->bindParam(":${key}", $value);
        }

        return $stmt->execute($arr);

    }

    /**
     * @param table "TableName"
     * @param cond Mean Condition 
     * @example WHERE id = 1 ??
     * @param data Example "DELETE FROM `TableName` WHERE `cond` LIMIT `limit`"
     */
    public function delete($table, $cond) {
        $sql = "UPDATE ${table} SET `deleted_at`=:del WHERE ${cond} ";
        $del = "NOW()";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(":del", $del);
        return $stmt->execute();

        // ForceDelete Below
        // $sql = "DELETE FROM ${table} WHERE ${cond} LIMIT ${limit}";
    }

    /**
     * @param table "TableName"
     * @param cond Mean Condition 
     * @example WHERE id = 1 ??
     * @param exec Example ["id","name"]
     * Executive Array 
     */
    public function affectedRow($sql, $execArr = []) {
        $stmt = $this->prepare($sql);
        $stmt->execute($execArr);
        return $stmt->rowCount();
        // ForceDelete Below
        // $sql = "DELETE FROM ${table} WHERE ${cond} LIMIT ${limit}";
    }

    /**
     * @param table "TableName"
     * @desc 
     * @return Count_Of_Pages Numeric
     */
    public function pageCount($table, $cond = '', $limitPageOffset = LIMIT_PAGE_OFFSET) {
        
        $sql = "SELECT COUNT(*) FROM $table $cond";
        // $sql = "SELECT COUNT(*) FROM $table WHERE `deleted_at` IS NULL";
        // die($sql);

        $stmt = $this->prepare($sql);
        $stmt->execute();
        $no_of_row = $stmt->fetchColumn();
        $total_pages = ceil($no_of_row / $limitPageOffset);

        return $total_pages ;
    }

    /**
     *  
     * All Get 
     * 
     */

    public function allGet($table, $cond) {
        // die($cond);
        $sql = "SELECT COUNT(*) FROM $table $cond"; 
        // die($table);
        $stmt = $this->prepare($sql);
        $stmt->execute();
        $no_of_row = $stmt->fetchColumn();
        return $no_of_row;
    }
    
}