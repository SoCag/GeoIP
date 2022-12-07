<?php

function Connexion()
{
    $json = file_get_contents($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/app.settings.json');
    $obj = json_decode($json);

    try
    {
        $dbh = new PDO('mysql:host='.$obj->Host.';dbname='.$obj->Dbname.';', $obj->User, $obj->Pass, array(PDO::MYSQL_ATTR_LOCAL_INFILE => true));
    }
    catch (Exception $e)
    {
        exit("Erreur : Connexion à la base échouée.");
    }

    return $dbh;
}
?>