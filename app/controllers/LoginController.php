<?php

/**
 *  Login Controller
 */

 class Login extends Dcontroller {
    
    /**
     * @desc    Call Load Model From D Controller Constructor
     * @desc    Load -> View & Model Works parent::__construt()
     */
    function __construct() {
        parent::__construct();
    }

    function index() {
        $result = Middleware::LoginApi();

        if(!$result['isValid']) {
            die($this->json($result));
        }

        return die($this->json($result));
    }

    function check() {
        SESSION::init();
        if(SESSION::get('auth')) {
          return  die($this->json(['data'=>SESSION::get('auth')]));
        }
        return die($this->json(['errors'=>'CantFound'], 500));
    }


 }