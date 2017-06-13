<?php

class Blark_Utiware_Model_Sms_Gateway extends Blark_Sms_Gateway_Abstract {
    
    const ENDPOINT_SEND     = 'http://98.102.204.231/smsapi/Send.aspx';
    const ENDPOINT_BALANCE  = 'http://98.102.204.231/smsapi/GetCreditBalance.aspx';


    protected $_username;
    protected $_password;
    
    public function __construct() {
        $config = $this->getStoreConfig();
        
        $this->_username = $config['username'];
        $this->_password = $config['password'];
    }
    
    private function _buildQuery($data){
        return http_build_query($data);
    }

    private function _request($data, $endpoint){
        $q      = $this->_buildQuery($data);
        $url    = parse_url($endpoint);
        
        if ($url['scheme'] != 'http') {
            die('Only HTTP request are supported !');
        }

        // extract host and path:
        $host = $url['host'];
        $path = $url['path'];
        

        // open a socket connection on port 80
        $fp = fsockopen($host, 80);

        // send the request headers:
        fputs($fp, "POST $path HTTP/1.1\r\n");
        fputs($fp, "Host: $host\r\n");
        fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
        fputs($fp, "Content-length: " . strlen($q) . "\r\n");
        fputs($fp, "Connection: close\r\n\r\n");
        fputs($fp, $q);

        $result = '';
        while (!feof($fp)) {
            // receive the results of the request
            $result .= fgets($fp, 128);
        }

        // close the socket connection:
        fclose($fp);
        
        return $result;
    }
    
    public function checkBalance() {
        $data = [
            'UN' => $this->_username,
            'p' => $this->_password
        ];
        
        $result = $this->_request($data, self::ENDPOINT_BALANCE);

        // split the result header from the content
        $resultParts = explode("\r\n\r\n", $result, 2);

        //$header = isset($resultParts[0]) ? $resultParts[0] : '';
        $content = isset($resultParts[1]) ? $resultParts[1] : '';

        $tok = strtok($content, " "); //Split the $content result into workds

        if ($tok == "OK") { //Success
            $tok = strtok(" ");
            return $tok;
        } else {
            //Diaply the full error message
            return "The following error occured: <br> " . $content . "<br>";
        }
    }

    public function send(Blark_Sms $sms) {
        $isLong = (strlen($sms->getBody()) > self::MAX_CHAR_LENGTH) ? 1 : 0;
        
        $recipients = $this->filterRecipients($sms->getRecipients(), $sms->getCountryCodes());
        
        $data = [
            'UN'    => $this->_username,
            'p'     => $this->_password,
            'SA'    => $sms->getSenderId(),
            'DA'    => $recipients,
            'L'     => $isLong,
            'M'     => $sms->getBody()
        ];

        
        $result = $this->_request($data, self::ENDPOINT_SEND);

        // split the result header from the content
        $resultParts = explode("\r\n\r\n", $result, 2);

        //$header = isset($resultParts[0]) ? $resultParts[0] : '';
        $content = isset($resultParts[1]) ? $resultParts[1] : '';
        
        
        // display the result of the request
        $tok = strtok($content, " "); //Split the $content result into workds

        if ($tok == "OK") { //Success
            $tok = strtok(" ");
            return $tok;
        } else {
            //Diaply the full error message
            return "The following error occured: <br> " . $content . "<br>";
        }
    }

    protected function filterRecipients(array $recipients, array $countryCodes) {
        //$code = '234';
        return implode(',', $this->processPhoneNumbers($recipients, $countryCodes));
    }

    protected function processPhoneNumbers($_numbers, $countryCodes) {
        $numbers = array();

        foreach ($_numbers as $index => $value) {
            $code = $this->getPhonePrefix($countryCodes[$index]);
            $chars = ['-','_','[',']','{','}','(',')','+','>','<'];
            $number = str_replace($chars, '', $value);

            if (substr($number, 0, 1) == "0" || 
                    substr($number, 0, strlen($code)) != $code){
                $number = $code . substr($number, 1, strlen($number));
            }

            $numbers[] = $number;
        }
        return $numbers;
    }
    
    protected function getStoreConfig(){
        return Mage::getStoreConfig('sms/utiware');
    }
}
