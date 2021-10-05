<?php

/**
 *  Creator Controller
 */

 class Creator extends Dcontroller {
    
    /**
     * @desc    Call Load Model From D Controller Constructor
     * @desc    Load -> View & Model Works parent::__construt()
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * @desc    If Crator Index Call Only Controller
     *          & We Don't Get Method And Params
     *          & Default Method is Index();
     */
   
    public function index() {
        Middleware::isAuthForCreator();
        return $this->load->view('creator/home');
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
        $creatorModel = $this->load->model('creatorModel');

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
            
            $data["data"] = $creatorModel->findById($id, $select)[0];

            if(!($data["data"])) {

                return die($this->json(['errors'=>'Cant Found'], 400));

            } else{

                return die($this->json($data));

            }
            
        } else {

            $page_no = Page::getPage();

            $total_page = $this->pageCount([
                "table" => "user",
                "cond" => " WHERE `deleted_at` IS NULL",
                "limit" => "",
                "model" => $creatorModel
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
                "data" => $creatorModel->All($select, $page_no)
            ];

            if(!count($data["data"])) {
                return die($this->json(["errors"=> "Cant Count!~!"]));
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
        $creatorModel = $this->load->model('creatorModel');
        $result = $creatorModel->create($data);

        if($result["status"]) {
            unset($result["data"]["passsword"]);
            return die($this->json($result));
        } else {
            return die($this->json(["errors" => "Cant Inserted!!"], 500));
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
        $creatorModel = $this->load->model('creatorModel');

        $cond = "id=" . $_POST["id"];

        $result = $creatorModel->update($data, $cond);

        if($result) {
            return die($this->json(["status" => true, "message" => "Successfully Updated"]));
        } else {
            return die($this->json(["errors" => "Cant Updated"], 500));
        }
    }

    /** 
    * @route   /user/delete
    * @param   {id} => $id from Route
    * @desc    Delete User
    */ 
    public function delete() {
        // Call User Model
        $creatorModel = $this->load->model('creatorModel');
        $id = $_POST["id"];
        $result = $creatorModel->deleteById($id);
        
        if($result) {
            return die($this->json(["status" => true, "message" => "Successfully Deleted"]));
        } else {
            return die($this->json(["errors" => "Cant Deleted"], 500));
        }

    }

    /**
     * @route   /user/pageCount
     * @param   arr = [
     *          "table" => "user",
     *          "cond" => " WHERE `deleted_at` IS NULL",
     *          "limit" => "",
     *          "model" => $creatorModel
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
            $creatorModel = $arr["model"];
        } else {
            $creatorModel = $this->load->model("testingModel");
        }

        return ($creatorModel->pageCount($table, $cond, $limit));
    }

    // DashBoard    
    public function dashBoard($id = 2) {
        $adminModel = $this->load->model('adminModel');
        
        $order = "ticket";
        $result["tickets"] = $adminModel->dashBoard($order, ' WHERE user_id = ' . $id); 

        $order = "ticket";
        $result["pending_tickets"] = $adminModel->dashBoard($order, ' WHERE status = 1 AND user_id = ' . $id);
        
        $order = "ticket";
        $result["success_tickets"] = $adminModel->dashBoard($order, ' WHERE status = 2 AND user_id = ' . $id);
        
        $order = "ticket";
        $result["reject_tickets"] = $adminModel->dashBoard($order, ' WHERE status = 3 AND user_id = ' . $id);
    
        return die(
            $this->json($result)
        );
    }
 }