<?php

namespace BPX;

use BPX\Utils\RPCClient;

class Harvester extends RPCClient {
    public function getPlots() {
        $resp = $this -> request('get_plots');
        unset($resp -> success);
        return $resp;
    }
    
    public function refreshPlots() {
        $this -> request('refresh_plots');
    }
    
    public function deletePlot(string $filename) {
        $this -> request('delete_plot', [
            'filename' => $filename
        ]);
    }
    
    public function addPlotDirectory(string $dirname) {
        $this -> request('add_plot_directory', [
            'dirname' => $dirname
        ]);
    }
    
    public function getPlotDirectories() {
        return $this -> request('get_plot_directories') -> directories;
    }
    
    public function removePlotDirectory(string $dirname) {
        $this -> request('remove_plot_directory', [
            'dirname' => $dirname
        ]);
    }
}

?>