<?php

/*include($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/Controller/ControllerTraitementIp.php');

$TraitementIp = TraitementIp($AdresseIp);

if($TraitementIp['datas']['country_code'] != 'FR')
{
    http_response_code(403);
    require($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/View/error403.html');
    exit;
}*/

function RequireBody($body, $dataArray)
{
    require($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/View/base.php');
}

?>