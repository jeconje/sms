<?php error_reporting(0); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Parent Registration</title>

    <?php include ('/application/views/templates/nav.php'); ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/student/body.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.min.js"></script>

</head>

<body>
<div id="wrapper">
  <!-- Sidebar -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Header -->
    <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>parents/parent_registration">University Of San Jose Recoletos - Student Monitoring System</a>
    </div>
     <!-- Nagivation -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">

      <ul class="nav navbar-nav navbar-right navbar-user">
        <form action="<?php echo base_url(); ?>sms"><input type="submit" class="buttonsignin" value="Sign In"></form>
      </ul>

    </div><!-- /.navbar-collapse -->
  </nav><!-- /.navbar navbar-inverse navbar-fixed-top--> 
  <div id="page-wrapper">
    <div id="title">
        <br><h1>Create your SMS Account</h1>
    </div>
    <div id="home">
      <p>A single username and password lets you keep track of your child/children's attendance(s).</p>

      <br><br>

      <i class="icon32 icon-color icon-home"></i><?php echo "&nbsp&nbsp"; ?>
      <i class="icon32 icon-color icon-document"></i><?php echo "&nbsp&nbsp"; ?>
      <i class="icon32 icon-color icon-compose"></i><?php echo "&nbsp&nbsp"; ?>
      <i class="icon32 icon-red icon-clock"></i><?php echo "&nbsp&nbsp"; ?>
      <i class="icon32 icon-color icon-users"></i><?php echo "&nbsp&nbsp"; ?>
      <i class="icon32 icon-color icon-calendar"></i><?php echo "&nbsp&nbsp"; ?>

      <br><br><br>

      <p>Be updated on school events.</p>
    </div>
      <div class="form" id="registration">
            <?php echo form_open("parents/view_registration_ajax"); ?>

            <p class="contact"><label for="referral_key" id="referral_keylbl">Referral Key</label></p>
              <input type="text" name="referral_key" id="referral_key" required="" tabindex="1" placeholder="referral key" value="<?php echo set_value('referral_key'); ?> "></input><span id="check_referral_key" style="color: rgb(255, 0, 0); font: normal 10px/12px Arial,Helvetica,sans-serif; opacity: 50;"></span>

            <p class="contact"><label for="name" id="namelbl">Name</label></p>
              <input type="text" name="first_name" id="first_name" required="" tabindex="1" placeholder="first name" value="<?php echo set_value('first_name'); ?>">
              <input type="text" name="middle_name" id="middle_name" required="" tabindex="1" placeholder="middle name" value="<?php echo set_value('middle_name'); ?>">
              <input type="text" name="last_name" id="last_name" required="" tabindex="1" placeholder="last name" value="<?php echo set_value('last_name'); ?>">

            <p class="contact"><label for="gender" id="genderlbl">Gender</label></p>
            <select class="select-style select" name="gender" id="gender">
              <option value="male" <?php set_radio('gender', 'Male'); ?>>Male</option>
              <option value="female" <?php set_radio('gender', 'Female'); ?>>Female</option>
            </select><br><br>

            <p class="contact"><label for="address" id="addresslbl">Address</label></p>
              <input type="text" name="address" id="address" required="" tabindex="1" value="<?php echo set_value('address');?>" >

            <p class="contact"><label for="contact_number" id="contact_numberlbl">Contact Number</label></p>
              <input type="text" name="contact_number" id="contact_number" required="" tabindex="1" value="<?php echo set_value('contact_number');?>" >

            <?php 
              //Setup months
              $data['months'] = array('FALSE' => 'Month',
                                   '1'  => 'January',
                                   '2'  => 'February',
                                   '3'  => 'March',
                                   '4'  => 'April',
                                   '5'  => 'May',
                                   '6'  => 'June',
                                   '7'  => 'July',
                                   '8'  => 'August',
                                   '9'  => 'September',
                                   '10' => 'October',
                                   '11' => 'November',
                                   '12' => 'December'
                                  );
              //Setup days
              $data['days']['FALSE'] = 'Day';         

              for($i=1;$i<=31;$i++) {
                $data['days'][$i] = $i;
              }

              //Setup years
              $start_year = date("Y",mktime(0,0,0,date("m"),date("d"),date("Y")-80)); //Adjust 80 to however many year back you want
              $data['byear']['FALSE'] = 'Year';

              for ($i=date("Y");$i>=$start_year;--$i) {
                $data['byear'][$i] = $i;
              }
            ?>
            
            <p class="contact"><label for="date_of_birth"  id="date_of_birthlbl">Date of Birth</label></p>
              <?php echo form_dropdown('months',$data[months],'id="month"'). " " . form_dropdown('days',$data[days],'id="day"'). " " . form_dropdown('byear',$data[byear],'id="byear"'); ?><br><br> 

            <p class="contact"><label for="username" id="usernamelbl">Choose your username</label></p>
              <input type="text" name="username" id="username" value="<?php echo set_value('username');   ?>" required="" tabindex="1"><span id="check_username" style="color: rgb(255, 0, 0); font: normal 10px/12px Arial,Helvetica,sans-serif; opacity: 50;"></span>

            <p class="contact"><label for="password" id="passwordlbl">Create a password</label></p>
              <input type="password" name="password" id="password" required="" tabindex="1">

            <p class="contact"><label for="confirm_password" id="confirm_passwordlbl">Confirm password</label></p>
              <input type="password" name="confirm_password" id="confirm_password" onkeyup="checkPasswordMatch()" required="" tabindex="1">

            <div class="error"><?php echo validation_errors(); ?></div>
              <div id="divCheckPasswordMatch" style="color: rgb(255, 0, 0); font: normal 10px/12px Arial,Helvetica,sans-serif; opacity: 50;"></div>

             <br><br><input class="button" name="submit" id="submitbtn" tabindex="1" value="Register" type="submit"> 

      </form>
    </div><!-- /.form -->
  </div><!-- /.page-wrapper -->
