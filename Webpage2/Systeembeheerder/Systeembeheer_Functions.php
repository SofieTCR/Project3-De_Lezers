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
    $result = "<div style='display: flex; align-items: center; margin-bottom: 2vh;'><h2 class=Systeembeheer_CRUDDisplaytitle>CRUD " . $table . "</h2>";
    $result .= "<form method=post action=CRUD_Edit.php><input type=hidden name=table value=" . $table . "><input id=Systeembeheer_CRUDDisplaynew type=submit name=submit value='Add New'></form></div>";
    $result .= "<table id=Systeembeheer_CRUDDisplaytable><tr>";

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
        $result .= "<td class=Systeembeheer_CRUDDisplaycolumn>" . $key["Field"];
        foreach ($keydata as $keytype) { // add labels for primary, foreign and AI keys.
            if ($keytype["Column_name"] == $key["Field"]) {
                if ($keytype["Key_name"] == "PRIMARY") {
                    $result .= " (PK)";
                }
                else {
                    $result .= " (FK)";
                }
                if ($key["Extra"] == "auto_increment") {
                    $result .= " (AI)";
                }
            }
        }
        $result .= "</td>";
    }
    $result .= "</tr>";

    // Fill in all the rows etc etc.
    foreach ($data as $dat) {
        $result .= "<tr class=Systeembeheer_CRUDDisplayrow>";
        $result .= "<form method=post action=CRUD_Edit.php> <input type=hidden name=table value='" . $table . "'>";

        foreach ($keys as $key) {
            $result .= "<td class=Systeembeheer_CRUDDisplaycolumn>" . $dat[$key["Field"]] . "</td>";
            foreach ($keydata as $keytype) {
                if ($keytype["Column_name"] == $key["Field"]) {
                    if ($keytype["Key_name"] == "PRIMARY") {
                        $result .= "<input type=hidden name=PK_" . $key["Field"] . " value='" . $dat[$key["Field"]] . "'>";
                    }
                }
            }
        }
        $result .= "<td><input class=Systeembeheer_CRUDDisplaysubmit type=submit value=Edit name=submit></td>";
        $result .= "<td class=Systeembeheer_CRUDDisplaycolumn> <input class=Systeembeheer_CRUDDisplaysubmit type=submit value=Delete name=submit> </td> </form>";
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
    else if ($type == "Update") {
        $sql = "SHOW COLUMNS FROM " . $table;
        $query = ExecuteQuerry($db, $sql);
        $keys =  $query->fetchAll(PDO::FETCH_ASSOC);
        
        $sql = "UPDATE " . $table . " SET ";
        
        foreach ($keys as $key) {
            $sql .= "" . $key["Field"];
            if ($_POST[$key["Field"]] != null) {
                $sql .= "='" . $_POST[$key["Field"]] . "'";
            }
            else {
                $sql .= "=" . "NULL";
            }
            if ($key != $keys[array_key_last($keys)]) {
                $sql .= ", ";
            }
        }

        $sql .= " WHERE ";

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
    else if ($type == "Add") {
        $sql = "SHOW COLUMNS FROM " . $table;
        $query = ExecuteQuerry($db, $sql);
        $keys =  $query->fetchAll(PDO::FETCH_ASSOC);
        
        $sql = "INSERT INTO " . $table . " (";
        foreach ($keys as $key) {
            $sql .= $key["Field"];
            if ($key != $keys[array_key_last($keys)]) {
                $sql .= ", ";
            }
        }

        $sql .= ") VALUES (";

        foreach ($keys as $key) {
            if ($_POST[$key["Field"]] != null) {
                $sql .= "'" . $_POST[$key["Field"]] . "'";
            }
            else {
                $sql .= "NULL";
            }
            if ($key != $keys[array_key_last($keys)]) {
                $sql .= ", ";
            }
        }

        $sql .= ")";
        
        ExecuteQuerry($db, $sql); // execute the query
        $hdr = "<form method=post action='./CRUD.php' id=returnform><input type=hidden name=table value=" . $table . "></form><script>document.getElementById('returnform').submit();</script>";
        echo $hdr; // send the user back to the crud for this table page
    }
    else {
        //echo $type; // temp log to show which call executed this

        $sql = "SHOW COLUMNS FROM " . $table;
        $query = ExecuteQuerry($db, $sql);
        $keys =  $query->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SHOW KEYS FROM " . $table . " WHERE Key_name LIKE '%fk%' OR Key_name = 'Primary'";
        $query = ExecuteQuerry($db, $sql);
        $keydata =  $query->fetchAll(PDO::FETCH_ASSOC);

        if ($type == "Edit") { // get all the values that should be pre-inserted in case of edit
            $sql = "SELECT *  FROM " . $table . " WHERE "; // start preparing the query
        
            for ($i=0; $i < count($pkarr); $i++) { 
                $sql .= substr(array_keys($pkarr)[$i], 3) . " = '" . $pkarr[array_keys($pkarr)[$i]] . "'";
                if ($i != count($pkarr) - 1) {
                    $sql .= " AND ";
                }
            }

            $query = ExecuteQuerry($db, $sql);
            $values =  $query->fetchAll(PDO::FETCH_ASSOC);
        }

        $result = "<form method=post id=Aanmeld_Form>";

        $result .= "<input type=hidden name=table value=" . $table . ">";

        foreach ($keys as $key) {
            $result .= "<div class=Aanmeld_Row><label>" . $key["Field"];

            foreach ($keydata as $keytype) { // add labels for primary, foreign and AI keys.
                if ($keytype["Column_name"] == $key["Field"]) {
                    if ($keytype["Key_name"] == "PRIMARY") {
                        $result .= " (PK)";
                    }
                    else {
                        $result .= " (FK)";
                    }
                    if ($key["Extra"] == "auto_increment") {
                        $result .= " (AI)";
                    }
                }
            }

            $result .= ": </label>";
            $result .= "<input type=";
            if ($key["Type"] == "date") {
                $result .= "date";
            }
            else {
                $result .= "text";
            }
            $result .= " name='" . $key["Field"] . "'";

            if ($key["Extra"] != "auto_increment" && $key["Null"] != "YES") {
                $result .= " required";
            }

            if ($type == "Edit") { // insert the pre-existing value if we're in edit mode
                $result .= " value='" . $values[0][$key["Field"]] . "'";
            }

            $result .= "></div><br>";
            if ($type == "Edit") {
                foreach ($keydata as $keytype) {
                    if ($keytype["Column_name"] == $key["Field"]) {
                        if ($keytype["Key_name"] == "PRIMARY") {
                            $result .= "<input type=hidden name=PK_" . $key["Field"] . " value='" . $values[0][$key["Field"]] . "'>";
                        }
                    }
                }
            }
        }

        $result .= "<input id=Aanmeld_Submit type=submit name=submit value=";
        if ($type == "Add New") {
            $result .= "Add";
        }
        else if ($type == "Edit") {
            $result .= "Update";
        }

        $result .= "></form>";

        echo $result;
    }
}

function GetPrimaryKeys($arr) {
    $pkarr = array_filter($arr, function($key) {
        return strpos($key, "PK_") === 0;
    }, ARRAY_FILTER_USE_KEY);
    return $pkarr;
}
?>