<?php error_reporting(0); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">
    <title>USJR - SMS</title>
    <?php include ('/application/views/templates/nav.php'); ?>  
  </head>

<body>
    <div id="wrapper">
       <?php $home = 'admin/profile'; ?>
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
          <a class="navbar-brand" href="<?php echo $home ?>">University Of San Jose Recoletos - Student Monitoring System</a></div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="<?php echo base_url(); ?><?php echo $home ?>"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>admin/add_account"><i class="icon32 icon-color icon-book-empty"></i> Add Account</a></li>
            <li><a href="<?php echo base_url(); ?>admin/calendar/2014/03"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>    
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">

            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> Admin Ko <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>admin/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>admin/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

 <div id="page-wrapper">
      <?php echo form_open("admin/view_changepassword"); ?>
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