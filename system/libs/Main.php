<?php

    # Main Class 

    class Main {

        public $url ;
        public $controllerName = "Index";
        public $methodName = "index";
        public $controllerPath = "./app/controllers/";
        public $controller;

        public function __construct() {

            // Getting Url
            $this->getURL();

            // Load Controller
            $this->loadController();

            // Call Method
            $this->callMethod();

        }

        /**
         * Getting Routes Url
         * @param url [array] like controller/method/params
         */ 
        public function getURL() {
            $this->url = isset($_GET['url']) ? $_GET['url'] : null ;

            if($this->url === null) {
                unset($this->url);
            } else {
                $this->url = rtrim($this->url, "/");
                // Filter URL with Filter_Var BuildInMethod
                $this->url = explode("/", filter_var($this->url, FILTER_SANITIZE_URL));
            }
        }

        /**
         * Load Controller
         */
        public function loadController() {
            
            // If donesn't Have Controller Name 
            if(!isset($this->url[0])) {
                include $this->controllerPath . $this->controllerName . "Controller.php";
                $this->controller = new $this->controllerName();
            } else {
                /**
                 *  If You Get Controller Name From 
                 *  @param url[0] is Controller
                 */
                $this->controllerName = $this->url[0];
                $fileName = $this->controllerPath . $this->controllerName . "Controller.php";
                
                // If File Exist
                // Mean ControllerName-Controller.php isExists
                if(file_exists($fileName)) {
                    include $fileName;

                    // If Class Exists
                    if(class_exists($this->controllerName)) {
                        $this->controller = new $this->controllerName ();
                    } else {
                    // If Class Is Not Exists
                        header("Location:" . URL . "/");
                        die(); // Redirect Home Directory
                    }
                    
                } else {
                // If File Not Found
                // Mean ControllerName-Controller.php isNotExists
                    header("Location:" . URL . "/");
                    die(); // Redirect Home Directory
                }


            }
        }

        /**
         * Call Method
         */
        public function callMethod() {
            // If Url Give Params
            if(isset($this->url[2])) {
                // First Call Method
                $this->methodName = $this->url[1];

                /**
                 * Check MethodExists
                 */
                if(method_exists($this->controller, $this->methodName)) {
                    $this->controller->{$this->methodName}( $this->url[2] );
                } else {
                    // Method Not Exists
                    header("Location:" . URL . "/");
                    die(); // Redirect Home Directory
                }

            } else {
            // If Url Not Given Params 
            // Url[2] doesn't exists

                /**
                 * If isset URL 1 
                 * Mean Url[1] Method
                 */
                if(isset($this->url[1])) {

                    $this->methodName = $this->url[1];

                    if(method_exists($this->controller, $this->methodName)) {
                        $this->controller->{$this->methodName}();
                    } else {
                        // Method Not Exists
                        header("Location:" . URL . "/");
                        die(); // Redirect Home Directory
                    }

                } else {
                    // If Method is Not Give 
                    // We Direct to Index method
                    // Default $this->methodName = "index";
                    if(method_exists($this->controller, $this->methodName)) {
                        $this->controller->{$this->methodName}();
                    } else {
                        // Method Not Exists
                        header("Location:" . URL . "/");
                        die(); // Redirect Home Directory
                    }
                }

            }
        }

    }