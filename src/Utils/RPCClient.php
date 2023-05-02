<?php

namespace BPX\Utils;

use BPX\Exceptions\ConnException;
use BPX\Exceptions\BPXException;

class RPCClient {
    protected $ch;
    protected $baseUrl;
    
    public function __construct(string $host, int $port, string $cert, string $key) {
        $this -> ch = curl_init();
        curl_setopt($this -> ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this -> ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this -> ch, CURLOPT_SSLCERT, $cert);
        curl_setopt($this -> ch, CURLOPT_SSLKEY, $key);
        curl_setopt($this -> ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($this -> ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($this -> ch, CURLOPT_RETURNTRANSFER, true);
        $this -> baseUrl = 'https://'.$host.':'.$port.'/';
    }
    
    public function __destruct() {
        curl_close($this -> ch);
    }
    
    protected function request(string $method, array $payload = []) {
        curl_setopt($this -> ch, CURLOPT_URL, $this -> baseUrl . $method);
        $encodedPayload = '{}';
        if(!empty($payload))
            $encodedPayload = json_encode($payload, JSON_NUMERIC_CHECK);
        curl_setopt($this -> ch, CURLOPT_POSTFIELDS, $encodedPayload);
        $result = curl_exec($this -> ch);
        if($result === false)
            throw new ConnException(curl_error($this -> ch));
        $httpRespCode = curl_getinfo($this -> ch, CURLINFO_RESPONSE_CODE);
        if($httpRespCode != 200)
            throw new ConnException("Unexpected HTTP code: $httpRespCode");
        $resultObj = json_decode($result, false, 512, JSON_BIGINT_AS_STRING);
        if($resultObj == null)
            throw new ConnException('Not a valid JSON response');
        if($resultObj -> success == false)
            throw new BPXException($resultObj -> error);
        return $resultObj;
    } 
}

?>