<?php

/**
 * @desc DController Is Get Private Load From Load.Php
 * @desc For All Controller that 'll be extend this .
 * @desc D for Destiny [ For Meaning ]
 */

 class Dcontroller {

    protected $load = array();

    function __construct () {
        // echo " D Controller In LIbs From Parent~!!<br> ";
        $this->load = new Load();
    }

    /**
     * Return Json for Rest Api
     */
    public function json($jsonData = array(), $status = 200) {
        header('Content-Type: application/json');
        http_response_code($status);

        return json_encode($jsonData);
    }

 }