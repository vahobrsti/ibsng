<?php
require_once("../inc/init.php");

needAuthType(ADMIN_AUTH_TYPE);
face();
echo "hi";
function face()
{
    $smarty=new IBSSmarty();
    $smarty->display("admin/admin_index.tpl");
}
?>