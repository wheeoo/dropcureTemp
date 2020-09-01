<style>
    .patientListDT th{
        color:#fff !important;
        padding:15px !important;
    }
    .patientListDT tbody tr:hover{
        background-color: #ffa8f3 !important;
    }
    .popover-title{
        max-width:750px;
    }
    .popover-content{
        margin-bottom: 30px;
    }
    
</style>


<?php        
include_once('dbconnect.php');

    $providerID = $_POST['providerID'];
	
	//Clinic Name search and print
	$sqlClinic = "SELECT clinicName FROM provider WHERE providerID = '$providerID'";
	$resultClinic = mysqli_query($conn, $sqlClinic);
    $rowClinic = mysqli_fetch_assoc($resultClinic);
	$clinicName = $rowClinic['clinicName'];
   

	//result for all patients from Clinic
    $sqlPat = "SELECT * FROM patient
    INNER JOIN userCoverage ON patient.userCoverage = userCoverage.coverageCode
    INNER JOIN provider ON provider.providerID = patient.providerID
    WHERE patient.providerID = '$providerID' AND patient.patientStatus=1 ORDER by patient.lName ASC, patient.DOB ASC"; 
	
    $resultPat = mysqli_query($conn, $sqlPat);
    $rowCount = mysqli_num_rows($resultPat);
?>




<div class="container mb-3 mt-3">
    
    <div style="text-align:center; font-size: 24px; background: linear-gradient(-45deg, #ae41c1 0%,#f06292 100%); color:#fff; width:100%; padding:15px; margin-bottom: 5px;"><strong><?php echo $clinicName; ?> </strong> <br>Patient List</div>
    <center><h1><?php// echo $datePrint; ?></h1> </center>
    
    <table class="table table-striped table-hover patientListDT" style="background-color:#fff;">

        <thead style="background-color:#2F323A; width:100%; padding:10px;">
            <tr>
                <th style="width:5%"></th>
                <th style="width:22%">Patient Name</th>
                <th style="width:10%">DOB</th>
                <th style="width:7%">Gender</th>
                <th style="width:19%">Coverage </th>
                <th style="width:17%">Telephone</th>
                <th style="width:20%">Actions </th>
            </tr>
        </thead>
    
       

        <?php        
            while($rowCount =mysqli_fetch_assoc($resultPat)):
                $fname =  $rowCount['fName']; 
                $lname =  $rowCount['lName']; 
                $phone =  $rowCount['phoneNumber']; 
				if(empty($phone)){
					$phone='5552223344';
				}				
                $len = strlen($phone);
                $phone = "(".substr($phone, 0,3).") ".substr($phone, -7,-4)."-".substr($phone, -4,$len);

                $username =  $rowCount['userName']; 
                $avatar =  $rowCount['userImage'];  
                $bday =  $rowCount['DOB'];  
                $bday = date(' m-d-Y', strtotime($bday)); 
                $gender =  $rowCount['gender']; 
				if(empty($gender)){
					$gender = "THEY";
				}
                $pID =  $rowCount['providerID']; 
                $patientID = $rowCount['patientID'];

                $permission =  $rowCount['permission']; 
                $coPay = $rowCount['coPay'];
                $userCoverage = $rowCount['userCoverageType'];
                $address =  $rowCount['address'];  
                $city =  $rowCount['city'];  
                $state =  $rowCount['state'];  
                $zip =  $rowCount['zipcode'];  
                $location1 = $address;
                $location2 = $city.", ".$state." ".$zip;
                $location = $location1.$location2;


                $code = $rowCount['userCoverage'];
				if(empty($code)){
					$code = 5;
				}

                // pulling coverage type
                $sqlCov = "SELECT * FROM userCoverage WHERE coverageCode = {$code};";
                $resultCov = mysqli_query($conn, $sqlCov);
                $tabCount = mysqli_fetch_assoc($resultCov);

                $coverage = $tabCount['userCoverageType'];
                $patientCount++;

        ?>      
            <tr>
                <td><?php echo $patientCount; ?></td>
                <td><p  class="hover" id="pID<?php echo $rowCount['patientID']; ?>" style="cursor:pointer; color:#ae41c1;"> <?php echo $rowCount['fName']." ".$rowCount['lName']; ?></p></td>
                <td><?php echo  $bday; ?></td>
                <td><?php echo  $gender; ?></td>
                <td><?php echo  $userCoverage; ?></td>
                <td><?php echo  $phone; ?></td>
                <td style="background-color: #ccc;"> <div>
                   <!-- <span class="checkIn" id="checkIn<?php echo $patientID; ?>" style="cursor:pointer;">
                        <img src="../serviceAll/allImages/signinIcon.png" style="width:15px; height:15px; margin-right:20px;">
                    </span>-->

                    <span class="apptMaker" id="<?php echo $patientID; ?>">
                        <img src="../serviceAll/allImages/apptIcon.png"  style="width:15px; height:15px; margin-right:20%; cursor:pointer;" title="Make Appointment For Patient">
                    </span> 

                    <span class="msg">
                        <img src="../serviceAll/allImages/messageIcon.png" class="autoClick" style="width:15px; height:15px; margin-right:20%; " title="Leave Message For Patient">
                    </span> 

                    <span class="history" style="cursor:pointer;">
                        <img src="../serviceAll/allImages/history.png" style="width:15px; height:15px; " title="Prescription History">
                    </span>

                </div></td>
        </tr>
        <?php endwhile; ?>

        
        
        

       <!-- <tfoot>
            <tr>
                <th style="width:5%"></th>
                <th style="width:22%">Patient Name</th>
                <th style="width:10%">DOB</th>
                <th style="width:7%">Gender</th>
                <th style="width:19%">Coverage </th>
                <th style="width:17%">Telephone</th>
                <th style="width:20%">Actions </th>
            </tr>

        </tfoot> -->
    </table>
