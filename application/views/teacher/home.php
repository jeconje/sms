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
    <div id="wrapper">
      <?php $home = 'teacher/profile'; ?>
      <?php foreach($teacherInfo as $value) { } ?>
      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?><?php echo $home; ?>">University Of San Jose Recoletos - Student Monitoring System</a></div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li class="active"><a href="<?php echo base_url(); ?>teacher/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>teacher/view_logs"><i class="icon32 icon-color icon-book-empty"></i> Attendance Logs</a></li>
            <li><a href="<?php echo base_url(); ?>teacher/view_candidates"><i class="icon32 icon-color icon-contacts"></i> SDPC Candidates </a></li>
            <li><a href="<?php echo base_url(); ?>teacher/calendar_teacher/2014/03"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>    
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown messages-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="noti-box"><div id="noti"></div><i class="icon icon-color icon-messages"></i> Notification <b class="icon icon-color icon-triangle-s"></b></a>
          <ul class="dropdown-menu">
            <li class="dropdown-header"><div id="notification"></div></li>
            <li class="divider"></li>
            <!-- <li><a href="<?php echo base_url(); ?>sms/message">View Inbox <span class="icon icon-color icon-envelope-closed"></span></a></li> -->
          </ul>
        </li><!-- /.dropdown messages-dropdown -->
            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $first_name.' '.$last_name; ?> <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>teacher/edit_profile"><i class="icon icon-color icon-user"></i> Edit Profile</a></li>
                <li><a href="<?php echo base_url(); ?>teacher/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>teacher/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
        </nav>

        </div><!-- /.navbar-collapse -->      

        <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-3">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="upload">
                   <img style="height:180px;width:240px" src="<?php echo $image_path; ?>"></img>
                   <br>
                  </div>
                </div>
              </div>
                <div class="panel-footer announcement-bottom">
                  <center>
                    <?php echo form_open_multipart('teacher/profile'); ?>
                          <input  type = "file" name = "userfile" /> <br>
                          <input class="btn btn-primary" type="submit" value="Upload Photo"/>
                    <?php echo form_close();?>    
                  </center>
                  <div class="row">
                  </div>
                </div>
            </div>        
          </div>

          <?php foreach($collegeinfo as $college) { 

          } ?>

          <div class="col-lg-3">
           <div class="panel panel-warning" style="width:312px; height:200px;">
                 <div class="panel-heading" style="width:310px; height:200px;">
            <?php if($college['college_id'] == $college_id) { ?>
                <?php echo "<b>Faculty ID: </b>".$faculty_id; ?><br>
                <?php echo "<b>Name: </b>".$first_name." ".$middle_name." ".$last_name; ?><br>
                <?php echo "<b>Department: </b>" .$college['college_desc']; ?><br>
                <?php echo "<b>Address: </b>".$address; ?><br>
                <?php echo "<b>Email Address: </b>".$email_address; ?><br>
                <?php echo "<b>Contact Number: </b>".$contact_number; ?><br>
                <?php echo "<b>Date of Birth: </b>".$date_of_birth; } ?> 
              </div>
  
            </div>
          </div>
        </div><!-- /.row -->        
        <div class="row">
          <div class="col-lg-12" style="left: 0px; top: 0px">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </i>
                     <?php 
                  date_default_timezone_set('Asia/Manila');
                  $datestring = "%D %M %d, %Y - %h:%i:%s %A";
                  $time = time();
                ?>
                Today&#39;s Date : <?php echo mdate($datestring, $time);?></h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-area"></div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->

  <div class="col-lg-4" style="right: 13px; top: -10px; width: 1100px;">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money"></i> Class Schedule</h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                      <tr>
                        <th> Offer Code </th>
                        <th> Subject Description </th>
                        <th> Time </th>
                        <th> Day </th>
                        <th> Room </th>
                        <th> Enrollees </th>
                        <th>  </th>
                        <th>  </th>
                      </tr>
                    </thead>
                    <tbody>                                       
                   <?php                                  
                     date_default_timezone_set('Asia/Manila');                              
                     $date = date('Y-m-d');                       
             foreach($classes as $value) {                        
                 $count = 0;
                    foreach($students_load as $load)
                         {
                            if($load['offer_code'] == $value['offer_code'])                             
                                $count++;
                         };       
                    ?>
                  <tr>
                    <td><?php echo $value['offer_code']; ?></td>  
                    <td><?php echo $value['subject_description']; ?></td>
                    <td><?php echo $value['start_time'].' - '.$value['end_time']; ?></td>
                    <td><?php echo $value['days']; ?></td>   
                    <td><?php echo $value['room']; ?></td>  
                    <td><?php echo $count; ?></td>

<?php if($value['room'] == 'BCL 1' || $value['room'] == 'BCL 2' || $value['room'] == 'BCL 3' || $value['room'] == 'BCL 4' || $value['room'] == 'BCL 5' || $value['room'] == 'BCL 6' || $value['room'] == 'BCL 7' || $value['room'] == 'BCL 8' || $value['room'] == 'BCL 9') 
  {
      $room = "laboratory";
      $check = "assign_laboratory";
  }
  else if($value['room'] == 'BRD 1')
  { 
      $room = "brd1";
      $check = "assign_brd1";

  }
  else if ($value['room'] == 'BRD 2')
  {
      $room = "brd2";
      $check = "assign_brd2";
  }
  else
  {
      $room = "classroom";
      $check = "assign_classroom";
  }
?>

<td><a href='<?php echo base_url(); ?>teacher/<?php echo $check ?>/<?php echo $value['offer_code']; ?>'><input class="btn btn-primary" type="submit" value="Assign Seats"/></a></td>
<td><a href='<?php echo base_url(); ?>teacher/<?php echo $room ?>/<?php echo $value['offer_code']; ?>'>
<input  
    <?php 
      if($wayKlase != "") {
        echo "disabled";
      }
      else 
      {
        if($event == "Suspended" && $petsa == date('Y-m-d')) {
        if(strtotime(date('h:i A')) >= strtotime($start_time) && strtotime(date('h:i A')) <= strtotime($end_time)) {
       echo "disabled";
          
        }
      }
     if(strtotime(date('h:i A')) >= strtotime($value['start_time']) && strtotime(date('h:i A')) <= strtotime($value['end_time']))   {                                                         
        echo "";
     }      
     else
      echo "disabled";
    }
     ?>
     
 class="btn btn-primary" type="submit" value="Check Attendance"/>

</a></td>                                        

                            
                  </tr>
                  <?php } ?>
                    
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

<script type="text/javascript">
  var num = 0;
$(document).ready(function() {
  $('#noti').hide();
  var audioElement = document.createElement('audio');
  audioElement.setAttribute('src', '<?php echo base_url(); ?>notification/Notify_Sound.mp3');
  var es = new EventSource("<?php echo base_url(); ?>notification/notification_to_teacher");
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
      url: "<?php echo base_url(); ?>notification/notification_update_teacher",
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
