<?php

/**
 *  User Controller
 */

 class User extends Dcontroller {
    
    /**
     * @desc    Call Load Model From D Controller Constructor
     * @desc    Load -> View & Model Works parent::__construt()
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * @desc    If User Call Only Controller
     *          & We Don't Get Method And Params
     *          & Default Method is Index();
     */
    public function index() {
        Middleware::isAuthForUser();

        return $this->load->view('user/home');
    }

    /** 
     * @route   /user/get 
     * @route   /user/get/{id} 
     * 
     * @param   {id} => $id from Route
     * @desc    User Model Calling
     */ 
    public function get($id = false) {

        // Call User Model
        $userModel = $this->load->model('userModel');

        /**
         *  @desc   If {id} is not Null
         */
        if($id) {
            $select = [
                "user.id", 
                "user.name", 
                "user.email", 
                "user.address", 
                "user.image", 
                "user.phone", 
                "role.id as role_id",
                "role.name as role_name"
            ];
            
            $data["data"] = $userModel->findById($id, $select)[0];

            if(!($data["data"])) {

                return die($this->json(['errors'=>['Cant Found']], 400));

            } else{

                return die($this->json($data));

            }
            
        } else {

            $page_no = Page::getPage();

            $total_page = $this->pageCount([
                "table" => "user",
                "cond" => " WHERE `deleted_at` IS NULL",
                "limit" => "",
                "model" => $userModel
            ]);
            

            /**
             * @desc    {id} param doesnt get
             * @desc    show All Datas
             * @param select to pick from DB
             */
            $select = [
                "user.id", 
                "user.name", 
                "user.email", 
                "user.address", 
                "user.image", 
                "user.phone", 
                "role.id as role_id",
                "role.name as role_name"
            ];

            $data = [
                "total_page" => $total_page,
                "current_page" => (int)$page_no,
                "data" => $userModel->All($select, $page_no)
            ];

            if(!count($data["data"])) {
                return die($this->json(["errors"=> ["Cant Count!~!"]]));
            }

            return die($this->json($data));
           
        }
        
    }

    /** 
    * @route   /user/insert 
    * @desc    Insert User
    */ 
    public function insert() {

        $resultError = Validation::UserInput();
        
        if(!$resultError["isValid"]) {
            return die($this->json($resultError, 400));
        }

        $data = [
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "password" => password_hash($_POST['password'], PASSWORD_DEFAULT) ,
            "phone" => $_POST['phone'],
            "address" => (isset($_POST["address"])) ? $_POST["address"] : "",
            "image" => URL . DEFAULT_USER_IMAGE
        ];
        
        // Call User Model
        $userModel = $this->load->model('userModel');

        $existUser = $userModel->findByEmail($_POST['email']);
        if($existUser) {
            return die($this->json(['errors' => ['Email already Exist']], 400));
        }

        $result = $userModel->create($data);

        if($result["status"]) {
            unset($result["data"]["passsword"]);
            return die($this->json($result));
        } else {
            return die($this->json(["errors" => ["Cant Inserted!!"]], 400));
        }
    }

    /** 
    * @route   /user/insertcreator 
    * @desc    Insert Creator
    */ 
    public function insertcreator() {
        $resultError = Validation::UserInput();
        
        if(!$resultError["isValid"]) {
            return die($this->json($resultError, 400));
        }
       
        $data = [
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "password" => password_hash($_POST['password'], PASSWORD_DEFAULT) ,
            "phone" => $_POST['phone'],
            "address" => (isset($_POST["address"])) ? $_POST["address"] : "",
            "image" => URL . DEFAULT_USER_IMAGE,
            "role_id" => 2
        ];
        
        // Call User Model
        $userModel = $this->load->model('userModel');

        $existUser = $userModel->findByEmail($_POST['email']);
        if($existUser) {
            return die($this->json(['errors' => ['Email already Exist']], 400));
        }

        $result = $userModel->create($data);

        if($result["status"]) {
            unset($result["data"]["passsword"]);

            //Create a new PHPMailer instance
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            //Set the encryption system to use - ssl (deprecated) or tls
            $mail->SMTPSecure = 'tls';
            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;
            //Username to use for SMTP authentication - use full email address for gmail
            $mail->Username = EMAIL;
            //Password to use for SMTP authentication
            $mail->Password = Middleware::pass(PASS);
            //Set who the message is to be sent from
            $mail->setFrom(EMAIL, MAIL_REPLY);
            //Set an alternative reply-to address
            $mail->addReplyTo(EMAIL);
            //Set who the message is to be sent to
            $mail->addAddress($_POST['email']);
            $mail->isHTML(true);
            //Set the subject line
            $mail->Subject = 'Creator Account Password Set .';
            $password =  $_POST['password'] ;
            $html = '<div style="margin: 0 auto ;max-width:640px;"> ' ;
            $html .= '<img src="https://i.ibb.co/X8gYPfP/banner.jpg" style="width: 100%"> <br>';
            $html .= '<div><h3>Creator Email is '. $_POST['email'] .' </h3></div>';
            $html .= '<div><h3>Creator Password is '. $password .' </h3> <p>You Can Now Login As Creator</p> </div>';
            $html .= '<div><p> Thanks for your register.</p> </div>';
            $html .= "</div>";
            $mail->Body = $html;
            $mail->AltBody = 'This is Password Returning For Creator';
            $mail->send();
            return die($this->json($result));
        } else {
            return die($this->json(["errors" => ["Cant Inserted!!"]], 400));
        }
    }

     /** 
    * @route   /user/insertAdmin 
    * @desc    Insert Admin
    */ 
    public function insertadmin() {

        $resultError = Validation::UserInput();
        
        if(!$resultError["isValid"]) {
            return die($this->json($resultError, 400));
        }

        $data = [
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "password" => password_hash($_POST['password'], PASSWORD_DEFAULT) ,
            "phone" => $_POST['phone'],
            "address" => (isset($_POST["address"])) ? $_POST["address"] : "",
            "image" => URL . DEFAULT_USER_IMAGE,
            "role_id" => 3
        ];
        
        // Call User Model
        $userModel = $this->load->model('userModel');

        $existUser = $userModel->findByEmail($_POST['email']);
        if($existUser) {
            return die($this->json(['errors' => ['Email already Existed']], 400));
        }

        $result = $userModel->create($data);

        if($result["status"]) {
            unset($result["data"]["passsword"]);

            return die($this->json($result));
        } else {
            return die($this->json(["errors" => ["Can't Insert!!"]], 400));
        }
    }

    /** 
    * @route   /user/update
    * @param   {id} => $id from Route
    * @desc    Update User
    */ 
    public function update() {

        $data = [
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "phone" => $_POST['phone']
        ];
        
        // Call User Model
        $userModel = $this->load->model('userModel');

        $cond = "id=" . $_POST["id"];

        $result = $userModel->update($data, $cond);

        if($result) {
            return die($this->json(["status" => true, "message" => "Successfully Updated"]));
        } else {
            return die($this->json(["errors" => ["Can't Update, Email is Already"]], 400));
        }
    }

    /** 
    * @route   /user/delete
    * @param   {id} => $id from Route
    * @desc    Delete User
    */ 
    public function delete() {
        // Call User Model
        $userModel = $this->load->model('userModel');
        $id = $_POST["id"];
        $result = $userModel->deleteById($id);
        
        if($result) {
            return die($this->json(["status" => true, "message" => "Successfully Deleted"]));
        } else {
            return die($this->json(["errors" => ["Can't Delete"]], 400));
        }

    }

    /** 
    * @route   /user/updateProfile
    * @param   {id} => $id from Route
    * @desc    Delete User
    */ 
    public function updateprofile() {
        // Call User Model

        $data = [
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "phone" => $_POST['phone']
        ];
        
        // Call User Model
        $userModel = $this->load->model('userModel');

        $cond = "id=" . $_POST["id"];

        $result = $userModel->update($data, $cond);

        if($result) {
            return die($this->json(["status" => true, "message" => "Successfully Updated"]));
        } else {
            return die($this->json(["errors" => ["Can't Update, Email Already Existed"]], 400));
        }

    }

    /** 
    * @route   /user/updateImage
    * @param   {id} => $id from Route
    * @desc    Delete User
    */ 
    public function updateImage() {
        // Call User Model
        
        $resultError = Validation::ProfileImageInput();
        
        if(!$resultError["isValid"]) {
            return die($this->json($resultError, 400));
        }

            $file = $_FILES["file"]["tmp_name"];
            // Declare Patch
            $path = __DIR__ . "/../.././assets/images/profile/";
            // Get Origininal File's Extension
            $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
            // New Name
            $newName =  "profile" . "_" . date("H_i_s") . "_" . uniqid() . "." . $ext;
           
            // die($file . "\n" . $path. "\n" . $newName);
            // Same Width Height
            if(move_uploaded_file($file, $path . $newName)) {

                    $data = [
                        "image" => URL . "/assets/images/profile/" . $newName
                    ];
                    
                    // Call User Model
                    $userModel = $this->load->model('userModel');
            
                    $cond = "id=" . $_POST["id"];
            
                    $result = $userModel->update($data, $cond);
            
                    if($result) {
                        return die($this->json(["status" => true, "message" => "Successfully Updated"]));
                    } else {
                        return die($this->json(["errors" => ["Can't Updated"]], 400));
                    }
                    // $sql = "INSERT INTO `plants` (`id`, `image`, `name`, `price`, `category_id`, `admin_id`, `deleted_at`, `created_at`, `modified_at`) ";
                    // $sql .= " VALUES (NULL, '/assets/images/plants/" . $newName . "', ";
                    // $sql .= " '" . $req['name'] . "', '" . $req['price'] . "', ";
                    // $sql .= " '" . $req['category_id'] ."', '" . $req['admin_id'] . "', NULL, NOW(), NOW())";
                    
                    // // die($sql);
                    // if(mysqli_query($conn, $sql))  {
                    //     $req["name"] = "";
                    //     $req["price"] = "";
                    //     $req['success'][] = "Successfully Uploaded With MoveUploaded";
                    // } else {
                    //     $req['errors'][] = "Errors: DB WRONG !";
                    // } 
                    die(json_encode("UPLOADED"));

            } else {
                $err = "Can't Upload Something Wrong";
                return die($this->json(['errors' => [$err] ], 400));
            }

        // $data = [
        //     "name" => $_POST['name'],
        //     "email" => $_POST['email'],
        //     "phone" => $_POST['phone']
        // ];
        
        // Call User Model
        $userModel = $this->load->model('userModel');

        $cond = "id=" . $_POST["id"];

        die("");

        // $result = $userModel->update($data, $cond);

        // if($result) {
        //     return die($this->json(["status" => true, "message" => "Successfully Updated"]));
        // } else {
        //     return die($this->json(["errors" => "Cant Updated"], 400));
        // }

    }

    /**
     * @route   /user/pageCount
     * @param   arr = [
     *          "table" => "user",
     *          "cond" => " WHERE `deleted_at` IS NULL",
     *          "limit" => "",
     *          "model" => $userModel
     *          ]
     */
    public function pageCount($arr = ["table" => "testing_table","cond" => "cond","limit" => "", "model" => "useModel"]) {
       
        $table = $arr["table"];
        $cond = "";
        $limit = "";
        
        if(isset($arr["cond"])) {
            $cond = $arr["cond"];
        }
        if(isset($arr["limit"])) {
            $limit = $arr["limit"];
        }
        if(isset($arr["model"]) && $arr["model"] != "") {
            $userModel = $arr["model"];
        } else {
            $userModel = $this->load->model("testingModel");
        }

        return ($userModel->pageCount($table, $cond, $limit));
    }
 }