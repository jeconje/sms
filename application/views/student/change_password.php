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
    $home = 'sms/profile'; 
    include ('/application/views/templates/header.php'); 
  ?>
  <!-- Nagivation -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav side-nav">
        <li><a href="<?php echo base_url(); ?>sms/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>sms/viewgrades"><i class="icon32 icon-color icon-document"></i> Grades</a></li>
        <li><a href="<?php echo base_url(); ?>sms/viewstudyload"><i class="icon32 icon-color icon-compose"></i> Study Load</a></li>
        <li><a href="<?php echo base_url(); ?>sms/viewlasent"><i class="icon32 icon-red icon-clock"></i> Lates and Absences</a></li>
        <li><a href="<?php echo base_url(); ?>sms/viewParents"><i class="icon32 icon-color icon-users"></i> Trackers</a></li>
        <li><a href="<?php echo base_url(); ?>sms/calendarforstudent/2014/03"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right navbar-user">
        <li class="dropdown messages-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-messages"></i> Notification <b class="icon icon-color icon-triangle-s"></b></a>
          <ul class="dropdown-menu">
            <li class="dropdown-header">8 New Messages</li>
            <li class="message-preview">
              <a href="#">
                <span class="name">John Smith:</span>
                <span class="message">Hey there, I wanted to ask you something... ASA NI DAPITA</span>
                <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
              </a>
            </li>
            <li class="divider"></li>
            <li class="message-preview">
              <a href="#">
                <span class="name">John Smith:</span>
                <span class="message">Hey there, I wanted to ask you something...</span>
                <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
              </a>
            </li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>sms/message">View Inbox <span class="icon icon-color icon-envelope-closed"></span></a></li>
          </ul>
        </li><!-- /.dropdown messages-dropdown -->

        <li class="dropdown user-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $first_name.' '.$last_name; ?> <b class="icon icon-color icon-triangle-s"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>sms/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>sms/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
          </ul>
        </li><!-- /.dropdown user-dropdown -->
      </ul><!-- /.nav navbar-nav navbar-right navbar-user -->
    </div><!-- /.navbar-collapse -->
  </nav><!-- /.navbar navbar-inverse navbar-fixed-top-->

  <div id="page-wrapper">
      <?php echo form_open("sms/view_changepassword"); ?>
      <div class="changepassword_form">   
        <p class="contact"><label for="password" id="passwordlbl">Current Pasword</label></p>
          <input type="password" name="password" id="password">
       
       <p class="contact"><label for="newpassword" id="newpasswordlbl">New Password</label></p>
          <input type="password" name="new_password" id="new_password">
        
        <p class="contact"><label for="cnewpassword" id="cnewpasswordlbl">Confirm New Password</label> </p>       
          <input type="password" name="cnew_password" id="cnew_password" onkeyup="checkPasswordMatch()">
          
         <div class="error"><?php echo validation_errors(); ?></div>
         <div id="divCheckPasswordMatch" style="color: rgb(255, 0, 0); font: normal 10px/12px Arial,Helvetica,sans-serif; opacity: 50;"></div>
  
        <button class="button" type="submit" id="submit">Save Changes</button>
      </div>
      <?php echo form_close(); ?>
  </div><!-- /.page-wrapper -->
</div><!-- /.wrapper -->

<!-- Checks the lenght of the password -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#password").keyup(function(){
      var password = $("#password").val();
       if(password=="") {
            $('$newpassword, #cnew_password').attr("disabled",true).css({ "background": "#F0F0F0" });
        } else {
          $.ajax({
            type:"POST",
            url: "<?php echo base_url(); ?>sms/validate_password",
            data:"password=" + password,
            success:function(password){
              if($.trim(password) == "Valid") {
                $('#password').css('border-color','#00FF00');
                $('#new_password, #cnew_password,#submit').removeAttr("disabled").css({ "background": "" });
              } else {
                $('#password').css('border-color','#FF0000');
                $('#new_password, #cnew_password').attr("disabled",true).css({ "background": "#F0F0F0" });
                $('#submit').attr("disabled",true);
              }
            }
          });
          };
    });
  });
</script>

<!-- Checks if the new password and confirm password matched -->
<script>
  function checkPasswordMatch() {
    var new_password = $("#new_password").val();
    var cnew_password = $("#cnew_password").val();

    if(new_password != cnew_password) { 
      $("#divCheckPasswordMatch").html("Passwords do not match!").css("color","red");
      $('#submit').attr("disabled",true);
    } else {
      $("#divCheckPasswordMatch").html("Passwords matched!").css("color","green");
      $('#submit').removeAttr("disabled");
    }
  }
</script>

<!-- Checks the lenght of the new password -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#new_password").keyup(function(){
      var new_password = $("#new_password").val();
      $.ajax({
        type:"POST",
        url: "<?php echo base_url(); ?>sms/check_newpasswordlength",
        data:"new_password=" + new_password,
        success:function(new_password){
          if($.trim(new_password) == "Valid") {
            $('#new_password').css('border-color','#00FF00');
            $('#cnew_password, #submit').removeAttr("disabled").css({ "background": "" });
          } else {
            $('#new_password').css('border-color','#FF0000');
            $('#cnew_password, #submit').attr("disabled",true);
          }
        }
      });
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() 
  {
    $('#new_password, #cnew_password').attr("disabled",true).css({ "background": "#F0F0F0" });
    $('#submit').attr("disabled",true);
  });
</script> 

</body>
</html>