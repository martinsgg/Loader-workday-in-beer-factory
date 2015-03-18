<?php

require_once('Loader.php');
require_once('canBeHappyWorker.php');

/*
 * Dusmīgs krāvējs kas strādā Alus rūpnīcā
 * @author Mārtiņš Grigors
 */
class AngryLoader extends Loader implements canBeHappyWorker{
    
    public function atCretion() 
    {
        // Dusmīgs krāvejs nevar būt priecīgs līdz ar to izturības bonusus nesaņem
    }
}
