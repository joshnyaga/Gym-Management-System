<?php
session_start();
error_reporting(0);
include '../con.php';
if(strlen($_SESSION['trainerlogin'])==0)
  { 
header('location:../login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gym Management</title>
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">



    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="../css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css"/>
 

<style type="text/css">
    .vis-container{
        background-color: #0e1a35;
        border-radius: 20px;
        height: 229px;
        margin: 10px;
        padding-top: 90px;
        font-size: 2.592em;
        text-align: center;
     
      }
      .header{
        font-size: 100px;
      }
      @media only screen and (max-width:620px) {
  /* For mobile phones: */
  .vis-container, .header{
    width:100%;
  }
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../DataTables/datatables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
         } );
} );
</script>
</head>

	
<body class="home">
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="logo">
                   <a hef="home.html"><?php echo "<img src='  ".$_SESSION['trainer_profilepic']."' alt='Trainer profilepic' class='hidden-xs hidden-sm'>"; ?>
                        <?php echo "<img src='".$_SESSION['trainer_profilepic']."' alt='merkery_logo' class='visible-xs visible-sm circle-logo'>"; ?>
                    </a>
                </div>
                <div class="navi">
                    <ul>
                        <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Home</span></a></li>
                        <li><a href="all_schedules.php"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">All Schedules</span></a></li>
                         <li><a href="booked.php"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Unpaid Sessions</span></a></li>
                        <li><a href="paid.php"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Paid Sessions</span></a></li>
                        <li><a href="reviews.php"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Reviews</span></a></li>
                        <li><a href="availablegyms.php"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Gyms</span></a></li>
                        <li><a href="profile.php"><i class="fa fa-cog" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Profile</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
                <div class="row">
                    <header>
                        <div class="col-md-7">
                            <nav class="navbar-default pull-left">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                            </nav>
                            <div class="search hidden-xs hidden-sm">
                               <form name="Tick">
<input type="text" size="11" name="Clock">
</form>
<script>
<!--
/*By George Chiang (JK's JavaScript tutorial)
http://javascriptkit.com
Credit must stay intact for use*/
function show(){
var Digital=new Date()
var hours=Digital.getHours()
var minutes=Digital.getMinutes()
var seconds=Digital.getSeconds()
var dn="AM"
if (hours>12){
dn="PM"
hours=hours-12
}
if (hours==0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
document.Tick.Clock.value=hours+":"+minutes+":"
+seconds+" "+dn
setTimeout("show()",1000)
}
show()
//-->
</script>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="header-rightside">
                                <ul class="list-inline header-top pull-right">
                                    <li class="hidden-xs"><a href="#" class="add-project" data-toggle="modal" data-target="#add_project">Logout </a></li>
                                    <li><a href="#"><h4><span>Logged in as <?php echo $_SESSION['trainer_fname']; ?></span></h4></a></li>
                                   
                                    
                                </ul>
                            </div>
                        </div>
                    </header>
                </div>
                <div class="user-dashboard">
                    <h1>Unbooked schedules</h1>
<table id="example" class="display" width="100%">
    <thead>
       <tr>
           
           <th>Date</th>
           <th>From</th>
           <th>To</th>
           <th>Gym Name</th>
           <th>Gym Location</th>
           <th>Sheduled on</th>
           
       </tr>
    </thead>
    <tbody>
        <?php
        include '../con.php';
            $sql = "SELECT * FROM schedules where status='unbooked'";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) { 

        ?>
        <tr>                                                                
            
           
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['start_time']; ?></td>
            <td><?php echo $row['end_time']; ?></td>
            <td><?php echo $row['gym_name']; ?></td>
             <td><?php echo $row['gym_location']; ?></td>
            <td><?php echo $row['date_added']; ?></td>
          
           
            
            
        </tr>

        <?php
 }
}
else
{
 ?>
 <tr>
 <th colspan="2">There's No data found!!!</th>
 </tr>
 <?php
}
?>
    </tbody>
</table>

    </div>



    <!-- Modal -->
    <div id="add_project" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Add Project</h4>
                </div>
                <div class="modal-body">
                            <form method="post" action="all_schedules.php">
                                <input type="date"  name="date">
                            <input type="time" placeholder="Post of Post" name="dateFrom">
                            <input type="time" placeholder="Author" name="dateTo">
                           <select class="form-control">
                               <option>Gakuyo</option>
                               <option>Petaans</option>
                               <option>Nairobi</option>
                           </select>
                           <div class="form-group">
                                            <input type="checkbox" class="inline" class="form-control"  name="trainerservice2" value="" ><span>Joging</span>
                                        </div>
                            <input type="checkbox" class="inline" name="service2">riding <br>
                             <input type="checkbox" class="inline" name="service3">Boxing <br>
                            </form>
                           
                    </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
                    <button type="button" class="add-project" data-dismiss="modal">Save</button>
                </div>
            </div>

        </div>
    </div>
<script type="text/javascript">
	$(document).ready(function(){
   $('[data-toggle="offcanvas"]').click(function(){
       $("#navigation").toggleClass("hidden-xs");
   });
});


</script>
</body>
</html>
