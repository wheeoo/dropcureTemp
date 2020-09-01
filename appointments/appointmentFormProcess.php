<?php    
    

        //dbase connection file
		include_once('../dbconnect.php');
			
        $madeBy = trim(mysqli_real_escape_string($conn, $_POST['madeByID']));
        $patientID = trim(mysqli_real_escape_string($conn, $_POST['patientID']));
        $reason = trim(mysqli_real_escape_string($conn, $_POST['reason'])); 
        $doa = trim(mysqli_real_escape_string($conn, $_POST['doa']));
        $doat = mysqli_real_escape_string($conn,  $_POST['doat']);
       

		$doaPrint = date('l, F d, Y', strtotime($doa));	
        $doatPrint = date("h:i:sa", strtotime($doat));
  
					$dataInsert = [
                        	
                            'patientID' => $patientID,
                            'providerID' => $madeBy,
                            'dateOfAppointment' => $doa,
                            'timeOfAppointment' => $doat,
                            'reason' => $reason,
                            'madeBy' => $madeBy,
						];					
						
						foreach ($dataInsert as $key => $value){
							$k[] = $key;
							$v[] = "'".$value."'";
						}
							
						$k = implode(',', $k);
						$v = implode(',', $v);
						
						$sqlAppt = "INSERT INTO userAppointment($k) VALUES($v)";	
						$resultNewP = mysqli_query($conn, $sqlAppt);		


                        if($resultNewP) {
                                echo'<script>$("#regForm")[0].reset();';
                                echo '$("#regform").get(0).reset();</script>';
                         
                                $msg .= "<br \><div class='alert alert-outline alert-success alert-dismissble' role='alert' style='text-align: center'>Your data was correctly entered. Thank you!
                                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times; </a></div>";
                             
                                ?> <div style='margin: auto; width:50%; background-color:#eaf7e6; border:0.5 solid #abc789; border-radius: 5px; padding:10px; margin-bottom:20px;'>
                                <?php
                                $msg .="<strong>Date of Appointment:</strong>  ".$doaPrint."<br>";
                                $msg .="<b>Time of Appointment:</b>  ".$doatPrint."<br>";
                                $msg .="<strong>Reason:</strong>  ".$reason."<br>";
                                $msg .="<b>made by employee ID:</b>  ".$madeBy."<br>";
                                $mgs .="</div>";
                                echo $msg;
                            
                                header("refresh: 3; ; url = https://dropcure.org/dropsocial//common_things/");
                               // exit;
                            } else {
                            
                                    $msg= "<div class='alert alert-danger alert-dismissible' role='alert' style='text-align:center''>Form Error Found!: ".$resultNewP."<br>" . mysqli_error($conn)."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times; </a></div";
                        
                                    echo $msg;
                                    header("Refresh: 5;");
                                }

        
            mysqli_close($conn);
						

?>