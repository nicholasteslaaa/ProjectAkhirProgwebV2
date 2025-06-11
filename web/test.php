<?php
require "DBmanager/DBconnection.php";
include "tableManager/clientTable.php";

$client = new clientTable($conn);
$user = $client->getClientByEmail("k@gmail.com");
echo $user->getNamaDepan();

?>