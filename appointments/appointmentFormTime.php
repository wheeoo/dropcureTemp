<!--
This page queries the database for all appointments from a selected time slot and compares them to requested time from user and gives you available slots.

files:  regFull.php - has ajax call and post it to apptOpen.php -->


<?php
include_once('../dbconnect.php');

$dateSearch = $_POST['dateOfAppointment'];
$providerID = $_POST['providerID'];




//pull all appointment for date above into array - taken.
$sql = "SELECT * FROM userAppointment WHERE dateOfAppointment = '$dateSearch' AND providerID = '$providerID'   ORDER By timeOfAppointment ASC";
$sqlResult = mysqli_query($conn, $sql);
$sqlNumRows = mysqli_num_rows($sqlResult);


$taken =[];
$providerID = $_POST['providerID'];

// put all appointment into an array.
if($sqlNumRows < 1 ){
    $taken=[];
}
else{
    while($sqlRecords = $sqlResult ->fetch_assoc()):
            $time = $sqlRecords['timeOfAppointment'];
            array_push($taken, $time);
    endwhile;
}

$timePush = [];
$timeIn =[];
$fullAppt =[];

//time slot with 2 appointments are not shown and placed in fullAppts slot array!
foreach($taken as $take){
	if (in_array($take, $timePush)){
		array_push($timeIn, $take);
		}
	else{		
		array_push($timePush, $take);	
		}
	array_push($timePush, $take);
}

foreach($timeIn as $timeout){
	array_push($fullAppt, $timeout);
}

//query db for all time slots.  will use later for different practice.
$sql1 = "SELECT time FROM userAppointmentTime ORDER By Time ASC";
$sqlResult1 = mysqli_query($conn, $sql1);
$taken1 =[];

//creating array for appointment slots taken to compare.
while($sqlRecords1 = $sqlResult1 ->fetch_assoc()):
	$time1 = $sqlRecords1['time'];
	array_push($taken1, $time1);
endwhile;

// used comparison method to compare taken appointments and open appointment.
$results = array_diff($taken1, $fullAppt); ?>
<select name="apptTimeChose" id="apptTimeChose" style="background-color:transparent; border:0; width:100%; margin-top:0; padding: 11px; 0 15px 0; color:#000;">
		<?php 
		//loop left over open slots and print them to select.
		foreach($results as $result){ ?>
			<option value="<?php echo $result;?>"><?php echo $result;	?></option>	
		<?php 	}  ?>
</select>

