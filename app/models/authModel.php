<?php

    /**
     * AuthModel 
     */

    class AuthModel extends Dmodel {

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
         * @desc    Get All Users ...
         */
        public function All($select = ['*'], $limit = 1 , $offset = LIMIT_PAGE_OFFSET) {

            if($select == "" || $select == null || $select == false || $select == [])  {
                $select = ['*'];
            }

            $limit = ($limit-1) * $offset;

            $select = implode(",", $select);
            $sql = $sql = "SELECT $select FROM ". $this->table ;
            $sql .= " INNER JOIN role ON $this->table.role_id = role.id ";
            $sql .= " WHERE $this->table.deleted_at IS NULL ORDER BY $this->table.id DESC LIMIT $limit," . $offset;

            // die($sql);

            $result = $this->db->select($sql);

            // die(print_r($result));
            return ($result);
        }

        /**
         * @desc    Get User By Id
         */
        public function findById($id, $select = ['*']) {
            if($select == "" || $select == null || $select == false || $select == [])  {
                $select = ['*'];
            }
            
            $select = implode(",", $select);
            $sql = "SELECT ${select} FROM ".$this->table;
            $sql .= " INNER JOIN role ON $this->table.role_id = role.id ";
            $sql .= " where $this->table.id=:id AND $this->table.deleted_at IS NULL";
            $data = [
                ":id" => $id
            ];

            return $this->db->select($sql, $data);
        }
        
        /**
         * @desc    Insert User By Id
         * @param data
         * @example data ["name" => $_POST['name'],"title" => $_POST['title']]
         */
        public function create($data) {
           return $this->db->insert($this->table, $data);
        }

        /**
         * @desc    Update User By COnd
         * @param data 
         * @example data [ 'name'=> 'name', 'pass'=> 'pass' ]
         * @param cond = Condition "WHERE id = 1"
         */
        public function update($data, $cond) {
            return $this->db->update($this->table, $data, $cond);
        }

        /**
         * @desc    DELETE User By Id
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
         * @desc    Get All Delete Users ...
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
        
        /**
         * @desc    FindByEmail And Password
         */
        public function findByEmail($email, $select) {
            
            if($select == "" || $select == null || $select == false || $select == [])  {
                $select = ['*'];
            }
            
            $select = implode(",", $select);
            $sql = "SELECT ${select} FROM ".$this->table;
            $sql .= " INNER JOIN role ON $this->table.role_id = role.id ";
            $sql .= " where $this->table.email=:email ";
            $data = [
                ":email" => $email
            ];

            // die($sql);

            return $this->db->select($sql, $data);
        }

    }

