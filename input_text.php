<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Some input html</title>
</head>
<body>
<form action="input_text.php" method="post">
    <label>
        <input type="text" name="author" placeholder="Введите Автора">
    </label>
    <p>
        <textarea name="text"></textarea>
    </p>
    <p>
        <input type="text" placeholder="Введите email" name="email">
    </p>
    <div>
        <button class="button-11" type="submit" role="button">Отправить</button>
    </div>
</form>
</body>
</html>
<?php
include_once "autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);
if(isset($_POST['author']) && isset($_POST['text'])) {
    $object = new TelegraphText();
    $object->author = $_POST["author"] ;
    $object->text = $_POST["text"];
    echo $object->author . PHP_EOL;
    echo $object->text . PHP_EOL;
    $storage = new FileStorage() ;
    $storage->create($object->author . " " . $object->text);
    if(isset($_POST['email'])){
        try {
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPDebug = 0;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->Host = 'ssl://smtp.gmail.com';
            $mail->Port = 465;
            $mail->Username = 'gtedbest@gmail.com';
            $mail->Password = '';

// От кого
            $mail->setFrom('gtedbest@gmail.com', 'George');

// Кому
            $mail->addAddress($_POST['email'], $_POST['author']);

// Тема письма
            $sub="Как ты малышка?";
            $mail->Subject = $sub;

// Тело письма
            $body = '<p><strong>«Hello, world!» </strong></p>';
            $mail->msgHTML($body);

// Приложение
            $mail->addAttachment('C:\xampp\htdocs\prog\index_11.09.22_0.txt');

            $mail->send();?>
            <div class="send"><?echo 'Message has been sent';?></div>
<?php
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
