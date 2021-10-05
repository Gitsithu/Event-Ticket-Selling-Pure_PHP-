<?php

/**
 *  Logout Controller
 */

 class Logout extends Dcontroller {
    
    /**
     * @desc    Call Load Model From D Controller Constructor
     * @desc    Load -> View & Model Works parent::__construt()
     */
    function __construct() {
        parent::__construct();
    }

    function index() {
        SESSION::init();
        SESSION::destroy();
        
        header("Location: " . URL . "/");
        die();
        return die("");
    }

 }