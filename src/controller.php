<?php

function index()
{
    smtpList();
}

function smtpList($id = null)
{
    if ($id !== null and is_numeric($id) === true) {
        $smtp = getSmtpById($id);
        if ($smtp !== null) {
            $checkServer = checkSmtpServer($smtp['username'], $smtp['password'], $smtp['host'], $smtp['port'], $smtp['security']);
            if ($checkServer === 'success') {
                $success = 'Success. Connection to Mail server ' . $smtp['host'] . ' with usernae ' . $smtp['username'] . ' was correct.';
            } else {
                $failed = 'Failed. Connection to Mail server ' . $smtp['host'] . ' with usernae ' . $smtp['username'] . ' was Failed with message "<b>' . $checkServer . '</b>';
            }
        }
    }
    $listSmtp = getAllSmtp();
    require 'view/listSmtp.php';
}

function smtpNew()
{
    $username = '';
    $host = '';
    $password = '';
    $port = '';
    $security = '';
    require 'view/newSmtp.php';
}

function smtpSave($username, $password, $host, $port, $security)
{
    $errors = [];
    if (empty($username) === true) {
        $errors[] = 'Username is required.';
    }
    if (empty($password) === true) {
        $errors[] = 'Password is required.';
    }
    if (empty($host) === true) {
        $errors[] = 'Host is required.';
    }
    if (empty($port) === true) {
        $errors[] = 'Port is required.';
    }
    if (count($errors) === 0) {
        $checkServer = checkSmtpServer($username, $password, $host, $port, $security);
        if ($checkServer === 'success') {
            doInsertSmtp($username, $password, $host, $port, $security);
            header("Location: /swiftmailer/index.php/smtp");
        } else {
            $errors[] = $checkServer;
            require 'view/newSmtp.php';
        }
    } else {
        require 'view/newSmtp.php';
    }
}

function checkSmtpServer($username, $password, $host, $port, $security)
{
    try {
        $transport = Swift_SmtpTransport::newInstance($host, $port, $security);
        $transport->setUsername($username);
        $transport->setPassword($password);
        $mailer = \Swift_Mailer::newInstance($transport);
        $mailer->getTransport()->start();
        return 'success';
    } catch (Swift_TransportException $e) {
        return $e->getMessage();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function documentList()
{
    $listDocument = getAllDocument();
    require 'view/listDocument.php';
}

function documentNew()
{
    require 'view/newDocument.php';
}

function documentSave($fileUpload)
{
    if ($fileUpload['size'] > 0) {
        $result = doUploadFile($fileUpload);
        if ($result !== 'success') {
            $error = $result;
            require 'view/newDocument.php';
        } else {
            header("Location: /swiftmailer/index.php/document");
        }
    } else {
        $error = 'There is no file selected/uploaded.';
        require 'view/newDocument.php';
    }
}

function documentShow($id)
{
//    echo 'hai';
    $document = getDocumentById($id);
//    var_dump($document);
    $size = $document['size'];
    $type = $document['type'];
    $name = $document['name'];
    header("Content-length: $document");
    header("Content-type: $type");
    header("Content-Disposition: attachment; filename=$name");
    echo $document['file'];
    exit;
}


function openMailForm($postPar)
{
    $listSmtp = getAllSmtp();
    $subject = '';
    $from = 0;
    $to = '';
    $cc = '';
    $bcc = '';
    $message = '';
    require 'view/newMail.php';
}

function sendMail($postPar)
{
    $subject = $postPar['subject'];
    $from = $postPar['from'];
    $to = $postPar['to'];
    $cc = $postPar['cc'];
    $bcc = $postPar['bcc'];
    $message = $postPar['message'];
    $error = [];
    if (empty($from) === true) {
        $error[] = 'From field is required.';
    }
    if (empty($to) === true) {
        $error[] = 'To field is required.';
    }
    if (count($error) === 0) {
        if (empty($subject) === true) {
            $subject = 'No Subject';
        }
        $to = str_replace(' ', '', $to);
        $to = str_replace(',', ';', $to);
        $to = explode(';', $to);
        $cc = str_replace(' ', '', $cc);
        $cc = str_replace(',', ';', $cc);
        if(empty($cc) === true) {
            $cc = [];
        } else {
            $cc = explode(';', $cc);
        }
        $bcc = str_replace(' ', '', $bcc);
        $bcc = str_replace(',', ';', $bcc);
        if(empty($bcc) === true) {
            $bcc = [];
        } else {
            $bcc = explode(';', $bcc);
        }
        doSendEmail($postPar, $subject, $to, $cc, $bcc);
    } else {
        $listSmtp = getAllSmtp();
        require 'view/newMail.php';
    }
}

function doSendEmail($postPar, $subject, $to, $cc, $bcc)
{
    $smtp = getSmtpById($postPar['from']);
    $transport = Swift_SmtpTransport::newInstance($smtp['host'], $smtp['port'], $smtp['security']);
    $transport->setUsername($smtp['username']);
    $transport->setPassword($smtp['password']);

    $message = Swift_Message::newInstance(null);

    $message->setTo($to);
    if (empty($cc) === false) {
        echo 'hai';
        $message->setCc($cc);
    }
    if (empty($bcc) === false) {
        $message->setBcc($bcc);
    }
    $message->setSubject($subject);
    $message->setBody($postPar['message']);
    $message->setFrom($smtp['username']);
    $length = $postPar['lengthData'];
    for ($i = 0; $i < $length; $i++) {
        $keyID = 'id-' . $i;
        $document = getDocumentById($postPar[$keyID]);
        $message->attach(new Swift_Attachment($document['file'], $document['name'], $document['type']));
    }
    $mailer = Swift_Mailer::newInstance($transport);
    $mailer->send($message, $response);
    require 'view/resultMail.php';
}
