<?php error_reporting(0); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Student Registration</title>

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
            <a class="navbar-brand" href="<?php echo base_url(); ?>sms/profile">University Of San Jose Recoletos - Student Monitoring System</a>
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
      <p>A single username and password lets you keep track of your attendance.</p>

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
            <?php foreach($studentDetails as $value){ ?>

           <?php } ?>
            <?php echo form_open("sms/registration"); ?>

            <p class="contact"><label for="student_number" id="student_numberlbl">Student Number</label></p>
              <input type="text" name="student_number" id="student_number" required="" tabindex="1" placeholder="student number" value="<?php echo $value['student_number']; ?>">         
              <input type="submit" class="button" name="submit" value="Search"> 

            <?php echo form_close(); ?>

          <?php echo form_open("sms/view_registration_ajax"); ?>

          
            <br><br>
            <p class="contact"><label>Name</label></p>
              <input type="text" name="first_name" value="<?php echo $value['first_name']; ?>" disabled="disabled">
              <input type="text" name="middle_name" value="<?php echo $value['middle_name']; ?>" disabled="disabled">
              <input type="text" name="last_name" value="<?php echo $value['last_name']; ?>" disabled="disabled">

            <p class="contact"><label for="gender" id="genderlbl">Gender</label></p>
              <input type="text" name="gender" disabled="disabled" value="<?php echo $value['gender']; ?>">

           <!-- <p class="contact"><label for="year" id="yearlbl">Year / College / Course</label></p>
            <select class="select-style select" name="year" id="year">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
            <select class="select-style select" id="college" name="college">
                <option value="" selected="selected" id="college">- select college -</option>
                <?php foreach ($colleges as $college => $value){ ?>
                  <option value="<?php echo $value->college_name; ?>"><?php echo $value->college_name; ?></option>
                <?php } ?>
            </select>
            <select class="select-style select" id="course" name="course"> 
                <option value="">------</option>
            </select><br><br> -->

            <p class="contact"><label for="address" id="addresslbl">Address</label></p>
              <input type="text" name="address" value="<?php echo $value['address']; ?>" disabled="disabled">

            <p class="contact"><label for="contact_number" id="contact_numberlbl">Contact Number</label></p>
              <input type="text" name="contact_number" value="<?php echo $value['contact_number']; ?>" disabled="disabled">
            
            <p class="contact"><label for="date_of_birth"  id="date_of_birthlbl">Date of Birth</label></p>
              <input type="text" value="<?php echo $value['date_of_birth']; ?>" disabled="disabled">

            <p class="contact"><label for="email_address" id="email_addresslbl">Your current email address</label></p>
              <input name="email_address" id="email_address" value="<?php echo $value['email_address']; ?>" disabled="disabled">

            <p class="contact"><label for="parent_email" id="parent_emaillbl">Parent's Email Address</label></p>
              <input name="parent_email"  id="parent_email" required="" type="email">

            <p class="contact"><label for="username" id="usernamelbl">Choose your username</label></p>
              <input type="text" name="username" id="username" required="" tabindex="1"><span id="user"></span> 

            <p class="contact"><label for="password" id="passwordlbl">Create a password</label></p>
              <input type="password" name="password" id="password" required="" tabindex="1">

            <p class="contact"><label for="confirm_password" id="confirm_passwordlbl">Confirm password</label></p>
              <input type="password" name="confirm_password" id="confirm_password" onkeyup="checkPasswordMatch()" required="" tabindex="1">

            <div class="error"><?php echo validation_errors(); ?></div>
              <div id="divCheckPasswordMatch" style="color: rgb(255, 0, 0); font: normal 10px/12px Arial,Helvetica,sans-serif; opacity: 50;"></div>

            <br><br><input class="button" name="submit" id="submitbtn" tabindex="1" value="Register" type="submit"> 
           
            <?php echo form_close(); ?>

    </div><!-- /.form -->
  </div><!-- /.page-wrapper -->
