<?php

class Email extends CModel {

    public $AddAddress = array();
    public $message;
    public $subject;
    
    public function create() {
        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
        $mailer->Mailer='smtp';
        $mailer->IsSMTP();
        $mailer->Host = "smtpout.asia.secureserver.net";
       // $mailer->Host = "relay-hosting.secureserver.net";
        $mailer->SMTPDebug = 0;
        $mailer->SMTPAuth = true;
        $mailer->SMTPSecure = "https";      
        $mailer->Username = "dato@christeran.com";        
        $mailer->Password = "Dato2014";
        $mailer->Port = "25";
        $mailer->From     = "dato@christeran.com";        
        $mailer->FromName = 'el dato.pe';
        $mailer->CharSet = 'UTF-8';
        $mailer->IsHTML (true);
        return $mailer; 
    }
    
    public function attributeNames() {
        
    }

    public function sendEmail() {
        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
        $mailer->Mailer='smtp';
        $mailer->IsSMTP();
        $mailer->Host = "hp137.hostpapa.com";
        $mailer->SMTPAuth = true;
        $mailer->SMTPSecure = "ssl";       
        $mailer->Username = "test@auscomm.com.au";        
        $mailer->Password = "Auscomm1";
        $mailer->Port = "465";
        $mailer->From     = "test@auscomm.com.au";        
        $mailer->FromName = 'El Dato';
        $mailer->AddCC($this->AddAddress);
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject = $this->subject;
        $mailer->IsHTML (true);
        $mailer->Body = $this->message;
        if (!$mailer->Send())
        {
            return "Error: $mailer->ErrorInfo";
        }
        else
        {
            return true;
        }
    }

}

