<?php error_reporting(0); ?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>USJR - SMS</title>

      <?php include ('/application/views/templates/nav.php'); ?>
    
  </head>

<body>
<div id="wrapper">
  <!-- Sidebar -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Header -->
  <?php $home = 'sms/profile'; ?>
  <?php foreach($studentinfo as $value) { } ?>
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">    
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      <a class="navbar-brand" href="<?php echo base_url(); ?><?php echo $home; ?>">University Of San Jose Recoletos - Student Monitoring System</a>
    </div>

<!-- Nagivation -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
  <ul class="nav navbar-nav side-nav">
    <li><a href="<?php echo base_url(); ?>sms/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url(); ?>sms/viewgrades"><i class="icon32 icon-color icon-document"></i> Grades</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>sms/viewstudyload"><i class="icon32 icon-color icon-compose"></i> Study Load</a></li>
    <li><a href="<?php echo base_url(); ?>sms/viewlasent"><i class="icon32 icon-red icon-clock"></i> Lates and Absences</a></li>
    <li><a href="<?php echo base_url(); ?>sms/viewParents"><i class="icon32 icon-color icon-users"></i> Trackers</a></li>
    <li><a href="<?php echo base_url(); ?>sms/calendarforstudent/2014/03"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>
  </ul>

      <ul class="nav navbar-nav navbar-right navbar-user">
        <li class="dropdown messages-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="noti-box"><div id="noti"></div><i class="icon icon-color icon-messages"></i> Notification <b class="icon icon-color icon-triangle-s"></b></a>
          <ul class="dropdown-menu">
            <li class="dropdown-header"><div id="notification"></div></li>
          </ul>
        </li><!-- /.dropdown messages-dropdown -->

        <li class="dropdown user-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $value['first_name'].' '.$value['last_name']; ?> <b class="icon icon-color icon-triangle-s"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>sms/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>sms/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
          </ul>
        </li><!-- /.dropdown user-dropdown -->
      </ul><!-- /.nav navbar-nav navbar-right navbar-user -->
</div><!-- /.navbar-collapse -->
</nav>

      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1>Study Load</h1>
              <ol class="breadcrumb">
              <li class="active"><i class="fa fa-desktop"></i> Lost your study load...again? Hmmm HAHAHA</li>
            </ol>
          </div>
          <div class="col-lg-4" style="width:300px;">
            <div class="well well-sm">
               <?php
                    echo 'Student Number: '.$value['student_number']; 
                ?>
            </div>
          </div>

          <div class="col-lg-4" style="right: -520px; width:300px;">
            <div class="well well-sm">
              Term: 2nd Sem. 2013 - 2014
            </div>
          </div>

        </div><!-- /.row -->
        <div>
          <div class="col-lg-4" style="right: 15px; width:300px; top:-12px;">
            <div class="well well-sm">
              <?php echo 'Course & Year: '.$value['course']. '- ' .$value['year'] ?>
            </div>
          </div>
        </div>

<br><br>
            <div class="table-responsive">
              <table class="table table-hover tablesorter">
                <thead>
                  <tr>
                    <th>Subject Code</th>
                    <th>Offer Code</th>
                    <th>Description</th>
                    <th>Units</th>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Room</th>
                    <th>Teacher</th>
                  </tr>
                </thead>

                <tbody align="center">
                  <?php 
                      foreach($viewStudyLoad as $value) {
                  ?>
                  <tr>
                    <td>
                      <?php echo $value['subject_code']; ?>
                    </td>  
                    <td>
                      <?php echo $value['offer_code']; ?>
                    </td>  
                    <td>
                      <?php echo $value['subject_description']; ?>
                    </td>      
                    <td>
                      <?php echo $value['units']; ?>
                    </td>    
                    <td>
                      <?php echo $value['days']; ?>
                    </td>    
                    <td>
                      <?php echo $value['start_time']; ?>
                    </td>
                    <td>
                      <?php echo $value['end_time']; ?>
                    </td> 
                    <td>
                      <?php echo $value['room']; ?>
                    </td>    
                    <td>
                      <?php echo $value['first_name']. " " .$value['last_name']; ?>
                    </td>              
                  </tr>
                  <?php } ?>


                </tbody>
              </table>
            </div><!-- table-responsive -->
          </div> <!-- end page-wrapper -->
</div> <!-- end wrapper -->

<script type="text/javascript">
  var num = 0;
$(document).ready(function() {
  $('#noti').hide();
  var audioElement = document.createElement('audio');
  audioElement.setAttribute('src', '<?php echo base_url(); ?>notification/Notify_Sound.mp3');
  var es = new EventSource("<?php echo base_url(); ?>notification/notification_to_student");
  var listener = function (data) {
  var data = $.parseJSON(data.data); 
  
    var num2 = 0;
    var id_update = [];
    var num3=0;

    if(num==num2) { 
      $.each(data, function(index, val) {  
        //if(index==data.length-1) { 
          //audioElement.play();
          $("#notification").prepend("<li>"+val.message+" ("+val.date+")</li>");
       // }
      });  
    }

    $.each(data, function(index, val) {  
      id_update[num] = val.notification_id;
      num++;
      num3++;
      $("#noti").hide(); 
      $("#noti").show(); 
      $("#noti").html("!");
    });  
    
    num2=num;
    num=num2;
    num3=0;

  }
  es.addEventListener("message", listener);

  $("#noti-box").click(function() {
  $("#noti").hide();
  function update_print_noti() {
    $.ajax({
      type: 'POST',
      url: "<?php echo base_url(); ?>notification/notification_update_student",
      data: {id : id_update},
      dataType: 'json', 
      success: function(update) {
        $.each(update, function(index, val) {
          $("#notification").prepend("<li>"+val.message+" ("+val.date+")</li>");
        });
      }
    });
    $("#notification").empty();
  }
  update_print_noti();
  });

});

</script>

  </body>
</html>
