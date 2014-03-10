<!DOCTYPE html>
<html lang="en">
<?php error_reporting(0); ?>
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
        Ezlogger Emulator
      </div>
      <br><br><br>
      <form class="form-signin" <?php echo form_open('ezscanner/log'); ?>
        <div>
          <input type="text" class="input-block-level" name="student_number" placeholder="Enter Student Number">
        </div>
        <center>
        <div>
          <input type="radio" name="status" class="form-control" value="login">Login
        	<input type="radio" name="status" class="form-control" value="logout">Logout
        </div>
      </center>
              <div><?php echo validation_errors(); ?></div> 
        <button class="button" type="submit">Submit</button>
      <?php echo form_close(); ?>

  </body>
</html>
