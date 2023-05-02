<?php
require '../vendor/autoload.php';

try {
    $crawler = new BPX\Crawler('localhost', 8206, 'C:\private_crawler.crt', 'C:\private_crawler.key');
    
    echo "GET PEER COUNTS --------------------------------------------------\n";
    var_dump(
        $crawler -> getPeerCounts()
    );
    
    echo "GET IPS AFTER TIMESTAMP ------------------------------------------\n";
    var_dump(
        $crawler -> getIPsAfterTimestamp(1640991600, 0, 10) // 2022-01-01 00:00:00
    );
}

catch(BPX\Exceptions\ConnException $e) {
    echo "CONNECTION ERROR: " . $e->getMessage() . "\r\n";
}

catch(BPX\Exceptions\BPXException $e) {
    echo "BPX ERROR: " . $e->getMessage() . "\r\n";
}

?>