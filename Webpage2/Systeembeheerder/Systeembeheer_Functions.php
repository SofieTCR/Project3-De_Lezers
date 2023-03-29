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
    $result = "<div style='display: flex; align-items: center; margin-bottom: 2vh;'><h2 class=Systeembeheer_CRUDtitle>CRUD " . $table . "</h2>";
    $result .= "<form method=post action=CRUD_Edit.php><input type=hidden name=table value=" . $table . "><input id=Systeembeheer_CRUDnew type=submit name=submit value='Add New'></form></div>";
    $result .= "<table id=Systeembeheer_CRUDtable><tr>";

    $sql = "SELECT * FROM " . $table;
    $query = ExecuteQuerry($db, $sql);
    $data =  $query->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SHOW KEYS FROM " . $table . " WHERE Key_name LIKE '%fk%' OR Key_name = 'Primary'";
    $query = ExecuteQuerry($db, $sql);
    $keydata =  $query->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SHOW COLUMNS FROM " . $table;
    $query = ExecuteQuerry($db, $sql);
    $keys =  $query->fetchAll(PDO::FETCH_ASSOC);    

    // Create headings
    foreach ($keys as $key) {
        $result .= "<td class=Systeembeheer_CRUDcolumn>" . $key["Field"];
        foreach ($keydata as $keytype) { // add labels for primary and foreign keys.
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
        $result .= "<form method=post action=CRUD_Edit.php> <input type=hidden name=table value='" . $table . "'>";

        foreach ($keys as $key) {
            $result .= "<td class=Systeembeheer_CRUDcolumn>" . $dat[$key["Field"]] . "</td>";
            foreach ($keydata as $keytype) {
                if ($keytype["Column_name"] == $key["Field"]) {
                    if ($keytype["Key_name"] == "PRIMARY") {
                        $result .= "<input type=hidden name=PK_" . $key["Field"] . " value='" . $dat[$key["Field"]] . "'>";
                    }
                }
            }
        }
        $result .= "<td><input class=Systeembeheer_CRUDsubmit type=submit value=Edit name=submit></td>";
        $result .= "<td class=Systeembeheer_CRUDcolumn> <input class=Systeembeheer_CRUDsubmit type=submit value=Delete name=submit> </td> </form>";
        $result .= "</tr>";
    }

    $result .= "</table>";
    echo $result;
}

function CRUDEdit($db, $table, $type, $pkarr) {
    //echo $type;
    if ($type == "Delete") {
        $sql = "DELETE FROM " . $table . " WHERE "; // start preparing the deletion query
        
        for ($i=0; $i < count($pkarr); $i++) { 
            $sql .= substr(array_keys($pkarr)[$i], 3) . " = '" . $pkarr[array_keys($pkarr)[$i]] . "'";
            if ($i != count($pkarr) - 1) {
                $sql .= " AND ";
            }
        }

        ExecuteQuerry($db, $sql); // execute the query
        $hdr = "<form method=post action='./CRUD.php' id=returnform><input type=hidden name=table value=" . $table . "></form><script>document.getElementById('returnform').submit();</script>";
        echo $hdr; // send the user back to the crud for this table page
    }
    else {

    }
}

function GetPrimaryKeys($arr) {
    $pkarr = array_filter($arr, function($key) {
        return strpos($key, "PK_") === 0;
    }, ARRAY_FILTER_USE_KEY);
    return $pkarr;
}
?>