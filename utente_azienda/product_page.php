<?php
require('_header.php');
require('../include/_db_dal.inc.php');
$conn = db_connect();


if(isset($_POST['edit'])){
    debug_to_console("edit " . $_POST['prodotto']);
    
}

if(isset($_POST['delete'])){
    debug_to_console("delete " . $_POST['prodotto']);
    delete_product($conn,$_POST['prodotto']);
}

?>
