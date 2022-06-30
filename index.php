<?php
include_once 'config/config.php';
include_once 'iface/UriBuilder.php';
include 'inc/autoloader.php';

$uri = new Uri;//
$account = new Account();
$view = new AccountView($account);
$contr = new AccountContr();//

?>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Panel</title>
    <meta name="description" content="Panel">
    <meta name="author" content="Recruit">

    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
</head>
<body>

<?php

    if(isset($_GET['panel'])){
        if ($_GET['panel'] == 'create') echo $view->index($view->createAccount($account));
        if ($_GET['panel'] == 'list') echo $view->index($view->listAccount($account));
        if ($_GET['panel'] == 'modify') echo $view->index($view->modifyAccount($account));
        if ($_GET['panel'] == 'del') echo $view->index($view->deleteAccount($account));
    }else{
        echo $view->index($view->panel());
    }

?>
</body>
</html>