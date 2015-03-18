<?php

/**
 * Rūpnīcai uzdotais uzdevums
 * @author Mārtiņš Grigors
 */
class BussinessRequriment 
{
    public $bottleCount = 0;  // Cik pudeles ar konkrēto dzērienu jāsaražo
    public $beerName = null;  // Dzēriena nosaukums
    
    function __construct($nBeerName, $nBottleCount)
    {
        $this->bottleCount = $nBottleCount;
        $this->beerName = $nBeerName;
    }
}
