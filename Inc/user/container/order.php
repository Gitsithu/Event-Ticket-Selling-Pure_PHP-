<div class="row">

    <!-- User Functions -->
    <div class="col-sm-6 mb-3 col-md-3">
        <div class="card">
                <div class="card-body">
                    <ul class="list-group">

                        <a
                            data-container="Order_List_Container"
                            class="list-group-item side_hover order_container_change_click"
                        >
                            <i class="material-icons text-primary">list</i>
                            OrderList
                        </a>

                        <!-- <a
                            data-container="Ticket_Add_Container"
                            class="list-group-item side_hover ticket_container_change_click"
                        >
                            <i class="material-icons text-primary">person_add</i>
                            TicketAdd
                        </a> -->
                        

                    </ul>
                </div>
        </div>
                
    </div>
    <!-- User Functions End -->

    
    <div class="col-sm-6 mb-3 col-md-9">
    
        <!-- Order_List_Container Container -->
        <div class="fadeIn" id="Order_List_Container">
            
            <div class="row justify-content-end">
                <div class="col-md-3 col-lg-2">
                    <div class="input-group mb-3">
                    
                        <input
                            type="text"
                            class="form-control" 
                            value="1" 
                            aria-label="Default" 
                            aria-describedby="inputGroup-sizing-default"
                            id="order_list_get_input"
                         >
                        <div class="input-group-prepend">
                            <button class="btn btn-sm btn-outline-primary" type="button" id="order_list_get">
                                /<span id="order_list_get_total_page"> 0 </span>
                            </button>
                        </div>  
                    </div>
                </div>
            </div>

            <!-- Table COntainer -->
            <div class="table-responsive">
                    <table class="table table-hover " id="Order_list_Table">

                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Status</th>
                                <th scope="col">Detail</th>
                            </tr>
                        </thead>

                        <tbody id="order_list_table_body">
                           
                        </tbody>

                    </table>
            </div>
            <!-- Table COntainer End-->

        </div>
        <!-- Order_List_Container Container End -->

        <!-- Order Detail -->
        <div class="fadeIn d-none" id="Order_Check_Container">
        <div class="card">
                    
                    <div class="card-header ">
                        <h4>  
                            Order Detail   
                        </h4>
                    </div>

                    <div 
                        id="order_check_image"
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
                                            <td class="table_tr_pos_for_icon" id="order_check_user_name">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td> Phone </td> 
                                            <td class="" id="order_check_user_phone">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Title</td> <td id="order_check_title"> </td>
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
                                            <td>Ga Price</td> <td id="order_check_ga_price"> 100 </td>
                                        </tr>
                                        <tr>
                                            <td>Ga Quantity </td> <td id="order_check_ga_quantity"> 200 </td>
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
                                            <td>Vip Price</td> <td id="order_check_vip_price"> 100 </td>
                                        </tr>
                                        <tr>
                                            <td>Vip Quantity </td> <td id="order_check_vip_quantity"> 200 </td>
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
                                            <td>Vvip Price</td> <td id="order_check_vvip_price"> 100 </td>
                                        </tr>
                                        <tr>
                                            <td>Vvip Quantity </td> <td id="order_check_vvip_quantity"> 200 </td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- vvip End -->

                                <!-- Total Price -->
                                <div class="col-md-6 table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td> Total Price Ticket</td>
                                        </tr>
                                        <tr>
                                            <td id="order_check_total_price"> 100 </td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- Total End -->

                                
                            </div>
                        </div>
                        
                      
                        <!-- <p class="card-text" id="ticket_check_end_date"></p> -->
                    </div>
                    <!--  End -->

                </div>
        </div>
        <!-- Order Detail -->

    </div>


</div>