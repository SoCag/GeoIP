<?php

include($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/Controller/ControllerVue.php');

$dataArray = array();

RequireBody($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/View/chooseIndex.html', $dataArray);

?>