</div><!-- /.wrapper -->

<!-- Verifies the inputted referral_key if it exist in the database -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#referral_key").keyup(function() {
      var referral_key = $('#referral_key').val();
        if(referral_key == " ") {
            $('#first_name, #middle_name, #last_name, #gender, #address, #contact_number, #username, #password, #confirm_password').attr("disabled",true).css({ "background": "#F0F0F0" });
            $('#check_referral_key').html(" ").css("color"," ");
            $('#submitbtn').attr("disabled",true);
        } else {
            $.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>parents/check_referral_key_registration",
              data: "referral_key=" + referral_key,
              success: function(result) {
                  if($.trim(result) == 'Invalid') {
                    $('#referral_key').css('border-color','#FF0000');
                    $('#check_referral_key').html(" Referral key doesn't exist.").css("color","red");
                    $('#name, #first_name, #middle_name, #last_name, #gender, #address, #contact_number, #username, #password, #confirm_password').attr("disabled",true).css({ "background": "#F0F0F0" });
                    $('#submitbtn').attr("disabled",true); 
                  } else {
                    $('#referral_key').css('border-color','#00CC00');
                    $('#check_referral_key').html(" Referral key exist.").css("color","green");
                    $('#name, #first_name, #middle_name, #last_name, #gender, #address, #contact_number, #username, #password, #submitbtn, #confirm_password').removeAttr("disabled").css({ "background": "" });
                  }
              }
            });
            return false;
          }
    });
  });
</script>

<!-- Checks if the password and confirm password matched -->
<script>
  function checkPasswordMatch() {
    var password = $("#password").val();
    var confirm_password = $("#confirm_password").val();

    if(password != confirm_password) { 
      $("#divCheckPasswordMatch").html("Passwords do not match!").css("color","red");
      $('#submitbtn').attr("disabled",true);
    } else {
      $("#divCheckPasswordMatch").html("Passwords matched!").css("color","green");
      $('#submitbtn').removeAttr("disabled");
    }
  }
</script>

<!-- Checks the availability of the username -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#username").keyup(function(){
      var username = $('#username').val();

      // if(username = " "){
      //   $('#check_username').html(" ").css("color"," ");
      //   $('#password, #confirm_password, #submitbtn').attr("disabled",true).css({ "background": "#F0F0F0" });
      // } else {
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>parents/check_username",
        data: "username=" + username,
        success:function(username){
          if($.trim(username) == "Valid") {
            $('#username').css('border-color','#00FF00');
            $("#check_username").html(" Username available.").css("color","green");
            $('#password, #confirm_password, #submitbtn').removeAttr("disabled").css({ "background": "" });
          } else {
            $('#username').css('border-color','#FF0000');
            $("#check_username").html(" Username already taken.").css("color","red");
            $('#password, #confirm_password, #submitbtn').attr("disabled",true).css({ "background": "#F0F0F0" });
          }
        }
      });
    // }
    });
  });
</script>

<!-- Checks the lenght of the password -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#password").keyup(function(){
      var password = $("#password").val();
      $.ajax({
        type:"POST",
        url: "<?php echo base_url(); ?>sms/check_passwordlength",
        data:"password=" + password,
        success:function(password){
          if($.trim(password) == "Valid") {
            $('#password, #confirm_password').css('border-color','#00FF00');
            $('#submitbtn').removeAttr("disabled");
          } else {
            $('#password, #confirm_password').css('border-color','#FF0000');
            $('#submitbtn').attr("disabled",true);
          }
        }
      });
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#first_name, #middle_name, #last_name, #address, #contact_number, #gender, #username, #password, #confirm_password').attr("disabled",true).css({ "background": "#F0F0F0" });
     $('#submitbtn').attr("disabled",true);
  });
</script>

</head>
</body>
</html>