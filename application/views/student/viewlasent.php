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
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Header -->
  <?php $home = 'sms/profile'; ?>
    <?php foreach($studentinfo as $value) { } ?>

    <div class="navbar-header">    
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      <a class="navbar-brand" href="<?php echo base_url(); ?><?php echo $home; ?>">University Of San Jose Recoletos - Student Monitoring System</a>
    </div>
    
<!-- Nagivation -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
  <ul class="nav navbar-nav side-nav">
    <li><a href="<?php echo base_url(); ?>sms/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url(); ?>sms/viewgrades"><i class="icon32 icon-color icon-document"></i> Grades</a></li>
    <li><a href="<?php echo base_url(); ?>sms/viewstudyload"><i class="icon32 icon-color icon-compose"></i> Study Load</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>sms/viewlasent"><i class="icon32 icon-red icon-clock"></i> Lates and Absences</a></li>
    <li><a href="<?php echo base_url(); ?>sms/viewParents"><i class="icon32 icon-color icon-users"></i> Trackers</a></li>
    <li><a href="<?php echo base_url(); ?>sms/calendarforstudent/2014/03"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>
  </ul>

      <ul class="nav navbar-nav navbar-right navbar-user">
        <li class="dropdown messages-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="noti-box"><div id="noti"></div><i class="icon icon-color icon-messages"></i> Notification <b class="icon icon-color icon-triangle-s"></b></a>
          <ul class="dropdown-menu">
            <li class="dropdown-header"><div id="notification"></div></li>
          </ul>
        </li><!-- /.dropdown messages-dropdown -->

        <li class="dropdown user-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $value['first_name'].' '.$value['last_name']; ?> <b class="icon icon-color icon-triangle-s"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>sms/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>sms/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
          </ul>
        </li><!-- /.dropdown user-dropdown -->
      </ul><!-- /.nav navbar-nav navbar-right navbar-user -->
</div><!-- /.navbar-collapse -->
</nav>
      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1>Attendance</h1>
              <ol class="breadcrumb">
              <li class="active"><i class="fa fa-desktop"></i>  Stop being so tardy! Think about your parents money and effort! :( </li>
            </ol>
        </div><!-- /.row -->

<br><br>
<center>

            <div class="table-responsive" style="width:1000px;">
              <table class="table table-bordered table-hover tablesorter">
                <thead>
                  <tr>
                    <th class="active">Subject Listing</th>
                    <th class="warning">Lates</th>
                    <th class="danger">Excused Absences</th>
                    <th class="danger">Unexcused Absences</th>
                    <th class="active"></th>
                  </tr>
                </thead>
                <tbody align="center">
                  <?php
                    foreach ($viewSubjects as $value) 
                    {
                      $late = 0;
                      $absences = 0;
                      $excused = 0;
                  ?>    
                      <?php foreach($viewLatesAndAbsences as $viewLates){
                            
                              if($viewLates['attendance'] == 'L' && $viewLates['offer_code'] == $value['offer_code'] ){
                                $late++;
                              }                              
                              if($viewLates['attendance'] == 'A' && $viewLates['offer_code'] == $value['offer_code'] ){
                                $absences++;
                              }
                              if($viewLates['attendance'] == 'X' && $viewLates['offer_code'] == $value['offer_code'] ){
                                $excused++;
                              }
                      }
                       ?>
                    <tr>
                      <td>
                          <?php echo $value['subject_description']; ?>
                      </td>  
                      <td>                        
                          <?php echo $late; ?>
                      </td>     
                      <td>
                          <?php echo $excused?>
                      </td>
                      <td>
                          <?php echo $absences?>
                      </td>
                      <td><a href='<?php echo base_url(); ?>sms/attendance_logs?id=<?php echo base64_encode($value['offer_code']); ?>'><button type="button" class="btn btn-primary">View Logs</button></td>
                    </tr>
                   <?php } ?>
                   
                  
                </tbody>
              </table>
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
  var es = new EventSource("<?php echo base_url(); ?>notification/notification_to_student");
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
      url: "<?php echo base_url(); ?>notification/notification_update_student",
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
