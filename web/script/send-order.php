<?php
session_start();
//pridat_do_kosiku
foreach (glob("../model/*.php") as $filename)
{
    include $filename;
}
try{
    \core\core::$configFile = require_once '../config.php';
    $kosikClass = new database\kosik();
        if (is_array($_POST['jidlo_id'])){
            foreach ($_POST['jidlo_id'] as $key => $value){
                $kosikClass->addInKosik($value, 1);
            }
        } else {
            @$pocet = $_POST['quntity-1'];
            $jidlo_id = $_POST['jidlo_id'];
            $result = $kosikClass->addInKosik($jidlo_id, $pocet);
        }
        $newPocet = $kosikClass->getPocet();
        $newCena = $kosikClass->getCena();
        echo json_encode(array("stav" => "true", "cena" => $newCena, 'pocet' => $newPocet));
}  catch (Exception $e) {
    echo json_encode(array("stav" => "false", "chyba" => $e->getMessage()));
}
?>
