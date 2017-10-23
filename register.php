<?php
	require('connect.php');
    // If the values are posted, insert them into the database.
    if (isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
	$email = $_POST['email'];
        $password = $_POST['password'];
	$date = exec("date");
	$timestamp = date('Y-m-d H:i:s', strtotime($date)); 
 
        $query = "INSERT INTO `user` (username, password, email,timestamp) VALUES ('$username', '$password', '$email','$timestamp')";
        $result = mysqli_query($connection, $query);
        if($result){
            $smsg = "User Created Successfully.";
        }else{
            $fmsg ="User Registration Failed";
        }
    }
    ?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div id="wrapper">
	<h2>Registration</h2>
	<form method="POST"  onsubmit="return Validate()" name="vForm">

		<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg ; header("Location: login.php");exit; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>

		<div>
			<input type="text" name="username" class="textInput" placeholder="Username">
			<div id="name_error" class="val_error"></div>
		</div>
		<div>
			<input type="email" name="email" class="textInput" placeholder="Email">
			<div id="email_error" class="val_error"></div>
		</div>
		<div>
			<input type="password" name="password" class="textInput" placeholder="Password">
		</div>
		<div>
			<input type="password" name="password_confirmation" class="textInput" placeholder="password confirmation">
			<div id="password_error" class="val_error"></div>
		</div>
		<div>
			<input type="submit" class="btn" name="register" value="Register">
		</div>
	</form>
</div>
</body>
</html>
<!-- add javascript here -->
<script type="text/javascript">

      
	// GETTING ALL INPUT TEXT FIELDS
	var username = document.forms["vForm"]["username"];
	var email = document.forms["vForm"]["email"];
	var password = document.forms["vForm"]["password"];
	var password_confirmation = document.forms["vForm"]["password_confirmation"];
	
	 //localStorage.setItem("nameid",username);
	 
	// GETTING ALL ERROR OBJECTS
	var name_error = document.getElementById("name_error");
	var email_error = document.getElementById("email_error");
	var password_error = document.getElementById("password_error");

	// SETTING ALL EVENT LISTENERS
	username.addEventListener("blur", nameVerify, true);
	email.addEventListener("blur", emailVerify, true);

	function Validate(){
		// VALIDATE USERNAME
		var namepattern = /^[A-Za-z0-9]{5,}$/;
		if(username.value == ""){
			name_error.textContent = "Username is required";
			username.style.border = "1px solid red";
			username.focus();
			return false;
		}
		if(!(username.value.match(namepattern))){
			name_error.textContent = "Username is invalid";
			username.style.border = "1px solid red";
			username.focus();
			return false;
			
		}

		// VALIDATE EMAIL
		 var emailPattern =/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/; 
		 // /^[a-zA-Z0-9]._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		if(email.value == ""){
			email_error.textContent = "Email is required";
			email.style.border = "1px solid red";
			email.focus();
			return false;
		}
		if(!(email.value.match(emailPattern))){
			email_error.textContent = "Email is invalid";
			email.style.border = "1px solid red";
			email.focus();
			return false;
		}

		// VALIDATE PASSWORD
		if (password.value != password_confirmation.value) {
			password_error.textContent = "The two passwords do not match";
			password.style.border = "1px solid red";
			password_confirmation.style.border = "1px solid red";
			password.focus();
			return false;
		}

		// PASSWORD REQUIRED
		if (password.value == "" || password_confirmation.value == "") {
			password_error.textContent = "Password required";
			password.style.border = "1px solid red";
			password_confirmation.style.border = "1px solid red";
			password.focus();
			return false;
		}
	}

	// ADD EVENT LISTENERS
	function nameVerify(){
		if (username.value != "") {
			name_error.innerHTML = "";
			username.style.border = "1px solid #110E0F";
			return true;
		}
	}

	function emailVerify(){
		if (email.value != "") {
			email_error.innerHTML = "";
			email.style.border = "1px solid #110E0F";
			return true;
		}
	}


</script>
