<?php
$username=$_POST['username'];
$age=$_POST['age'];
$DOB=$_POST['DOB'];
$phone number=$_POST['phone number'];
$email id=$_POST['email id'];
$password=$_POST['password']; 

if (!empty($username) || !empty($password) || !empty($DOB) || !empty($phone number) || !empty($email id) || !empty($password)) {
  	$host = "localhost";
	$dbUsername = "root";
	$dbPassword="";
	$dbname="register";
	
	$conn = new mysqli($host,$dbUsername,$dbPassword,$dbname);

	if (mysqli_connect_error()){
		die('Connect Error('. mysqli_connect_errno().')'.mysqli_connect_error());
	} else {
		$SELECT="SELECT email From register Where email = ? Limit 1";
		$INSERT="INSERT into register (username,age,DOB,phone number,email id,password) values(?,?,?,?,?,?)";

		$stmt=$conn->prepare($SELECT);
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->bind_result($email);
		$stmt->store_result();	
		$rnum=$stmt->num_rows;

		if($rnum==0) {
			$stmt->close();

			$stmt=$conn->prepare($INSERT);
			$stmt->bind_param("ssssii",$username,$age,$DOB,$phone number,$email id,$password);
			$stmt->execute();
			echo "new record inserterd sucessfully";
		}else{
			echo "some one registered with this email";
	}
		$stmt->close();
		$conn->close();
	}

}else{
	echo "All fields are required";
	die();
}
?>