<?php

    /**
     * Admin Model [ Sample ]
     */

    class AdminModel extends Dmodel {

        public $table = 'user';

        /**
         * @desc    Constructor making Call Class new Database() 
         * @desc    From Extended Dmodel 
         * @desc    So You Can use $this->db  Like That
         */
        function __construct() {
            parent::__construct();
        }

        /**
         * @desc    Get All Categories ...
         */
        public function All($select = ['*'], $limit = 1 , $offset = LIMIT_PAGE_OFFSET) {

            if($select == "" || $select == null || $select == false || $select == [])  {
                $select = ['*'];
            }

            $limit = ($limit-1) * $offset;

            $select = implode(",", $select);
            $sql = $sql = "SELECT $select FROM ". $this->table ;
            $sql .= " WHERE deleted_at IS NULL ORDER BY id ASC LIMIT $limit," . $offset;

            $result = $this->db->select($sql);

            // die(print_r($result));
            return ($result);
        }

        /**
         * @desc    Get Categorie By Id
         */
        public function findById($id, $select = ['*']) {

            if($select == "" || $select == null || $select == false || $select == [])  {
                $select = ['*'];
            }

            $select = implode(",", $select);
            $sql = "SELECT ${select} FROM ".$this->table." where id=:id AND deleted_at IS NULL";
            $data = [
                ":id" => $id
            ];

            return $this->db->select($sql, $data);

            // $stmt = $this->db->prepare($sql);
            // $stmt->bindParam(":id", $id);
            // $stmt->execute();
    
            // return ($stmt->fetch($this->db::FETCH_ASSOC));
        }
        
        /**
         * @desc    Insert Categorie By Id
         * @param data
         * @example data ["name" => $_POST['name'],"title" => $_POST['title']]
         */
        public function create($data) {
           return $this->db->insert($this->table, $data);
        }

        /**
         * @desc    Update Categorie By COnd
         * @param data 
         * @example data [ 'name'=> 'name', 'pass'=> 'pass' ]
         * @param cond = Condition "WHERE id = 1"
         */
        public function update($data, $cond) {
            return $this->db->update($this->table, $data, $cond);
        }

        /**
         * @desc    DELETE Categorie By Id
         */
        public function deleteById($id) {
            $cond = " id=${id} ";
            // die("$cond");
            $table = $this->table;
            return $this->db->delete($table, $cond);
        }

        /**
         * @desc    Get PageCount
         */
        public function pageCount($table, $cond = '', $limitPageOffset = LIMIT_PAGE_OFFSET) {
           
            if(
                $limitPageOffset == "" || 
                $limitPageOffset == null || 
                $limitPageOffset == false || 
                $limitPageOffset == []
            ) {
                $limitPageOffset = LIMIT_PAGE_OFFSET;
            }

            return $this->db->pageCount($table, $cond, $limitPageOffset);
        }
         /**
         * @desc    Get All DELETE Categories ...
         */
        public function AllDelete($select = ['*'], $limit = 1 , $offset = LIMIT_PAGE_OFFSET) {

            if($select == "" || $select == null || $select == false || $select == [])  {
                $select = ['*'];
            }

            $limit = ($limit-1) * $offset;

            $select = implode(",", $select);
            $sql = $sql = "SELECT $select FROM ". $this->table ;
            $sql .= " WHERE deleted_at IS NOT NULL ORDER BY id DESC LIMIT $limit," . $offset;

            $result = $this->db->select($sql);

            // die(print_r($result));
            return ($result);
        }

        public function dashBoard($sql, $cond ) {
            // die($cond);
            return $this->db->allGet($sql, $cond);
        } 
        

    }

