<?php

include($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/Controller/ControllerTraitementIp.php');
include($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/Controller/ControllerVue.php');

$dataArray = array();

$TraitementData = TraitementData();

$dataArray['style'] = '../../';
$dataArray['message'] = $TraitementData['message'];
$dataArray['warning'] = $TraitementData['warning'];
$dataArray['error'] = $TraitementData['error'];

RequireBody($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/View/informationData.html', $dataArray);

?>