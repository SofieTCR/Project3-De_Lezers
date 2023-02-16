<table>
    <?php
        if (isset($_POST)) {
            echo("<tr>");
            echo("<td>" . "uname" . "</td>");
            echo("<td>" . $_POST["uname"] . "</td>");
            echo("</tr>");
            echo("<tr>");
            echo("<td>" . "pword" . "</td>");
            echo("<td>" . $_POST["pword"] . "</td>");
            echo("</tr>");
        }
    ?>
</table>

<style>
    table {
        border-collapse: collapse;
        border: 1px solid black;
    }
    td {
        border: 1px solid black;
        width: 100px;
    }
</style>