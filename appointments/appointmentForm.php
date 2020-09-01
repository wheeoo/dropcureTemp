<style>
.popover{
        max-width:750px;
    /*background-color: #d4edda; */
    }
    
    @media (min-width: 1200px) {
   .popover {
      width: 90%; 
   }
.popover fade left in{
    left: =20.0938px !important;
    }
}
</style>

<?php

include_once('../dbconnect.php');
$patientID = $_POST['patientID'];

$formInfo = "SELECT * FROM patient WHERE patientID = '$patientID'"; 
$formQry = mysqli_query($conn, $formInfo);
$formRows = mysqli_num_rows($formQry);
$formResult = $formQry -> fetch_assoc();
$madeByID = $formResult['providerID'];  


$dob = date(' F-d-Y', strtotime($formResult['DOB']));

?>



<!----  AJAX call and all 3 necessary jquery cdn has to be called from this page. 7-10-2020--->
<!--------- patient appointment settings for provider access -->
  
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css"> -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>		
	$(document).ready(function(){
        var madeByID = $(".hiddenProviderID").attr("id");
        //alert(madeByID);
		var minDate = new Date();
		
		 
			$(".apptDate").datepicker({					
				minDate: minDate,
				dateFormat: 'yy-mm-dd',
				onClose: function (selectd){
					$('#apptDate').html(selectd);
                 
				
						$.ajax({
							type: "POST",
							data: {dateOfAppointment: selectd, providerID: madeByID},
							url: "https://dropcure.org/dropsocial/serviceAll/provider/appointments/appointmentFormTime.php",
							success: function(msg){
								$('#apptTimeChose').html(msg);
								}
						}); 
				
			}
		});	
	});
</script>


<div id="apptConfirmation"> 

        <!--<div class="resume-item d-flex flex-column flex-md-row justify-content-between mb-5"> -->
          <div class="container" style="width:100%;">
              
            <div>
		  <!-- Row start -->
		  <nav class="navbar navbar-dark"  style="background-color:#343a40; border-color: #343a40; color:#fff; padding:20px; text-align:center;" >
       
            Patient Appointment:  
            <strong><?php echo $formResult['fName']." ".$formResult['lName']; ?></strong>
              Date of Birth: <strong><?php echo $dob; ?></strong>
      
        </nav>
		   
		
    <form action="" method="post" id="regForm" style="padding-bottom: 50px;" class="main-form needs-validation" novalidate>			
		  <div class="row alert alert-success" style="color:#343a40; margin-left:0.5px; margin-right:0.5px; border-radius: 0  0 5px 5px;"> 
			<div class="col-lg-3 col-xs-4">
                <div>
                    <label for="date">date</label>	
						<input type="text" name="apptDate" class="apptDate form-control" id="apptDate"  autocomplete="off"    placeholder="select appointment date">
                      <input type="hidden" class="hiddenPatientID" id="<?php echo $formResult['patientID'];?>">
                      <input type="hidden" class="hiddenProviderID" id="<?php echo $formResult['providerID']; ?>">
              
						
                </div>
            </div>

              <div class="col-lg-3 col-xs-4">
                <div class="form-group">
                    <label for="Open Slots">time</label>	
					<div type="text" name="apptTimeChose" class="apptTimeChose"  id="apptTimeChose" style="height:40px; border-radius: 3px; background-color: #fff;"></div>
				</div>
            </div>

		 <div class="col-lg-6 col-xs-4">
                <div class="form-group">
                    <label for="reason for visit">reason for office visit:</label>
                    <input type="text" name="reason" id="apptreason" class="form-control" required>  
                </div>
            </div>				
        </div>		 
		
		<div style="margin:auto 25%;">
		<!-- <span style="float:left;">
		<button  name="canAppt" id="canAppt" class="btn btn-danger" style="float:right; background-color:#ff3bf8; border-color:#ff3bf8;">cancel</button></span> -->
		
	
          <button  id="mkAppt" class="btn btn-outline alert-success mkAppt" style="color:#ff3bf8; width:340px; padding:20px 0;">make appointment</button></div>
    </form>
  
 </div>
          
            </div> </div> 
<style>
    button:hover{
        background-color: #343a40;
        color: #fff !important;
        
    }
</style>

       
<script>
    $(document).ready(function(){
        
        $('.mkAppt').on('click', function(e) {
            e.preventDefault();
            var doa = $('#apptDate').val();
            var doat = $('#apptTimeChose option:selected').html();
            var reason = $('#apptreason').val();
            var patientID = $(".hiddenPatientID").attr("id");
            var madeByID = $(".hiddenProviderID").attr("id");
           // alert(madeByID);
           // alert(patientID);
			
            if(doa=='' || doat==''){
                alert("Please enter date of appointment & time of appointment");
            }
            else{
            	
                $.ajax({
                    type: "POST",
                    url: "https://dropcure.org/dropsocial/serviceAll/provider/appointments/appointmentFormProcess.php",
                    data: {doa: doa, doat: doat, reason: reason, patientID: patientID, madeByID: madeByID},
                    success: function(msg){
                        $('#apptConfirmation').html(msg);
                       
                    }
                }); 
				
            
            }
            
        });
        
        
    });

</script>

<!--</div>-->

	

  