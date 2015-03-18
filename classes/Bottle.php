<?php

/*
 * Stikla pudele kurā tiks liets alus
 * @author Mārtiņš Grigors
 */
class Bottle 
{
    public $weight = 0.2;           // Pudeles svars Kilogramos
    public $isFilled = false;       // Vai pudele ir piepildita
    private $bottleContents = null; // Dzēriens kas ieliets pudelē
    
    function __construct($newContents = null)
    {
        if(!is_null($newContents)){
            $this->fillBottle($newContents);
        }
    }
    
    /*
     * Piepildam pudeli ar norādītu saturu ja tās atļauts
     */
    public function fillBottle($newContents)
    {
        foreach(config::$allowedBestBottleContents as $bestContent){
            if($bestContent === $newContents){
                $this->bottleContents = $newContents;
                $this->isFilled = true;
                $this->weight = config::$bestBottleWieght; // Labu alu ir vieglāk nest
                return true;
            }
        }
        
        foreach(config::$allowedBottleContents as $allowedContent){
            if($allowedContent === $newContents){
                $this->bottleContents = $newContents;
                $this->isFilled = true;
                $this->weight = config::$fullBottleWieght;
                return true;
            }
        }
        
        throw new Exception("Alu ar nosaukumu: $newContents mēs neražojam!");
    }
    
    public function getContents()
    {
        return $this->bottleContents;
    }
}
