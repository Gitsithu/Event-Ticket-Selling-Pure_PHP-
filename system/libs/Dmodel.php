<?php

/**
 * @desc D Model Is Get Private db From Database.Php
 * @desc For All Models that 'll be extend this .
 * @desc D for Destiny [ For Meaning ] 
 * @param DB_NAME,HOST_NAME,DB_USER,DB_PASS mean from config
 */

    class Dmodel {

        protected $db = array();

        public function __construct() {
    
            $dsn = "mysql:dbname=". DB_NAME . "; host=" . HOST_NAME ;

            $this->db = new Database($dsn, DB_USER , DB_PASS);
        }

    }