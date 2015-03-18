<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Krāvēju darbadienas simulācija</title>
        <meta name="author" content="Mārtiņš Grigors"/>
    </head>
    <body>
        <?php

        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        require_once('config.php');
        require_once('classes/Loader.php');
        require_once('classes/AngryLoader.php');
        require_once('classes/BussinessRequriment.php');
        require_once('classes/BeerFacility.php');
        
        function printFormatedBeerReport($bottleReport){
            $beerNames = array_keys($bottleReport);
            foreach($beerNames as $beerName){
                echo "Alus nosaukums: $beerName" . ' skaits: ' . $bottleReport[$beerName] . ' gab</br>';
            }
        }

        //Alus rūpnīcā strādājošie darbinieki
        $loaders = [
            0 => new Loader('Jānis', 25, ['expirience' => 20]),
            1 => new Loader('Ivars', 30),
            2 => new Loader('Māris', 57, ['expirience' => 85]),
            3 => new AngryLoader('Pēteris', 30, ['expirience' => 18]),
        ];

        /*
         * Alus rūpnīcas biznesa prasību(Līgumu) paraugi
        $contracts = [
            new BussinessRequriment('Cēsu Porteris', 8),
            new BussinessRequriment('Mītava', 2),
            new BussinessRequriment('Beershake', 7),
        ];*/
        
        // Te es līgumus ģenerēju pēc nejaušibas principa
        $contractCount = 8; 
        $contracts = [];
        echo '------------------------Līgumi-----------------------</br>';
        for($i = 0; $i < $contractCount; $i++){
            $beerName = config::$allAllowedBeer[rand(0, sizeof(config::$allAllowedBeer) - 1)];
            $bottleCount = rand(5,20);
            $contracts[$i] = new BussinessRequriment($beerName, $bottleCount);
            $contractNum = $i+1;
            echo "Līgums Nr.$contractNum Jāsaražo $bottleCount pudeles ar $beerName alu</br>";
        }
        
        echo '--------------------Darba pārskats-------------------</br>';

        $beerFacility = new BeerFacility($contracts);
        $beersInStorage = $beerFacility->moveProducedBottlesToStorage($loaders);
        echo '-------------------Rūpnīcā palikuši------------------</br>';
        printFormatedBeerReport($beerFacility->getFacilityReport());
        echo '-------------------Noliktavā atrodas-----------------</br>';
        printFormatedBeerReport($beerFacility->getStorageReport($beersInStorage));

        ?>
    </body>
</html>

