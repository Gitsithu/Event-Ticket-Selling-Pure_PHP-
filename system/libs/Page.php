<?php

/**
 * 
 * Page Class 
 * 
 */

 class Page {


    /**
     *@desc getPage() Mean to Define Paginate 
     */ 
    public static function getPage() {

        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $page = $_GET['page'] <= 0 ? 1 : $_GET['page'];
        } else {
            $page = 1;
        }

        return $page;
    }

 }