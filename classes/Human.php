<?php

/*
 * @author Mārtiņš Grigors
 */
abstract class Human
{
    public $name;            // Cilvēka vārds
    public $age;             // Vecums
    public $happiness = 0;   // Darbinieka apmierinātība 0 - 100%
    private $params = array();
    
    function __construct($nName, $nAge, $nParams = null)
    {
        $this->name = $nName;
        $this->age = $nAge;
        $this->happiness = rand(0, 100);
        
        if(is_null($nParams)){
            $this->params = $nParams;
        }
        
        $this->atCretion();
        $this->calculateStamina();
    }
}
