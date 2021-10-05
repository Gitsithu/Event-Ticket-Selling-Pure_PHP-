<?php

/**
 * Events Controller 
 * @desc Extend From Dcontroller to Control Params
 */

 class Events extends Dcontroller{

    /**
     * Call Load Model From D Controller Constructor
     */
    function __construct  () {
        parent::__construct();
    }

    /**
     * @desc If User Call Only Controller
     *       & We Don't Get Method And Params
     *       & Default Method is Index();
     */
    function index() {
        return false;
    }


    function getAll ($params = null) {
        $param = isset($params) ? $params : '';
        echo "Get All Events <br>  ${param}";
    }

 }