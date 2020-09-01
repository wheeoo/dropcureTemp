<style>
        table.table-hover tbody tr:hover {
            background-color: #ECF4FE;
        }

            table th {
                 background-color:#343a40;
                border-color: #343a40; 
                color:#fff !important;
            }
</style>

<?php 
    $datePrint2 = date('l, F d, Y');
    $providerID = $_POST['providerID'];

?>


    <div style="text-align:center; font-size: 24px; background: linear-gradient(-45deg, #ae41c1 0%,#f06292 100%); color:#fff; width:100%; padding:15px; margin-bottom:5px;">Appointment List</div>


<?php

    include_once('../dbconnect.php');
    date_default_timezone_set('America/Los_Angeles');
    $todayD = date('Y-m-d');
    $datePrint = date('l, m-d-Y');


//---------------------------- Data for cost ------------------------------------->
        $sqlCost = "SELECT SUM(userDiagnosis_price) AS dailyCollection FROM userDiagnosis WHERE dateOfAppointment = '$todayD';";
        $resultCost = mysqli_query($conn, $sqlCost);
        $rowCost = mysqli_fetch_assoc($resultCost);
        $dailyCollection = $rowCost['dailyCollection'];
//---------------------------- Data for cost Ends ---------------------------------->


           $sqlAppt = "SELECT * FROM userAppointment Inner Join patient ON userAppointment.patientID = patient.patientID AND dateOfAppointment = '$todayD' AND patient.providerID ='$providerID'  ORDER BY timeOfAppointment ASC";
            $resultAppt = mysqli_query($conn, $sqlAppt);

            
          $appCount=0;
            while($appTotal = $resultAppt ->fetch_assoc()){
                $appCount++;
            }  

?>
	<!--<div style="margin:0"> -->

