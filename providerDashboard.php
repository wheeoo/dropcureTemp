


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
<!--<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">-->

<?php include_once('https://dropcure.org/dropsocial/serviceAll/allAjaxCalls.php'); ?>
<link rel="stylesheet" href="https://dropcure.org/dropsocial/serviceAll/provider/providerAdmin/dashBoard.css">


<?php 
    include_once('dbconnect.php');   
    date_default_timezone_set('America/Los_Angeles');
    $todayD = date('Y-m-d');
    $datePrint = date('l, F d, Y');
    $providerID = $wo['user']['providerID'];
    $employeeUsername = $wo['user']['username'];
    $employeeAvatar = $wo['user']['avatar'];

    $queryFx = "SELECT * FROM provider WHERE providerID = '$providerID'";
    $resultFx = mysqli_query($conn, $queryFx);
    $rowFx = mysqli_num_rows($resulFx);
    $rowData = $resultFx->fetch_assoc();


//$dReturn = pharmacyFx($pharmacyID);
$profileImage = $rowData['profileImage'];

?>
        <div class="wrapper">
    <div class="fixIT">
	<div class="wow_main_float_head com_thing">
        <div class="container"> 
			<h1><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M15,2C16.94,2 18.59,2.7 19.95,4.05C21.3,5.41 22,7.06 22,9C22,10.56 21.5,11.96 20.58,13.2C19.64,14.43 18.44,15.27 16.97,15.7L17,15.38V15C17,12.81 16.23,10.93 14.65,9.35C13.07,7.77 11.19,7 9,7H8.63L8.3,7.03C8.73,5.56 9.57,4.36 10.8,3.42C12.04,2.5 13.44,2 15,2M9,8A7,7 0 0,1 16,15A7,7 0 0,1 9,22A7,7 0 0,1 2,15A7,7 0 0,1 9,8M9,10A5,5 0 0,0 4,15A5,5 0 0,0 9,20A5,5 0 0,0 14,15A5,5 0 0,0 9,10Z"></path></svg> 
                <?php echo $clinicName; ?></h1>
			<h4 class="text-center">
				<?php echo $cLocation."<br>";?>
				<?php echo "Contact: ".$cContact. "&nbsp;&nbsp;\t".$cPhone;?>
				</h4>
        </div>	
	</div>
 </div>


        <!--wrapper start-->
            <!--header menu start
            <div class="header">
                <div class="header-menu">
                </div>
            </div> -->
            <!--header menu end-->
            <!--sidebar start-->
            <div class="sidebar">
                <div class="sidebar-menu">
                    <input type="hidden" class ="providerID" id= "<?php echo $providerID; ?>">
                    <center class="profile">
                        <img src="<?php echo $employeeAvatar; ?>" alt="">
                        <p>Medical Office Staff:<br> <?php echo $employeeUsername; ?> </p>
                    </center>
                    <li class="item dashboardLanding">
                        <a href="#" class="menu-btn">
                            <i class="fas fa-home"></i><span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="item appointments">
                        <a href="#" class="menu-btn">
                            <i class="far fa-calendar-check"></i><span>Appointments</span>
                        </a>
                    </li>
                    
                    <li class="item patient">
                        <a href="#" class="menu-btn">
                            <i class="fa fa-users"></i><span>Patient Search</span>
                        </a>
                    </li>
                    
                    <li class="item addPatient">
                        <a href="#profile" class="menu-btn">
                            <i class="fas fa-user-plus"></i><span>Add Patient</span>
                        </a>
                        <div class="sub-menu">
                            <a href="#"><i class="fas fa-image"></i><span>Picture</span></a>
                            <a href="#"><i class="fas fa-address-card"></i><span>Info</span></a>
                        </div>
                    </li>
                    <li class="item messages">
                        <a class="menu-btn">
                            <i class="fas fa-envelope"></i><span>Messages</span>
                        </a>
                        <div class="sub-menu">
                            <a href="#"><i class="fas fa-envelope"></i><span>New</span></a>
                            <a href="#"><i class="fas fa-envelope-square"></i><span>Sent</span></a>
                            <a href="#"><i class="fas fa-exclamation-circle"></i><span>Spam</span></a>
                        </div>
                    </li>
                    <li class="item settings">
                        <a href= "#" class="menu-btn">
                            <i class="fas fa-cog"></i><span>Settings <i class="fas fa-chevron-down drop-down"></i></span>
                        </a>
                        <div class="sub-menu">
                            <a href="#"><i class="fas fa-lock"></i><span>Prescription History</span></a>
                            <a href="#"><i class="fas fa-language"></i><span>Daily Visit History</span></a>
                            <a href="#"><i class="fas fa-language"></i><span>Staff Permission</span></a>
                            <a href="#"><i class="fas fa-language"></i><span>Pharmacy Exclusivity</span></a>
                            <a href="#"><i class="fas fa-language"></i><span>Password</span></a>
                        </div>
                    </li>
                    <li class="item">
                        <a  class="menu-btn">
                            <i class="fas fa-user-circle"></i><span>About</span>
                        </a>
                    </li>
                </div>
            </div>
            
            <!--sidebar end-->
            
              <!-------------------------------------DROP DOWN MENU RESPONSIVE---------------------------->
            <div class="wrapper resProfile">
                <span style="width:15%; padding-right: 15px;"><img src="<?php echo $employeeAvatar; ?>" alt=""></span> 
            
                <span><?php echo $employeeUsername; ?></span>
                <span style="width:85%;"><i class="fa fa-bars fa-2x hamburger" aria-hidden="true"></i>
                </span>
            </div>
            
            <div class="wrapper dDownMenu">
                    <input type="hidden" class ="providerID" id= "<?php echo $providerID; ?>">

                 <!--   <a href="#"><i class="fas fa-home" id="dashboardLanding"></i><span>Dashboard</span></a>
                    <a href="#" id="appointments"><i class="far fa-calendar-check"></i><span>Appointments</span></a>
                    <a href="#" id="patient"><i class="fa fa-users"></i><span>Patient Search</span></a>
                    <a href="#" id="addPatient"><i class="fas fa-user-plus"></i><span>Add Patient</span></a> -->
                
                <li class="item dashboardLanding">
                        <a href="#" class="menu-btn"><i class="fas fa-home"></i><span>Dashboard</span></a>
                </li>
                <li class="item appointments">
                        <a href="#" class="menu-btn"><i class="far fa-calendar-check"></i><span>Appointments</span></a>
                </li>
                <li class="item patient">
                        <a href="#" class="menu-btn"><i class="fa fa-users"></i><span>Patient Search</span></a>
                </li>
                <li class="item addPatient">
                        <a href="#" class="menu-btn"><i class="fas fa-user-plus"></i><span>Add Patient</span></a>
                </li>
                
            </div>
            <!----------------------------------------- DROP DOWN MENU ENDS -------------------------------->
            <!--main container start-->
        
            <div class="main-container">
                <div class="card"> 
                </div>
            </div>
            <!--main container end-->
        </div>
        <!--wrapper end-->


