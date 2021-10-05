<script>

    $(document).ready(function () {

        var All_Container = [
            'Dashboard_Container',
            'User_Container',
            'Ticket_Container',
            'Order_Container',
            'Profile_Container'
        ];

        // Nav Bar Link 
        // @desc Each Link Eg Dashboard/ Login/ Register
        $(".container_change_click").click( function () {
              // get Container
              var container = $(this).data('container');
              // console.log(container);
              allClose();
              if(container == 'Profile_Container') {
                checkProfile();
              }
              $('#'+container).removeClass('d-none');
        });


        $(".toLogout").click( function () {
            toLogout();
        });
        
        // All Close Function
        function allClose() {
              All_Container.map( function (value) {
                $('#' + value).addClass('d-none');
              });
        };
        // To Sugger Login Page
        function toLogout() {
            document.location.href= "<?= URL ?>/logout";
        }

        // Check Profile 
        function checkProfile() {
          $.get('<?=URL?>/login/check', function (data) {
                  console.log(data);
                  var url = "<?=URL?>/user/get/" + data.data.id ;
                  $.get(url, function (getData) {
                            console.log('Get Editi Profile Data=>', getData);
                            profileFormSet(getData.data);
                  });
          });
        }

        // Set Profile Form Set
        function profileFormSet(obj) {

          $("#profile_image_input_id").val(obj.id);
          $('#profile_id').val(obj.id);
          $('#profile_card_name').html(obj.name);
          $('#profile_name').val(obj.name);
          $('#profile_email').val(obj.email);
          $('#profile_phone').val(obj.phone);

          $('#profile_image').css({
            backgroundImage: 'url('+obj.image+')'
          })

          console.log($('#profile_image'));
        }

        

        /**
         * 
         * For User Vision
         * 
         *  */ 
        var All_User_Container = [
            'User_List_Container',
            'User_Add_Container',
            'User_Edit_Container',
            'User_Creator_Add_Container',
            'User_Admin_Add_Container'
        ];

        function allUserContainerClose() {
            All_User_Container.map( function (value) {
                $('#' + value).addClass('d-none');
            });
        }

        // User Container Link 
        $(".user_container_change_click").click( function () {
              // get Container
              var container = $(this).data('container');
              allUserContainerClose();
              console.log(container);
              $('#'+container).removeClass('d-none');
        });

        userGet();

        $("#user_list_get").click( function () {
            var page = $('#user_list_get_input').val();
            if(page > $('#user_list_get_total_page').html()) {
                alert(' More than Count');
                return false;
            }
            userGet(page);
        });

        function userGet(page = 1) {
            console.log('userGet');
            $.ajax({
                url: '<?=URL?>/user/get?page=' + page,
                type: 'GET',
                data:'',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                   if(data) {
                       console.log(data);
                       $('#user_list_get_total_page').html(data.total_page);
                       $('#user_table_body > tr').remove();
                       if(data.data.length > 0 ) {
                           data.data.map( function (user)  {
                            userListTable(user).appendTo("#user_table_body");
                           } );
                       }
                   }
                },
                error: function(e) {
                   console.log(e);
                }
            });
        }

        function userListTable(data) {
            return $('<tr>')
            .append(
                $('<th>').html(data.id)
            )
            .append(
                $('<td>').html(data.name)
            )
            .append(
                $('<td>').html(data.role_name)
            )
            .append(
                $('<td>')
                    .append(
                        $('<button>', {type: 'button', class: 'btn btn-success  bmd-btn-icon'})
                        .html('<i class="material-icons medium text-success">edit</i>')
                        .data('data', data)
                        .click( function () {
                            console.log('edit');
                            var data = $(this).data('data');
                            console.log(data);

                            if(data.id == 1) {
                                // Admin
                                // $.get('/user/check').done();
                                $.ajax({
                                    url: '<?= URL ?>/login/check',
                                    type: 'GET',
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    beforeSend: function() {
                                        // $("#Register_Form_Loading").removeClass('d-none');
                                    },
                                    success: function(data2) {
                                        console.log('Get Self Data=>', data2);

                                        if(data2.data.id == data.id ) {
                                          // Get User Edit Profile
                                          var url = "<?=URL?>/user/get/" + data.id ;
                                          $.get(url, function (getData) {
                                                    console.log('Get Editi Profile Data=>', getData);
                                                    userEditFormSet(getData.data);
                                          });
                                        } else {
                                         
                                          alert("You Are Not Super Admin");
                                        }
                                    },
                                    error: function(e) {
                                        console.log('Error=>', e);
                                    }
                                });
                            } else {
                                 // Get User Edit Profile
                                  var url = "<?=URL?>/user/get/" + data.id ;
                                  $.get(url, function (getData) {
                                            console.log('Get Editi Profile Data=>', getData);
                                            userEditFormSet(getData.data);
                                  });
                            }
                        })
                    )
            )
            .append(
                $('<td>')
                    .append(
                        $('<button>', {type: 'button', class: 'btn btn-danger bmd-btn-icon ' +  (data.id == 1 ? 'disabled' : '')})
                        .data('data', data)
                        .html(
                            '<i class="material-icons medium text-danger '
                            +
                            '">delete</i>'
                        )
                        .click( function () {
                            console.log('delete');
                            console.log($(this).data('data'));
                            var user = $(this).data('data');
                            if(user.id == 1 ) {
                                alert(' This is Super Admin Cant Delete ');
                                return false;
                            } else if( user.id == <?= $_SESSION['auth']['id']?> ) {
                                alert("is YOu");
                                return false;
                            } else {
                                console.log();
                                var containerRow = $($(this).parent()).parent();
                                var url = "<?= URL ?>/user/delete";
                                $.post(url, { id: user.id })
                                .done(function(data){ 
                                  console.log(data);
                                  if(data.status) {
                                    $(containerRow).remove();
                                  }
                                })
                                .fail(function(xhr, status, error) {
                                    console.log(error);
                                });

                            }
                        })
                    )
            );
                             
        }

        // All Login_Form Submit 
        $('#Register_Form').on('submit', function(e) {
                e.preventDefault();

                console.log($(this).data('action'));

                var url = $(this).data('action');

                $.ajax({
                  url: url,
                  type: 'POST',
                  data: new FormData(this),
                  contentType: false,
                  cache: false,
                  processData: false,
                  beforeSend: function() {
                    $("#Register_Form_Loading").removeClass('d-none');
                  },
                  success: function(data) {
                    
                    if(data.errors) {
                      console.log("Errors", data.errors);
                      
                      var err = "";
                      data.errors.map(function ( error ) {
                        err += '<div class="alert alert-danger" role="alert">' + error + '</div>';
                      });
                      
                      $("#Register_Form_Error").html(err);

                    } else {
                      console.log("SUccess =>", data);
                      if(data.status) {
                        var success =  '<div class="alert alert-success" role="alert">' + 'Successfull Added' + '</div>';
                        userGet();
                        ['name', 'email', 'password', 'phone'].map( function (value) {
                          $('#register_'+value).val('');
                        });
                        $("#Register_Form_Error").html(success);
                      }
                    }
                    $("#Register_Form_Loading").addClass('d-none');
                  },
                  error: function(e) {
                    $("#Register_Form_Loading").addClass('d-none');
                    if(e) {
                      console.log(e.responseJSON);
                      var err = "";
                      e.responseJSON.errors.map(function (error) {
                        err += '<div class="alert alert-danger" role="alert">' + error + '</div>';
                      });
                      $("#Register_Form_Error").html(err);
                    }
                  }
                });
        });

        // All Login_Form Submit 
        $('#Creator_Register_Form').on('submit', function(e) {
                e.preventDefault();

                console.log($(this).data('action'));

                var url = $(this).data('action');

                $.ajax({
                  url: url,
                  type: 'POST',
                  data: new FormData(this),
                  contentType: false,
                  cache: false,
                  processData: false,
                  beforeSend: function() {
                    $("#Creator_Register_Form_Loading").removeClass('d-none');
                  },
                  success: function(data) {

                    if(data.errors) {
                      console.log("Errors", data.errors);
                      
                      var err = "";
                      data.errors.map(function ( error ) {
                        err += '<div class="alert alert-danger" role="alert">' + error + '</div>';
                      });
                      
                      $("#Creator_Register_Form_Error").html(err);

                    } else {
                      console.log("SUccess =>", data);
                      if(data.status) {
                        var success =  '<div class="alert alert-success" role="alert">' + 'Successfull Added' + '</div>';
                        userGet();
                        ['name', 'email', 'password', 'phone'].map( function (value) {
                          $('#register_creator_'+value).val('');
                        });
                        $("#Creator_Register_Form_Error").html(success);
                      }
                    }
                    $("#Creator_Register_Form_Loading").addClass('d-none');
                  },
                  error: function(e) {
                    $("#Creator_Register_Form_Loading").addClass('d-none');
                    if(e) {
                      console.log(e.responseJSON);
                      var err = "";
                      e.responseJSON.errors.map(function (error) {
                        err += '<div class="alert alert-danger" role="alert">' + error + '</div>';
                      });
                      $("#Creator_Register_Form_Error").html(err);
                    }
                  }
                });
        });

        // All Login_Form Submit 
        $('#Admin_Register_Form').on('submit', function(e) {
                e.preventDefault();

                console.log($(this).data('action'));

                var url = $(this).data('action');

                $.ajax({
                  url: url,
                  type: 'POST',
                  data: new FormData(this),
                  contentType: false,
                  cache: false,
                  processData: false,
                  beforeSend: function() {
                    $("#Admin_Register_Form_Loading").removeClass('d-none');
                  },
                  success: function(data) {

                    if(data.errors) {
                      console.log("Errors", data.errors);
                      
                      var err = "";
                      data.errors.map(function ( error ) {
                        err += '<div class="alert alert-danger" role="alert">' + error + '</div>';
                      });
                      
                      $("#Admin_Register_Form_Error").html(err);

                    } else {
                      console.log("SUccess =>", data);
                      if(data.status) {
                        var success =  '<div class="alert alert-success" role="alert">' + 'Successfull Added' + '</div>';
                        userGet();
                        ['name', 'email', 'password', 'phone'].map( function (value) {
                          $('#register_admin_'+value).val('');
                        });
                        $("#Admin_Register_Form_Error").html(success);
                      }
                    }
                    $("#Admin_Register_Form_Loading").addClass('d-none');
                  },
                  error: function(e) {
                    $("#Admin_Register_Form_Loading").addClass('d-none');
                    if(e) {
                      console.log(e.responseJSON);
                      var err = "";
                      e.responseJSON.errors.map(function (error) {
                        err += '<div class="alert alert-danger" role="alert">' + error + '</div>';
                      });
                      $("#Admin_Register_Form_Error").html(err);
                    }
                  }
                });
        });

        // All Login_Form Submit 
        $('#User_Edit_Form').on('submit', function(e) {
                e.preventDefault();

                console.log($(this).data('action'));

                var url = $(this).data('action');

                $.ajax({
                  url: url,
                  type: 'POST',
                  data: new FormData(this),
                  contentType: false,
                  cache: false,
                  processData: false,
                  beforeSend: function() {
                    $("#User_Edit_Form_Loading").removeClass('d-none');
                  },
                  success: function(data) {

                    if(data.errors) {
                      console.log("Errors", data.errors);
                      
                      var err = "";
                      data.errors.map(function ( error ) {
                        err += '<div class="alert alert-danger" role="alert">' + error + '</div>';
                      });
                      
                      $("#User_Edit_Form_Error").html(err);

                    } else {
                      console.log("SUccess =>", data);
                      if(data.status) {
                        var success =  '<div class="alert alert-success" role="alert">' + 'Successfull Updated' + '</div>';
                        userGet();
                        ['id', 'name', 'email', 'password', 'phone'].map( function (value) {
                          $('#user_edit_'+value).val('');
                        });
                        $("#User_Edit_Form_Error").html(success);
                      }
                    }
                    $("#User_Edit_Form_Loading").addClass('d-none');
                  },
                  error: function(e) {
                    $("#User_Edit_Form_Loading").addClass('d-none');
                    if(e) {
                      console.log(e.responseJSON);
                      var err = "";
                      e.responseJSON.errors.map(function (error) {
                        err += '<div class="alert alert-danger" role="alert">' + error + '</div>';
                      });
                      $("#User_Edit_Form_Error").html(err);
                    }
                  }
                });
        });

        // All Login_Form Submit 
        $('#Profile_Form').on('submit', function(e) {
                e.preventDefault();

                console.log($(this).data('action'));

                var url = $(this).data('action');

                $.ajax({
                  url: url,
                  type: 'POST',
                  data: new FormData(this),
                  contentType: false,
                  cache: false,
                  processData: false,
                  beforeSend: function() {
                    $("#Profile_Form_Loading").removeClass('d-none');
                  },
                  success: function(data) {

                    if(data.errors) {
                      console.log("Errors", data.errors);
                      
                      var err = "";
                      data.errors.map(function ( error ) {
                        err += '<div class="alert alert-danger" role="alert">' + error + '</div>';
                      });
                      
                      $("#Profile_Form_Error").html(err);

                    } else {
                      console.log("SUccess =>", data);
                      if(data.status) {
                        var success =  '<div class="alert alert-success" role="alert">' + 'Successfull Updated' + '</div>';
                        [ 'name', 'email', 'phone'].map( function (value) {
                          $('#profile'+value).val('');
                        });
                        checkProfile();
                        $("#Profile_Form_Error").html(success);
                      }
                    }
                    $("#Profile_Form_Loading").addClass('d-none');
                  },
                  error: function(e) {
                    $("#Profile_Form_Loading").addClass('d-none');
                    if(e) {
                      console.log(e.responseJSON);
                      var err = "";
                      e.responseJSON.errors.map(function (error) {
                        err += '<div class="alert alert-danger" role="alert">' + error + '</div>';
                      });
                      $("#Profile_Form_Error").html(err);
                    }
                  }
                });
        });

        // All Login_Form Submit 
        $('#Profile_Image_Form').on('submit', function(e) {
                e.preventDefault();

                console.log($(this).data('action'));

                var url = $(this).data('action');

                $.ajax({
                  url: url,
                  type: 'POST',
                  data: new FormData(this),
                  contentType: false,
                  cache: false,
                  processData: false,
                  beforeSend: function() {
                    $("#Profile_Image_Form_Loading").removeClass('d-none');
                  },
                  success: function(data) {

                    if(data.errors) {
                      console.log("Errors", data.errors);
                      
                      var err = "";
                      data.errors.map(function ( error ) {
                        err += '<div class="alert alert-danger" role="alert">' + error + '</div>';
                      });
                      
                      $("#Profile_Image_Form_Error").html(err);

                    } else {
                      console.log("SUccess =>", data);
                      if(data.status) {
                        var success =  '<div class="alert alert-success" role="alert">' + 'Successfull Updated' + '</div>';
                        // [ 'name', 'email', 'phone'].map( function (value) {
                        //   $('#profile'+value).val('');
                        // });
                        checkProfile();
                        $("#Profile_Image_Form_Error").html(success);
                      }
                    }
                    $("#Profile_Image_Form_Loading").addClass('d-none');
                  },
                  error: function(e) {
                    $("#Profile_Image_Form_Loading").addClass('d-none');
                    if(e) {
                      console.log(e.responseJSON);
                      var err = "";
                      e.responseJSON.errors.map(function (error) {
                        err += '<div class="alert alert-danger" role="alert">' + error + '</div>';
                      });
                      $("#Profile_Image_Form_Error").html(err);
                    }
                  }
                });
        });


        // User Edit Back 
        $('#user_edit_back').click( function () {
          allUserContainerClose();
          $("#User_List_Container").removeClass('d-none');
        });

        function userEditFormSet(obj) {
          console.log('userEditFormSet =>', obj);
          $("#User_Edit_Form_Error").html('');
          $("#user_edit_id").val(obj.id);
          $("#user_edit_name").val(obj.name);
          $("#user_edit_email").val(obj.email);
          $("#user_edit_phone").val(obj.phone);
          allUserContainerClose();
          $("#User_Edit_Container").removeClass('d-none');
        }


        /**
         * 
         * Ticket 
         * 
         */
        var All_Ticket_Container = [
            'Ticket_List_Container',
            'Ticket_Check_Container',
            'Ticket_Pending_List_Container',
            'Ticket_Reject_List_Container',
            'Ticket_Success_List_Container'
        ];

        function allTicketContainerClose() {
            All_Ticket_Container.map( function (value) {
                $('#' + value).addClass('d-none');
            });
        }

        // Ticket Container Link 
        $(".ticket_container_change_click").click( function () {
              // get Container
              var container = $(this).data('container');
              allTicketContainerClose();
              console.log(container);
              $('#'+container).removeClass('d-none');
        });
        
        // Ticket Check Detail
        function ticketCheckDetail(obj) {
          console.log('ticketCheck =>', obj);

          // Check Confrim or not
          if(obj.status == 1) {
            $("#ticket_check_confirm_or_not_container").removeClass('d-none');
            $("#ticket_check_confirm_button").data('id', obj.id);
            $("#ticket_check_reject_button").data('id', obj.id);
          } else {
            $("#ticket_check_confirm_or_not_container").addClass('d-none');            
          }
         
          $("#ticket_check_user_name").html('');
          $("#ticket_check_user_name")
          .append('<span class="table_image_icon_sm" style="background-image:url('+obj.user_image+')"></span>')
          .append('<span style="margin-left:40px">'+obj.user_name+'</span>');
          $("#ticket_check_user_phone").html(obj.user_phone);

          $("#ticket_check_image").css('background-image', 'url('+obj.image+')');
          $("#ticket_check_title").html(obj.title);
          $("#ticket_check_description").html( obj.description);
          $("#ticket_check_address").html(obj.address);
          $("#ticket_check_place").html(obj.event_category_name + ' in ' + obj.location_name);
          $("#ticket_check_start_date").html(obj.start_date);
          $("#ticket_check_end_date").html(obj.end_date);
          $("#ticket_check_status").html((obj.status_name));
          $("#ticket_check_free_ticket").html(JSON.stringify(obj.free_ticket == "1").toUpperCase());
          
          $("#ticket_check_ga_price").html( (obj.ticket_list.ga_price) + " Kyats");
          $("#ticket_check_ga_quantity").html((obj.ticket_list.ga_quantity) );
          $("#ticket_check_vip_price").html((obj.ticket_list.vip_price) + " Kyats");
          $("#ticket_check_vip_quantity").html( (obj.ticket_list.vip_quantity) );
          $("#ticket_check_vvip_price").html((obj.ticket_list.vvip_price) + " Kyats");
          $("#ticket_check_vvip_quantity").html( (obj.ticket_list.vvip_quantity) );

          allTicketContainerClose();
          $("#Ticket_Check_Container").removeClass('d-none');
        }

        // Ticket Confirm Button
        $("#ticket_check_confirm_button").click(function () {

          $("#ticket_check_confirm_or_not_loading").removeClass("d-none");

          var id = $(this).data("id");

          $.get("<?= URL ?>/ticket/updateConfirm/"+ id , function (data) {
            if(data.status) {
              $("#ticket_check_confirm_or_not_loading").addClass("d-none");
              $("#ticket_check_confirm_or_not_container").addClass("d-none");
              AllInOneTicket();
            }
          });

        });
        $("#ticket_check_reject_button").click(function () {

          $("#ticket_check_confirm_or_not_loading").removeClass("d-none");

          var id = $(this).data("id");

          $.get("<?= URL ?>/ticket/updateReject/"+ id , function (data) {
            if(data.status) {
              $("#ticket_check_confirm_or_not_loading").addClass("d-none");
              $("#ticket_check_confirm_or_not_container").addClass("d-none");
              AllInOneTicket();
            }
          });
        });
        
        // Get Initial Cretor Ticket List
        $("#ticket_list_get").click( function () {
                var page = $('#ticket_list_get_input').val();
                if(page > $('#ticket_list_get_total_page').html()) {
                    alert(' More than Count');
                    return false;
                }
                getAllTicketByAdmin(page);
        });

        function getAllTicketByAdmin(page = 1) {
              console.log('Ticket Get By User Id ');
              $.get( '<?=URL?>/ticket/get?page=' + page,
              function(data) {
                console.log(data);
                if(data.errors) {
                  console.log(data.errors);
                } else if (data.data) {
                        $('#ticket_list_get_total_page').html(data.total_page);
                        $('#ticket_table_body > tr').remove();
                        if(data.data.length > 0 ) {
                            data.data.map( function (user)  {
                              ticketListTable(user).appendTo("#ticket_table_body");
                            } );
                        }  
                  console.log('Get Data');
                }
              })
              .fail(function(e) {
                console.log(e);
              });
        }

        // Get Pening Cretor Ticket List
        $("#ticket_pending_list_get").click( function () {
                var page = $('#ticket_pending_list_get_input').val();
                if(page > $('#ticket_pending_list_get_total_page').html()) {
                    alert(' More than Count');
                    return false;
                }
                getPendingTicketByAdmin(page);
        });
        function getPendingTicketByAdmin(page = 1) {
              $('#ticket_pending_table_body > tr').remove();
              $.get( '<?=URL?>/ticket/getByPending?page=' + page,
              function(data) {
                console.log(data);
                if(data.errors) {
                  console.log(data.errors);
                } else if (data.data) {
                        $('#ticket_pending_list_get_total_page').html(data.total_page);
                        
                        if(data.data.length > 0 ) {
                            data.data.map( function (user)  {
                              ticketListTable(user).appendTo("#ticket_pending_table_body");
                            } );
                        }  
                  console.log('Get Data');
                }
              })
              .fail(function(e) {
                console.log(e);
              });
        }

        // Get Success Creator Ticket List
        $("#ticket_success_list_get").click( function () {
                var page = $('#ticket_success_list_get_input').val();
                if(page > $('#ticket_success_list_get_total_page').html()) {
                    alert(' More than Count');
                    return false;
                }
                getSuccessTicketByAdmin(page);
        });
        function getSuccessTicketByAdmin(page = 1) {
              $('#ticket_success_table_body > tr').remove();
              $.get( '<?=URL?>/ticket/getBySuccess?page=' + page,
              function(data) {
                console.log(data);
                if(data.errors) {
                  console.log(data.errors);
                } else if (data.data) {
                        $('#ticket_success_list_get_total_page').html(data.total_page);
                        
                        if(data.data.length > 0 ) {
                            data.data.map( function (user)  {
                              ticketListTable(user).appendTo("#ticket_success_table_body");
                            } );
                        }  
                  console.log('Get Data');
                }
              })
              .fail(function(e) {
                console.log(e);
              });
        }

        // Get Reject Creator Ticket List
        $("#ticket_reject_list_get").click( function () {
                var page = $('#ticket_reject_list_get_input').val();
                if(page > $('#ticket_reject_list_get_total_page').html()) {
                    alert(' More than Count');
                    return false;
                }
                getRejectTicketByAdmin(page);
        });
        function getRejectTicketByAdmin(page = 1) {
              $('#ticket_reject_table_body > tr').remove();
              $.get( '<?=URL?>/ticket/getByReject?page=' + page,
              function(data) {
                console.log(data);
                if(data.errors) {
                  console.log(data.errors);
                } else if (data.data) {
                        $('#ticket_reject_list_get_total_page').html(data.total_page);
                        
                        if(data.data.length > 0 ) {
                            data.data.map( function (user)  {
                              ticketListTable(user).appendTo("#ticket_reject_table_body");
                            } );
                        }  
                  console.log('Get Data');
                }
              })
              .fail(function(e) {
                console.log(e);
              });
        }


        function ticketListTable (data) {
                var color = data.status == 1 ? 'primary' : 
                data.status == 2 ? 'success' : 'danger';
                var icon = data.status == 1 ? 'slow_motion_video' : 
                data.status == 2 ? 'mobile_friendly' : 'backspace';;

                return $('<tr>')
                .append(
                    $('<th>').html(data.id)
                )
                .append(
                    $('<td>').append(
                      $('<div>', {
                          class: "table_image_icon",
                          style: "background-image:url("+data.image+")"
                        }
                      )
                    )
                )
                .append(
                    $('<td>').html(data.title)
                )
                .append(
                    $('<td>')
                    .append(
                          $('<button>', {type: 'button', class: 'btn btn-'+color+' bmd-btn-icon ', disabled: "disabled"})
                          .html('<i class="material-icons medium text-'+color+'">'+icon+'</i>')
                    )
                    .append(data.status_name)
                )
                .append(
                    $('<td>')
                        .append(
                            $('<button>', {type: 'button', class: 'btn btn-success  bmd-btn-icon'})
                            .html('<i class="material-icons medium text-success">remove_red_eye</i>')
                            .data('data', data)
                            .click( function () {
                                console.log('check');
                                var data = $(this).data('data');
                                // console.log(data);
                                ticketCheckDetail(data);
                            })
                        )
                );
        }

        function AllInOneTicket() {
          getAllTicketByAdmin();
          getPendingTicketByAdmin();
          getSuccessTicketByAdmin();
          getRejectTicketByAdmin();
          DashBoard();
        }
        AllInOneTicket();



         /**
         * 
         * Order 
         * 
         */
        var All_Order_Container = [
            'Order_List_Container',
            'Order_Check_Container',
            'Order_Pending_List_Container',
            'Order_Reject_List_Container',
            'Order_Success_List_Container'
        ];

        function allOrderContainerClose() {
            All_Order_Container.map( function (value) {
                $('#' + value).addClass('d-none');
            });
        }

        // Order Container Link 
        $(".order_container_change_click").click( function () {
              // get Container
              var container = $(this).data('container');
              allOrderContainerClose();
              console.log(container);
              $('#'+container).removeClass('d-none');
        });
        
        // Order Check Detail
        function orderCheckDetail(obj) {
          console.log('order_Check =>', obj);

          // Check Confrim or not
          if(obj.status == 1) {
            ['ga','vip','vvip'].map( function (dt) {
              $("#left_"+dt).html(obj.ticket_list[dt+"_quantity"]);
            });
            $("#order_check_confirm_or_not_container").removeClass('d-none');
            $("#order_check_confirm_button").data('id', obj.id);
            $("#order_check_reject_button").data('id', obj.id);
          } else {
            $("#order_check_confirm_or_not_container").addClass('d-none');            
          }

          $("#order_check_user_name").html('');
          $("#order_check_user_name")
          .append('<span class="table_image_icon_sm" style="background-image:url('+obj.user_image+')"></span>')
          .append('<span style="margin-left:40px">'+obj.user_name+'</span>');
          $("#order_check_user_phone").html(obj.user_phone);

          $("#order_check_image").css('background-image', 'url('+obj.image+')');
          $("#order_check_title").html(obj.ticket_title);
          console.log(obj.ticket_title);
          
          $("#order_check_ga_price").html( (obj.ga_price) + " Kyats");
          $("#order_check_ga_quantity").html((obj.ga_quantity) );
          $("#order_check_vip_price").html((obj.vip_price) + " Kyats");
          $("#order_check_vip_quantity").html( (obj.vip_quantity) );
          $("#order_check_vvip_price").html((obj.vvip_price) + " Kyats");
          $("#order_check_vvip_quantity").html( (obj.vvip_quantity) );
          $("#order_check_total_price").html( (obj.total_price) + " Kyats" );

          allOrderContainerClose();
          $("#Order_Check_Container").removeClass('d-none');

        }

        // Ticket Confirm Button
        $("#order_check_confirm_button").click(function () {

          $("#order_check_confirm_or_not_loading").removeClass("d-none");

          var id = $(this).data("id");

          $.get("<?= URL ?>/order/updateConfirm/"+ id , function (data) {
            if(data.status) {
              $("#order_check_confirm_or_not_loading").addClass("d-none");
              $("#order_check_confirm_or_not_container").addClass("d-none");
              AllInOneOrder();
            } else if(data.errors) {
              AllInOneOrder();
              console.log(data.errors);
              data.errors.map( function (value) {

                console.log("Value => ", value);
                Object.keys(value).map( function (d) {
                  var thi = $("<div>", {class: "alert alert-danger", role: "alert"})
                  .append(value[d])
                  .prependTo("#right_side");
                    setTimeout(function () {
                        $(thi).remove();
                    }, 3000);
                });
              });
              
              $("#order_check_confirm_or_not_loading").addClass("d-none");
            }
          });

        });

        $("#order_check_reject_button").click(function () {

          $("#order_check_confirm_or_not_loading").removeClass("d-none");

          var id = $(this).data("id");

          $.get("<?= URL ?>/order/updateReject/"+ id , function (data) {
            if(data.status) {
              $("#order_check_confirm_or_not_loading").addClass("d-none");
              $("#order_check_confirm_or_not_container").addClass("d-none");
              AllInOneOrder();
            }
          });
        });

        // Get Initial Cretor Order List
        $("#order_list_get").click( function () {
                var page = $('#order_list_get_input').val();
                if(page > $('#order_list_get_total_page').html()) {
                    alert(' More than Count');
                    return false;
                }
                getAllOrderByAdmin(page);
        });

        function getAllOrderByAdmin(page = 1) {
              $.get( '<?=URL?>/order/get?page=' + page,
              function(data) {
                console.log(data);
                if(data.errors) {
                  console.log(data.errors);
                } else if (data.data) {
                        $('#order_list_get_total_page').html(data.total_page);
                        $('#order_table_body > tr').remove();
                        if(data.data.length > 0 ) {
                            data.data.map( function (user)  {
                              orderListTable(user).appendTo("#order_table_body");
                            } );
                        }  
                  console.log('Get Data');
                }
              })
              .fail(function(e) {
                console.log(e);
              });
        }

        function orderListTable (data) {
                var color = data.status == 1 ? 'primary' : 
                data.status == 2 ? 'success' : 'danger';
                var icon = data.status == 1 ? 'slow_motion_video' : 
                data.status == 2 ? 'mobile_friendly' : 'backspace';;

                return $('<tr>')
                .append(
                    $('<th>').html(data.id)
                )
                .append(
                    $('<td>').append(
                      $('<div>', {
                          class: "table_image_icon",
                          style: "background-image:url("+data.image+")"
                        }
                      )
                    )
                )
                .append(
                    $('<td>').html(data.ticket_title)
                )
                .append(
                    $('<td>')
                    .append(
                          $('<button>', {type: 'button', class: 'btn btn-'+color+' bmd-btn-icon ', disabled: "disabled"})
                          .html('<i class="material-icons medium text-'+color+'">'+icon+'</i>')
                    )
                    .append(data.status_name)
                )
                .append(
                    $('<td>')
                        .append(
                            $('<button>', {type: 'button', class: 'btn btn-success  bmd-btn-icon'})
                            .html('<i class="material-icons medium text-success">remove_red_eye</i>')
                            .data('data', data)
                            .click( function () {
                                console.log('check');
                                var data = $(this).data('data');
                                // console.log(data);
                                orderCheckDetail(data);
                            })
                        )
                );
        }

        // Get Pening Cretor Order List
        $("#order_pending_list_get").click( function () {
                var page = $('#order_pending_list_get_input').val();
                if(page > $('#order_pending_list_get_total_page').html()) {
                    alert(' More than Count');
                    return false;
                }
                getPendingOrderByAdmin(page);
        });
        function getPendingOrderByAdmin(page = 1) {
              $('#order_pending_table_body > tr').remove();
              $.get( '<?=URL?>/order/getByPending?page=' + page,
              function(data) {
                console.log(data);
                if(data.errors) {
                  console.log(data.errors);
                } else if (data.data) {
                        $('#order_pending_list_get_total_page').html(data.total_page);
                        
                        if(data.data.length > 0 ) {
                            data.data.map( function (user)  {
                              orderListTable(user).appendTo("#order_pending_table_body");
                            } );
                        }  
                  console.log('Get Data');
                }
              })
              .fail(function(e) {
                console.log(e);
              });
        }

        // Get Success Creator Order List
        $("#order_success_list_get").click( function () {
                var page = $('#order_success_list_get_input').val();
                if(page > $('#order_success_list_get_total_page').html()) {
                    alert(' More than Count');
                    return false;
                }
                getSuccessOrderByAdmin(page);
        });
        function getSuccessOrderByAdmin(page = 1) {
              $('#order_success_table_body > tr').remove();
              $.get( '<?=URL?>/order/getBySuccess?page=' + page,
              function(data) {
                console.log(data);
                if(data.errors) {
                  console.log(data.errors);
                } else if (data.data) {
                        $('#order_success_list_get_total_page').html(data.total_page);
                        
                        if(data.data.length > 0 ) {
                            data.data.map( function (user)  {
                              orderListTable(user).appendTo("#order_success_table_body");
                            } );
                        }  
                  console.log('Get Data');
                }
              })
              .fail(function(e) {
                console.log(e);
              });
        }

        // Get Reject Creator Order List
        $("#order_reject_list_get").click( function () {
                var page = $('#order_reject_list_get_input').val();
                if(page > $('#order_reject_list_get_total_page').html()) {
                    alert(' More than Count');
                    return false;
                }
                getRejectOrderByAdmin(page);
        });
        function getRejectOrderByAdmin(page = 1) {
              $('#order_reject_table_body > tr').remove();
              $.get( '<?=URL?>/order/getByReject?page=' + page,
              function(data) {
                console.log(data);
                if(data.errors) {
                  console.log(data.errors);
                } else if (data.data) {
                        $('#order_reject_list_get_total_page').html(data.total_page);
                        
                        if(data.data.length > 0 ) {
                            data.data.map( function (user)  {
                              orderListTable(user).appendTo("#order_reject_table_body");
                            } );
                        }  
                  console.log('Get Data');
                }
              })
              .fail(function(e) {
                console.log(e);
              });
        }


        function AllInOneOrder() {
          getAllOrderByAdmin();
          getPendingOrderByAdmin();
          getSuccessOrderByAdmin();
          getRejectOrderByAdmin();
          DashBoard();
        }

        AllInOneOrder();

        function DashBoard() {
          var url = "<?= URL ?>/admin/dashboard";
          $.get(url, function (data) {
            Object.keys(data).map(function (key) {
              $("#dashboard_"+key).html(data[key]);
            });
          });
        }

        DashBoard();

    });

</script>