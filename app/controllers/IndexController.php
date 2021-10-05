<?php

/**
 *  Index Controller
 */

 class Index extends Dcontroller {

    /**
     * Call Load Model From D Controller Constructor
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * @desc If User Call Only Controller
     *       & We Don't Get Method And Params
     *       & Default Method is Index();
     */
    public function index() {
        Middleware::isAuthForHome();
        // Asia/Rangoon
        // die(date_default_timezone_get());
        return $this->load->view('home');
    }

    public function home () {
        Middleware::isAuthForHome();
        // echo " Home Content From Index Controller <br> ";
        return $this->load->view('home');
    }

    public function getCat () {

        $CatModel = $this->load->model('catModel');
        $data["cat"] = $CatModel::All();

        $this->load->view('category', $data);

    }

 }