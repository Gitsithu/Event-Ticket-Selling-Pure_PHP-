<?php

/**
 * Category Model
 */

 class CatModel {

    function __construct() {
        // echo " Get All CatModel";
    }

    // Get ALL Method catModel
    public static function All(){
        return  array(
                    array(
                        "catOne" =>  "Education",
                        "catTwo" =>  "Poweranger"
                    ),
                    array(
                        "catOne" =>  "Education",
                        "catTwo" =>  "Poweranger"
                    )
            );
    }

 }