<script> 
    $('.dDownMenu').hide();
    $('.hamburger').on("click", function(){
        $('.dDownMenu').toggle();
    });

    
    
$('.menu-btn').on('click', function(){
    $('.menu-btn').removeClass('active').addClass('inactive');
     $(this).removeClass('inactive').addClass('active');
});
    
</script>

<script type="text/javascript">
    $(document).ready(function(){
        
        
          var providerID = $('.providerID').attr("id");
           // $('.main-container').load('https://dropcure.org/dropsocial/serviceAll/provider/dashboardLanding.php');
            

            $('.dashboardLanding').on('click', function(e){
                e.preventDefault(); 
                    fetchMap();
            });
                function fetchMap(){ 
                        $.ajax({
                            type: "POST",
                            url: "https://dropcure.org/dropsocial/serviceAll/provider/dashboardLanding.php",
                            dataType: "html",
                            data: {providerID: providerID},
                            success: function(data){
								$('html, body').scrollTop(0);
                                $('.main-container').html(data);
                            }
                        });
          
                }
        fetchMap();
            
            
            
            $('.appointments').on('click', function(e){
                e.preventDefault(); 
           
           
                var providerID = $('.providerID').attr("id");
                
                        $.ajax({
                            type: "POST",
                            url: "https://dropcure.org/dropsocial/serviceAll/provider/appointments/appointmentList.php",
                            dataType: "html",
                            data: {providerID: providerID},
                            success: function(data){
								$('html, body').scrollTop(0);
                                $('.main-container').html(data);
                            }
                        });
          
                
                });
            
            
             
            $('.patient').on('click', function(e){
                e.preventDefault();
                var providerID = $('.providerID').attr("id");
    
                
                        $.ajax({
                            type: "POST",
                            url: "https://dropcure.org/dropsocial/serviceAll/provider/patientList.php",
                            dataType: "html",
                            data: {providerID: providerID},
                            success: function(data){
								$('html, body').scrollTop(0);
                                $('.main-container').html(data);
                            }
                        });
            });
            
            
            $('.addPatient').on('click', function(e){
                e.preventDefault();
                var providerID = $('.providerID').attr("id");
                $('.main-container').load("https://dropcure.org/dropsocial/serviceAll/patientRegistration/patientRegistrationForm.php", {providerID:providerID});
            });
            
			
			
			             
            $('.settings').on('click', function(e){
                e.preventDefault();
                var providerID = $('.providerID').attr("id");
    
                
                        $.ajax({
                            type: "POST",
                            url: "https://dropcure.org/dropsocial/serviceAll/provider/settings.php",
                            dataType: "html",
                            data: {providerID: providerID},
                            success: function(data){
								$('html, body').scrollTop(0);
                                $('.main-container').html(data);
                            }
                        });
            });
			
			
			
   
           
            
        });
</script>


                  