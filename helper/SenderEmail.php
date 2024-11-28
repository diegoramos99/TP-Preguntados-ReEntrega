<?php

class SenderEmail
{

    public function sendEmail($to, $subject, $message)
    {
        mail($to, $subject, $message);
    }

    public function sendActivationEmail($userId, $email, $token)
    {
        // $activationLink = "http://localhost/app/index.php?usuario/validar?id=$userId&token=$token";
        $activationLink = "http://localhost/app/index.php?usuario/validar&id=$userId&token=$token";

        // $activationLink = "http://localhost/usuario/validar?id=$userId&token=$token";
        $message = "Hola, haz clic en el siguiente enlace para activar tu cuenta: <a href='$activationLink'>Activar cuenta</a>";
        $this->sendEmail($email, "Activación de cuenta", $message);
    }

}