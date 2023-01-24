<?php

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\MailerInterface;

class EmailController{

    public function main()
    {
       
       //custom smtp
    //    $dsn="smtp://127.0.0.1:1025";
    $transport=Transport::fromDsn($_ENV['MAILER_DSN']);
       //ends custom smtp
       $mailer=new Mailer($transport);
        
       return $this->sendEmail($mailer);
        // return View::make('emailView');

       


    }

    public function sendEmail(MailerInterface $mailer){
       
        $email=(new Email())
            ->from('sales@app.com')
            ->to('mojjysolo1@gmail.com')
            ->subject('Your order has been placed')
            // ->attach('hello',$_SESSION['DOCUMENT_ROOT'].'/storage/assets/DB2.xlsx')
            ->text("Hello Josh, Jesus Loves you.")
            ->html("<b>Hello Josh, Jesus Loves you.</b>");

            $mailer->send($email);

            return ParseSuccess("email sent successfully");
    }


}