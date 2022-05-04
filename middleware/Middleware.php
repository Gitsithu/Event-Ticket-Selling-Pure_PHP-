<?php

    /**
     *  Middleware Class
     */
    class Middleware {

        function __construct () {
            // Middle Ware Constructor
        }

        public static function LoginApi() {
            $result = Validation::LoginInput();
            /**
             * If Field Required
             * @return valid Error
             *  */ 
            if(!$result['isValid']) {
                return $result;
            }

            $authModel = include "./app/models/authModel.php";
            $model = new AuthModel();
            $result["data"] = $model->findByEmail($_POST["email"], [
                "user.*", 
                "role.name as role_name"
            ]);

            if(!count($result["data"])) {
                // die("no");
                $result["isValid"] = false;
                $result["errors"][] = "Email is Not Found";
                unset($result["data"]); 
                return $result;
            }
            
            // If You Get Email Result
            $result["data"] = $result["data"][0];

            if(!password_verify($_POST["password"], $result["data"]["password"])) {
                // die("no");
                $result["isValid"] = false;
                $result["errors"][] = "Password is Not Correct";
                unset($result["data"]); 
                return $result;
            } else {

                // If Banned
                if($result["data"]["deleted_at"] == true) {
                    $result["isValid"] = false;
                    $result["errors"][] = "Your Acc was Banned";
                    unset($result["data"]); 
                    return $result;
                }

                unset($result["errors"]);


                SESSION::init();
                SESSION::set('auth', [
                    "id" => $result["data"]["id"],
                    "name" => $result["data"]["name"],
                    "email" => $result["data"]["email"],
                    "image" => $result["data"]["image"],
                    "role_name" => $result["data"]["role_name"],
                    "role_id" => $result["data"]["role_id"]
                ]);

                return $result;
            }
           
            
        }

        public static function isAuthForHome() {

            SESSION::init();
            if(SESSION::get('auth') == false) {
                SESSION::destroy();
                return true;
            }  else {
                $User = SESSION::get('auth');
                header("Location:" . URL . "/" . $User["role_name"]);
                die();

            }

        }

        public static function isAuthForAdmin() {

            SESSION::init();
            if(SESSION::get('auth') == false) {
                SESSION::destroy();
                header("Location:" . URL . "/" );
                return true;
            }  else {
                $User = SESSION::get('auth');
                
                if( $User['role_name'] != 'admin') {
                    header("Location:" . URL . "/" );
                    return die("");
                }

                return true;
            }

        }

        public static function isAuthForCreator() {

             SESSION::init();
            if(SESSION::get('auth') == false) {
                SESSION::destroy();
                header("Location:" . URL . "/" );
                return true;
            }  else {
                $User = SESSION::get('auth');
                
                if( $User['role_name'] != 'creator') {
                    header("Location:" . URL . "/" );
                    return die("");
                }
                
                return true;
            }

        }

        public static function isAuthForUser() {

            SESSION::init();
           if(SESSION::get('auth') == false) {
               SESSION::destroy();
               header("Location:" . URL . "/" );
               return true;
           }  else {
               $User = SESSION::get('auth');
               
               if( $User['role_name'] != 'user') {
                   header("Location:" . URL . "/" );
                   return die("");
               }
               
               return true;
           }

       }

        public static function pass($str) {
            return base64_decode($str);
        }

    }
    