<?php

function CheckAdministrator() {
    if (!isset($_SESSION)) {
        session_start();
    }

    // Get the db ready.
    $MyDB = GetDatabase("localhost", "root", "", "de_lezers");

    // Get SQL string ready
    $sql = "SELECT klant.Administrator FROM klant WHERE klant.klantId = '" . $_SESSION["klantId"] . "'";

    try {
        $query = ExecuteQuerry($MyDB, $sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result[0]["Administrator"] == 1; // Check if the user has the administrator attribute. 
    } catch (PODException ) {
        return false;
    }
}

Function CRUDDisplay($db, $table) {
    $result = "<table id=Systeembeheer_CRUDtable><tr>";

    $sql = "SELECT * FROM " . $table;
    $query = ExecuteQuerry($db, $sql);
    $data =  $query->fetchAll(PDO::FETCH_ASSOC);



    // Create headings
    foreach (array_keys($data[0]) as $key) {
        $result .= "<td class=Systeembeheer_CRUDcolumn>" . $key . "</td>";
    }
    $result .= "</tr>";

    // Fill in all the rows etc etc.

    $result .= "</table>";
    echo $result;
}

function GetPrimaryKey($par) {
    return array_keys($par)[0];
}
?>