<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {

        //crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->SMTPSecure = 'tls';

        $mail->setFrom($_ENV['EMAIL_FROM']);
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu cuenta';

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong> Hola " . $this->nombre .  "</strong> Has creado tu cuenta en App Salon, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='" . $_ENV['APP_URL'] ."/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a> </p>";
        $contenido .= "<p> Si tu no solicitaste esta cuenta, puedes ignorar el mensaje </p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        //enviar el email

        $mail->send();
    }

        public function enviarInstruccion()
    {

        //crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->SMTPSecure = 'tls';

        $mail->setFrom($_ENV['EMAIL_FROM']);
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Restablece Tu Password';

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p><strong> Hola " . $this->nombre .  "</strong> ¿Has olvidado el password de tu cuenta en App Salon? , si es asi , solo debes presionar el siguiente enlace para restablecer el Password.</p>";
        $contenido .= "<p>Presiona aqui: <a href='" . $_ENV['APP_URL'] ."/recuperar?token=" . $this->token . "'>Restablecer Password</a> </p>";
        $contenido .= "<p> Si tu no solicitaste este cambio, puedes ignorar el mensaje </p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        //enviar el email

        $mail->send();
    }
}
