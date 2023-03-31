<?php 
require('_header.php');
require('../include/_db_dal.inc.php');
$conn = db_connect();
?>
 <?php echo imagesfromblob($conn,6);?>
