<?php

function GetDatabase($srvname, $uname, $pword, $dbname)
{
    try {
        $db = new PDO("mysql:host=$srvname;dbname=$dbname", $uname, $pword);
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        return $db;
    } 
    catch(PDOException $e) {

    }
}

function ExecuteQuerry($db, $query)
{
    $q = $db->prepare($query);
    $q->execute();
    return $q;
}



?>