<?php
require '../vendor/autoload.php';

try {
    $harvester = new BPX\Harvester('localhost', 8205, 'C:\private_harvester.crt', 'C:\private_harvester.key');
    
    echo "GET PLOTS --------------------------------------------------------\n";
    var_dump(
        $harvester -> getPlots()
    );
    
    echo "REFRESH PLOTS ----------------------------------------------------\n";
    var_dump(
        $harvester -> refreshPlots()
    );
    
    echo "GET PLOT DIRECTORIES ---------------------------------------------\n";
    var_dump(
        $harvester -> getPlotDirectories()
    );
}

catch(BPX\Exceptions\ConnException $e) {
    echo "CONNECTION ERROR: " . $e->getMessage() . "\r\n";
}

catch(BPX\Exceptions\BPXException $e) {
    echo "BPX ERROR: " . $e->getMessage() . "\r\n";
}

?>