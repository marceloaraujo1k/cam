<?php
session_start();

echo $_SESSION['email2'];

echo $_SESSION['pdff'];
require("vendor/autoload.php");




use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

//$dados_form = filter_input_array(INPUT_POST, FILTER_DEFAULT);



    //670 885


    $mail = new PHPMailer();
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ];

    $mail->isSMTP();
    /**
     * Debug
     */
     //$mail->SMTPDebug = 3;

    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'danilobraz96@gmail.com';
    $mail->Password = 'Dar1!ni2@tloy3#3';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    /**
     * Quem esta enviando
     */
    $mail->setFrom("danilobraz96@gmail.com", "Danilo");/*opcional*/
    /**
     * Quem irá receber
     */
    $mail->addAddress($_SESSION['email2'], 'Enviado do Site cam');
    /**
     * REsponder para
     */
    $mail->addReplyTo($_SESSION['email2'], 'danilo');

    /**
     * Anexos
     */
    //$mail->addAttachment('assets/img/php.jpg'); 
    $mail->addAttachment('assets/img/'.$_SESSION['pdff'].'.pdf'); 
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // nome opcional para o anexo

    /**
     * formato do email (texto ou html)
     */
    $mail->isHTML(true);
    /**
     * Assunto do email
     */
    $mail->Subject = 'Relatorio para o medico: x';
    /**
     * Mensagem no corpo do email
     */
    $mail->Body = "teste";
    $mail->send();
    


