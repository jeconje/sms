<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>USJR - SMS</title>
      <meta charset="utf-8">
      <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">
      <link rel="icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">

      <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootplus.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>css/student/signin.css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>css/opa-icons.css">
  </head>
  <body>
    
  <div class="container">
      <div class="text">
        Student Monitoring System
      </div>
      <br><br><br>
      <form class="form-signin" <?php echo form_open('verifylogin'); ?>
          <div class="logo">
            <img src="<?php echo base_url(); ?>images/sms_logo.png">
          <br>
          <div class="text2">
            Login to continue to SMS
          </div>
          <br>
      </div>
        <div>
          <input type="text" class="input-block-level" name="username" placeholder="username">
        </div>
        <div>
          <input type="password" class="input-block-level" name="password" placeholder="password">
        </div>
              <div class="error"><?php echo validation_errors(); ?></div> 
        <button class="button" type="submit">Login</button>
      </form>
  <center>
    <div class="notyetregistered"><a href="<?php echo base_url();?>sms/registration">Create an account</a></div>
    <br><i class="icon32 icon-color icon-home"></i><i class="icon32 icon-color icon-document"></i><i class="icon32 icon-color icon-compose"></i>
    <i class="icon32 icon-color icon-clock"></i><i class="icon32 icon-color icon-users"></i><i class="icon32 icon-color icon-calendar"></i>
    <i class="icon32 icon-color icon-messages"></i><i class="icon32 icon-color icon-envelope-closed"></i><i class="icon32 icon-color icon-book-empty"></i>
  </body>
</html>
