<?php

namespace BPX;

use BPX\Utils\RPCClient;

class Crawler extends RPCClient {    
    public function getPeerCounts() {
        return $this -> request('get_peer_counts') -> peer_counts;
    }
    
    public function getIPsAfterTimestamp(int $after, int $offset = NULL, int $limit = NULL) {
        $payload = [];
        if($offset !== NULL) $payload['offset'] = $offset;
        if($limit !== NULL) $payload['limit'] = $limit;                   
        $resp = $this -> request('get_ips_after_timestamp', $payload);
        unset($resp -> success);
        return $resp;
    }
}

?>