<?php

class Blark_Sms_Model_Message{
    
    protected $recipients = array();
    
    protected $body;
    
    protected $senderId;
    
    public function setRecipients(array $recipients){
        $this->recipients = $recipients;
        return $this;
    }
    
    public function getRecipients(){
        return $this->recipients;
    }
    
    public function addRecipient($number, $code='NG'){
        $this->recipients[$number] = $code;
        return $this;
    }


    public function setBody($value){
        $this->body = $value;
        return $this;
    }
    
    public function getBody(){
        return $this->body;
    }
    
    public function setSenderId($value){
        $this->senderId = $value;
        return $this;
    }
    
    public function getSenderId(){
        return $this->senderId;
    }
    
}
