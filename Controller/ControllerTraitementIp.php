<?php

include($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/Controller/ControllerConnexion.php');

function TraitementIp($AdresseIp)
{
    $ResRequete = array();
    $error = '';
    $warning = '';
    $message = '';

    $dbh = Connexion();
    
    $starttime = microtime(true);

    $Ip = TraiteIp($AdresseIp);
   
    $sql = "SELECT country_code, country_name, region_name, city_name, latitude, longitude FROM geoip WHERE ip_from <= ".$Ip." AND ip_to >= ".$Ip;
    $query = $dbh->query($sql);
    $infos = $query->fetch();

    $endtime = microtime(true);
    $seconds = $endtime - $starttime;

    $time = TimeToSeconds($seconds);

    if(empty($infos))
    {
        $error .= 'Erreur lors de la récupération des informations.<br>';
    }
    else
    {
        if($infos['country_code'] == '-' && $infos['country_name'] == '-' && $infos['region_name'] == '-' && $infos['city_name'] == '-' && $infos['latitude'] == '0' && $infos['longitude'] == '0')
        {
            $warning .= "Adresse IP privée : Aucune information disponible.";
        }
    }

    $ResRequete['time'] = $time;
    $ResRequete['seconds'] = $seconds;
    $ResRequete['datas'] = $infos;
    $ResRequete['message'] = $message;
    $ResRequete['warning'] = $warning;
    $ResRequete['error'] = $error; 
    
    return $ResRequete;
}

function TraiteIp($AdresseIp)
{
    $ExplodeIp = explode('.', $AdresseIp);
    
    $Ip = ($ExplodeIp[0] * 256 * 256 * 256) + ($ExplodeIp[1] * 256 * 256) + ($ExplodeIp[2] * 256) + $ExplodeIp[3];

    return $Ip;
}

function TraitementData()
{
    $dbh = Connexion();

    $ResRequete = array();
    $error = '';
    $warning = '';
    $message = '';

    $sqlDelete = "DELETE FROM geoip";
    $prepareDelete = $dbh->prepare($sqlDelete);
        
    try
    {
        $prepareDelete->execute();
    }
    catch (Exception $e)
    {
        $error .= "Erreur : Suppression des lignes de la table geoip échouée";
        exit();
    }
    
    $sqlLoad = "LOAD DATA INFILE '/var/lib/mysql/geoip.csv' INTO TABLE geoip CHARACTER SET 'utf8mb4' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\r\\n' IGNORE 1 LINES";
    $prepareLoad = $dbh->prepare($sqlLoad);

    try
    {
        $prepareLoad->execute();
    }
    catch (Exception $e)
    {
        $error .= "Erreur : Insertion depuis le CSV échouée.";
        exit();
    }

    if($error == '' || $error == null)
    {
        $message .= "Insertion depuis le CSV réussie.";
    }

    $ResRequete['message'] = $message;
    $ResRequete['warning'] = $warning;
    $ResRequete['error'] = $error; 
    
    return $ResRequete;
}

function TraitementTime($NombreIP)
{
    $ResRequete = array();
    $error = '';
    $warning = '';
    $message = '';

    $TraitementTime = array();

    for($i = 0; $i < $NombreIP; $i++)
    {
        $AdresseIp = rand(0,255).'.'.rand(0,255).'.'.rand(0,255).'.'.rand(0,255);
        $TraitementIp = TraitementIp($AdresseIp);
        $TraitementIp['AdresseIp'] = $AdresseIp;
        array_push($TraitementTime, $TraitementIp);
    }

    foreach($TraitementTime as $Traitement)
    {
        $seconds += $Traitement['time'];
    }

    $moytime = TimeToSeconds($seconds / $NombreIP);
    $time = TimeToSeconds($seconds);
    
    $ResRequete['time'] = $time;
    $ResRequete['moytime'] = $moytime;
    $ResRequete['seconds'] = $seconds;
    $ResRequete['datas'] = $TraitementTime;
    $ResRequete['message'] = $message;
    $ResRequete['warning'] = $warning;
    $ResRequete['error'] = $error;
    
    return $ResRequete;
}

function TimeToSeconds($seconds)
{
    $explodeTime = explode('.', $seconds);
    
    return $explodeTime[0].'.'.substr($explodeTime[1], 0, 3);
}