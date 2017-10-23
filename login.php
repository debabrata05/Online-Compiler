<?php
	require('connect.php');
    // If the values are posted, fetch coresponding data from the database.
    if (isset($_POST['username']) && isset($_POST['password'])){
		$uname = $_POST['username'];
		//$email = $_POST['email'];
		$pass = $_POST['password'];
	 
		$query = "SELECT password FROM user WHERE username='$uname' ";
		$result = mysqli_query($connection, $query);
		if($result){
		    if(mysqli_num_rows($result)){
			session_start();
			$_SESSION['varname'] = $uname;
			while($data=mysqli_fetch_array($result,MYSQL_ASSOC)){
				if($pass==$data['password'])
					{
		    				$smsg = "User credentials are valid.";
						//$smsg="$_SESSION['varname']";
						//exit;
					}
				else{
					$fmsg="Invalid password";
					//exit;
				     }
			}
		     }else
			{$fmsg="Invalid username";}
		}else{
		    $fmsg ="Invalid details";
		}
    }
    
    ?>

<!DOCTYPE html>
<html>
<head>
	<title>SignIn</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div id="wrapper">
	<h2>Signin</h2>
	<form method="POST"  name="vForm">

		<?php if(isset($smsg)){ ?><div class="test" role="alert"> <?php /*echo $smsg ;*/ header("Location: compiler.html");exit; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="test" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>

		<div>
			<label for="inputUsername" class="sr-only">Username</label>
			<input type="text" name="username" class="textInput" placeholder="Username">
			<div id="name_error" class="val_error"></div>
		</div>
		<div>
			<label for="inputpass" class="sr-only">Password</label>
			<input type="password" name="password" class="textInput" placeholder="Password">
			<div id="password_error" class="val_error"></div>
		</div>
		<div>
			<input type="submit" class="btn" name="login" value="Login">
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
	//var email_error = document.getElementById("email_error");
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
