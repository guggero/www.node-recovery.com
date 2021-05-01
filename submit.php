<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && @$_POST['do'] == 'register') {
    foreach($_POST as $key => $value) {
        if (!is_array($key)) {
            // sanitize the input data
            $_POST[$key] = htmlspecialchars(stripslashes(trim($value)));
        }
    }

    $node_id = @$_POST['node_id'];
    $contact = @$_POST['contact'];
    $captcha = @$_POST['captcha_code'];

    $errors = array();

    if (strlen($node_id) < 66) {
        $errors['node_id_error'] = 'Node ID is required';
    }

    if (strlen($contact) == 0) {
        // no email address given
        $errors['contact_error'] = 'Please enter contact information';
    }

    // Only try to validate the captcha if the form has no errors
    // This is especially important for ajax calls
    if (sizeof($errors) == 0) {
        require_once dirname(__FILE__) . '/securimage/securimage.php';
        $securimage = new Securimage();

        if ($securimage->check($captcha) == false) {
            $errors['captcha_error'] = 'Incorrect security code entered';
        }
    }

    if (sizeof($errors) == 0) {
        // no errors, send the form
        $time       = date('r');
        $message = "------------------------------------------------\n"
                 . "ID: $node_id\n"
                 . "Time: $time\n"
                 . "Browser: " . htmlspecialchars($_SERVER['HTTP_USER_AGENT']) . "\n"
                 . "Contact: $contact\n";

        $fp = fopen('data.txt', 'a');
        fwrite($fp, $message);
        fclose($fp);

        $return = array('error' => 0, 'message' => 'OK');
        die(json_encode($return));
    } else {
        $errmsg = '';
        foreach($errors as $key => $error) {
            // set up error messages to display with each field
            $errmsg .= " - {$error}\n";
        }

        $return = array('error' => 1, 'message' => $errmsg);
        die(json_encode($return));
    }
}

?>