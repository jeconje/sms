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
      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <?php $home = 'sao/profile'; ?>

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
            <li><a href="<?php echo base_url(); ?>sao/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>sao/add_violation"><i class="icon32 icon-color icon-add"></i> Add Violation</a></li>
            <li><a href="<?php echo base_url(); ?>sao/violators"><i class="icon32 icon-color icon-alert"></i> Violators</a></li>
            <li ><a href="<?php echo base_url(); ?>sao/calendar_sao"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>    
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
                <li class="message-preview">
                  <a href="#">
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>sao/message">View Inbox <span class="icon icon-color icon-envelope-closed"></span></a></li>
              </ul>
            </li>
            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $info['first_name'].' '.$info['last_name']; ?> <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>sao/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>sao/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
        </nav>
        </div><!-- /.navbar-collapse -->

<div id="page-wrapper">

  
  <br><br>
  <div id="content" align="center">
    <?php
      $student_number = $this->input->post('student_number');
    ?>
    <?php echo form_open('sao/get_student_info'); ?>
      <p><input type="text" name="student_number" id="student_number" required="" tabindex="1" placeholder="student number" value="<?php echo $student_number; ?>"></p>   
      
      <button class="btn btn-primary">Search Student</button>
    <?php echo form_close(); ?>

    <?php echo form_open("sao/add_violation"); ?>
    <?php foreach($student_info as $value){ ?>
      <p class="contact"><label>Name: </label>   
        <input type="hidden" name="student_number" value="<?php echo $student_number; ?>" >
        <input type="text" class="form-control" name="student_info" id="student_info" value="<?php echo $value['last_name'].', '.$value['first_name']; ?>" disabled="disabled"></p>
      <?php } ?>
      <br>
      <p><textarea id="violation" name="violation" required="" tabindex="1" placeholder="What's the violation?" value="<?php echo set_value('violation'); ?>"></textarea></p>

      <button class="btn btn-primary">Add Violation</button>
    <?php echo form_close(); ?>
  </div>

</div>

<!-- Student info will depend on what student number is inputted 
<script type="text/javascript">
  $('#student_number').keyup(function() {
    $('#student_info').empty();
      var student_number = $(this).val();
      if (student_number != "") {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>sao/get_student_number",
            data: "student_number=" + student_number,
            dataType: "json",
            success: function (data) {
              //$("#student_info").html(data);
              alert(data);
            }
        });
      } else {
        $('#student_info').empty();
      }
  });
</script>
-->


<script type="text/javascript">
 $(document).ready(function(){
    $("#student_number").keyup(function() {
      var student_number = $('#student_number').val();
        if(student_number=="") {
            $('#violation').attr("disabled",true).css({ "background": "#F0F0F0" });
        } else {
            $.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>sao/check_student_number",
              data: "student_number=" + student_number,
              success: function(result) {
                  if($.trim(result) == 'Invalid') {
                    $('#student_number').css('border-color','#FF0000')
                    $('#violation').attr("disabled",true).css({ "background": "#F0F0F0" });
                  } else {
                    $('#student_number').css('border-color','#00CC00')
                    $('#violation').removeAttr("disabled").css({ "background": "" });
                  }
              }
            });
            return false;
          }
    });
  });
</script>


<script type="text/javascript">
  $('#violation').attr("disabled",true).css({ "background": "#F0F0F0" });
</script>
  </body>
</html>
