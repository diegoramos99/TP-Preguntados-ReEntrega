<?php

class SenderEmailFile
{

    private $filePath = 'emails.txt';

    public function sendEmail($to, $subject, $message)
    {
        $emailData = "Para: $to\nAsunto: $subject\nMensaje: $message\n\n";
        file_put_contents($this->filePath, $emailData, FILE_APPEND);
    }

}