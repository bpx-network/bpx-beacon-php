<?php

namespace BPX;

use BPX\Utils\RPCClient;

class Beacon extends RPCClient {
    public function getBlockchainState() {
        return $this -> request('get_blockchain_state') -> blockchain_state;
    }
    
    public function getBlock(string $headerHash) {
        return $this -> request('get_block', [
            'header_hash' => $headerHash
        ]) -> block;
    }
    
    public function getBlocks(int $start, int $end, bool $excludeReorged = false) {                 
        return $this -> request('get_blocks', [
            'start' => $start,
            'end' => $end,
            'exclude_header_hash' => true,
            'exclude_reorged' => $excludeReorged
        ]) -> blocks;
    }
    
    public function getBlockRecordByHeight(int $height) {
        return $this -> request('get_block_record_by_height', [
            'height' => $height
        ]) -> block_record;
    }
    
    public function getBlockRecord(string $headerHash) {
        return $this -> request('get_block_record', [
            'header_hash' => $headerHash
        ]) -> block_record;
    }
    
    public function getBlockRecords(int $start, int $end) {
        return $this -> request('get_block_records', [
            'start' => $start,
            'end' => $end
        ]) -> block_records;
    }
    
    public function getUnfinishedBlockHeaders() {
        return $this -> request('get_unfinished_block_headers') -> headers;
    }
    
    public function getNetworkSpace(string $newerBlockHeaderHash, string $olderBlockHeaderHash) {
         return $this -> request('get_network_space', [
            'newer_block_header_hash' => $newerBlockHeaderHash,
            'older_block_header_hash' => $olderBlockHeaderHash
        ]) -> space;
    }
    
    public function getNetworkInfo() {
        $resp = $this -> request('get_network_info');
        unset($resp -> success);
        return $resp;
    }
    
    public function getRecentSignagePointOrEos(string $spHash = NULL, string $challengeHash = NULL) {
        $payload = [];
        if($spHash !== NULL) $payload['sp_hash'] = $spHash;
        if($challengeHash !== NULL) $payload['challenge_hash'] = $challengeHash;                  
        $resp = $this -> request('get_recent_signage_point_or_eos', $payload);
        unset($resp -> success);
        return $resp;
    }
    
    public function getCoinbase() {
        return $this -> request('get_coinbase') -> coinbase;
    }
    
    public function setCoinbase(string $coinbase) {
        $this -> request('set_coinbase', [
            'coinbase' => $coinbase
        ]);
    }
}

?>