<?php


        $sqlAppt = "SELECT * FROM userAppointment Inner Join patient ON userAppointment.patientID = patient.patientID AND dateOfAppointment = '$todayD' AND patient.providerID ='$providerID'  ORDER BY timeOfAppointment ASC;";

        $resultAppt = mysqli_query($conn, $sqlAppt);
        $numRowAppt = mysqli_num_rows($resultAppt);
            

        if($numRowAppt < 1  ){
            echo "<div style='background-color: #fff; border: 0.5px solid #f06292; text-align:center; color: #f06292; font-size: 1.6vw; margin-top:15px; padding:10px;'> No Appointments Listed for  ".$datePrint2." </div>";
        }
    else{

    ?>

        <div class="table-responsive" style="font-size:1.15em;">
        <table class="table table-bordered">
         <tr class="bg bg-dark text-white pad-10" style="background-color:#343a40; border-color: #343a40; color:#fff;">
          <th width="15%">Cancellation</th>
          <th width="25%">total expected</th>
          <th width="20%">total paid</th>
          <th width="20%">balance due</th>
          <th width="20%">new appointment</th>
         </tr>
         <tr style="background-color: #fff;">
          <td style=" border:0.1px solid #d3d7db;"> 3</td>
          <td style=" border:0.1px solid #d3d7db;"><?php $exp = 3195.23; echo "$".$exp;?></td>
          <td style=" border:0.1px solid #d3d7db;"> <?php  echo "$".$dailyCollection; ?></td>
          <td style=" border:0.1px solid #d3d7db;"> <?php  

            $balanceDue = $exp - $dailyCollection;
            echo "$".$balanceDue; 


              ?></td>
          <td style=" border:0.1px solid #d3d7db;">8</td>

         </tr>
        </table>

       </div>






    <div style="margin-top: 40px; background: linear-gradient(-45deg, #ae41c1 0%,#f06292 100%);  color:#fff; padding: 15px;">

        <span style="display:inline-block; background-color:#fff; border-radius:4px; margin: 0 10px 0  10px; padding: 2px 10px 5px 10px; color: #000;"> <?php echo $appCount;  ?></span>

            <span> Appointment List </span>
            <span style="float:right;"> Date: <?php echo $datePrint; ?> </span> 
        </div>	



        <table class="table table-hover table-striped" style="background-color:#fff;">
                <thead>
                    <div class="row justify-content-center" style="width:100%; font-size: 14px;  padding:0px 20px 0 0; cursor:pointer;">	
                    <tr style="background-color:#343a40; border-color: #343a40; color:#fff;">

                        <th width="2%">
                            <span class="dot" id="patientList" style="margin-right:10px;  text-align:center;">

                            </span></th>
                        <th width="7%">Time</th>
                        <th width="9%">last name</th>
                        <th width="9%">first name</th>
                        <th width="11%">dob</th>
                        <th width="11%">Phone</th>
                        <th width="3%">gender</th>
                        <th width="26%">Reason</th>
                        <th width="21%" colspan="3">Action</th>

                    </tr></div>
                </thead>


            <?php
               $appCountList=0;

                while($rowAppt = $resultAppt ->fetch_assoc()):

                $appTime = $rowAppt['timeOfAppointment'];
                $appTime = date("h:i a", strtotime($appTime));

                $appDate  = $rowAppt['dateOfAppointment'];	
                $appDate = date(' m-d-Y', strtotime($appDate)); 

                $dob  = $rowAppt['DOB'];	
                $dob = date(' m-d-Y', strtotime($dob)); 

                $patientID = $rowAppt['patientID'];

                //split phone string and formats it for display.
                $phone = $rowAppt['phoneNumber'];
                $len = strlen($phone);
                $phone = "(".substr($phone, 0,3).")".substr($phone, -7,-4)."-".substr($phone, -4,$len);
                $appCountList++; 

    ?>

                   <tr style="width:100%; font-size: 1.2rem; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd;">

                        <td>

                    <?php  
                    if($rowAppt['signedIn'] == 1){ ?>
                            <span style="padding:3px 10px; width:25px; height: 25px; background-color:#ff3bf8; border: 0.5px solid #ff3bf8; border-radius:5px;" title="Patient Has Signed In"><?php echo $appCountList; ?> </span>
                    <?php } 
                    else{ ?>
                        <span style="padding:3px 10px; width:25px; height: 25px; border: 0.5px solid #ff3bf8; border-radius:5px;" title="Patient Not Signed In"><?php echo $appCountList; ?></span>
                                <?php } ?>
                       </td>

                        <td><?php echo $appTime;  ?></td>
                        <td><?php echo $rowAppt['lName']; ?></td>
                        <td><?php echo $rowAppt['fName']; ?></td>
                        <td><?php echo $dob; ?></td>
                        <td><?php echo $phone; ?></td>
                        <td><?php echo $rowAppt['gender']; ?></td>
                        <td><?php echo $rowAppt['reason']; ?></td>
                        <td style="padding-left:0; padding-right:0;">
                        <div>    
                            
                    <?php  
                            if($rowAppt['signedIn'] == 1){ ?>
                            <span  style="margin-right: 25px; cursor:pointer;">
                               <img src="upload/photos/dropimg/allImages/signedinIcon.png" width="20px" height="20px" title="Click to check patient in"></span>
                    <?php } 
                        else{ ?> 
                             <span  style="margin-right: 25px; cursor:pointer;" class="officeSignIn" id="os<?php echo $rowAppt['patientID']; ?>">
                               <img src="upload/photos/dropimg/allImages/signinIcon.png" width="20px" height="20px"  title="Patient already checked in"></span>
                    <?php } ?>
                            
                            <span style="margin-right: 25px; cursor:pointer;" class="scriptIMG" id="scriptIMG<?php echo $rowAppt['patientID']; ?>" >
                                <img src='upload/photos/dropimg/drop512.png' width="20px" height="20px"  title="Click to enter prescriptions order"></span> 

                            <span style="margin-right: 25px; cursor:pointer;" class="serviceIMG" id="serviceIMG<?php echo $rowAppt['patientID'];?>" >
                                <img src='upload/photos/dropimg/servicePatients.png' width="20px" height="20px" id="serviceUpdate" title="Click to enter diagnosis"></span> 


                             <span style="cursor:pointer;" class="scriptToPharmacy" id="<?php echo $rowAppt['patientID']; ?>" > <img src='upload/photos/dropimg/scriptDone.png'  width="20px" height="20px" id="serviceUpdate" title="Click to send prescription to pharmacy"></span>
                        </div>
                        </td>
                    </tr>



            <?php endwhile; ?>


            </table>	<?php } ?>		



    <div class="apptFormDisplay" id="<?php echo $patientID; ?>"></div>
    <div class="patientInfoDisplay" id="patientInfo<?php echo $patientID; ?>"></div>

    <! -- this is where your script submit message will appear -->
    <div class="msgDisplay"></div>

    <! -- this is where all of your displays will appear for script/dx  -->
    <div class="services2"> <div class="serviceDisplay" id="service<?php $patientID; ?>"></div></div>

    <br>

