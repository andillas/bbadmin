<section class="container">
    <header>
        <h2>Lúpulos
                <a class="btn btn-primary float-right" href="?c=lupulo&a=newLupulo">Nuevo lúpulo</a>
        </h2>

    </header>
    <article>
        <table class="table table-hover">
            <thead>
            <th>Nombre</th>
            <th>Alfa Ácidos</th>
            <th>Lotes</th>
            <th>Comentarios</th>
            <th></th>
            </thead>
            <tbody>
            <?php
            while ($lupulo = $all_lupulos->fetch_object()){
                echo '<tr id="row_lupulo_' . $lupulo->id_lupulo . '">';
                echo   '<td data-name="lupuname">' . $lupulo->nombre_lupulo . '</td>
                        <td>' . $lupulo->alfa_acidos . '</td>
                        <td><span class="badge">5</span></td>
                        <td>' . $lupulo->notas_lupulo . '</td>
                        <td id="tddellupulo"><button id="botdellupulo" class="btn btn-danger" onclick="deleteLupulo(' . $lupulo->id_lupulo . ', ' . $lupulo->id_lupulo . ')">Eliminar</button></td>
                        ';
                echo '</tr>';
            }
            ?>
            </tbody>

        </table>

    </article>
</section>