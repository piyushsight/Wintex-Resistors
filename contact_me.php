<?php
$name = $_POST['name']; // contain name of person
$email = $_POST['email']; // Email address of sender\
$phone = $_POST['phone']; // Your Phone
$message = $_POST['message']; // Your message 
$receiver = "info@wintexresistor.com" ; // hardcorde your email address here - This is the email address that all your feedbacks will be sent to 

if (!empty($name) & !empty($email) && !empty($message)) {
    $body = "Name:{$name}\n\nEmail:{$email}\n\nPhone :{$phone}\n\nQuery: {$message}";
	//$send = mail($receiver, '[Wintex Resistor] Online Contact Form '.$name, $body, 'From: '.$email);
	$send = mail("gkfarwaha@yahoo.com", '[Wintex Resistor] Online Contact Form '.$name, $body, 'From: '.$email);
	$send = mail("gkfarwaha@gmail.com", '[Wintex Resistor] Online Contact Form '.$name, $body, 'From: '.$email);
	
	$body = "Dear ,{$name}\n\rThank you for contacting us. We will revert back soon.\n\r\n\rKind regards,\nGaurav Kumar\nWinner Electronics\nRZ-41, Ravi Nagar EXT., Khyala\nNew Delhi-110018\nM: (+91)9953959805\n\rhttp://www.wintexresistor.com\nE: info@wintexresistor.com";
	$send = mail($email, '[Wintex Resistor] Auto Reply', $body, 'From: '.$receiver);
}
?>