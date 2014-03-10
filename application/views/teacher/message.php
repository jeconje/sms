
<?php header("refresh: 5;"); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>USJR - SMS</title>
    <?php include ('/application/views/templates/nav.php'); ?>
  </head>

    <script src="<?php echo base_url(); ?>js/jquery.bpopup-x.x.x.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/x.x.x/jquery.min.js"></script>
    <script>
    ;(function($) {
        $(function() {
            $('#my-button').bind('click', function(e) {
                e.preventDefault();
                $('#element_to_pop_up').bPopup({
                    appendTo: 'form'
                    , zIndex: 2
                    , modalClose: false,
                    opacity: 0.6,
                    positionStyle: 'fixed',
                    speed: 450,
                    transition: 'slideDown'
                });
            });
         });
     })(jQuery);
    </script>

    <style>
    #element_to_pop_up 
    { 
      background-color:#E6E6E6;
      border-radius:9px;
      color:#fff;
      display:none; 
      padding:20px;
      min-width:400px;
      min-height: 180px;
    }
    .b-close
    {
      cursor:pointer;
      position:absolute;
      right:10px;
      top:5px;
    }

    </style>
  </head>

<body>
  <div id="element_to_pop_up">
    <a class="b-close"><b>x</b><a/>
    HOY IMUNG ANAK SIGE NAG KA LATEEE!! DI JUD NA KA GRADUATE RON HAHAHA
  </div>

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
            <li><a href="<?php echo base_url(); ?>teacher/view_candidates"><i class="icon32 icon-color icon-contacts"></i> SDPC Candidates </a></li>
            <li><a href="<?php echo base_url(); ?>teacher/calendar_teacher"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>    
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
            <li><a href="<?php echo base_url(); ?>teacher/message">View Inbox <span class="icon icon-color icon-envelope-closed"></span></a></li>
              </ul>
            </li>
            
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
     <div class="table-responsive">
              <table class="table table-hover tablesorter">
                <thead>
                  <tr>
                    <th class="warning"><center>Name of Sender</th>
                    <th class="warning">Subject</th>
                    <th class="warning">Date</th>
                    <th class="warning"></th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>Get</td>
                    <td>Get WAAAAAT</td>
                    <td>Get</td>
                    <td><button type="button" id="my-button" class="btn btn-primary">Details</button></td>
                    <td><button type="button" class="btn btn-primary">Delete</button></td>
                  </tr>

                </tbody>
              </table>
              </div>
  </body>
</html>
