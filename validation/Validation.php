<?php

/**
 * Validation Class
 */

 class Validation {

    function __construct() {
        // Nothing Doing
        // echo "Validation Calling";
    }


    // User Create Input Validation
    public static function UserInput() {
        $errors = array();

        if(
            !isset($_POST['name']) ||
            !isset($_POST['email']) ||
            !isset($_POST['password']) ||
            !isset($_POST['phone']) 
        )
        {
            // If Name Null
            if (!isset($_POST['name'])) {
                $errors[] = "Name Field is Required";
            }

            // If Email Null
            if (!isset($_POST['email'])) {
                $errors[] = "email Field is Required";
            }

            // If Password Null
            if (!isset($_POST['password'])) {
                $errors[] = "password Field is Required";
            }

            // If Phone Null
            if (!isset($_POST['phone'])) {
                $errors[] = "phone Field is Required";
            }
            
        } else {

            if (!stristr($_POST['email'],"@") OR !stristr($_POST['email'],".")) {
                $errors[] = "Email is not Valid";
            } 

            if (strlen($_POST['password'])<6) {
                $errors[] = "Password less than 6";
            }

            if (trim($_POST['name']) == '') {
                $errors[] = "Name is Required";
            }

            if (trim($_POST['email']) == '') {
                $errors[] = "Email is Required";
            }


            if (trim($_POST['phone']) == '') {
                $errors[] = "Phone is Required";
            }

        }


        return [
            "errors" => $errors,
            "isValid" => count($errors)==0
        ];
    }


    // User Create Input Validation
    public static function LoginInput() {
        $errors = array();

        if(
            !isset($_POST['email']) ||
            !isset($_POST['password']) 
        )
        {
            // If Email Null
            if (!isset($_POST['email'])) {
                $errors[] = "email Field is Required";
            } 


            // If Password Null
            if (!isset($_POST['password'])) {
                $errors[] = "password Field is Required";
            }

        } else {
            
            if (!stristr($_POST['email'],"@") OR !stristr($_POST['email'],".")) {
                $errors[] = "Email is not Valid";
            } 

            if (strlen($_POST['password'])<6) {
                $errors[] = "Password less than 6";
            }


        }

        return[
            "errors" => $errors,
            "isValid" => count($errors)==0 ? true: false
        ];
    }

    // Profile Image Input Validation
    public static function ProfileImageInput() {
        $errors = array();

        if(
            !isset($_FILES['file']['tmp_name']) ||
            !isset($_POST["id"])
        )
        {   
            if(!isset($_FILES['file']['tmp_name'])) {
                $errors[] = "File Field is Required";
            }

            if(!isset($_POST["id"])) {
                $errors[] = "Id Field is Required";
            }

        } else {
            $file = $_FILES["file"]["tmp_name"];
            if($check = @getimagesize($file)) {
                // Check Image True But If Error Occur We Show Errors
                
                    // Allowed Extension
                    $allowed =  ['png', 'jpg', 'jpeg'];
                
                    // Get Origininal File's Extension
                    $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                
                    if( in_array($ext, $allowed) ) {
                        // Image Type is Allowed in Array
                        
                        // Check file size
                        $KB = ($_FILES["file"]["size"]/1024);
                       
                        if (($KB/1024) > 2) {
                            $errors[] = "Sorry, your file is Larger Than 2Mb .";
                        }
                
                
                    } else {
                        // Not Image In Array
                       $errors[] = "$ext".  " JPG, PNG files Not Found In Image Array"; 
                    }
            
            } else {
                $errors[] = "Only JPG & PNG files R allowed But Your " . $_FILES["file"]["name"];
            }
    

        }

        return[
            "errors" => $errors,
            "isValid" => count($errors)==0 ? true: false
        ];
    }

    // Ticket Inupt Validation 
    public static function TicketInput() {
        $errors = [];
        if(
            !isset($_POST['title']) ||
            !isset($_POST['description']) ||
            !isset($_POST['address']) ||
            !isset($_POST['location_id']) ||
            !isset($_POST['event_category_id']) ||
            !isset($_POST['user_id']) ||
            !isset($_POST['start_date']) ||
            !isset($_POST['end_date']) ||
            !isset($_POST['free_ticket']) ||
            // !isset($_POST['image']) ||
            // !isset($_POST['status']) ||
            !isset($_POST['ga']) ||
            !isset($_POST['ga_price']) ||
            !isset($_POST['ga_quantity']) ||
            !isset($_POST['vip']) ||
            !isset($_POST['vip_price']) ||
            !isset($_POST['vip_quantity']) ||
            !isset($_POST['vvip']) ||
            !isset($_POST['vvip_price']) ||
            !isset($_POST['vvip_quantity']) ||
            !isset($_FILES['file']['tmp_name'])
        )
        {
            if(!isset($_FILES['file']['tmp_name'])) {
                $errors[] = "File Field is Required";
            }
           
            // If Name Null
            if (!isset($_POST['title'])) {
                $errors[] = "title Field is Required";
            }
            if (!isset($_POST['description'])) {
                $errors[] = "description Field is Required";
            }
            if (!isset($_POST['address'])) {
                $errors[] = "address Field is Required";
            }
            if (!isset($_POST['location_id'])) {
                $errors[] = "location_id Field is Required";
            }
            if (!isset($_POST['event_category_id'])) {
                $errors[] = "event_category_id Field is Required";
            }
            if (!isset($_POST['user_id'])) {
                $errors[] = "user_id Field is Required";
            }
            if (!isset($_POST['start_date'])) {
                $errors[] = "start_date Field is Required";
            }
            if (!isset($_POST['end_date'])) {
                $errors[] = "end_date Field is Required";
            }
            if (!isset($_POST['free_ticket'])) {
                $errors[] = "free_ticket Field is Required";
            }

            // if (!isset($_POST['status'])) {
            //     $errors[] = "status Field is Required";
            // }

            if (!isset($_POST['ga'])) {
                $errors[] = "ga Field is Required";
            }
            if (!isset($_POST['ga_price'])) {
                $errors[] = "ga_price Field is Required";
            }
            if (!isset($_POST['ga_quantity'])) {
                $errors[] = "ga_quantity Field is Required";
            }
            if (!isset($_POST['vip'])) {
                $errors[] = "vip Field is Required";
            }
            if (!isset($_POST['vip_price'])) {
                $errors[] = "vip_price Field is Required";
            }
            if (!isset($_POST['vip_quantity'])) {
                $errors[] = "vip_quantity Field is Required";
            }
            if (!isset($_POST['vvip'])) {
                $errors[] = "vvip Field is Required";
            }
            if (!isset($_POST['vvip_price'])) {
                $errors[] = "vvip_price Field is Required";
            }
            if (!isset($_POST['vvip_quantity'])) {
                $errors[] = "vvip_quantity Field is Required";
            }
         
            
        } else {

            if (trim($_POST['title']) == '') {
                $errors[] = "Title is Required";
            }

            if (strlen($_POST['title']) < 3) {
                $errors[] = "Title less than 3";
            }

            if (trim($_POST['description']) == '') {
                $errors[] = "Description is Required";
            }

            if (strlen($_POST['description']) < 3) {
                $errors[] = "Description less than 3";
            }

            if (trim($_POST['address']) == '') {
                $errors[] = "Address is Required";
            }

            if (strlen($_POST['address']) < 3) {
                $errors[] = "Address less than 3";
            }

            if (trim($_POST['location_id']) == '') {
                $errors[] = "Location is Required";
            }

            if (trim($_POST['event_category_id']) == '') {
                $errors[] = "Event Category is Required";
            }

            if (trim($_POST['user_id']) == '') {
                $errors[] = "User is Required";
            }

            if (trim($_POST['start_date']) == '') {
                $errors[] = "Start Date is Required";
            }

            if (trim($_POST['end_date']) == '') {
                $errors[] = "End Date is Required";
            }

            if (trim($_POST['free_ticket']) == '') {
                $errors[] = "Free Ticket is Required";
            }

            if (trim($_POST['ga']) == '') {
                $errors[] = "Ga is Required";
            }

            if (trim($_POST['ga_price']) == '') {
                $errors[] = "Ga Price is Required";
            }

            if (trim($_POST['ga_quantity']) == '') {
                $errors[] = "Ga Quantity is Required";
            }

            if (trim($_POST['vip']) == '') {
                $errors[] = "Vip is Required";
            }

            if (trim($_POST['vip_price']) == '') {
                $errors[] = "Vip Price is Required";
            }

            if (trim($_POST['vip_quantity']) == '') {
                $errors[] = "Vip Quantity is Required";
            }

            if (trim($_POST['vvip']) == '') {
                $errors[] = "Vvip is Required";
            }

            if (trim($_POST['vvip_price']) == '') {
                $errors[] = "Vvip Price is Required";
            }

            if (trim($_POST['vvip_quantity']) == '') {
                $errors[] = "Vvip Quantity is Required";
            }

            $file = $_FILES["file"]["tmp_name"];
            if($check = @getimagesize($file)) {
                // Check Image True But If Error Occur We Show Errors
                
                    // Allowed Extension
                    $allowed =  ['png', 'jpg', 'jpeg'];
                
                    // Get Origininal File's Extension
                    $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
                
                    if( in_array($ext, $allowed) ) {
                        // Image Type is Allowed in Array
                        
                        // Check file size
                        $KB = ($_FILES["file"]["size"]/1024);
                       
                        if (($KB/1024) > 2) {
                            $errors[] = "Sorry, your file is Larger Than 2Mb .";
                        }
                
                
                    } else {
                        // Not Image In Array
                       $errors[] = "$ext".  " JPG, PNG files Not Found In Image Array"; 
                    }
            
            } else {
                $errors[] = "Only JPG & PNG files R allowed But Your " . $_FILES["file"]["name"];
            }

        }

        
        return [
            "errors" => $errors,
            "isValid" => count($errors)==0
        ];
    }

    // Ticket Inupt Validation 
    public static function OrderInput() {
        $errors = [];
        if(
            !isset($_POST['ticket_id']) ||
            !isset($_POST['user_id']) ||
            !isset($_POST['image']) ||
            !isset($_POST['ga']) ||
            !isset($_POST['ga_price']) ||
            !isset($_POST['ga_quantity']) ||
            !isset($_POST['vip']) ||
            !isset($_POST['vip_price']) ||
            !isset($_POST['vip_quantity']) ||
            !isset($_POST['vvip']) ||
            !isset($_POST['vvip_price']) ||
            !isset($_POST['vvip_quantity']) ||
            !isset($_POST['total_price'])
        )
        {
            // If Name Null
            if (!isset($_POST['ticket_id'])) {
                $errors[] = "Ticket_Id Field is Required";
            }
            if (!isset($_POST['user_id'])) {
                $errors[] = "user_id Field is Required";
            }
            if (!isset($_POST['image'])) {
                $errors[] = "image Field is Required";
            }
            if (!isset($_POST['ga'])) {
                $errors[] = "ga Field is Required";
            }
            if (!isset($_POST['ga_price'])) {
                $errors[] = "ga_price Field is Required";
            }
            if (!isset($_POST['ga_quantity'])) {
                $errors[] = "ga_quantity Field is Required";
            }
            if (!isset($_POST['vip'])) {
                $errors[] = "vip Field is Required";
            }
            if (!isset($_POST['vip_price'])) {
                $errors[] = "vip_price Field is Required";
            }
            if (!isset($_POST['vip_quantity'])) {
                $errors[] = "vip_quantity Field is Required";
            }
            if (!isset($_POST['vvip'])) {
                $errors[] = "vvip Field is Required";
            }
            if (!isset($_POST['vvip_price'])) {
                $errors[] = "vvip_price Field is Required";
            }
            if (!isset($_POST['vvip_quantity'])) {
                $errors[] = "vvip_quantity Field is Required";
            }
            if (!isset($_POST['total_price'])) {
                $errors[] = "total_price Field is Required";
            }
         
            
        } else {

            if (trim($_POST['ticket_id']) == '') {
                $errors[] = "Ticket Id is Required";
            }

            if (trim($_POST['user_id']) == '') {
                $errors[] = "User is Required";
            }

            if (trim($_POST['image']) == '') {
                $errors[] = "Image Url  is Required";
            }

            if (trim($_POST['ga']) == '') {
                $errors[] = "Ga is Required";
            }

            if (trim($_POST['ga_price']) == '') {
                $errors[] = "Ga Price is Required";
            }

            if (trim($_POST['ga_quantity']) == '') {
                $errors[] = "Ga Quantity is Required";
            }

            if (trim($_POST['vip']) == '') {
                $errors[] = "Vip is Required";
            }

            if (trim($_POST['vip_price']) == '') {
                $errors[] = "Vip Price is Required";
            }

            if (trim($_POST['vip_quantity']) == '') {
                $errors[] = "Vip Quantity is Required";
            }

            if (trim($_POST['vvip']) == '') {
                $errors[] = "Vvip is Required";
            }

            if (trim($_POST['vvip_price']) == '') {
                $errors[] = "Vvip Price is Required";
            }

            if (trim($_POST['vvip_quantity']) == '') {
                $errors[] = "Vvip Quantity is Required";
            }

            if (trim($_POST['total_price']) == '') {
                $errors[] = "total_price is Required";
            }

        }

        
        return [
            "errors" => $errors,
            "isValid" => count($errors)==0
        ];
    }

    // Check Id 
    public static function CheckId($id) {
        $errors = [];
        if($id == '' || $id == false || $id == null || !isset($id)){
            $errors[] = "id is required";
        }

        return[
            "errors" => $errors,
            "isValid" => count($errors)==0 ? true: false
        ];
    }

    // Ticket Get By User Id
    public static function TicketUserId() {
        $errors = [];
        if(
            !isset($_POST['id'])
        ) {
            $errors[] = "id is required";
        } else {

        }

        return[
            "errors" => $errors,
            "isValid" => count($errors)==0 ? true: false
        ];
    }

 }