</div><!-- /.wrapper -->

<!-- course dropdown will depende on what college is chosen
<script type="text/javascript">
  $('#college').on('change', function () {
    $('#course').empty();
      var x = $(this).val();
      if (x != "") {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>sms/get_courses",
            data: {college : x},
            dataType: "json",
            success: function (data) {
                $.each (data, function(index, val) {
                    var opt = $('<option />'); // here we're creating a new select option for each group
                    opt.val(val.c_name);
                    opt.text(val.c_name);
                    $('#course').append(opt);
                });
            }
        });
      } else {
        $('#course').empty();
        $('#course, #lbl_course').hide();
      }
  });
</script>
-->

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
//   $(document).ready(function(){
//     $("#student_number").keyup(function() { 
//       $.ajax({
//           type: "POST",
//           url: "<?php echo base_url(); ?>sms/getStudentDetails",
//           data: "student_number=" + student_number,
//           success: function(result) {
//               if($.trim(result) == 'Invalid') {
//                 $('#student_number').css('border-color','#FF0000')
//                  $('#submitbtn').attr("disabled",true);
//               } else {
//                 $('#student_number').css('border-color','#00CC00')
//                 $('#submitbtn').removeAttr("disabled");
//               }
//           }
//         });
//     });
//   });
// </script>

<!-- Verifies the inputted student_number if it exist in the database 
<script type="text/javascript">
  $(document).ready(function(){
    $("#student_number").keyup(function() {
      var student_number = $('#student_number').val();
        if(student_number == "") {
            $('#first_name, #middle_name, #last_name, #address, #contact_number, #email_address, #parent_email, #username, #password, #confirm_password').attr("disabled",true).css({ "background": "#F0F0F0" });
            $('submitbtn').attr("disabled",true);
        } else {
            $.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>sms/check_student_number",
              data: "student_number=" + student_number,
              success: function(result) {
                  if($.trim(result) == 'Invalid') {
                    $('#student_number').css('border-color','#FF0000')
                    $('#first_name, #middle_name, #last_name, #gender, #address, #contact_number, #email_address, #parent_email, #username, #password, #confirm_password').attr("disabled",true).css({ "background": "#F0F0F0" });
                     $('#submitbtn').attr("disabled",true);
                  } else {
                    $('#student_number').css('border-color','#00CC00')
                    $('#first_name, #middle_name, #last_name, #gender, #address, #contact_number, #email_address, #parent_email, #username, #password, #confirm_password, #submitbtn').removeAttr("disabled").css({ "background": "" });
                  }
              }
            });
            return false;
          }
    });
  });
</script> -->

<!-- Checks the availability of the username -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#username").keyup(function(){
      var username = $('#username').val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>sms/check_username",
        data: "username=" + username,
        success:function(username){
          if($.trim(username) == "Valid") {
            $('#username').css('border-color','#00FF00');
            $('#password, #confirm_password, #submitbtn').removeAttr("disabled").css({ "background": "" });
          } else {
            $('#username').css('border-color','#FF0000');
            $('#password,#confirm_password').attr("disabled",true).css({ "background": "#F0F0F0" });
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
        url: "<?php echo base_url(); ?>sms/check_passwordlength",
        data:"password=" + password,
        success:function(password){
          if($.trim(password) == "Valid") {
            $('#password').css('border-color','#00FF00');
            $('#submitbtn').removeAttr("disabled");
          } else {
            $('#password').css('border-color','#FF0000');
            $('#submitbtn').attr("disabled",true);
          }
        }
      });
    });
  });
</script>

 <script type="text/javascript">
//   $(document).ready(function() {
//     $('#first_name, #middle_name, #last_name, #gender, #address, #contact_number, #email_address, #parent_email, #username, #password, #confirm_password').attr("disabled",true).css({ "background": "#F0F0F0" });
//   });

// </script>

</body>
</html>