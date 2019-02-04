<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="description" content="Gestor de lotes">
<head>
    <base href="<?php echo parse_ini_file(dirname(dirname(__DIR__)) . '/conf/config.ini')['basetag']; ?>" />

    <script src="assets/js/jquery-2.2.4.min.js" language="JavaScript"></script>
    <script src="assets/js/js.js" language="JavaScript"></script>
    <script src="assets/js/bootstrap.min.js" language="JavaScript"></script>
    <script src="assets/js/js.js" language="JavaScript"></script>
    <script>
        $(function(){
            /*
            Esto dejó de funcionar con las urls amigables mediante htaccesss

            let params = new URLSearchParams(window.location.search);
            let controller = params.get('c');
            $("#nav_" + controller).addClass('active');
            */

            $("#nav_<?php echo $_REQUEST['c']; ?>").addClass('active');
        });


    </script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<header>
    <div class="jumbotron container">
        <h1 class="container">Gestor de lotes</h1>
    </div>
</header>

<nav class="container">
    <ul class="nav nav-tabs">
        <li id="nav_lote"><a href="lote">Lotes</a></li>
        <li id="nav_lupulo"><a href="lupulo">Lúpulos</a></li>
        <li id="nav_malta"><a href="malta">Maltas</a></li>
    </ul>
</nav>