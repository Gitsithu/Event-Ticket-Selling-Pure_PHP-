<?php 

/**
 *  Load Controller 
 *  @desc To Load View & Response
 */

 class Load {

    function __construct() {

    }

    /**
     * @param $viewDir = View Directory [2Show ViewFile]
     */
    public function view ($viewDir, $data = false) {

        if($data == true) {
            // extract($data);
            // print_r($data);
        }

        // echo "View Function ${viewDir}";
        include "./app/views/${viewDir}.view.php";
    }

    /**
     * @param $modelsDir = View Directory [2Get Models]
     */
    public function model ($modelsDir) {
        // echo "View Function ${viewDir}";
        include "./app/models/${modelsDir}.php";
        $model = new $modelsDir;
        return $model;
    }

 }

