<?php

require_once('Human.php');
require_once('canBeHappyWorker.php');

/*
 * Krāvējs kas strādā Alus rūpnīcā
 * @author Mārtiņš Grigors
 */
class Loader extends Human implements canBeHappyWorker{
    public $expirience = 0;       //Pieredze strādājot par krāvēju 0 - 100
    public $stamina = 100;        //Atlikušais spēks, lai nestu pudeles
    
    public function atCretion() 
    {
        //Darbinieka izturība ir atkarīga no tā cik viņš ir priecīgs
        $this->stamina = $this->stamina + 0.3 * ($this->happiness - 50);
    }
    
    /*
     * Ja darbiniekam pietiek spēka, lai aiznestu pudeli tad atgriežam true
    */
    public function carryBottle(Bottle $bottle)
    {
        $this->stamina -= $bottle->weight * 5;
        if($this->stamina < 0){
            return false;
        } else {
            return true;
        }
    }

    public function calculateStamina() 
    {
        //Pieredzējis darbinieks var pudeles kraut ilgāk
        $this->stamina = $this->stamina + 0.2 * $this->expirience;
        
        //Darbinieka izturība ir ārī atkarīga no viņa vecuma
        if($this->age < 20){
            $this->stamina = $this->stamina * 1.5;
        } else {
            if($this->age > 19 && $this->age < 40){
                $this->stamina = $this->stamina * 2.2;
            } else {
                if($this->age > 39){
                    $this->stamina = $this->stamina * 1.8;
                }
                if($this->age > 49){
                    $this->stamina = $this->stamina - (pow($this->age - 50, 2)) * 0.4;
                    if($this->stamina < 0){
                        $this->stamina = 1;
                    }
                }
            }
        }
        
        if(isset($this->params['expirience'])){
            $this->expirience = $this->params['expirience'];
        }
    }

}
