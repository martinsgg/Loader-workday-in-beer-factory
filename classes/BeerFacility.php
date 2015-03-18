<?php

require_once('Bottle.php');

/*
 * Alus rūpnīca, kas pēc pasūtijuma sagatavo ar alu pildītas pudeles.
 * @author Mārtiņš Grigors
 */
class BeerFacility 
{
    public $producedBottles = array();

    function __construct($contracts)
    {
        foreach($contracts as $contract){
            for($a = 0; $a < $contract->bottleCount; $a++){
                array_push($this->producedBottles, new Bottle($contract->beerName));
            }
        }
    }
    
    /*
     * Noskaidrojam vai visi darbinieki ir noguruši
     */
    private function areLoadersTired($loaders)
    {
        $tiredLoaderCount = 0;
        foreach($loaders as $loader){
            if($loader->stamina < 0){
                $tiredLoaderCount++;
            }
        }
        
        if($tiredLoaderCount === sizeof($loaders)){
            echo 'Visi krāvēji ir noguruši!</br>';
            return true;
        }
        
        return false;
    }
    
    /*
     * Alus pudeles tiek nestas uz noliktavu tik ilgi līdz darbinieki ir
     * vai nu noguriši vai aiznesuši visas pudeles
     * rezultātā mēs uzzinam cik pudeles ir aiznestas uz noliktavu
     */
    public function moveProducedBottlesToStorage($loaders)
    {
        $bottlesInStorage = array();
        
        while($this->areLoadersTired($loaders) === false && 
                sizeof($this->producedBottles) > 0){
            //Pēc nejaušibas pricipa izvēlamies darbinieku
            $loaderNumber = rand(0, sizeof($loaders) - 1);
            if($loaders[$loaderNumber]->carryBottle($this->producedBottles[sizeof($this->producedBottles) - 1])){
                echo 'Darbinieks: ' . $loaders[$loaderNumber]->name . ' uz noliktavu aiznesa ' . $this->producedBottles[sizeof($this->producedBottles) - 1]->getContents() . '</br>';
                array_push($bottlesInStorage, $this->producedBottles[sizeof($this->producedBottles) - 1]);
                unset($this->producedBottles[sizeof($this->producedBottles) - 1]);
            } else {
                echo 'Darbinieks: ' . $loaders[$loaderNumber]->name . ' ir noguris</br>';
            }
        }
        
        return $bottlesInStorage;
    }
    
    public function getFacilityReport()
    {
        $beerBottleReport = [];
        foreach(config::$allAllowedBeer as $AllowedBeer){
            $beerBottleReport[$AllowedBeer] = 0;
        }
        
        foreach($this->producedBottles as $beerBottle){
            $beerBottleReport[$beerBottle->getContents()]++;
        }
        
        return $beerBottleReport;
    }
    
    public function getStorageReport($bottlesInStorage)
    {
        $beerBottleReport = [];
        foreach(config::$allAllowedBeer as $AllowedBeer){
            $beerBottleReport[$AllowedBeer] = 0;
        }
        
        foreach($bottlesInStorage as $beerBottle){
            $beerBottleReport[$beerBottle->getContents()]++;
        }
        
        return $beerBottleReport;
    }
}
