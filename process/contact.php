<?php
require $_SERVER['DOCUMENT_ROOT'].'/contactform/config/config.php';
require $_SERVER['DOCUMENT_ROOT'].'/contactform/config/function.php';

require $_SERVER['DOCUMENT_ROOT'].'/contactform/class/model.php';
require $_SERVER['DOCUMENT_ROOT'].'/contactform/class/contact.php';

$contactForm = new ContactForm();

$name_error = $email_error = $contactnumber_error = $message_error =  "";
$name = $email = $contactnumber = $message = $success =  "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //debugger($_POST, true);
    if(empty($_POST["name"])){
        $name_error = "Name is required";
    } else {
        $name = sanitize($_POST["name"]);
        if(!preg_match("/^[a-zA-Z ]*$/",$name)){
            $name_error = "Only letters are allowed";
        }
    }

    if(empty($_POST["contactnumber"])){
        $contactnumber_error = "Contact number is required";
    } else {
        $contactnumber = sanitize($_POST["contactnumber"]);
        if(!preg_match("/^[0-9]{10}$/", $contactnumber)){
            $contactnumber_error = "Invalid contact number";
        }
    }

    if(empty($_POST["email"])){
        $email_error = "Email is required";
    } else {
        $email = sanitize($_POST["email"]);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email_error = "Invalid email format";
        }
    }

    if(empty($_POST["message"])){
        $message_error = "Message is required";
    } else {
        $message = sanitize($_POST["message"]);
    }

    if ($name_error == '' and $email_error == '' and $contactnumber_error == '' and $message_error == ''){
        $data = array();
        $data['name'] = $name;
        $data['contactnumber'] = $contactnumber;
        $data['email'] = $email;
        $data['message'] = $message;

        $contactForm_id = isset($_POST['id']) ? (int)$_POST['id'] : NULL;
        $contactForm_id = $contactForm->addContactForm($data); // for create

        if($contactForm_id){
            $success = "Message sent, thank you for contacting us!";
            $name = $email = $contactnumber = $message = '';
            //redirect('./index');
        } else {
            $success = "There was a problem while sending message";
            $name = $email = $contactnumber = $message = '';
        }


        // send mail
        // $message_body = '';
        // unset($_POST['submit']);
        // foreach($_POST as $key => $value){
        //     $message_body .= "$key: $value\n";
        // }

        // $to = 'dongolmt@gmail.com';
        // $subject = 'Contact form submited data';
        // if(mail($to, $subjet, $message)){
        //     $success = "message sent, thank you for contacting us!";
        //     $name = $email = $contactnumber = $message = '';
        // }
    }
}

?>