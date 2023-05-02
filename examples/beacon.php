<?php
require '../vendor/autoload.php';

try {
    $beacon = new BPX\Beacon('localhost', 8201, 'C:\private_beacon.crt', 'C:\private_beacon.key');
    
    echo "GET NETWORK INFO -------------------------------------------------\n";
    var_dump(
        $beacon -> getNetworkInfo()
    );
    
    echo "GET BLOCKCHAIN STATE ---------------------------------------------\n";
    var_dump(
        $beacon -> getBlockchainState()
    );
}

catch(BPX\Exceptions\ConnException $e) {
    echo "CONNECTION ERROR: " . $e->getMessage() . "\r\n";
}

catch(BPX\Exceptions\BPXException $e) {
    echo "BPX ERROR: " . $e->getMessage() . "\r\n";
}

?>