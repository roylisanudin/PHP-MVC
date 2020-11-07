<?php 

if( !session_id()){
    session_start();
}
require_once '../app/init.php';

//Inisialisasi (bootstrapping) class app yg udh dibuat
$app = new App;



?>