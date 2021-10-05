<?php 
    include "./Inc/header.php";
    // NavBar Include
    include "./Inc/user/navbar.php";
?>
   
<!-- Wrap Container -->
<div class="mt-4 container-fluid">
    <div class="row justify-content-center">
        <div class="col-11 ">
            
            <div class="row">

            <!-- Left Side Container -->
            <div class="col-md-3 mb-3">
                    <!-- Left Side Bar -->
                        <?php include './Inc/user/sidebarleft.php' ?>
                    <!-- Left Side Bar End -->
                </div>
            <!-- Left Side Container End -->

            <!-- Right Side Container -->
            <div class="col-md-9 mb-3" id="right_side">
                    
                    <!-- Ticket Container  -->
                    <div id="Ticket_Container" class="fadeIn ">
                            <?php include "./Inc/user/container/ticket.php" ?>
                    </div>
                    <!-- Ticket Container End -->

                    <!-- Ticket_Detail Container  -->
                    <div id="Ticket_Detail_Container" class="fadeIn d-none">
                            <?php include "./Inc/user/container/ticket_detail.php" ?>
                    </div>
                    <!-- Ticket_Detail Container End -->

                    <!-- Ticket Container  -->
                    <div id="Order_Container" class="fadeIn d-none">
                            <?php include "./Inc/user/container/order.php" ?>
                    </div>
                    <!-- Ticket Container End -->

                    <!-- Ticket Container  -->
                    <div id="Coming_Soon_Container" class="fadeIn d-none">
                            <?php include "./Inc/user/container/coming_soon.php" ?>
                    </div>
                    <!-- Ticket Container End -->

                    <!-- Profile Container  -->
                    <div id="Profile_Container" class="fadeIn d-none">
                        <?php include "./Inc/user/container/profile.php" ?>
                    </div>
                    <!-- Profile Container End -->
            
            </div>
            <!-- Right Side Container End -->

            </div>

        </div>
    </div>
    
</div>
<!-- Wrap Container End -->


<?php
    include "./Inc/user/js/js.php";
    // footer
    include "./Inc/footer.php";
 
?>