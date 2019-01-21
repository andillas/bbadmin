<?php
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="description" content="Gestor de lotes">
<head>
    <script src="assets/js/jquery-2.2.4.min.js" language="JavaScript"></script>
    <script src="assets/js/bootstrap.min.js" language="JavaScript"></script>
    <script src="assets/js/js.js" language="JavaScript"></script>
    <script>
        $(function(){
            let params = new URLSearchParams(window.location.search);
            let controller = params.get('c');

            $("#nav_" + controller).addClass('active');
        });


    </script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<header>
    <div class="jumbotron">
        <h1 class="container">Gestor de lotes</h1>
    </div>
</header>

<nav class="container">
    <ul class="nav nav-tabs">
        <li id="nav_lote"><a href="?c=lote">Lotes</a></li>
        <li id="nav_lupulo"><a href="?c=lupulo">Lúpulos</a></li>
        <li id="nav_malta"><a href="?c=malta">Maltas</a></li>
    </ul>
    <!--
    <span class="panel-body">
        <a href="?c=lote">Lotes</a> | <a href="?c=lupulo">Lúpulos</a> | <a href="?c=malta">Maltas</a>
    </span>
    -->
</nav>
