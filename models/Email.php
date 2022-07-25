<?php

namespace Model;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email{
    //------------------------------- ATRIBUTOS -------------------------------
    public $email;
    public $nombre;
    public $token;

    //------------------------------- FUNCIONES -------------------------------
    public function __construct($email, $nombre, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function Enviar_Confirmacion(){
        try {
            $mail = new PHPMailer();
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->Mailer = "smtp";
            $mail->isSMTP();
            $mail->Host = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['MAIL_USER'];
            $mail->Password = $_ENV['MAIL_PASSWORD'];
            $mail->SMTPSecure = 'tls'; //Encriptado, seguro
            $mail->Port = $_ENV['MAIL_PORT'];

            $mail->setFrom($_ENV['MAIL_USER']);
            $mail->addAddress($this->email);//$this->email
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Confirmar cuenta';

            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8';
            $mail->Body = "
            <html>
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
            </style>
            <body
                style='max-width:400px; margin:0 auto; font-family: Inter, sans-serif; padding: 20px; height: auto; word-wrap: break-word;'>
                <h1 style='text-align: center; color: #4338CA; font-size: calc(3.5em + 1vh); margin: 2rem 0;'>UpTask</h1>
                <h2 font-size='25px' font-weight='500' line-height='25px' style='color: #4338CA;'>¡Gracias por registrarte!</h2>
                <p style='line-height:18px; font-size: calc(.5em + 1vh);'>Por favor confirma tu correo electrónico para que puedas comenzar a disfrutar de UpTask</p>
                <a style='position: relative; z-index: 0; display: inline-block; margin: 0;' href='http://localhost:4000/confirmar_cuenta?token=" . $this->token . "'>
                    <button style='padding: 10px 20px; font-size: 16px; font-weight: 500; background-color: #4338CA; color: #ffffff; border: none; text-transform: uppercase; cursor: pointer;'>Verificar</button>
                </a>
                <p style='line-height:18px; font-size: calc(.5em + 1vh);'>Si tú no te registraste en UpTask, por favor ignora este correo electrónico.</p>
                <div>
                    <p style='border-bottom: 1px solid #4338CA; border-top: none; margin-top: 25px;'></p>
                </div>
                <p style='line-height:18px; font-size: calc(.5em + 1vh);'>
                    <span font-size='12px'>Este correo electrónico fue enviado desde una dirección solamente de notificaciones que no puede aceptar correo electrónico entrante. Por favor no respondas a este mensaje.</span>
                </p>
            </body>
            </html>";

            $mail->send();

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function Enviar_Instrucciones(){
        $mail = new PHPMailer();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Mailer = "smtp";
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_USER'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = 'tls'; //Encriptado, seguro
        $mail->Port = $_ENV['MAIL_PORT'];

        $mail->setFrom($_ENV['MAIL_USER']);
        $mail->addAddress($this->email);//$this->email
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Reestablece tu cuenta';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';
        $mail->Body = "
        <html>
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap');
        </style>
        <body style='width:400px; max-width:400px; margin:0 auto; font-family:Poppins,sans-serif; padding: 20px'>
            <h1 style='text-align: center; color: #4338CA; font-size: calc(3.5em + 1vh); margin: 2rem 0;''>UpTask</h1>
            <h2 font-size='25px' font-weight='500' line-height='25px' style='color: #4338CA;''>¡Hola, ". $this->nombre ."!</h2>
            <p style='line-height:18px; font-size: calc(.5em + 1vh);'>Recientemente has solicitado restablecer tu contraseña, por favor sigue el proceso como se te indica. En caso de que no hayas sido tu quien solicito reestablecer, por favor haz caso omiso a este mensaje</p>
            <a style='position: relative; z-index: 0; display: inline-block; margin: 0;' href='http://localhost:4000/crear_password?token=" . $this->token . "'>
                <button style='padding: 10px 20px; font-size: 16px; font-weight: 500; background-color: #4338CA; color: #ffffff; border: none; text-transform: uppercase; cursor: pointer;'>Cambiar contraseña</button>
            </a>
            <p style='line-height:18px; font-size: calc(.5em + 1vh);'>Si el boton de cambiar contraseña no funciona por favor copia y pega el siguiente enlace en tu navegador http://localhost:4000/crear_password?token=" . $this->token . "</p>
            <div>
                <p style='border-bottom: 1px solid #4338CA; border-top: none; margin-top: 25px;'></p>
            </div>
            <p style='line-height:18px; font-size: calc(.5em + 1vh);'>
                <span font-size='12px'>Este correo electrónico fue enviado desde una dirección solamente de notificaciones que no puede aceptar correo electrónico entrante. Por favor no respondas a este mensaje.</span>
            </p>
        </body>
        </html>";

        $mail->send();
    }
}
