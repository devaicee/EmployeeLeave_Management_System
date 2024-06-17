<?php

    require('../vendor/autoload.php');
    
    class Mailer
    {
        private $transport;
        private $mailer;
        
        public function __construct()
        {
            $this->initMailer();
        }
        
        public function initMailer()
        {
            // Create the Transport
            $this->transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                ->setUsername('ekattortvltd@gmail.com')
                ->setPassword('EKATTORtv');
            
            // Create the Mailer using your created Transport
            $this->mailer = new Swift_Mailer($this->transport);
        }
        
        public function sendMessage($mailTo, $password)
        {
            // Create a message
            $message = (new Swift_Message('Recovered Password'))
                ->setFrom(['ekattortvltd@gmail.com' => 'test mail service'])
                ->setTo([$mailTo => 'Forget Password'])
                ->setBody('Here is your password: ' . $password);
            
            // Send the message
            $result = $this->mailer->send($message);
            
            if ($result) {
                echo "<br/> Password sent to <br/>" . $mailTo . ' Please check your email.';
            } else {
                echo "<br/> Message not sent<br/>";
            }
        }
    }
    
?>
