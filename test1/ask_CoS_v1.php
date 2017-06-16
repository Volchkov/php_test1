<?php

if (isset($_POST["area1"])) {
        $result = "12345".$_POST["area1"];
}

printf("<form method=\"post\">\n");

printf("<textarea name=\"area1\">%s</textarea>\n", $_POST["area1"]);

printf("<textarea name=\"area2\">%s</textarea>\n", $result);

printf("<input type=\"submit\" name=\"submit\" value=\"Отправить\">\n");

printf("</form>\n");

?>  