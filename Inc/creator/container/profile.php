<div class="row">

    <!-- User Functions -->
    <div class="col-sm-6 col-md-3 mb-3">
        <div class="card">
              <div class="image-container" id="profile_image" style="background-image:url(<?= URL ?>/assets/images/logo/homewallpaper.jpg)">

              </div>
              <div class="card-body">
                <h5 class="card-title" id="profile_card_name">Name</h5>
                
                <div>
                    <form enctype="multipart/form-data" id="Profile_Image_Form" data-action="<?= URL ?>/user/updateimage">
                                <input type="hidden" name="id" value="" id="profile_image_input_id">
                                <div class="mb-2">
                                    <label for="profile_input" class="profile_image_upload_label"> Image Upload </label>
                                    <input name="file" type="file" class="d-none" id="profile_input">
                                </div>

                                <button type="submit" class="btn btn-info bmd-btn-icon active">
                                    <i class="material-icons">add</i>
                                </button>

                            <!-- <button type="submit" class="btn btn-primary btn-raised btn-sm"> Upload </button> -->
                            <div id="Profile_Image_Form_Loading" class="lds-dual-ring d-none"></div>
                            <div id="Profile_Image_Form_Error" class="mt-2">
                            </div>
                    </form>
                </div>

              </div>
        </div>
                
    </div>
    <!-- User Functions End -->

    
    <div class="col-sm-6 col-md-9 mb-3">
        <!-- Profile Edit Container -->
        <div class="fadeIn" id="Profile_Edit_Container">
            <div class="card">
                
                <div class="card-header ">
                <h4> Profile Edit </h4>
                </div>

                <!-- Form Start -->
                <div class="card-body">
                
                <!-- Form -->
                <form class="mb-3" method="post" id="Profile_Form" data-action="<?= URL ?>/user/updateprofile">
                    
                    <input name="id" type="hidden" class="form-control" id="profile_id">

                    <div class="form-group">
                        <input placeholder="name" name="name" type="text" class="form-control" id="profile_name">
                    </div>

                    <div class="form-group">
                        <input placeholder="email" name="email" type="email" class="form-control" id="profile_email">
                    </div>

                    <div class="form-group">
                        <input placeholder="phone" name="phone" type="text" class="form-control" id="profile_phone">
                    </div>
                    
                    <div>
                    <button type="submit" class="btn btn-primary btn-raised">Submit</button>
                    <div id="Profile_Form_Loading" class="lds-dual-ring d-none"></div>
                    <div id="Profile_Form_Error" class="mt-2">
                    </div>

                    </div>

                </form>
                <!-- Form End -->

                </div>
                <!-- Form End -->
            </div>
        </div>
        <!-- Profile Edit Container End -->
    </div>


</div>