<?php include_once('https://dropcure.org/dropsocial/serviceAll/allAjaxCalls.php'); ?>

<script>
$(document).ready(function(){
    
    //<!--------- OFFICE SIGNIN-IN PATIENT:  ------------>
// - used to sign each patient in
$('.officeSignIn').on('click', function(){
    var signinID = $(this).attr('id');
   //alert(signinID);


        var confirmLock = confirm("Click OK to sign patient in!");
            if(!confirmLock){
                alert("Patient still not signed in!");
                exit();
            }
            else{

                signinID = signinID.substring(2, );
              //  alert(signInID);

                $.ajax({
                    type: "POST",
                    url: "https://dropcure.org/dropsocial/serviceAll/provider/appointments/patientSignin.php",
                    dataType: "html",
                    data: {signinID: signinID},
                    success: function(signIn){
                        alert(signIn);
                        if(!signIn.error) location.reload(true);

                        }
                });
        }
    });
    
                                  //<!--------- SCRIPTS RESULTS: provider button click result for prescriptions. Also where data is entered!----------->     
                                    $('.scriptIMG').on('click', function(){
                                    var patientID = $(this).attr('id');
                                       patientID = patientID.substring(9, );
                                      //alert("User ID: " + patientID);

                                            $.ajax({
                                                type: "POST",
                                                url: "https://dropcure.org/dropsocial/serviceAll/provider/serviceScript/index.script.php",
                                                dataType: "html",
                                                data: {patientID: patientID},
                                                success: function(msg){
                                                    $('.msgDisplay').html(msg);
                                                    }
                                            });
                                    });
    
    
    
    
    
    


                                                                    //<!-- DX & SCRIPT INSERT: ajax calls for appointment list actions.  inserts diagnosis & prescriptions 6-30-2020-->
                                                                    //var indexPage = "https://dropcure.org/dropsocial/serviceData/index.services.php";
                                                                       $('.serviceIMG').on('click', function(){
                                                                        var patientID = $(this).attr('id');
                                                                           patientID = patientID.substring(10, );
                                                                          // alert(patientID);

                                                                                        $.ajax({
                                                                                            type: "POST",
                                                                                            url: "https://dropcure.org/dropsocial/serviceAll/provider/serviceData/index.services.php",
                                                                                            dataType: "html",
                                                                                            data: {patientID: patientID},
                                                                                            success: function(msg){
                                                                                                $('.msgDisplay').html(msg);
                                                                                                }
                                                                                        });
                                                                          });


$('.scriptToPharmacy').on('click', function(){
    var scriptPatientID = $(this).attr("id");

    var confirmScripts = confirm("Clicking OK will submit all prescriptions to pharmacy now!");
    if(!confirmScripts){
        alert("You may continue to add additional prescriptions");
        exit();
    }
    else{

    //alert("User ID Sent: " + scriptPatientID);

        $.ajax({
            type: "POST",
            url: "https://dropcure.org/dropsocial/serviceAll/pharmacy/scriptToPharmacy.php",
            dataType: "html",
            data: {scriptPatientID: scriptPatientID},
            success: function(msg){
                $('.msgDisplay').html(msg);
                }
        });
    } //end of confirmation else bracket!
  });


       
    
    
});

</script>



<!--</div>   old check in color: #0bf446-->

		   


