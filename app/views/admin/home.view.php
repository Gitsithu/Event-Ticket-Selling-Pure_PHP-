<?php 
    include "./Inc/header.php";
    // NavBar Include
    include "./Inc/admin/navbar.php";
?>
   
<!-- Wrap Container -->
<div class="mt-4 container-fluid">
    <div class="row justify-content-center">
        <div class="col-11 ">
            
            <div class="row">

            <!-- Left Side Container -->
            <div class="col-md-3 mb-3">
                    <!-- Left Side Bar -->
                        <?php include './Inc/admin/sidebarleft.php' ?>
                    <!-- Left Side Bar End -->
                </div>
            <!-- Left Side Container End -->

            <!-- Right Side Container -->
            <div class="col-md-9 mb-3" id="right_side">
                    
                    <!-- Dashboard Container  -->
                    <div id="Dashboard_Container" class="fadeIn ">
                            <?php include "./Inc/admin/container/dashboard.php" ?>
                    </div>
                    <!-- Dashboard Container End -->
                    
                    <!-- User Container  -->
                    <div id="User_Container" class="fadeIn d-none">
                            <?php include "./Inc/admin/container/user.php" ?>
                    </div>
                    <!-- User Container End -->

                    <!-- Ticket Container  -->
                    <div id="Ticket_Container" class="fadeIn d-none">
                            <?php include "./Inc/admin/container/ticket.php" ?>
                    </div>
                    <!-- Ticket Container End -->

                    <!-- Order Container  -->
                    <div id="Order_Container" class="fadeIn d-none">
                            <?php include "./Inc/admin/container/order.php" ?>
                    </div>
                    <!-- Order Container End -->

                    <!-- Profile Container  -->
                    <div id="Profile_Container" class="fadeIn d-none">
                        <?php include "./Inc/admin/container/profile.php" ?>
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
    include "./Inc/admin/js/js.php";
    // footer
    include "./Inc/footer.php";
 
?>