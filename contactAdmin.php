<?php
$validActions = ["contact"];
if(isset($_POST['action']) && in_array($_POST['action'], $validActions)) {
    if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST["message"]) && $_POST['name']!= '' && $_POST['phone'] != '' && $_POST['message'] != '') {
             contact($_POST);
    } else {
               echo "Post  not found";
      }

} else {
     echo "action not found";
}
function contact($params) {
    $name = filter_var($params['name'], FILTER_SANITIZE_STRING);
    $phone=filter_var($params['phone'], FILTER_SANITIZE_STRING);
    $message=filter_var($params['message'], FILTER_SANITIZE_STRING);
    $formUrl = $params['formUrl'];
    $to = 'info@cloud9sleepsystems.com';

        $subject = 'Adjustable Beds Phoenix';
        $message = $params['message'];
        $emailBody ="Customer Info. \n". 
          " Name:  $name\n".
          " Phone no: $phone\n". 
          " Message:  $message";
    

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "Organization: turbify.com\r\n";
    $headers .= "Return-Path: <contact@turbify.com>\r\n"; 
    $headers .= "X-Priority: 3\r\n";
    $headers .= 'From: Turbify <contact@turbify.com>'."\r\n".
            'CC:puneet@kuroit.in'."\r\n".
            'Reply-To: <contact@turbify.com>'."\r\n" .
            'X-Mailer: PHP/' . phpversion()."\r\n";
    if(mail($to,$subject,$emailBody)) {
        echo json_encode([
            'status'    =>  'success',
            'message'   =>  'Thanks to contact. We will response soon.'
        ]);
     
    } else {
        echo json_encode([
            'status'    =>  'error',
            'message'   =>  'Unable to contact. Please try after some time.'
        ]);
        die;
    }
}

?>