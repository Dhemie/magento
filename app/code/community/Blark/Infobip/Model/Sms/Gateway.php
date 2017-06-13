<?php

class Blark_Infobip_Model_Sms_Gateway extends Blark_Sms_Gateway_Abstract {

    const ENDPOINT_BALANACE     = 'https://api.infobip.com/account/1/balance';
    const ENDPOINT_SEND         = 'https://api.infobip.com/sms/1/text/single';
    
    protected $_httpClient;
    
    protected $_username;
    
    protected $_password;
    
    protected $_response;
    
    public function __construct() {
        $config = $this->getStoreConfig();
        
        $this->_username = $config['username'];
        $this->_password = $config['password'];
    }

    public function checkBalance() {
        $httpClient = new Zend_Http_Client(self::ENDPOINT_BALANACE, array(
            'maxredirects' => 0,
            'timeout' => 30));
        
        $httpClient->setAuth(
                $this->_username, 
                $this->_password, 
                Zend_Http_Client::AUTH_BASIC);

        $httpClient->setHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ]);

        $response = $httpClient->request('GET');
        
        $result = Zend_Json::decode($response->getBody());
        
        return $result['currency'] . $result['balance'];
    }
    
    private function _request($data, $endpoint){
        $httpClient = new Zend_Http_Client($endpoint, array(
            'maxredirects' => 0,
            'timeout' => 30));
        
        

        $httpClient->setAuth(
                $this->_username, 
                $this->_password, 
                Zend_Http_Client::AUTH_BASIC);

        $httpClient->setHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ]);
        
        
        
        $httpClient->setRawData(Zend_Json::encode($data));
        
        try{
            $response = $httpClient->request('POST');
            if($response->isSuccessful()){
                return $response->getBody();
            }
        } catch (Zend_Http_Client_Exception $ex) {
            Mage::logException($ex);
        }
    }

    public function send(Blark_Sms $sms) {
        $recipients = $this->filterRecipients($sms->getRecipients(), $sms->getCountryCodes());

        $data = [
            'from'  => $sms->getSenderId(),
            'to'    => explode(',', $recipients), //converted to array because of infobip api specs
            'text'  => $sms->getBody()
        ];
            
        return $this->_request($data, self::ENDPOINT_SEND);
    }

    /**
     * Process and filter recipient numbers
     * 
     * @param array $recipients
     * @return array
     */
    protected function filterRecipients(array $recipients, array $countryCodes) {
        $procssedRecipients = $this->processPhoneNumbers($recipients,$countryCodes);
        return  implode(',', $procssedRecipients);
        
    }
    
    protected function processPhoneNumbers($numbers,$countryCodes) {
        $newnumbers = array();

        foreach ($numbers as $key => $value) {
            $code = $this->getPhonePrefix($countryCodes[$key]);
            $chars = ['-','_','[',']','{','}','(',')','+','>','<'];
            $value = str_replace($chars, '', $value);

            if (substr($value, 0, 1) == "0" || 
                    substr($value, 0, strlen($code)) != $code){
                $value = $code . substr($value, 1, strlen($value));
            }

            $newnumbers[] = $value;
        }
        return $newnumbers;
    }
    
    public function getResponseBody(){
        return $this->_response;
    }

    protected function _getHttpClient(){
        return $this->_httpClient;
    }
    
    protected function getStoreConfig(){
        return Mage::getStoreConfig('sms/infobip');
    }
}