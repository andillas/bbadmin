<?php
?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="description" content="Gestor de lotes">
<head>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/js/jquery-2.2.4.min.js" language="JavaScript"></script>
    <script src="../assets/js/bootstrap.min.js" language="JavaScript"></script>
    <script src="../assets/js/js.js" language="JavaScript"></script>
</head>
<body>
<header>
    <div class="jumbotron">
        <h1>Gestor de lotes</h1>
    </div>
</header>
<nav> Lotes | Nuevo | Estadísticas </nav>
<section>
    <header><h2>Nuevo lote</h2></header>
    <article>
        <form>
            <h4>Nombre y fechas</h4>
            <div class="form-group">
                <label for="nombrelote">Nombre del lote</label>
                <input type="text" class="form-control" id="nombrelote" name="nombrelote">
            </div>
            <div class="form-group">
                <label for="tipocerveza">Tipo</label>
                <input type="text" class="form-control" id="tipocerveza" name="tipocerveza">
            </div>
            <div class="form-group">
                <label for="fechacocinado">Fecha Cocinado</label>
                <input type="text" class="form-control" id="fechacocinado" name="fechacocinado">
            </div>
            <div class="form-group">
                <label for="fechaembotellado">Fecha Embotellado</label>
                <input type="text" class="form-control" id="fechaembotellado" name="fechaembotellado">
            </div>

            <h4>Agua</h4>
            <div class="form-group">
                <label for="aguamacerado">Agua Macerado</label>
                <input type="text" class="form-control" id="aguamacerado" name="aguamacerado" value="23">
                <span>Litros</span>
            </div>
            <div class="form-group">
                <label for="agualavado">Agua Lavado</label>
                <input type="text" class="form-control" id="agualavado" name="agualavado" value="8">
                <span>Litros a 78ºC</span>
            </div>
            <h4>Malta</h4>
            <div class="form-group">
                <input type="text" class="form-control" id="malta" name="malta">
            </div>
            <h4>Lúpulo</h4>
            <div class="form-group">
                <input type="text" class="form-control" id="lupulo" name="lupulo">
            </div>

        </form>
    </article>
</section>
<footer></footer>
</body>
</html>
