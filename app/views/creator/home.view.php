<?php 
    include "./Inc/header.php";
    // NavBar Include
    include "./Inc/creator/navbar.php";
?>
   
<!-- Wrap Container -->
<div class="mt-4 container-fluid">
    <div class="row justify-content-center">
        <div class="col-11 ">
            
            <div class="row">

            <!-- Left Side Container -->
            <div class="col-md-3 mb-3">
                    <!-- Left Side Bar -->
                        <?php include './Inc/creator/sidebarleft.php' ?>
                    <!-- Left Side Bar End -->
                </div>
            <!-- Left Side Container End -->

            <!-- Left Side Container -->
            <div class="col-md-9 mb-3">
                    
                    <!-- Dashboard Container  -->
                    <div id="Dashboard_Container" class="fadeIn ">
                            <?php include "./Inc/creator/container/dashboard.php" ?>
                    </div>
                    <!-- Dashboard Container End -->

                    <!-- Ticket Container  -->
                    <div id="Ticket_Container" class="fadeIn d-none">
                            <?php include "./Inc/creator/container/ticket.php" ?>
                    </div>
                    <!-- Ticket Container End -->

                    <!-- Profile Container  -->
                    <div id="Profile_Container" class="fadeIn d-none">
                        <?php include "./Inc/creator/container/profile.php" ?>
                    </div>
                    <!-- Profile Container End -->
            
            </div>
            <!-- Left Side Container End -->

            </div>

        </div>
    </div>
    
</div>
<!-- Wrap Container End -->


<?php
    include "./Inc/creator/js/js.php";
    // footer
    include "./Inc/footer.php";
 
?>