</div> <!-- end of containter 

<div class="patientInfoDisplay"></div> -->


<script>
$(document).ready(function(){  

	//$('body').on('click', '.patientListDT', function(){
		//$(this).DataTable();
	//});
   
   // $( ".patientListDT" ).on("click", function() {
   // $('.patientListDT').DataTable();
   // });
	
	   $('body .patientListDT').load('table', function(){
		   $(this).DataTable();
	   });   
		   
});

</script>



<script>	
$(document).ready(function(){
    //alert('ajax reaches!');
   // e.stopImmediatePropagation();
       $('.apptMaker').popover({
          title: "click X to exit popup!: <a class='close' href='#'>&times;</a>",
           content: fetchAppt,
            html: true,
            placement: 'left'
        });
});
       
       
            function fetchAppt(){
                var patientID = $(this).attr('id');
                    //patientID = patientID.substring(3,);
                //alert(patientID);
                
                
                var fetch_data ='';
                     $.ajax({
                            url: "https://dropcure.org/dropsocial/serviceAll/provider/appointments/appointmentForm.php",
                            method: "POST",
                            async:false,
                            dataType: 'html',
                            data: {patientID:patientID},
                            cache:false,
                            success: function(appt){
                             fetch_appt= appt
                                }
                            //cache: false
                            });
                return fetch_appt;
                    
                    }
</script>






<!-- This is popup for patient information in the Patient Search section! -->
<script>	
$(document).ready(function(){
    //alert('ajax reaches!');
   // e.stopImmediatePropagation();
   $('.hover').popover({
      title: "click edit or X to exit popup! <a class='close' href='#'>&times;</a>",
       content: fetchData,
        html: true,
        placement: 'right'
 });

            function fetchData(){
                var patientID = $(this).attr('id');
                    patientID = patientID.substring(3,);
                
                var fetch_data ='';
                     $.ajax({
                            url: "https://dropcure.org/dropsocial/serviceAll/provider/patientDataModal.php",
                            method: "POST",
                            async:false,
                            dataType: 'html',
                            data: {patientID:patientID},
                            success: function(data){
                             fetch_data = data
                                }
                            });
                return fetch_data;
                    
                    }
    
});
       
       
</script>




