<script>

    $(document).ready(function () {

      var dateTimePicker = [
        "ticket_start_date",
        "ticket_end_date"
      ];

      dateTimePicker.map( function (value) {
        // console.log("PickerList", value);
        var input = $('#'+value);
        var picker = new MaterialDatetimePicker()
        .on('submit', function (val) {
            $(input).data("time", val);
            $(input).val(val.format("YYYY-MM-DD  h:mm:ss a"));
        });
        
        $(input).on('focus', function () {
            picker.open();
        });
        
      });

      // Free Ticket Changes
      $('#Free_Ticket').on('click', function () {
        var prop = $(this);
        showHideFreeTicket(prop);
        handleArr.map( function (ga) {
            if($("#"+ ga + "_handler").prop("checked")) {
              $("#"+ ga + "_handler").click();
            }
        });
      });

      
      var handleArr = [
        'ga','vip','vvip'
      ]
      

      // Form Reset
      $("#Ticket_Add_Form").on('reset', function () {
        console.log('reset');

        setTimeout(function () {
          showHideFreeTicket($('#Free_Ticket'));
          handleArr.map( function (value) {
              handler(value);
          });
        }, 100);
        // Ga / Vip / VVIp
      })

      // Form Submit
      $("#Ticket_Add_Form").on('submit', function (e) {
        e.preventDefault();
        console.log("Submit");
       
        // var formData = new FormData(this);
        // for(var pair of formData.entries()) {
        //   console.log(pair[0]+ ' => '+ pair[1]); 
        // }

        var errors = [];
        var startDate = $("#ticket_start_date").val();
        var endDate = $("#ticket_end_date").val();

        if(startDate == '' ) {
          errors.push('Start Date required');
        }

        if(endDate == '' ) {
          errors.push('End Date is required');
        }

        if(errors.length > 0 ) {
          errors.map( function (error) {
            var thi = $('<div>', {class: 'alert alert-danger', role: 'alert'})
            .append(error)
            .appendTo("#Ticket_Add_Form_Error");
            setTimeout(function() {
              $(thi).remove();
            }, 2000);
          });
          return;
        }

        var now = moment().set({hour:0,minute:0,second:0,millisecond:0}).valueOf();
        startDate = moment($("#ticket_start_date").data("time")).valueOf();
        endDate = moment($("#ticket_end_date").data("time")).valueOf();

        console.log(now);
        console.log(startDate);
        console.log(endDate);
        // return;

        if(startDate < now ) {
          errors.push(' Start Date is Less than Now ');
        }

        if( endDate < startDate) {
          errors.push(' EndDate is Less than Start Date ');
        }

        if(errors.length > 0 ) {
          errors.map( function (error) {
            var thi = $('<div>', {class: 'alert alert-danger', role: 'alert'})
            .append(error)
            .appendTo("#Ticket_Add_Form_Error");
            setTimeout(function() {
              $(thi).remove();
            }, 3000);
          });
          return;
        }
        
        var url = $(this).data('action');

          $.ajax({
            url: url,
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
              $("#Ticket_Add_Form_Loading").removeClass('d-none');
            },
            success: function(data) {

              if(data.errors) {
                console.log("Errors", data.errors);

                var err = "";
                data.errors.map(function ( error ) {
                  err += '<div class="alert alert-danger" role="alert">' + error + '</div>';
                });

                $("#Ticket_Add_Form_Error").html(err);

              } else {
                console.log("SUccess =>", data);
                if(data.status) {
                  var success =  '<div class="alert alert-success" role="alert">' + 'Successfull Inserted' + '</div>';
                  $("#Ticket_Add_Form_Error").html(success);
                  $("#Ticket_Add_Form")[0].reset();
                  getTicketByUserId();
                  DashBoard();

                }
              }
              $("#Ticket_Add_Form_Loading").addClass('d-none');
            },
            error: function(e) {
              $("#Ticket_Add_Form_Loading").addClass('d-none');
              if(e) {
                console.log(e);
                console.log(e.responseJSON);
                e.responseJSON.errors.map(function (error) {
                  var thi = $('<div>', {class: 'alert alert-danger', role: 'alert'})
                  .append(error)
                  .appendTo("#Ticket_Add_Form_Error");
                    setTimeout(function() {
                      $(thi).remove();
                    }, 3000);
                });
              }
            }
          });
       
      });

      function showHideFreeTicket (prop) {
        if($(prop).is(":checked")) {
          $("#Ga_Container").addClass('d-none');
          $("#free_ticket_value").val(true);



        } else {
          $("#Ga_Container").removeClass('d-none');
          $("#free_ticket_value").val(false);     
        }
      }

      handleArr.map( function (value) {
        $("#"+value+"_handler").on('click',function () {
          handler(value);
        });
      });

      function handler(ga) {
        if($("#"+ ga + "_handler").prop("checked")) {
          $("#ticket_"+ga).removeAttr('readonly');
          $("#ticket_"+ga+"_quantity").removeAttr('readonly');
          $("#"+ga+"_value").val(true);
        } else {
          $("#"+ga+"_value").val(false);
          $("#ticket_"+ga).val(0);
          $("#ticket_"+ga+"_quantity").val(0);
          $("#ticket_"+ga).attr('readonly','readonly');
          $("#ticket_"+ga+"_quantity").attr('readonly','readonly');
        }
      }


      // Get Initial Cretor Ticket List
      $("#ticket_list_get").click( function () {
            var page = $('#ticket_list_get_input').val();
            if(page > $('#ticket_list_get_total_page').html()) {
                alert(' More than Count');
                return false;
            }
            getTicketByUserId(page);
      });

      function getTicketByUserId(page = 1) {
          console.log('Ticket Get By User Id ');
          $.post( '<?=URL?>/ticket/getByUserId?page=' + page,
          {
            "id": "<?= $_SESSION['auth']['id'] ?>"
          },
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

      getTicketByUserId();

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
    

        var All_Container = [
            'Dashboard_Container',
            'Ticket_Container',
            'Profile_Container',
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


        // Get And Set Location
        function setLocation () {
          var url = "<?=URL?>/location";
          $.get(url, function (data) {
            console.log(data.data);
            data.data.map( function (getData) {
              $("#ticket_location").append(
                $('<option>', {value: getData.id}).html(getData.name)
              );
            });
            // return data.data.map( function (data2) {return  data2});
          });
        }

        setLocation();

        // Get And Set Category
        function setCategory () {
          var url = "<?=URL?>/eventcategory";
          $.get(url, function (data) {
            console.log(data.data);
            data.data.map( function (getData) {
              $("#ticket_category").append(
                $('<option>', {value: getData.id}).html(getData.name)
              );
            });
            // return data.data.map( function (data2) {return  data2});
          });
        }

        setCategory();



        /**
         *
         * Ticket Start
         *
         */
        var All_Ticket_Container = [
            'Ticket_List_Container',
            'Ticket_Add_Container',
            'Ticket_Check_Container'
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


        function DashBoard() {
          var id = <?= $_SESSION['auth']['id'] ?>;
          var url = "<?= URL ?>/creator/dashboard/" + id;
          $.get(url, function (data) {
            Object.keys(data).map(function (key) {
              $("#dashboard_"+key).html(data[key]);
            });
          });
        }

        DashBoard();
    });

</script>