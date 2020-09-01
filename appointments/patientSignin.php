<?php  


        include_once('../dbconnect.php');
        $signinID = $_POST['signinID'];
       

        $sqlCheckIn = "UPDATE userAppointment SET signedIn = '1' WHERE patientID = $signinID";
		$resultCheckIn = mysqli_query($conn, $sqlCheckIn);

        if($resultCheckIn){
            echo "You've signed in!";
        }
        else{
            echo "error: ".mysqli_error($conn);
            exit();
        }





?>
    