   <div class="container">
    <!-- Ticket Detail Container -->
        <div class="fadeIn">
                <div class="card">
                        
                        <div 
                            id="ticket_check_image"
                            class="image-container-check" 
                            style="background-image:url(http://localhost/eventticket/assets/images/logo/homewallpaper.jpg)"
                        >
                        </div>

                        <!-- Form -->
                        <div class="card-body pb-1" id="ticket_check_form">
                            <div class="container-fluid table-responsive">
                                <table class="table table-bordered">
                                            <!-- Type  -->
                                            <tr id="Type">
                                                <th> Type </th> 
                                                <th id="Type_quantity"> 
                                                    LeftQty
                                                </th>
                                                <th id="Type_user_quantity"> 
                                                    OrderQty
                                                </th>
                                                <th id="Type_price"> 
                                                    Price
                                                </th>
                                            </tr>
                                            <!-- Type End -->

                                            <!-- Hidden Id -->
                                            <input type="number" id="ticket_id" data-id="1" class="d-none">

                                            <!-- Ga  -->
                                            <tr id="ga" data-ga="1">
                                                <td> Ga </td> 
                                                <td id="ga_quantity" data-quantity="1"> 
                                                    1
                                                </td>
                                                <td id="ga_user_quantity"> 
                                                    <input id="ga_user_input_quantity" type="number"  min="0" class="self_input" value="0">
                                                </td>
                                                <td id="ga_price" data-price="100"> 
                                                    100
                                                </td>
                                            </tr>
                                            <!-- Ga End -->

                                            <!-- vip  -->
                                            <tr id="vip" data-vip="1">
                                                <td> vip </td> 
                                                <td id="vip_quantity" data-quantity="1"> 
                                                    1
                                                </td>
                                                <td id="vip_user_quantity"> 
                                                    <input id="vip_user_input_quantity" type="number"  min="0" class="self_input" value="0">
                                                </td>
                                                <td id="vip_price" data-price="200"> 
                                                    200
                                                </td>
                                            </tr>
                                            <!-- vip End -->

                                            <!-- vvip  -->
                                            <tr id="vvip" data-vvip="1">
                                                <td> vvip </td> 
                                                <td id="vvip_quantity" data-quantity="1"> 
                                                    1
                                                </td>
                                                <td id="vvip_user_quantity"> 
                                                    <input id="vvip_user_input_quantity" type="number"  min="0" class="self_input" value="0">
                                                </td>
                                                <td id="vvip_price" data-price="300"> 
                                                    300
                                                </td>
                                            </tr>
                                            <!-- vvip End -->
                                            <tr id="">
                                                <td colspan=3>  </td> 
                                                <td id=""> 
                                                    <button id="submit" type="button" class="btn btn-sm btn-raised btn-primary">Buy Now</button>
                                                </td>
                                            </tr>

                                </table>
                            </div>
                        </div>
                        <!-- Form End-->

                        <!--  Start -->
                        <div class="card-body pt-2">
                            <!-- All List -->
                            <div class="container-fluid table-responsive">
                                        <table class="table table-bordered">
                                            

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

                            <!-- <div class="container-fluid">
                                <div class="row"> -->
                                    <!-- Ga -->
                                    <!-- <div class="col-md-6 table-responsive">
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
                                    </div> -->
                                    <!-- Ga End -->

                                    <!-- vip -->
                                    <!-- <div class="col-md-6 table-responsive">
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
                                    </div> -->
                                    <!-- vip End -->

                                    <!-- vvip -->
                                    <!-- <div class="col-md-6 table-responsive">
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
                                    </div> -->
                                    <!-- vvip End -->

                                    
                                <!-- </div>
                            </div> -->
                            
                        
                            <!-- <p class="card-text" id="ticket_check_end_date"></p> -->
                        </div>
                        <!--  End -->

                </div>
        </div>
    <!-- Ticket Detail Container End-->
   </div>
