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
       <?php $home = 'profile'; ?>
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
            <li><a href="<?php echo $home ?>"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
            <li  class="active"><a href="<?php echo base_url(); ?>admin/add_account"><i class="icon32 icon-color icon-book-empty"></i> Add Account</a></li>
            <li><a href="<?php echo base_url(); ?>admin/calendar/2014/03"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>    
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $info['first_name'].' '.$info['last_name']; ?> <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>admin/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>admin/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
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
  for($i=1;$i<=31;$i++) 
  {
    $data['days'][$i] = $i;
  }

  //Setup years
  $start_year = date("Y",mktime(0,0,0,date("m"),date("d"),date("Y")-80)); //Adjust 80 to however many year back you want
  $data['byear']['FALSE'] = 'Year';
  for ($i=date("Y");$i>=$start_year;--$i) 
  {
    $data['byear'][$i] = $i;
  }

?>
   <div id="page-wrapper">
    <div id="admin_title">
        <br><h1>Add an account</h1>
    </div>
    <div id="home">
      <p>Create an account for Dean, Chairperson or  Teachers.</p>

      <br><br>

      <i class="icon32 icon-color icon-home"></i><?php echo "&nbsp&nbsp"; ?>
      <i class="icon32 icon-color icon-document"></i><?php echo "&nbsp&nbsp"; ?>
      <i class="icon32 icon-color icon-compose"></i><?php echo "&nbsp&nbsp"; ?>
      <i class="icon32 icon-red icon-clock"></i><?php echo "&nbsp&nbsp"; ?>
      <i class="icon32 icon-color icon-users"></i><?php echo "&nbsp&nbsp"; ?>

      <br><br><br>

      <p>Be updated on school events.</p>
    </div>
    <div class="form" id="registration">
      <?php echo form_open("admin/add_account"); ?> 
      
      <p class="contact"><label for="faculty_id" id="faculty_idlbl">Faculty ID</label></p>
        <input type="text" name="faculty_id" id="faculty_id" class="form-control" placeholder="faculty id" value="<?php echo set_value('student_number') ?>" required="" tabindex="1">        

      <p class="contact"><label for="name" id="namelbl">Name</label></p>
        <input type="text" name="first_name" id="first_name" placeholder="First Name" value="<?php echo set_value('first_name'); ?>" required="" tabindex="1">        
        <input type="text" name="middle_name" id="middle_name" placeholder="Middle Name" value="<?php echo set_value('middle_name'); ?>" required="" tabindex="1">
        <input type="text" name="last_name" id="last_name" placeholder="Last Name" value="<?php echo set_value('last_name'); ?>" required="" tabindex="1">

      <p class="contact"><label for="account_type" id="account_typelbl">Account Type</label></p>
        <select class="select-style select" name="account_type" id="account_type">
          <option value="dean" <?php set_radio('account_type', 'Dean'); ?>>Dean</option>
          <option value="chairperson" <?php set_radio('account_type', 'Chairperson'); ?>>Chairperson</option>
          <option value="teacher" <?php set_radio('account_type', 'Teacher'); ?>>Teacher</option>
        </select><br><br>

      <p class="contact"><label for="gender" id="genderlbl">Gender</label></p>
          <select class="select-style select" name="gender" id="gender">
            <option value="male" <?php set_radio('gender', 'Male'); ?>>Male</option>
            <option value="female" <?php set_radio('gender', 'Female'); ?>>Female</option>
          </select><br><br>

      <p class="contact"><label for="contact_number" id="contact_numberlbl">Contact Number</label></p>
        <input type="text" name="contact_number" id="contact_number" value="<?php echo set_value('contact_number'); ?>" class="form-control" required="" tabindex="1">

      <p class="contact"><label for="address" id="addresslbl">Address</label></p>
        <input type="text" name="address" id="address" value="<?php echo set_value('address'); ?>" class="form-control" required="" tabindex="1">

      <p class="contact"><label for="email_address" id="email_addresslbl">Email Address</label></p>
        <input type="email" name="email_address" id="email_address" value="<?php echo set_value('email_address'); ?>" class="form-control" required="" tabindex="1">

      <p class="contact"><label for="date_of_birth" id="date_of_birth">Date Of Birth</label></p>
        <?php echo form_dropdown('months',$data['months'],"id='month'"). " " . form_dropdown('days',$data['days'],"id='day'"). " " . form_dropdown('byear',$data['byear'],"id='byear'"); ?><br><br>

      <p class="contact"><label for="username" id="usernamelbl">Choose your username</label></p>
            <input type="text" name="username" id="username" value="<?php echo set_value('username') ?>" required="" tabindex="1"><span id="user"></span> 

      <p class="contact"><label for="password" id="passwordlbl">Create a password</label></p>
        <input type="password" name="password" id="password" required="" tabindex="1">

      <p class="contact"><label for="confirm_password" id="confirm_passwordlbl">Create a password</label></p>
        <input type="password" name="confirm_password" id="confirm_password" required="" tabindex="1" onkeyup="checkPasswordMatch()">
      
      <div id="divCheckPasswordMatch" style="color: rgb(255, 0, 0); font: normal 10px/12px Arial,Helvetica,sans-serif; opacity: 50;"></div>

      <div class="error"><?php echo validation_errors(); ?></div>
      <br><br><input class="button" name="submit" type="submit" id="submitbtn" value="Add Account"></button>
           <?php echo form_close(); ?>
      </div> <!-- /.registration -->
    </div><!-- ./page-wrapper -->
    </div><!-- /.wrapper -->

