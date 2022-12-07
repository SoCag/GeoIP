<?php

include($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/Controller/ControllerTraitementIp.php');
include($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/Controller/ControllerVue.php');

$dataArray = array();

if(isset($_POST['ipAdress']) && ($_POST['ipAdress'] != '' || $_POST['ipAdress'] != null))
{
    $AdresseIp = $_POST['ipAdress'];
}
else
{
    $AdresseIp = $_SERVER['REMOTE_ADDR'];
}

$TraitementIp = TraitementIp($AdresseIp);

$dataArray['style'] = '../../';
$dataArray['AdresseIp'] = $AdresseIp;
$dataArray['TraitementIp'] = $TraitementIp['datas'];
$dataArray['message'] = $TraitementIp['message'];
$dataArray['warning'] = $TraitementIp['warning'];
$dataArray['error'] = $TraitementIp['error'];

RequireBody($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/View/informationIp.html', $dataArray);

?>