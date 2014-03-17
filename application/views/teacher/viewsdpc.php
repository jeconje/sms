
<!DOCTYPE html>
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
    <?php $home = 'teacher/profile'; ?>
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
              <li class="active"><a href="<?php echo base_url(); ?>teacher/view_candidates"><i class="icon32 icon-color icon-contacts"></i> SDPC Candidates </a></li>
              <li><a href="<?php echo base_url(); ?>teacher/calendar_teacher/2014/03"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>    
            </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown messages-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"id="noti-box"><div id="noti"></div><i class="icon icon-color icon-messages"></i> Notification <b class="icon icon-color icon-triangle-s"></b></a>
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

       <div id="page-wrapper">
        <center>
          <?php echo form_open("teacher/view_candidates"); ?>
          <table>
            <tr>
              <td></td><td></td><td></td>
              <td></td><td></td><td></td>
              <td></td><td></td><td></td>
              <td></td>
              <td>
                <select class="select-style select" id="subject" name="subject">
                <option value="" selected="selected" id="subject">- select subject -</option>
                <?php foreach ($subjects as $subject => $value){ ?>
                  <option value="<?php echo $value->subject_code; ?>"><?php echo $value->subject_description; ?></option>
                <?php } ?>
            </select>
            <select class="select-style select" id="offer_code" name="offer_code"> 
                <option value="">------</option>
            </select><br><br>
              </td>
              <td></td><td></td><td></td><td></td><td></td>

              <td>
                  <input class="btn btn-primary" type="submit" value="Search"/>
              </td>
            </tr>
          </table>
          <?php echo form_close(); ?>
      </center>
        </div>          

<br><BR>
        <div class="table-responsive">
              <table class="table table-hover tablesorter">
                <thead>
                  <tr>
                    <th><center>Name of Student</th>
                    <th><center>Subject</center></i></th>
                    <th><center>Day</center></i></th>
                    <th><center>Lates</i></th>
                    <th><center>Unexcused Absences</th>
                    <th><center>Excused Absences</th>
                  </tr>
                </thead>
                <?php
                    foreach ($viewSubjects as $value) 
                    {
                         $late = 0;
                         $absences = 0;
                         $excused= 0;
                ?>    

                  <?php foreach($viewCandidates as $viewAttendance){
                        if($viewAttendance['attendance'] == 'L' && $viewAttendance['offer_code'] == $value['offer_code']){
                          $late++;
                        }                              
                        if($viewAttendance['attendance'] == 'A' && $viewAttendance['offer_code'] == $value['offer_code']){
                          $absences++;
                        }
                        if($viewAttendance['attendance'] == 'X' && $viewAttendance['offer_code'] == $value['offer_code']){
                          $excused++;
                        }
                  } ?>
                  <?php if(($absences >= '5' && $value['days'] == 'MWF') || ($absences >= '3' && $value['days'] == 'TTH')){ ?>
                    <tr>
                        <td>
                            <?php echo $viewAttendance['last_name'].', '.$viewAttendance['first_name']; ?>
                        </td>
                        <td>
                            <?php echo $value['subject_description']; ?>
                        </td>   
                        <td>                        
                            <?php  echo $value['days']; ?>
                        </td>
                        <td>                        
                            <?php echo $late; ?>
                        </td>   
                        <td>
                            <?php echo $absences; ?>
                        </td>
                        <td>
                            <?php echo $excused ?>
                        </td>
                    </tr>
                  <?php }
                    } 
                  ?>
                </tbody>
              </table>
            </div>
          </div>

<!-- course dropdown will depende on what college is chosen -->
<script type="text/javascript">
$(document).ready(function(){
  $('#subject').on('change', function () {
      var subject = $('#subject').val();
      $('#offer_code').empty();
      if (subject != "") {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>teacher/get_offer_codes",
            data: "subject=" + subject,
            dataType: "json",
            success: function (data) {
                $.each (data, function(index, val) {
                    var opt = $('<option />'); // here we're creating a new select option for each group
                    opt.val(val.o_code);
                    opt.text(val.o_code);
                    $('#offer_code').append(opt);
                });
            }
        });
      } else {
        $('#offer_code').empty();
        $('#offer_code').hide();
      }
  });
});
</script>

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