<!-- Verifies the inputted student_number if it exist in the database -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#faculty_id").keyup(function() {
      var faculty_id = $('#faculty_id').val();
        if(faculty_id == "") {
            $('#first_name, #middle_name, #last_name, #account_type, #year, #college, #course, #gender, #address, #contact_number, #email_address, #username, #password, #confirm_password').attr("disabled",true).css({ "background": "#F0F0F0" });
            $('submitbtn').attr("disabled",true);
        } else {
            $.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>admin/check_id_number",
              data: "faculty_id=" + faculty_id,
              success: function(result) {
                  if($.trim(result) == 'Invalid') {
                    $('#faculty_id').css('border-color','#FF0000')
                    $('#first_name, #middle_name, #last_name, #account_type, #year, #college, #course, #gender, #address, #contact_number, #email_address, #username, #password, #confirm_password').attr("disabled",true).css({ "background": "#F0F0F0" });
                     $('#submitbtn').attr("disabled",true);
                  } else {
                    $('#faculty_id').css('border-color','#00CC00')
                    $('#first_name, #middle_name, #last_name, #account_type, #year, #college, #course, #gender, #address, #contact_number, #email_address, #username, #password, #confirm_password, #submitbtn').removeAttr("disabled").css({ "background": "" });
                  }
              }
            });
            return false;
          }
    });
  });
</script>

<!-- Verifies if the faculty id inputted is already registered or not -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#faculty_id").keyup(function(){
      var faculty_id = $('#faculty_id').val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>admin/verify_faculty_id",
        data: "faculty_id=" + faculty_id,
        success:function(faculty_id){
          if($.trim(faculty_id) == 'Valid') {
            $('#faculty_id').css('border-color','#FF0000')
            $('#first_name, #middle_name, #last_name, #account_type, #year, #college, #course, #gender, #address, #contact_number, #email_address, #username, #password, #confirm_password').removeAttr("disabled").css({ "background": "" });
          } else {
            $('#faculty_id').css('border-color','#00CC00')
            $('#first_name, #middle_name, #last_name, #account_type, #year, #college, #course, #gender, #address, #contact_number, #email_address, #username, #password, #confirm_password, #submitbtn').attr("disabled",true).css({ "background": "#F0F0F0" });
            $('#submitbtn').attr("disabled",true);
          }
        }
      });
    });
  });
</script>

<!-- Checks the availability of the username -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#username").keyup(function(){
      var username = $('#username').val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>admin/check_username",
        data: "username=" + username,
        success:function(username){
          if($.trim(username) == "Valid") {
            $('#username').css('border-color','#00FF00');
            $('#password, #confirm_password, #submitbtn').removeAttr("disabled").css({ "background": "" });
          } else {
            $('#username').css('border-color','#FF0000');
            $('#password, #confirm_password').attr("disabled",true).css({ "background": "#F0F0F0" });
            $('submitbtn').attr("disabled",true);
          }
        }
      });
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
        url: "<?php echo base_url(); ?>admin/check_passwordlength",
        data:"password=" + password,
        success:function(password){
          if($.trim(password) == "Valid") {
            $('#password').css('border-color','#00FF00');
            $('#confirm_password, #submitbtn').removeAttr("disabled");
          } else {
            $('#password').css('border-color','#FF0000');
            $('#confirm_password, #submitbtn').attr("disabled",true);
          }
        }
      });
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

<script type="text/javascript">
  $(document).ready(function() {
    $('#first_name, #middle_name, #last_name, #account_type, #year, #college, #course, #gender, #address, #contact_number, #email_address, #parent_email, #username, #password, #confirm_password').attr("disabled",true).css({ "background": "#F0F0F0" });
    $('#submitbtn').attr("disabled",true);
  });
</script>

  </body>
</html>
