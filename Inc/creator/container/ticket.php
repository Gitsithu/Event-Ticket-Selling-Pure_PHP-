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
                            data-container="Ticket_Add_Container"
                            class="list-group-item side_hover ticket_container_change_click"
                        >
                            <i class="material-icons text-primary">person_add</i>
                            TicketAdd
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

        <!-- Ticket_Add_Container Container   -->
        <div class="fadeIn d-none" id="Ticket_Add_Container">
            <div class="card">
                    
                    <div class="card-header ">
                        <h4> Add Ticket </h4>
                    </div>

                    <!-- Form Start -->
                    <div class="card-body">
                    
                        <!-- Form -->
                            <form 
                                class="mb-3" 
                                method="post" 
                                id="Ticket_Add_Form" 
                                data-action="<?= URL ?>/ticket/insert"
                                enctype="multipart/form-data"
                            >   

                                <input type="hidden" name="user_id" value="<?= $_SESSION["auth"]["id"] ?>">
                            
                                <div class="form-group">
                                    <label for="ticket_title" class="bmd-label-floating">Title</label>
                                    <input name="title" type="text" class="form-control" id="ticket_title">
                                </div>

                                <div class="form-group">
                                    <label for="ticket_description" class="bmd-label-floating">Description</label>
                                    <input name="description" type="text" class="form-control" id="ticket_description">
                                </div>

                                <div class="form-group">
                                    <label for="ticket_address" class="bmd-label-floating">Address</label>
                                    <input name="address" type="text" class="form-control" id="ticket_address">
                                </div>


                                <div class="form-group">
                                    <label for="ticket_location" class="bmd-label-floating"> Location </label>
                                    <select class="form-control" id="ticket_location" name="location_id">

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ticket_category" class="bmd-label-floating"> Category </label>
                                    <select class="form-control" id="ticket_category" name="event_category_id">

                                    </select>
                                </div>

                                <!-- Date -->
                                <div class="container-fluid mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>Start Date</h5>
                                            <input 
                                                name="start_date"
                                             placeholder="Choose Date"
                                             id="ticket_start_date"
                                             class="c-datepicker-input profile_image_upload_label"
                                            />
                                        </div>

                                        <div class="col-6">
                                            <h5>End Date</h5>
                                            <input 
                                             name="end_date"
                                             placeholder="Choose Date"
                                             id="ticket_end_date"  
                                             class="c-datepicker-input profile_image_upload_label"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <!-- Date End -->

                                <!-- Free Ticket Handler -->
                                <div class="switch">
                                    <label>
                                    <input
                                        id="Free_Ticket" 
                                        name="freely_ticket_handler"
                                        type="checkbox" 
                                        checked
                                    >
                                        Free Ticket
                                    </label>

                                    <input type="text" class="d-none" id="free_ticket_value" name="free_ticket" value="true">
                                </div>
                                <!-- Free Ticket Handler -->
                                

                                <!-- Not Free Ticket -->
                                <div class="container-fluid fadeIn d-none" id="Ga_Container">
                                    <div class="row">

                                        <!-- Ga -->
                                        <div class="col-md-6 mb-3">
                                            <div class="card">

                                                    <div class="card-header">
                                                        <h6> Ga </h6>
                                                    </div>

                                                    <div class="card-body pt-1">

                                                        <div class="switch">
                                                                <label>
                                                                <input name="ga_handler" type="checkbox" id="ga_handler">
                                                                    Ga
                                                                </label>
                                                                <input type="text" class="d-none" name="ga" value="false" id="ga_value">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="ticket_ga" class="bmd-label-floating">Price</label>
                                                            <input name="ga_price" type="number" class="form-control" id="ticket_ga" value="0" readonly="readonly">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="ticket_ga_quantity" class="bmd-label-floating">Count</label>
                                                            <input name="ga_quantity" type="number" class="form-control" id="ticket_ga_quantity" value="0" readonly="readonly">
                                                        </div>

                                                    </div>
                                            </div>
                                        </div>
                                        <!-- Ga End -->

                                         <!-- Vip -->
                                         <div class="col-md-6 mb-3">
                                            <div class="card">

                                                    <div class="card-header">
                                                        <h6> VIP </h6>
                                                    </div>

                                                    <div class="card-body pt-1">

                                                        <div class="switch">
                                                                <label>
                                                                <input name="vip_handler" type="checkbox" id="vip_handler">
                                                                    VIP
                                                                </label>
                                                                <input type="text" class="d-none" name="vip" value="false" id="vip_value">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="ticket_vip" class="bmd-label-floating">Price</label>
                                                            <input name="vip_price" type="number" class="form-control" id="ticket_vip" value="0" readonly="readonly">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="ticket_vip_quantity" class="bmd-label-floating">Count</label>
                                                            <input name="vip_quantity" type="number" class="form-control" id="ticket_vip_quantity" value="0" readonly="readonly">
                                                        </div>

                                                    </div>
                                            </div>
                                        </div>
                                        <!-- Vip End -->

                                         <!-- VVIP -->
                                         <div class="col-md-6 mb-3">
                                            <div class="card">

                                                    <div class="card-header">
                                                        <h6> VVIP </h6>
                                                    </div>

                                                    <div class="card-body pt-1">

                                                        <div class="switch">
                                                                <label>
                                                                <input name="vvip_handler" type="checkbox" id="vvip_handler">
                                                                    VVIP
                                                                </label>
                                                                <input type="text" class="d-none" name="vvip" value="false" id="vvip_value">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="ticket_vvip" class="bmd-label-floating">Price</label>
                                                            <input name="vvip_price" type="number" class="form-control" id="ticket_vvip" value="0" readonly="readonly">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="ticket_vvip_quantity" class="bmd-label-floating">Count</label>
                                                            <input name="vvip_quantity" type="number" class="form-control" id="ticket_vvip_quantity" value="0" readonly="readonly">
                                                        </div>

                                                    </div>
                                            </div>
                                        </div>
                                        <!-- VVIP End -->

                                    </div>
                                </div>
                                <!-- Not Free Ticket End -->

                                <div class="mb-5 mt-5">
                                    <label for="ticket_image" class="profile_image_upload_label"> Image Upload </label>
                                    <input name="file" type="file" class="d-none" id="ticket_image">
                                </div>
                               
                                <div>
                                    <button type="submit" class="btn btn-primary btn-raised">Submit</button>
                                    <button type="reset" class="btn btn-danger btn-raised"> Clear </button>

                                    <div id="Ticket_Add_Form_Loading" class="lds-dual-ring d-none"></div>
                                    <div id="Ticket_Add_Form_Error" class="mt-2">
                                </div>

                                </div>

                            </form>
                        <!-- Form End -->

                    </div>
                    <!-- Form End -->

                </div>
        </div>
        <!-- Ticket_Add_Container Container End  -->

        <!-- Ticket Check Container -->
        <div class="fadeIn d-none" id="Ticket_Check_Container">
            <div class="card">
                    
                    <div class="card-header ">
                        <h4>  Ticket Detail </h4>
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