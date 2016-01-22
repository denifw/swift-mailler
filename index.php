<?php
require_once 'lib/swift_required.php';
require('src/model.php');
require('src/controller.php');
# Route the request.
$uri = $_SERVER['PHP_SELF'];

#Control the request base on uri.
if ($uri === "/swiftmailer/") {
    index();
} else if ($uri === "/swiftmailer/index.php") {
    index();
} else if ($uri === "/swiftmailer/index.php/smtp") {
    $id = null;
    if (isset($_GET['id']) === true) {
        $id = $_GET['id'];
    }
    smtpList($id);
} else if ($uri === "/swiftmailer/index.php/smtp/new") {
    smtpNew();
} else if ($uri === "/swiftmailer/index.php/smtp/save" and isset($_POST['username']) === true and isset($_POST['password']) === true and isset($_POST['host']) === true and isset($_POST['port']) === true and isset($_POST['security']) === true) {
    smtpSave($_POST['username'], $_POST['password'], $_POST['host'], $_POST['port'], $_POST['security']);
} else if ($uri === "/swiftmailer/index.php/document") {
    documentList();
} else if ($uri === "/swiftmailer/index.php/document/new") {
    documentNew();
} else if ($uri === "/swiftmailer/index.php/document/save" and isset($_FILES['document']) === true) {
    documentSave($_FILES['document']);
} else if ($uri === "/swiftmailer/index.php/document/show" and isset($_GET['id']) === true) {
    documentShow($_GET['id']);
} else if ($uri === "/swiftmailer/index.php/mail") {
    openMailForm($_POST);
} else if ($uri === "/swiftmailer/index.php/mail/send") {
    sendMail($_POST);
} else {
    header('Status : 404 Not Found');
    echo '<html><body><h1>Page Not Found.</h1></body></html>';

}