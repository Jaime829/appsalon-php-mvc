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
        $mail->SMTPSecure = 'ssl'; // Con puerto 465 SIEMPRE usa 'ssl'

        $mail->setFrom($_ENV['EMAIL_FROM']);
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu cuenta';

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "
        <div style='background-color: #f6f9fc; padding: 20px; font-family: Arial, sans-serif;'>
        <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);'>
            <div style='background-color: #007bff; color: #ffffff; padding: 20px; text-align: center;'>
                <h1 style='margin: 0; font-size: 24px;'>App Salon</h1>
            </div>
            
            <div style='padding: 30px; line-height: 1.6; color: #333333;'>
                <p style='font-size: 18px;'><strong>Hola " . $this->nombre . "</strong>,</p>
                <p>Gracias por registrarte. Para activar tu cuenta y empezar a agendar tus citas, por favor confirma tu correo haciendo clic en el siguiente botón:</p>
                
                <div style='text-align: center; margin: 30px 0;'>
                    <a href='" . $_ENV['APP_URL'] . "/confirmar-cuenta?token=" . $this->token . "' 
                       style='background-color: #007bff; color: #ffffff; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;'>
                       Confirmar mi Cuenta
                    </a>
                </div>
                
                <p style='font-size: 12px; color: #777777;'>Si el botón no funciona, copia y paste este enlace en tu navegador:<br>
                " . $_ENV['APP_URL'] . "/confirmar-cuenta?token=" . $this->token . "</p>
            </div>
            
            <div style='background-color: #f1f1f1; color: #888888; padding: 15px; text-align: center; font-size: 12px;'>
                <p>&copy; 2026 App Salon. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
    ";
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



        $mail->SMTPSecure = 'ssl';

        $mail->setFrom($_ENV['EMAIL_FROM']);
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Restablece Tu Password';

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "
        <div style='background-color: #f6f9fc; padding: 20px; font-family: Arial, sans-serif;'>
        <div style='max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);'>
            <div style='background-color: #007bff; color: #ffffff; padding: 20px; text-align: center;'>
                <h1 style='margin: 0; font-size: 24px;'>App Salon</h1>
            </div>
            
            <div style='padding: 30px; line-height: 1.6; color: #333333;'>
                <p style='font-size: 18px;'><strong>Hola " . $this->nombre . "</strong>,</p>
                <p>¿Has olvidado el password de tu cuenta en App Salon? , si es asi, solo debes presionar el siguiente boton para restablecer el Password:</p>
                
                <div style='text-align: center; margin: 30px 0;'>
                    <a href='" . $_ENV['APP_URL'] . "/recuperar?token=" . $this->token . "' 
                       style='background-color: #007bff; color: #ffffff; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;'>
                       Restablecer Contraseña
                    </a>
                </div>
                
                <p style='font-size: 12px; color: #777777;'>Si el botón no funciona, copia y paste este enlace en tu navegador:<br>
                " . $_ENV['APP_URL'] . "/recuperar?token=" . $this->token . "</p>

                <p  style='font-size: 12px; color: #777777;'>Si no solicitaste este cambio puedes ignorar el mensaje</p>
            </div>
            
            <div style='background-color: #f1f1f1; color: #888888; padding: 15px; text-align: center; font-size: 12px;'>
                <p>&copy; 2026 App Salon. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
    ";
        $mail->Body = $contenido;

        //enviar el email

        $mail->send();
    }
}
