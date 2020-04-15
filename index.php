<?php
session_start();
include_once 'script/main.php';
include_once 'script/database.php';
include_once "script/profile_script.php";
include_once 'script/goods.php';



user_reg($connect);
user_login($connect);
buy_goods($connect);

ses_destroy();

include_once get_path_to_page();
?>