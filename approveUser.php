<?php
   include "connection.php";
?>
<?php
    $subject = "";
    $checkedboxes = explode(",",$_POST["checkedBoxes"]); //Split by comma
    $emails=explode(",",$_POST['emails']);
    $fnames=explode(",",$_POST['fnames']);
    $status="pending";

    if(isset($_POST["btnApprove"]))
        $status = "approved";
    else if(isset($_POST["btnDecline"]))
        $status = "declined";
    
    $isError="n";
    for($i = 0; $i < sizeof($checkedboxes); $i++){ 
        if($status=="approved"){
            $tempPass=getTempPass(12);
            $sql="INSERT INTO `credits` (`user_id`,`credits_received`,`received_on`,`reason`) VALUES(".$checkedboxes[$i].",5,'".date("Y-m-d H:i:s")."','registration')";
            mysqli_query($conn, $sql);
            $sql="UPDATE `user_login` SET status='".$status."', password='".$tempPass."' WHERE user_id='".$checkedboxes[$i]."'";
            $to=$emails[$i];
            $subject = "Registration Approved";
            $body = "Hi ".$fnames[$i].",\n\nYour registration has been approved. Your temporary password is: ".$tempPass.". Setup a new password via below link:\n\nwww.reachingteaching.com/resetPassword.php\n\nThanks,\nAdmin - Reaching Teaching";
        }
        else{
            $sql="UPDATE `user_login` SET status='".$status."' WHERE user_id='".$checkedboxes[$i]."'";
            $to=$emails[$i];
            $subject = "Registration Declined";
            $body = "Hi ".$fnames[$i].",\n\nWe regret to inform you that your registration has been declined. \n\nThanks,\nAdmin - Reaching Teaching";
        }
        mysqli_query($conn, $sql);
        sendMail($to,$subject,$body);
        echo $to." | ".$subject." | ".$body;
    }
    
    header("Location: admin_profile.php"); 
    
    
?>
<?php
function sendMail($to,$subject,$body){
    //$to = "varaprasath.sivaram@gmail.com";
    $headers = "From: admin@reachingteaching.com";// . "\r\n"; //."CC: somebodyelse@example.com";
    mail($to,$subject,$body,$headers);
}
?>
<?php
function getTempPass($n) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';

	for ($i = 0; $i < $n; $i++) {
		$index = rand(0, strlen($characters) - 1);
		$randomString .= $characters[$index];
	}

	return $randomString;
}
?>