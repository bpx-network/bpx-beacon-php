<?php

namespace BPX;

use BPX\Utils\RPCClient;

class Farmer extends RPCClient {
    public function getSignagePoint(string $spHash) {
        $resp = $this -> request('get_signage_point', [
            'sp_hash' => $spHash
        ]);
        unset($resp -> success);
        return $resp;
    }
    
    public function getSignagePoints() {
        return $this -> request('get_signage_points') -> signage_points;
    }
    
    public function getHarvesters() {
        return $this -> request('get_harvesters') -> harvesters;
    }
    
    public function getHarvestersSummary() {
        return $this -> request('get_harvesters_summary') -> harvesters;
    }
}

?>