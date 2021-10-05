<?php

/**
 *  Ticket Controller
 */

 class Ticket extends Dcontroller {
    
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
        return $this->get();
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
        $ticketModel = $this->load->model('ticketModel');

        /**
         *  @desc   If {id} is not Null
         */
        if($id) {

            $select = [
                "ticket.id","ticket.title","ticket.description",
                "ticket.address","ticket.location_id",
                "ticket.event_category_id",
                "ticket.free_ticket","ticket.image",
                "ticket.status","ticket.ga",
                "ticket.ga_price","ticket.ga_quantity",
                "ticket.vip","ticket.vip_price",
                "ticket.vip_quantity","ticket.vvip",
                "ticket.vvip_price","ticket.vvip_quantity",
                "ticket.start_date","ticket.end_date",
                "ticket.user_id",
                "user.name as user_name",
                "user.phone as user_phone",
                "user.image as user_image",
                "ticket_status.name as status_name",
                "location.name as location_name",
                "event_category.name as event_category_name"
            ];
            
            $data["data"] = $ticketModel->findById($id, $select)[0];

            if(!($data["data"])) {

                return die($this->json(['errors'=>['Cant Found']], 400));

            } 

            $data["data"]["ticket_list"] = [
                "ga" => $data["data"]["ga"],
                "ga_price" => $data["data"]["ga_price"],
                "ga_quantity" => $data["data"]["ga_quantity"],
                "vip" => $data["data"]["vip"],
                "vip_price" => $data["data"]["vip_price"],
                "vip_quantity" => $data["data"]["vip_quantity"],
                "vvip" => $data["data"]["vvip"],
                "vvip_price" => $data["data"]["vvip_price"],
                "vvip_quantity" => $data["data"]["vvip_quantity"],
            ];

            foreach(["ga", "vip", "vvip"] as $k => $v) {
                unset($data["data"][$v]);
                unset($data["data"][$v."_price"]);
                unset($data["data"][$v."_quantity"]);
            }

            return die($this->json($data));
            
        } else {

            $page_no = Page::getPage();

            $total_page = $this->pageCount([
                "table" => "ticket",
                "cond" => "",
                "limit" => "",
                "model" => $ticketModel
            ]);
            

            /**
             * @desc    {id} param doesnt get
             * @desc    show All Datas
             * @param select to pick from DB
             */
            $select = [
                "ticket.id","ticket.title","ticket.description",
                "ticket.address","ticket.location_id",
                "ticket.event_category_id",
                "ticket.free_ticket","ticket.image",
                "ticket.status","ticket.ga",
                "ticket.ga_price","ticket.ga_quantity",
                "ticket.vip","ticket.vip_price",
                "ticket.vip_quantity","ticket.vvip",
                "ticket.vvip_price","ticket.vvip_quantity",
                "ticket.start_date","ticket.end_date",
                "ticket.user_id",
                "user.name as user_name",
                "user.phone as user_phone",
                "user.image as user_image",
                "ticket_status.name as status_name",
                "location.name as location_name",
                "event_category.name as event_category_name"
            ];

            $result = $ticketModel->All($select, $page_no);

            foreach($result as $key => $value) {
                $result[$key]["ticket_list"] = [
                    "ga" => $result[$key]["ga"],
                    "ga_price" => $result[$key]["ga_price"],
                    "ga_quantity" => $result[$key]["ga_quantity"],
                    "vip" => $result[$key]["vip"],
                    "vip_price" => $result[$key]["vip_price"],
                    "vip_quantity" => $result[$key]["vip_quantity"],
                    "vvip" => $result[$key]["vvip"],
                    "vvip_price" => $result[$key]["vvip_price"],
                    "vvip_quantity" => $result[$key]["vvip_quantity"],
                ];

                foreach(["ga", "vip", "vvip"] as $k => $v) {
                    unset($result[$key][$v]);
                    unset($result[$key][$v."_price"]);
                    unset($result[$key][$v."_quantity"]);
                }
            };

            $data = [
                "total_page" => $total_page,
                "current_page" => (int)$page_no,
                "data" => $result
            ];

            if(!count($data["data"])) {
                return die($this->json(["errors"=> ["Cant Count!~!"]]));
            }

            return die($this->json($data));
           
        }
        
    }

    /**
     * 
     * @route /ticket/user
     * 
     */
    public function getByUserId($id = false) {
        $resultError = Validation::TicketUserId();
        
        if(!$resultError["isValid"]) {
            return die($this->json($resultError, 400));
        }

            $ticketModel = $this->load->model('ticketModel');

            $page_no = Page::getPage();

            $total_page = $this->pageCount([
                "table" => "ticket",
                "cond" => " WHERE user_id = " . $_POST["id"],
                "limit" => "",
                "model" => $ticketModel
            ]);
            

            /**
             * @desc    {id} param doesnt get
             * @desc    show All Datas
             * @param select to pick from DB
             */
            $select = [
                "ticket.id","ticket.title","ticket.description",
                "ticket.address","ticket.location_id",
                "ticket.event_category_id",
                "ticket.free_ticket","ticket.image",
                "ticket.status","ticket.ga",
                "ticket.ga_price","ticket.ga_quantity",
                "ticket.vip","ticket.vip_price",
                "ticket.vip_quantity","ticket.vvip",
                "ticket.vvip_price","ticket.vvip_quantity",
                "ticket.start_date","ticket.end_date",
                "ticket.user_id",
                "user.name as user_name",
                "user.phone as user_phone",
                "user.image as user_image",
                "ticket_status.name as status_name",
                "location.name as location_name",
                "event_category.name as event_category_name"
            ];

            $result =  $ticketModel->getByUserId($select, $_POST["id"], $page_no);

            if(!count($result)) {
                return die($this->json(["errors"=> ["Cant Count!~!"]]));
            }

            foreach($result as $key => $value) {
                $result[$key]["ticket_list"] = [
                    "ga" => $result[$key]["ga"],
                    "ga_price" => $result[$key]["ga_price"],
                    "ga_quantity" => $result[$key]["ga_quantity"],
                    "vip" => $result[$key]["vip"],
                    "vip_price" => $result[$key]["vip_price"],
                    "vip_quantity" => $result[$key]["vip_quantity"],
                    "vvip" => $result[$key]["vvip"],
                    "vvip_price" => $result[$key]["vvip_price"],
                    "vvip_quantity" => $result[$key]["vvip_quantity"],
                ];

                foreach(["ga", "vip", "vvip"] as $k => $v) {
                    unset($result[$key][$v]);
                    unset($result[$key][$v."_price"]);
                    unset($result[$key][$v."_quantity"]);
                }
            };


            $data = [
                "total_page" => $total_page,
                "current_page" => (int)$page_no,
                "data" => $result
            ];

           
            return die($this->json($data));
    }


    /**
     * Get By Pending
     */
    public function getByPending() {

            $ticketModel = $this->load->model('ticketModel');

            $page_no = Page::getPage();
            $status = 1;
            $total_page = $this->pageCount([
                "table" => "ticket",
                "cond" => " WHERE status = $status",
                "limit" => "",
                "model" => $ticketModel
            ]);
            

            /**
             * @desc    {id} param doesnt get
             * @desc    show All Datas
             * @param select to pick from DB
             */
            $select = [
                "ticket.id","ticket.title","ticket.description",
                "ticket.address","ticket.location_id",
                "ticket.event_category_id",
                "ticket.free_ticket","ticket.image",
                "ticket.status","ticket.ga",
                "ticket.ga_price","ticket.ga_quantity",
                "ticket.vip","ticket.vip_price",
                "ticket.vip_quantity","ticket.vvip",
                "ticket.vvip_price","ticket.vvip_quantity",
                "ticket.start_date","ticket.end_date",
                "ticket.user_id",
                "ticket_status.name as status_name",
                "user.name as user_name",
                "user.phone as user_phone",
                "user.image as user_image",
                "location.name as location_name",
                "event_category.name as event_category_name"
            ];

            $result =  $ticketModel->getByPendingStatus($select, $status, $page_no);

            if(!count($result)) {
                return die($this->json(["errors"=> ["Cant Count!~!"]]));
            }

            foreach($result as $key => $value) {
                $result[$key]["ticket_list"] = [
                    "ga" => $result[$key]["ga"],
                    "ga_price" => $result[$key]["ga_price"],
                    "ga_quantity" => $result[$key]["ga_quantity"],
                    "vip" => $result[$key]["vip"],
                    "vip_price" => $result[$key]["vip_price"],
                    "vip_quantity" => $result[$key]["vip_quantity"],
                    "vvip" => $result[$key]["vvip"],
                    "vvip_price" => $result[$key]["vvip_price"],
                    "vvip_quantity" => $result[$key]["vvip_quantity"],
                ];

                foreach(["ga", "vip", "vvip"] as $k => $v) {
                    unset($result[$key][$v]);
                    unset($result[$key][$v."_price"]);
                    unset($result[$key][$v."_quantity"]);
                }
            };


            $data = [
                "total_page" => $total_page,
                "current_page" => (int)$page_no,
                "data" => $result
            ];

        
            return die($this->json($data));
    }

    /**
     * Get By Pending
     */
    public function getByReject() {

            $ticketModel = $this->load->model('ticketModel');

            $page_no = Page::getPage();
            $status = 3;
            $total_page = $this->pageCount([
                "table" => "ticket",
                "cond" => " WHERE status = $status",
                "limit" => "",
                "model" => $ticketModel
            ]);
            

            /**
             * @desc    {id} param doesnt get
             * @desc    show All Datas
             * @param select to pick from DB
             */
            $select = [
                "ticket.id","ticket.title","ticket.description",
                "ticket.address","ticket.location_id",
                "ticket.event_category_id",
                "ticket.free_ticket","ticket.image",
                "ticket.status","ticket.ga",
                "ticket.ga_price","ticket.ga_quantity",
                "ticket.vip","ticket.vip_price",
                "ticket.vip_quantity","ticket.vvip",
                "ticket.vvip_price","ticket.vvip_quantity",
                "ticket.start_date","ticket.end_date",
                "ticket.user_id",
                "ticket_status.name as status_name",
                "user.name as user_name",
                "user.phone as user_phone",
                "user.image as user_image",
                "location.name as location_name",
                "event_category.name as event_category_name"
            ];

            $result =  $ticketModel->getByPendingStatus($select, $status, $page_no);

            if(!count($result)) {
                return die($this->json(["errors"=> ["Cant Count!~!"]]));
            }

            foreach($result as $key => $value) {
                $result[$key]["ticket_list"] = [
                    "ga" => $result[$key]["ga"],
                    "ga_price" => $result[$key]["ga_price"],
                    "ga_quantity" => $result[$key]["ga_quantity"],
                    "vip" => $result[$key]["vip"],
                    "vip_price" => $result[$key]["vip_price"],
                    "vip_quantity" => $result[$key]["vip_quantity"],
                    "vvip" => $result[$key]["vvip"],
                    "vvip_price" => $result[$key]["vvip_price"],
                    "vvip_quantity" => $result[$key]["vvip_quantity"],
                ];

                foreach(["ga", "vip", "vvip"] as $k => $v) {
                    unset($result[$key][$v]);
                    unset($result[$key][$v."_price"]);
                    unset($result[$key][$v."_quantity"]);
                }
            };


            $data = [
                "total_page" => $total_page,
                "current_page" => (int)$page_no,
                "data" => $result
            ];

        
            return die($this->json($data));
    }

    /**
     * Get By Success
     */
    public function getBySuccess() {

            $ticketModel = $this->load->model('ticketModel');

            $page_no = Page::getPage();
            $status = 2;
            $total_page = $this->pageCount([
                "table" => "ticket",
                "cond" => " WHERE status = $status",
                "limit" => "",
                "model" => $ticketModel
            ]);
            

            /**
             * @desc    {id} param doesnt get
             * @desc    show All Datas
             * @param select to pick from DB
             */
            $select = [
                "ticket.id","ticket.title","ticket.description",
                "ticket.address","ticket.location_id",
                "ticket.event_category_id",
                "ticket.free_ticket","ticket.image",
                "ticket.status","ticket.ga",
                "ticket.ga_price","ticket.ga_quantity",
                "ticket.vip","ticket.vip_price",
                "ticket.vip_quantity","ticket.vvip",
                "ticket.vvip_price","ticket.vvip_quantity",
                "ticket.start_date","ticket.end_date",
                "ticket.user_id",
                "ticket_status.name as status_name",
                "user.name as user_name",
                "user.phone as user_phone",
                "user.image as user_image",
                "location.name as location_name",
                "event_category.name as event_category_name"
            ];

            $result =  $ticketModel->getByPendingStatus($select, $status, $page_no);

            if(!count($result)) {
                return die($this->json(["errors"=> ["Cant Count!~!"]]));
            }

            foreach($result as $key => $value) {
                $result[$key]["ticket_list"] = [
                    "ga" => $result[$key]["ga"],
                    "ga_price" => $result[$key]["ga_price"],
                    "ga_quantity" => $result[$key]["ga_quantity"],
                    "vip" => $result[$key]["vip"],
                    "vip_price" => $result[$key]["vip_price"],
                    "vip_quantity" => $result[$key]["vip_quantity"],
                    "vvip" => $result[$key]["vvip"],
                    "vvip_price" => $result[$key]["vvip_price"],
                    "vvip_quantity" => $result[$key]["vvip_quantity"],
                ];

                foreach(["ga", "vip", "vvip"] as $k => $v) {
                    unset($result[$key][$v]);
                    unset($result[$key][$v."_price"]);
                    unset($result[$key][$v."_quantity"]);
                }
            };


            $data = [
                "total_page" => $total_page,
                "current_page" => (int)$page_no,
                "data" => $result
            ];

        
            return die($this->json($data));
    }

    /**
     * Get By UserTicket
     * 
     *  */ 
    public function getByUserTicket() {

        $ticketModel = $this->load->model('ticketModel');

        $page_no = Page::getPage();
        $status = 2;
        $total_page = $this->pageCount([
            "table" => "ticket",
            "cond" => " WHERE status = $status",
            "limit" => "6",
            "model" => $ticketModel
        ]);
        

        /**
         * @desc    {id} param doesnt get
         * @desc    show All Datas
         * @param select to pick from DB
         */
        $select = [
            "ticket.id","ticket.title","ticket.description",
            "ticket.address","ticket.location_id",
            "ticket.event_category_id",
            "ticket.free_ticket","ticket.image",
            "ticket.status","ticket.ga",
            "ticket.ga_price","ticket.ga_quantity",
            "ticket.vip","ticket.vip_price",
            "ticket.vip_quantity","ticket.vvip",
            "ticket.vvip_price","ticket.vvip_quantity",
            "ticket.start_date","ticket.end_date",
            "ticket.user_id",
            "ticket_status.name as status_name",
            "user.name as user_name",
            "user.phone as user_phone",
            "user.image as user_image",
            "location.name as location_name",
            "event_category.name as event_category_name"
        ];

        $result =  $ticketModel->getByPendingStatus($select, $status, $page_no, 6);

        if(!count($result)) {
            return die($this->json(["errors"=> ["Cant Count!~!"]]));
        }

        foreach($result as $key => $value) {
            $result[$key]["ticket_list"] = [
                "ga" => $result[$key]["ga"],
                "ga_price" => $result[$key]["ga_price"],
                "ga_quantity" => $result[$key]["ga_quantity"],
                "vip" => $result[$key]["vip"],
                "vip_price" => $result[$key]["vip_price"],
                "vip_quantity" => $result[$key]["vip_quantity"],
                "vvip" => $result[$key]["vvip"],
                "vvip_price" => $result[$key]["vvip_price"],
                "vvip_quantity" => $result[$key]["vvip_quantity"],
            ];

            foreach(["ga", "vip", "vvip"] as $k => $v) {
                unset($result[$key][$v]);
                unset($result[$key][$v."_price"]);
                unset($result[$key][$v."_quantity"]);
            }
        };


        $data = [
            "total_page" => $total_page,
            "current_page" => (int)$page_no,
            "data" => $result
        ];

    
        return die($this->json($data));
}


    /**
     * 
     * Update To Confirm status
     * 
     */
    public function updateConfirm($id = null) {
        if($id == null || $id == '' || $id == 0 ) {
            return die($this->json(["errors"=>["Cant Confirm"]] ,400));
        }
        $data = [
            "status" => 2
        ];
        
        // Call User Model
        $ticketModel = $this->load->model('ticketModel');

        $cond = "id=" . $id ;

        $result = $ticketModel->update($data, $cond);

        if($result) {
            return die($this->json(["status" => true, "message" => "Successfully Updated"]));
        } else {
            return die($this->json(["errors" => ["Cant Updated Email is Already"]], 400));
        }
    }

    /**
     * 
     * Update Reject Status
     * 
     *  */ 
    public function updateReject($id = null) {
        if($id == null || $id == '' || $id == 0 ) {
            return die($this->json(["errors"=>["Cant Confirm"]] ,400));
        }
        $data = [
            "status" => 3
        ];
        
        // Call User Model
        $ticketModel = $this->load->model('ticketModel');

        $cond = "id=" . $id ;

        $result = $ticketModel->update($data, $cond);

        if($result) {
            return die($this->json(["status" => true, "message" => "Successfully Updated"]));
        } else {
            return die($this->json(["errors" => ["Cant Updated Email is Already"]], 400));
        }
    }

    /** 
    * @route   /user/insert 
    * @desc    Insert User
    */ 
    public function insert() {

        $resultError = Validation::TicketInput();
        
        if(!$resultError["isValid"]) {
            return die($this->json($resultError, 400));
        }


        $file = $_FILES["file"]["tmp_name"];
        // Declare Patch
        $path = __DIR__ . "/../.././assets/images/ticket/";
        // Get Origininal File's Extension
        $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        // New Name
        $newName =  "ticket" . "_" . date("H_i_s") . "_" . uniqid() . "." . $ext;
       
        // die($file . "\n" . $path. "\n" . $newName);
        // Same Width Height
        if(move_uploaded_file($file, $path . $newName)) {

                $data = [
                    "title"  => $_POST["title"],
                    "description"  => $_POST["description"],
                    "address"  => $_POST["address"],
                    "location_id"  => $_POST["location_id"],
                    "event_category_id"  => $_POST["event_category_id"],
                    "user_id"  => $_POST["user_id"],
                    "start_date"  => $_POST["start_date"],
                    "end_date"  => $_POST["end_date"],
                    "free_ticket"  => $_POST["free_ticket"] == "true" ? 1 : 0,
                    "ga"  => $_POST["ga"] == "true" ? 1 : 0,
                    "ga_price"  => $_POST["ga_price"],
                    "ga_quantity"  => $_POST["ga_quantity"],
                    "vip"  => $_POST["vip"] == "true" ? 1 : 0,
                    "vip_price"  => $_POST["vip_price"],
                    "vip_quantity"  => $_POST["vip_quantity"],
                    "vvip"  => $_POST["vvip"] == "true" ? 1 : 0,
                    "vvip_price"  => $_POST["vvip_price"],
                    "vvip_quantity"  => $_POST["vvip_quantity"],
                    "status" => 1,
                    "image" => URL . "/assets/images/ticket/" . $newName
                ];
                
                // Call User Model
                $ticketModel = $this->load->model('ticketModel');
        
                $result = $ticketModel->create($data);
        
                if($result["status"]) {
                    return die($this->json($result));
                } else {
                    return die($this->json(["errors" => ["Cant Inserted!!"]], 400));
                }

        } else {
            $err = "Can't Upload Something Wrong";
            return die($this->json(['errors' => [$err] ], 400));
        }

       
    }

  
    public function update() {

        $data = [
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "phone" => $_POST['phone']
        ];
        
        // Call User Model
        $ticketModel = $this->load->model('ticketModel');

        $cond = "id=" . $_POST["id"];

        $result = $ticketModel->update($data, $cond);

        if($result) {
            return die($this->json(["status" => true, "message" => "Successfully Updated"]));
        } else {
            return die($this->json(["errors" => ["Cant Updated Email is Already"]], 400));
        }
    }

    /** 
    * @route   /user/delete
    * @param   {id} => $id from Route
    * @desc    Delete User
    */ 
    public function delete() {
        // Call User Model
        $ticketModel = $this->load->model('ticketModel');
        $id = $_POST["id"];
        $result = $ticketModel->deleteById($id);
        
        if($result) {
            return die($this->json(["status" => true, "message" => "Successfully Deleted"]));
        } else {
            return die($this->json(["errors" => ["Cant Deleted"]], 400));
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
                    $ticketModel = $this->load->model('ticketModel');
            
                    $cond = "id=" . $_POST["id"];
            
                    $result = $ticketModel->update($data, $cond);
            
                    if($result) {
                        return die($this->json(["status" => true, "message" => "Successfully Updated"]));
                    } else {
                        return die($this->json(["errors" => ["Cant Updated"]], 400));
                    }
               
                    die(json_encode("UPLOADED"));

            } else {
                $err = "Can't Upload Something Wrong";
                return die($this->json(['errors' => [$err] ], 400));
            }

    }

    /**
     * @route   /user/pageCount
     * @param   arr = [
     *          "table" => "user",
     *          "cond" => " WHERE `deleted_at` IS NULL",
     *          "limit" => "",
     *          "model" => $ticketModel
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
            $ticketModel = $arr["model"];
        } else {
            $ticketModel = $this->load->model("testingModel");
        }

        return ($ticketModel->pageCount($table, $cond, $limit));
    }
 }