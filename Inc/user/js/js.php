<script>

    $(document).ready(function () {



        var All_Container = [
            'Ticket_Container',
            'Ticket_Detail_Container',
            'Order_Container',
            'Profile_Container',
            'Coming_Soon_Container'
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


        /**
         *
         *  Ticket Form Submit
         *
         */

         $("#submit").click( function () {
           
          //  Check All is Zero ?
          if(
            $("#ga_user_input_quantity").val() <= 0 &&
            $("#vip_user_input_quantity").val() <= 0 &&
            $("#vvip_user_input_quantity").val() <= 0 
          ) {
            $("#ga_user_input_quantity").val(0);
            $("#vip_user_input_quantity").val(0);
            $("#vvip_user_input_quantity").val(0);
            alert("Plz Fill Something?")
            return;
          }


          var total = 0;
          var image = $("#ticket_check_image").data("image");

          var ga_qty = 0;
          var ga_price = $("#ga_price").data("price");
          var vip_qty = 0;
          var vip_price = $("#vip_price").data("price");
          var vvip_qty = 0;
          var vvip_price = $("#vvip_price").data("price");

          // Check User Input Quantity
          if($("#ga").data("ga") == 1 ) {
            console.log("Ga Exist");
             ga_qty = $("#ga_user_input_quantity").val();
            
            if(ga_qty > 0 ) {
              console.log("Total Ga Price => "+ga_qty+" Qty x "+ga_price+" Kyats = "+ (ga_qty * ga_price)+" Kyats ");
              total += (ga_qty * ga_price);
            }

          }

          if($("#vip").data("vip") == 1 ) {
            console.log("vip Exist");
            vip_qty = $("#vip_user_input_quantity").val();
            vip_price = $("#vip_price").data("price");
            if(vip_qty > 0 ) {
              console.log("Total vip Price => "+vip_qty+" Qty x "+vip_price+" Kyats = "+ (vip_qty * vip_price)+" Kyats ");
              total += (vip_qty * vip_price);
            }

          }

          if($("#vvip").data("vvip") == 1 ) {
            console.log("vvip Exist");
            vvip_qty = $("#vvip_user_input_quantity").val();
            vvip_price = $("#vvip_price").data("price");
            if(vvip_qty > 0 ) {
              console.log("Total vvip Price => "+vvip_qty+" Qty x "+vvip_price+" Kyats = "+ (vvip_qty * vvip_price)+" Kyats ");
              total += (vvip_qty * vvip_price);
            }

          }

          console.log("All Total => ", total);

          var ticket_id = $("#ticket_id").data("id");
          var user_id = <?= $_SESSION['auth']['id'] ?>;
          var ga = $("#ga").data("ga");
          var vip = $("#vip").data("vip");
          var vvip = $("#vvip").data("vvip");
          var data = {
            ticket_id: ticket_id,
            user_id: user_id,
            image: image,
            ga: ga,
            ga_price: ga_price,
            ga_quantity: ga_qty,
            vip: vip,
            vip_price: vip_price,
            vip_quantity: vip_qty,
            vvip: vvip,
            vvip_price: vvip_price,
            vvip_quantity: vvip_qty,
            total_price: total
          };

          // console.log(data);
          // return;

          var url = "<?= URL ?>/order/insert";
          $.post(url, data, function (res) {
              console.log(res);
              if(res.status) {

              allInOne();
              var thi = $("<div>", {class: "alert alert-success", role: "alert"})
              .append("Successfully Ordered Pending")
              .prependTo("#right_side")
                setTimeout(function () {
                    $(thi).fadeOut("slow");
                }, 500);
                  
                setTimeout(function () {
                    $(thi).remove();
                }, 1300);

              } else if(res.errors) {
                console.log(res);
              }
          });

         });
        //  Submit End

         var ticketTypeArr = [
           'ga',
           'vip',
           'vvip'
         ];

         ticketTypeArr.map(function (value) {
          
          $("#" + value + "_user_input_quantity").on("keyup", function (e) {
             var val = $(this).val();
             var thi = $(this);
            //  console.log("userQuantity=>",val);

             if(val == '') {
                alert("Not Number");
                $(thi).val(0);
                return ;
             }

             console.log("Limited Qty =>",  $("#"+value+"_quantity").data("quantity"));

             if(parseInt(val) >  parseInt($("#"+value+"_quantity").data("quantity"))) {
               alert("Check Limt");
               $(thi).val( $("#"+value+"_quantity").data("quantity"));
             }

           });

           $("#" + value + "_user_input_quantity").on("change", function (e) {
             var val = $(this).val();
             var thi = $(this);
            //  console.log("userQuantity=>",val);

             if(val == '') {
                alert("Not Number");
                $(thi).val(0);
                return ;
             }

             console.log("Limited Qty =>",  $("#"+value+"_quantity").data("quantity"));

             if(parseInt(val) >  parseInt($("#"+value+"_quantity").data("quantity"))) {
               alert("Check Limt");
               $(thi).val( $("#"+value+"_quantity").data("quantity"));
             }

           });

         });

        /**
         *  Initial Get
         */ 
         // Get Initial Cretor Ticket List
          $("#ticket_list_get").click( function () {
                var page = $('#ticket_list_get_input').val();
                if(page > $('#ticket_list_get_total_page').html()) {
                    alert(' More than Count');
                    return false;
                }
                getByUserTicket(page);
          });

          function getByUserTicket(page = 1) {
             $.get('<?= URL ?>/ticket/getByUserTicket?page='+page, function (data) {
                if(data.errors) {
                  console.log(data.errors);
                } else if (data.data) {
                        $('#ticket_list_get_total_page').html(data.total_page);
                        $('#ticket_table_body > tr').remove();
                        if(data.data.length > 0 ) {
                            $("#user_show_ticket_container> div").remove();
                            data.data.map( function (user)  {
                              // console.log(user);
                              makeTicketCard(user).appendTo("#user_show_ticket_container");
                            } );
                        }  
                  // console.log('Get Data');
                }
             } );
          }

        /**
         * Make Card Container
         */

         function makeTicketCard(obj) {
          var str = ( obj.ticket_list.ga_quantity == 0 && 
                              obj.ticket_list.vip_quantity == 0 && 
                              obj.ticket_list.vvip_quantity == 0)  ? 'SoldOut' : '';

           return $('<div>', {class: 'col-sm-6 col-md-4 mb-3'})
                  .append(
                    $('<div>', {class: 'card'})
                    .append(
                      $('<div>', {class: 'image-container', style: 'background-image:url('+obj.image+')'})
                    )
                    .append(
                      $('<div>', {class: 'card-body'})
                      .append("<h5 class='card-title card-fade-title'>"+obj.title+"</h5>")
                      .append("<p>"+obj.event_category_name+" in "+obj.location_name+"</p>")
                      .append("<p class='card-text card-description'>"+obj.description+"</p>")
                      .append(
                        $("<button>", {
                          type: "button", href: "#!", 
                          class: "btn btn-raised btn-"
                            + (obj.free_ticket == 1 ? "success" : obj.free_ticket == 0 && str == '' ? 'info' : 'danger') 
                            +" buyticket" 
                        })
                        .append(
                          obj.free_ticket == 1 ? "FreeTicket" : obj.free_ticket == 0 && str == '' ? 'Buy Now' : str
                        )
                        .data("id", obj.id)
                        .click( function () {
                          console.log("CLICK DIVVVV");
                          // First Check Form Hide
                          $("#ticket_check_form").addClass("d-none");
                          var id = $(this).data("id");
                          var url = "<?= URL ?>/ticket/get/" + id;
                          $.get(url, function (data) {
                            if(data.data) {
                              ticketDataSet(data.data);
                              allClose();
                              $("#Ticket_Detail_Container").removeClass("d-none");
                            } else {
                              alert("SomeThing Went Wrong Plz Try Again Refresh");
                            }
                          });
                         
                        })
                      )
                    )
                  )

         }

         function ticketDataSet(obj) {
            // Set Id 
            $("#ticket_id").data("id", obj.id);
            // Set Image
            $("#ticket_check_image")
            .css('background-image', 'url('+obj.image+')')
            .data("image", obj.image);
            
            var soldOut = false;
            var totalCount_4soldout = 0;
            // Hiddien
            ['ga', 'vip', 'vvip'].map( function (val) {
              $("#"+val).addClass("d-none");
              totalCount_4soldout += parseInt(obj.ticket_list[val + "_quantity"]);
              console.log("SoldOUt", totalCount_4soldout);
            });
            if(totalCount_4soldout == 0 ) {
              soldOut = true;
              console.log("Sold Out True");
            } 

            // Set Ga
            if(obj.ticket_list.ga == 1 ) $("#ga").removeClass("d-none");
            $("#ga").data("ga", obj.ticket_list.ga);
            $("#ga_quantity")
             .data("quantity", obj.ticket_list.ga_quantity)
             .html(obj.ticket_list.ga_quantity);
            $("#ga_price")
             .data("price", obj.ticket_list.ga_price)
             .html(obj.ticket_list.ga_price);
            $("#ga_user_input_quantity")
            .val(0)
            .attr("max", obj.ticket_list.ga_quantity);
            
            // Set vip
            if(obj.ticket_list.vip == 1 ) $("#vip").removeClass("d-none");
            $("#vip").data("vip", obj.ticket_list.vip);
            $("#vip_quantity")
             .data("quantity", obj.ticket_list.vip_quantity)
             .html(obj.ticket_list.vip_quantity);
            $("#vip_price")
             .data("price", obj.ticket_list.vip_price)
             .html(obj.ticket_list.vip_price);
            $("#vip_user_input_quantity")
            .val(0)
            .attr("max", obj.ticket_list.vip_quantity); 
            
            // Set vvip
            if(obj.ticket_list.vvip == 1 ) $("#vvip").removeClass("d-none");
            $("#vvip").data("vvip", obj.ticket_list.vvip);
            $("#vvip_quantity")
             .data("quantity", obj.ticket_list.vvip_quantity)
             .html(obj.ticket_list.vvip_quantity);
            $("#vvip_price")
             .data("price", obj.ticket_list.vvip_price)
             .html(obj.ticket_list.vvip_price);
            $("#vvip_user_input_quantity")
            .val(0)
            .attr("max", obj.ticket_list.vvip_quantity); 

            // If Sold Out Or Free Ticket 
            if(obj.free_ticket != 1 && soldOut != true) {
              $("#ticket_check_form").removeClass("d-none");
            }

            // All Below Description
            $("#ticket_check_title").html(obj.title);
            $("#ticket_check_description").html(obj.description);
            $("#ticket_check_place").html(obj.event_category_name + ' in ' + obj.location_name);
            $("#ticket_check_address").html(obj.address);
            $("#ticket_check_start_date").html(obj.start_date);
            $("#ticket_check_end_date").html(obj.end_date);
            $("#ticket_check_status").html((obj.status_name));
            $("#ticket_check_free_ticket").html(JSON.stringify(obj.free_ticket == "1").toUpperCase());

         };

        /**
         *
         * Order Start
         *
         */
        var All_Order_Container = [
            'Order_List_Container',
            'Order_Check_Container'
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

         // Get Pening Cretor Ticket List
         $("#order_list_get").click( function () {
                var page = $('#order_list_get_input').val();
                if(page > $('#order_list_get_total_page').html()) {
                    alert(' More than Count');
                    return false;
                }
                getOrderByUserId(page);
        });
       

        function getOrderByUserId(page=1) {
          var id = <?= $_SESSION['auth']['id'] ?>;
          var url = '<?= URL ?>/order/getByUserId/'+ id;

          $('#order_list_table_body > tr').remove();

          $.get(url, function (data) {
            console.log(data);
            if(data.data) {
              $('#order_list_get_total_page').html(data.total_page);
                        
                        if(data.data.length > 0 ) {
                            data.data.map( function (user)  {
                              orderListTable(user).appendTo("#order_list_table_body");
                            } );
                        }  
                  console.log('Get Data');
            }
          } );
        }

        function orderListTable(data) {
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
                                console.log(data);
                                ticketCheckDetail(data);
                            })
                        )
                );
        }

        allInOne();

          // Ticket Check Detail
          function ticketCheckDetail(obj) {
          console.log('ticketCheck =>', obj);

         
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

        // All In One Package

        function allInOne() {
          getByUserTicket();
          getOrderByUserId();
        }
        
    });

</script>