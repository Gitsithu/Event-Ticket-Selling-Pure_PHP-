<div class="row">

    <!-- User Functions -->
    <div class="col-sm-6 mb-3 col-md-3">
        <div class="card">
                <div class="card-body">
                    <ul class="list-group">

                        <a
                            data-container="Ticket_List_Container"
                            class="list-group-item side_hover ticket_container_change_click"
                        >
                            <i class="material-icons text-primary">list</i>
                            List
                        </a>

                        <a
                            data-container="Ticket_Pending_List_Container"
                            class="list-group-item side_hover ticket_container_change_click"
                        >
                            <i class="material-icons text-primary">slow_motion_video</i>
                            Pending
                        </a>

                        <a
                            data-container="Ticket_Success_List_Container"
                            class="list-group-item side_hover ticket_container_change_click"
                        >
                            <i class="material-icons text-success">mobile_friendly</i>
                            Success
                        </a>

                        <a
                            data-container="Ticket_Reject_List_Container"
                            class="list-group-item side_hover ticket_container_change_click"
                        >
                            <i class="material-icons text-danger">backspace</i>
                            Reject
                        </a>


                    </ul>
                </div>
        </div>
                
    </div>
    <!-- User Functions End -->

    
    <div class="col-sm-6 mb-3 col-md-9">
    
        <!-- Ticket_List_Container Container -->
        <div class="fadeIn" id="Ticket_List_Container">
            
            <div class="row justify-content-end">
                <div class="col-md-3 col-lg-2">
                    <div class="input-group mb-3">
                    
                        <input
                            type="text"
                            class="form-control" 
                            value="1" 
                            aria-label="Default" 
                            aria-describedby="inputGroup-sizing-default"
                            id="ticket_list_get_input"
                         >
                        <div class="input-group-prepend">
                            <button class="btn btn-sm btn-outline-primary" type="button" id="ticket_list_get">
                                /<span id="ticket_list_get_total_page"> 0 </span>
                            </button>
                        </div>  
                    </div>
                </div>
            </div>

            <!-- Table COntainer -->
            <div class="table-responsive">
                    <table class="table table-hover " id="Ticket_List_Table">

                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Status</th>
                                <th scope="col">Detail</th>
                            </tr>
                        </thead>

                        <tbody id="ticket_table_body">
                           
                        </tbody>

                    </table>
            </div>
            <!-- Table COntainer End-->

        </div>
        <!-- Ticket_List_Container Container End -->

        <!-- Ticket_Pending_List_Container Container -->
        <div class="fadeIn  d-none" id="Ticket_Pending_List_Container">
            
            <div class="row justify-content-end">
                <div class="col-md-3 col-lg-2">
                    <div class="input-group mb-3">
                    
                        <input
                            type="text"
                            class="form-control" 
                            value="1" 
                            aria-label="Default" 
                            aria-describedby="inputGroup-sizing-default"
                            id="ticket_pending_list_get_input"
                         >
                        <div class="input-group-prepend">
                            <button class="btn btn-sm btn-outline-primary" type="button" id="ticket_pending_list_get">
                                /<span id="ticket_pending_list_get_total_page"> 0 </span>
                            </button>
                        </div>  
                    </div>
                </div>
            </div>

            <!-- Table COntainer -->
            <div class="table-responsive">
                    <table class="table table-hover " id="Ticket_Pending_List_Table">

                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Status</th>
                                <th scope="col">Detail</th>
                            </tr>
                        </thead>

                        <tbody id="ticket_pending_table_body">
                           
                        </tbody>

                    </table>
            </div>
            <!-- Table COntainer End-->

        </div>
        <!-- Ticket_Pending_List_Container Container End -->

        <!-- Ticket_Success_List_Container Container -->
        <div class="fadeIn  d-none" id="Ticket_Success_List_Container">
            
            <div class="row justify-content-end">
                <div class="col-md-3 col-lg-2">
                    <div class="input-group mb-3">
                    
                        <input
                            type="text"
                            class="form-control" 
                            value="1" 
                            aria-label="Default" 
                            aria-describedby="inputGroup-sizing-default"
                            id="ticket_success_list_get_input"
                         >
                        <div class="input-group-prepend">
                            <button class="btn btn-sm btn-outline-primary" type="button" id="ticket_success_list_get">
                                /<span id="ticket_success_list_get_total_page"> 0 </span>
                            </button>
                        </div>  
                    </div>
                </div>
            </div>

            <!-- Table COntainer -->
            <div class="table-responsive">
                    <table class="table table-hover " id="Ticket_Success_List_Table">

                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Status</th>
                                <th scope="col">Detail</th>
                            </tr>
                        </thead>

                        <tbody id="ticket_success_table_body">
                           
                        </tbody>

                    </table>
            </div>
            <!-- Table COntainer End-->

        </div>
        <!-- Ticket_Success_List_Container Container End -->

        <!-- Ticket_Reject_List_Container Container -->
        <div class="fadeIn  d-none" id="Ticket_Reject_List_Container">
            
            <div class="row justify-content-end">
                <div class="col-md-3 col-lg-2">
                    <div class="input-group mb-3">
                    
                        <input
                            type="text"
                            class="form-control" 
                            value="1" 
                            aria-label="Default" 
                            aria-describedby="inputGroup-sizing-default"
                            id="ticket_reject_list_get_input"
                         >
                        <div class="input-group-prepend">
                            <button class="btn btn-sm btn-outline-primary" type="button" id="ticket_reject_list_get">
                                /<span id="ticket_reject_list_get_total_page"> 0 </span>
                            </button>
                        </div>  
                    </div>
                </div>
            </div>

            <!-- Table COntainer -->
            <div class="table-responsive">
                    <table class="table table-hover " id="Ticket_Reject_List_Table">

                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Status</th>
                                <th scope="col">Detail</th>
                            </tr>
                        </thead>

                        <tbody id="ticket_reject_table_body">
                           
                        </tbody>

                    </table>
            </div>
            <!-- Table COntainer End-->

        </div>
        <!-- Ticket_Reject_List_Container Container End -->

        <!-- Ticket Check Container -->
        <div class="fadeIn d-none" id="Ticket_Check_Container">
            <div class="card">
                    
                    <div class="card-header ">
                        <h4>  
                            Ticket Detail   
                        </h4>

                        <div id="ticket_check_confirm_or_not_container" class="pt-2">
                            <button type="button" id="ticket_check_confirm_button" class="btn btn-primary btn-raised btn-sm"> Confirm </button>
                            <button type="button" id="ticket_check_reject_button" class="btn btn-danger btn-raised btn-sm"> Reject </button>
                            <div id="ticket_check_confirm_or_not_loading" class="lds-dual-ring d-none"></div>
                        </div>

                    </div>

                    <div 
                        id="ticket_check_image"
                        class="image-container-check" 
                        style="background-image:url(http://localhost/eventticket/assets/images/logo/homewallpaper.jpg)"
                    >
                    </div>

                    <!--  Start -->
                    <div class="card-body">
                         <!-- All List -->
                         <div class="container-fluid table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Post By </td> 
                                            <td class="table_tr_pos_for_icon" id="ticket_check_user_name">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td> Phone </td> 
                                            <td class="" id="ticket_check_user_phone">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Title</td> <td id="ticket_check_title"> </td>
                                        </tr>
                                        <tr>
                                            <td>Description</td> <td id="ticket_check_description"> </td>
                                        </tr>
                                        <tr>
                                            <td>Location</td> <td id="ticket_check_place"> </td>
                                        </tr>
                                        <tr>
                                            <td>Address</td> <td id="ticket_check_address"> </td>
                                        </tr>
                                        <tr>
                                            <td>Start Date</td> <td id="ticket_check_start_date"> </td>
                                        </tr>
                                        <tr>
                                            <td>End Date</td> <td id="ticket_check_end_date"> </td>
                                        </tr>
                                        <tr>
                                            <td>Status</td> <td id="ticket_check_status"> </td>
                                        </tr>
                                        <tr>
                                            <td>Free</td> <td id="ticket_check_free_ticket"> </td>
                                        </tr>
                                    </table>
                        </div>
                        <!-- All List End -->

                        <div class="container-fluid">
                            <div class="row">
                                <!-- Ga -->
                                <div class="col-md-6 table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td colspan="2"> Ga Ticket</td>
                                        </tr>
                                        <tr>
                                            <td>Ga Price</td> <td id="ticket_check_ga_price"> 100 </td>
                                        </tr>
                                        <tr>
                                            <td>Ga Quantity </td> <td id="ticket_check_ga_quantity"> 200 </td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- Ga End -->

                                <!-- vip -->
                                <div class="col-md-6 table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td colspan="2"> Vip Ticket</td>
                                        </tr>
                                        <tr>
                                            <td>Vip Price</td> <td id="ticket_check_vip_price"> 100 </td>
                                        </tr>
                                        <tr>
                                            <td>Vip Quantity </td> <td id="ticket_check_vip_quantity"> 200 </td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- vip End -->

                                <!-- vvip -->
                                <div class="col-md-6 table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td colspan="2"> Vvip Ticket</td>
                                        </tr>
                                        <tr>
                                            <td>Vvip Price</td> <td id="ticket_check_vvip_price"> 100 </td>
                                        </tr>
                                        <tr>
                                            <td>Vvip Quantity </td> <td id="ticket_check_vvip_quantity"> 200 </td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- vvip End -->

                                
                            </div>
                        </div>
                        
                      
                        <!-- <p class="card-text" id="ticket_check_end_date"></p> -->
                    </div>
                    <!--  End -->

                </div>
        </div>
        <!-- Ticket Check Container End-->
        </div>


</div>