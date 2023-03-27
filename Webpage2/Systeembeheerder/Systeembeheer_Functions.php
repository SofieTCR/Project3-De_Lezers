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

Function CRUDDisplay($db, $table, $wantedwidth = 95) {
    $result = "<table id=Systeembeheer_CRUDtable><tr>";

    $sql = "SELECT * FROM " . $table;
    $query = ExecuteQuerry($db, $sql);
    $data =  $query->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SHOW KEYS FROM " . $table . " WHERE Key_name LIKE '%fk%' OR Key_name = 'Primary'";
    $query = ExecuteQuerry($db, $sql);
    $keydata =  $query->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SHOW COLUMNS FROM " . $table;
    $query = ExecuteQuerry($db, $sql);
    $keys =  $query->fetchAll(PDO::FETCH_ASSOC);

    $cols = (count($keys) + 2);
    $colwidth = round(($wantedwidth - 2) / $cols - 0.8, 1);
    

    // Create headings
    foreach ($keys as $key) {
        $result .= "<td class=Systeembeheer_CRUDcolumn style='max-width: " . $colwidth . "vw'>" . $key["Field"];
        foreach ($keydata as $keytype) {
            if ($keytype["Column_name"] == $key["Field"]) {
                if ($keytype["Key_name"] == "PRIMARY") {
                    $result .= " (PK)";
                }
                else {
                    $result .= " (FK)";
                }
            }
        }
        $result .= "</td>";
    }
    $result .= "</tr>";

    // Fill in all the rows etc etc.
    foreach ($data as $dat) {
        $result .= "<tr class=Systeembeheer_CRUDrow>";
        foreach ($keys as $key) {
            $result .= "<td class=Systeembeheer_CRUDcolumn style='max-width: " . $colwidth . "vw'>" . $dat[$key["Field"]] . "</td>";
        }
        $result .= "<form method=post action=edit.php> <td class=Systeembeheer_CRUDcolumn style='max-width: " . $colwidth . "vw'> <input type=hidden name=table value=" . $table . "><input type=hidden name=id value=" . $dat[GetPrimaryKey($dat)] . "><input class=Systeembeheer_CRUDsubmit type=submit value=Wijzig name=submit></td>";
        $result .= "<td class=Systeembeheer_CRUDcolumn style='max-width: " . $colwidth . "vw'> <input class=Systeembeheer_CRUDsubmit type=submit value=Verwijder name=submit> </td> </form>";
        $result .= "</tr>";
    }

    $result .= "</table>";
    echo $result;
}

function GetPrimaryKey($par) {
    return array_keys($par)[0];
}
?>