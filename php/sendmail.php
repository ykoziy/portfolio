<?php 

if(isset($_POST['submit'])) {
	$formok = true;
	$error_log = array();
	
	//extra data
	$ip = $_SERVER['REMOTE_ADDR'];
	$date = date('m/d/Y');
	$time = date('H:i:s');
	
	//form data
	$name;
	$email;
	$message;

	//captcha data
	$captcha;

    if(isset($_POST['name'])) {
      $name = $_POST['name'];
    }if(isset($_POST['message'])) {
      $message = $_POST['message'];
  	}if(isset($_POST['email'])) {
      $email = $_POST['email'];
    }if(isset($_POST['g-recaptcha-response'])) {
      $captcha = $_POST['g-recaptcha-response'];
    }

	//recaptcha
	$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=PRIVATE_KEY_GOES_HERE&response="
								  .$captcha."&remoteip=".$ip);

	if (!$captcha) {
		$error_log[] = "Check the the captcha form.";
		$formok = false;
	} elseif($response.success == false && $captcha) {
		$error_log[] = "You are a robot. Go away!!!.";
		$formok = false;
	}else {
		if(empty($name)){
			$formok = false;
			$error_log[] = "Did you enter a name?";
		}
		 
		if(empty($email)){
			$formok = false;
			$error_log[] = "Did you enter an email address?";
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$formok = false;
			$error_log[] = "Email address entered is not valid";
		}
		 
		if(empty($message)){
			$formok = false;
			$error_log[] = "Did you enter a message?";
		}
		
		elseif(strlen($message) < 20){
			$formok = false;
			$error_log[] = "Your message must be greater than 20 characters";
		}
		
		if($formok) {
			$headers = "From: $email" . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$emailbody = "<p>You have received a new message from contact form on your website.</p>
						  <p><strong>Name: </strong> {$name} </p>
						  <p><strong>Email Address: </strong> {$email} </p>
						  <p><strong>Message: </strong> {$message} </p>
						  <p>This message was sent from the IP Address: {$ip} on {$date} at {$time}</p>";
		 
			mail("NAME@DOMAIN.COM","New Message",$emailbody,$headers);		
		}		
	}
	
    $return = array(
        'form_ok' => $formok,
        'errors' => $error_log
    );
	
	//set session variables
	session_start();
	$_SESSION['cf_return'] = $return;     
	//redirect back to form
	header('location: ' . $_SERVER['HTTP_REFERER']);
}

?>