# bpx-beacon-php
Official PHP wrapper for the BPX Beacon Client RPC API

## Install
`composer require bpx-network/bpx-beacon-php`

## Requirements
- PHP >= 7.0
- cURL

## Usage
Check examples/ folder for more usage examples.
```php
<?php
require __DIR__ . '/vendor/autoload.php';
    
try {
    $beacon = new BPX\Beacon('localhost', 8201, 'C:\private_beacon.crt', 'C:\private_beacon.key');
    $farmer = new BPX\Farmer('localhost', 8204, 'C:\private_farmer.crt', 'C:\private_farmer.key');
    $harvester = new BPX\Harvester('localhost', 8205, 'C:\private_harvester.crt', 'C:\private_harvester.key');
    $crawler = new BPX\Crawler('localhost', 8206, 'C:\private_crawler.crt', 'C:\private_crawler.key');
        
    var_dump(
        $beacon -> getBlockchainState()
    );
    
    var_dump(
        $farmer -> getRewardTargets(true)
    );
		
    $harvester -> refreshPlots();
    
    var_dump(
        $crawler -> getPeerCounts()
    );
}
    
catch(BPX\Exceptions\ConnException $e) {
    echo "Connection error: " . $e->getMessage();
}
    
catch(BPX\Exceptions\BPXException $e) {
    echo "BPX error: " . $e->getMessage();
}    
?>
```