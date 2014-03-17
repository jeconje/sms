
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
  <?php 
    $home = 'teacher/profile';
  ?>
  <div id="wrapper">
<!-- Nagivation -->
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
            <li><a href="<?php echo base_url(); ?>teacher/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>teacher/view_logs"><i class="icon32 icon-color icon-book-empty"></i> Attendance Logs</a></li>
            <li><a href="<?php echo base_url(); ?>teacher/view_candidates"><i class="icon32 icon-color icon-contacts"></i> SDPC Candidates </a></li>
            <li ><a href="<?php echo base_url(); ?>teacher/calendar_teacher/2014/03"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>    
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown messages-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="noti-box"><div id="noti"></div><i class="icon icon-color icon-messages"></i> Notification <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header"><div id="notification"></div></li>
               
            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $first_name.' '.$last_name ?> <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>teacher/edit_profile"><i class="icon icon-color icon-user"></i> Edit Profile</a></li>
                <li><a href="<?php echo base_url(); ?>teacher/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>teacher/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
        </nav>
      
      <?php echo form_open("teacher/edit_profile"); ?>
      <table class="edit_profile" align="center">
         <?php foreach($collegeinfo as $college) { 

          } ?>
          <?php if($college['college_id'] == $college_id) { ?>
      <br><br><br><br>
          <tr>          
          <td>Username</td>
          <td><input name="username" value="<?php echo $info['username']; ?>"  class="form-control" disabled = "true"></td>
        </tr>
        <tr>  
          <td>Name</td>
          <td>
            <input name="first_name" value="<?php echo $info['first_name'].' '.$info['middle_name'].' '.$info['last_name']; ?>" class="form-control" disabled = "true">
          </td>
        </tr>
        <td>Department</td>
            <td>               
                <input name="college" value="<?php echo $college['college_name']; ?>" class="form-control" disabled="true" placeholder="">
            </td>
        </tr> 
        <tr>
          <td>Address</td>
          <td>
            <input name="address" value="<?php echo $info['address']; ?>" class="form-control" placeholder="">
          </td>
        </tr>

        <tr>
          <td>Contact Number</td>
          <td><input name="contact_number" value="<?php echo $info['contact_number']; ?>" class="form-control" placeholder=""></td>
        </tr>
        
        <tr>
          <td>Date of Birth</td>
          <td>
              <?php  
              $date = $info['date_of_birth'];
              ?>
              <input name="address" value="<?php echo $date; ?>" class="form-control" disabled = "true">
          </td>
        </tr>

        <tr>
          <td></td>
          <td><?php echo validation_errors(); ?></td>
        </tr>
<br>  
        
        <tr>
          <td></td>
          <td><button name = "submit" type="submit" class="btn btn-primary">Save Changes</button></td>
        </tr>
        <?php } ?>
        
        </table>
      <?php echo form_close(); ?>
  </div><!-- /.page-wrapper -->
</div><!-- /.wrapper -->

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