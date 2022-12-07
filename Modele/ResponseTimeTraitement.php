<?php

include($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/Controller/ControllerTraitementIp.php');
include($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/Controller/ControllerVue.php');

$dataArray = array();

$TraitementTime = TraitementTime($_POST['nbIpAdress']);

$dataArray['style'] = '../../';
$dataArray['time'] = $TraitementTime['time'];
$dataArray['moytime'] = $TraitementTime['moytime'];
$dataArray['seconds'] = $TraitementTime['seconds'];
$dataArray['TraitementTime'] = $TraitementTime['datas'];
$dataArray['message'] = $TraitementTime['message'];
$dataArray['warning'] = $TraitementTime['warning'];
$dataArray['error'] = $TraitementTime['error'];

RequireBody($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/View/informationTime.html', $dataArray);

?>