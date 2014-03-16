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
            <li><a href="<?php echo base_url(); ?>sao/suspendviolators"><i class="icon32 icon-color icon-pin"></i> Suspend Student</a></li>
            <li><a href="<?php echo base_url(); ?>sao/add_violation_view"><i class="icon32 icon-color icon-add"></i> Add Violation</a></li>
            <li  class="active"><a href="<?php echo base_url(); ?>sao/violators"><i class="icon32 icon-color icon-alert"></i> Violators</a></li>
            <li ><a href="<?php echo base_url(); ?>sao/calendar_sao/2014/03"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>    
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
          </div><!-- /.navbar-collapse -->    
        </nav>
 
 <!-- Setup birthday dropdown -->        
<?php 
  //Setup months
  $data['months'] = array('FALSE' => 'Month',
                       '01'  => 'January',
                       '02'  => 'February',
                       '03'  => 'March',
                       '04'  => 'April',
                       '05'  => 'May',
                       '06'  => 'June',
                       '07'  => 'July',
                       '08'  => 'August',
                       '09'  => 'September',
                       '10'  => 'October',
                       '11'  => 'November',
                       '12'  => 'December'
                      );
  //Setup days
  $data['days']['FALSE'] = 'Day';         

  for($i=1;$i<=31;$i++) {
    $data['days'][$i] = $i;
  }

  //Setup years
  $start_year = date("Y",mktime(0,0,0,date("m"),date("d"),date("Y")-14)); //Adjust 80 to however many year back you want
  $data['vyear']['FALSE'] = 'Year';

  for ($i=date("Y");$i>=$start_year;--$i) 
  {
    $data['vyear'][$i] = $i;
  }
?>

<!-- Form dropdown of choices-->
<?php 
  $data['choices'] = array(
                          '' => 'Please select',
                          'student_number' => 'Student Number',
                          'date' => 'Date',
                          )
?>

        <div id="page-wrapper">
          <?php echo form_open("sao/violators"); ?>
          <table class="view_violators">
            <tr>
              <td>
              <div id="div_choices">
                <?php echo form_dropdown('choices', $data[choices], 'id="choices"'); ?>
              </div>
              </td>
              <td>
              <div id="div_student_number">
                <input type="text" name="student_number" id="violator_student_number" placeholder="student number">
              </div>
              </td>
              <td>
              <div id="div_date">
                <?php echo form_dropdown('months',$data[months],'id="month"'). " " . form_dropdown('days',$data[days],'id="day"'). " " . form_dropdown('year',$data[vyear],'id="vyear"'); ?>
              </div>
              </td>
              <td>
                <input class="btn btn-primary" type="submit" id="submit" value="Search"/>
              </td>
            </tr>
          </table>
          <?php echo form_close(); ?>
<br><br><br>
          <?php echo form_open("sao/removeviolators"); ?>
          <div class="table-responsive">
            <table class="table table-hover tablesorter">
              <thead>
                  <tr>
                    <th><center>Student Number</center></th>
                    <th><center>Name</center></th>
                    <th><center>Violation</center></th>
                    <th><center>Date</center></th>
                    <th><center>Status</center></th>
                    <th><center></th>
                  </tr>
                </thead>

                <tbody align="center">           

                  <?php 
                  foreach($violators as $value) { ?>
                  <tr>
                    <td><?php echo $value['student_number']; ?></td>
                    <td><?php echo $value['first_name'].' '.$value['last_name']; ?></td>
                    <td><?php echo $value['violation']; ?></td>
                    <td><?php echo $value['date']; ?></td>
                    <td><?php echo $value['status']; ?></td>
                      <?php if($value['status'] == "In campus with violation") { ?> 
                        <td><?php echo anchor('sao/removeviolators?id='.$value['student_number'], 'Claimed', 'id="$value->student_number" class="btn btn-primary"'); ?></td>
                      <?php } else ?>
                        <td></td>
                  </tr>
                  <?php } ?>
                </tbody>
            </table>
          </div> <!-- table-responsive -->
          <?php echo form_close(); ?>
        </div> <!-- end page-wrapper -->
      </div> <!-- end wrapper -->


<script type="text/javascript">
  $(document).ready(function() {
    $('#div_student_number, #div_date').hide();
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#div_choices').change(function() {
     choice = $('#div_choices option:selected').val();

     if(choice == "") {
        $('#div_date').hide();
        $('#div_student_number').hide();
     } else if(choice == "date"){
        $('#div_date').fadeIn(1000);
        $('#div_student_number').hide();
      } else if(choice == "select_all") {
        $('#div_student_number').hide();
        $('#div_date').hide();
      } else {
        $('#div_student_number').fadeIn(1000);
        $('#div_date').hide();
      }
    });
  });
</script>
<!--
<script type="text/javascript">
  $(document).ready(function(){
    $('#submit').click(function(){
      choice = $('#div_choices option:selected').val();

    if(choice == 'student_number') {
      var student_number = $('#violator_student_number').val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>sao/viewViolatorsByStudentNumber",
      });
    }
    else
      alert(student_number);
    });
  });
</script>
-->

<!-- 
<script type="text/javascript">
  $(document).ready(function() {
    choice = $('#div_choices option:selected').val();

    $('#submit').click(function() {
    var student_number = $('#violator_student_number').val();
    if(choice == 'student_number') {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>sao/violators",
            data: "student_number=" + student_number,
            dataType: "json",
            success: function (data) {
                $.each (data, function(index, val) {
                    td.val(val.stud_num);
                    td.text(val.stud_num);
                    $('#disp').append(td);
                });
            }
        });
      } else {
        $('#disp').empty();
      }
  });
  });
</script>
-->

  </body>
</html>

