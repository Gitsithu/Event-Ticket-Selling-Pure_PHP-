<?php

    /**
     * Order Model [ Sample ]
     */

    class OrderModel extends Dmodel {

        public $table = 'orders';

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
            $sql = "SELECT $select FROM ". $this->table ;
            $sql .= " INNER JOIN order_status ON $this->table.status = order_status.id  " ;
            $sql .= " INNER JOIN user ON $this->table.user_id = user.id  " ;
            $sql .= " INNER JOIN ticket ON $this->table.ticket_id = ticket.id  " ;
            $sql .= " ORDER BY orders.id DESC LIMIT $limit," . $offset;

            // die($sql);
            $result = $this->db->select($sql);

            // die(print_r($result));
            return ($result);
        }

        /**
         * @desc    Get All Categories ...
         */
        public function getByUserId($select = ['*'], $id, $limit = 1 , $offset = LIMIT_PAGE_OFFSET) {

            if($select == "" || $select == null || $select == false || $select == [])  {
                $select = ['*'];
            }

            $limit = ($limit-1) * $offset;

            $select = implode(",", $select);
            $sql = "SELECT $select FROM ". $this->table ;
            $sql .= " INNER JOIN order_status ON $this->table.status = order_status.id  " ;
            $sql .= " INNER JOIN user ON $this->table.user_id = user.id  " ;
            $sql .= " INNER JOIN ticket ON $this->table.ticket_id = ticket.id  " ;
            $sql .= " WHERE orders.user_id=:id ";
            $sql .= " ORDER BY orders.id DESC LIMIT $limit," . $offset;

            $data = [
                ":id" => $id
            ];
            // die($sql);
            $result = $this->db->select($sql, $data);

            // die(print_r($result));
            return ($result);
        }

        /**
         * Get By Pending 
         */
        public function getByPendingStatus($select = ['*'], $status, $limit = 1 , $offset = LIMIT_PAGE_OFFSET) {

            if($select == "" || $select == null || $select == false || $select == [])  {
                $select = ['*'];
            }

            $limit = ($limit-1) * $offset;

            $select = implode(",", $select);
            $sql = "SELECT $select FROM ". $this->table ;
            $sql .= " INNER JOIN order_status ON $this->table.status = order_status.id  " ;
            $sql .= " INNER JOIN user ON $this->table.user_id = user.id  " ;
            $sql .= " INNER JOIN ticket ON $this->table.ticket_id = ticket.id  " ;
            $sql .= " WHERE orders.status=:status ";
            $sql .= " ORDER BY orders.id DESC LIMIT $limit," . $offset;

            $data = [
                ":status" => $status
            ];
            // die($sql);
            $result = $this->db->select($sql, $data);

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
            $sql = "SELECT ${select} FROM ".$this->table;
            $sql .= " INNER JOIN order_status ON $this->table.status = order_status.id  " ;
            $sql .= " INNER JOIN user ON $this->table.user_id = user.id  " ;
            $sql .= " INNER JOIN ticket ON $this->table.ticket_id = ticket.id  " ;
            $sql .= " WHERE orders.id=:id ";
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
        

    }

