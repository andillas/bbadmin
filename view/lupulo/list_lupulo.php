<section class="container">
    <header>
        <h2>Lúpulos
                <a class="btn btn-primary float-right" href="./lupulo/newLupulo">Nuevo lúpulo</a>
        </h2>

    </header>
    <article>
        <table class="table table-hover">
            <thead>
            <th>Nombre</th>
            <th>Alfa Ácidos</th>
            <th>Lotes</th>
            <th>Cantida total</th>
            <th>Comentarios</th>
            <th></th>
            </thead>
            <tbody>
            <?php
            while ($lupulo = $all_lupulos->fetch_object()){

                    $lupulo_x_lote = $this->obj_lupulo->usosLupuloByIdLupulo($lupulo->id_lupulo);
                    $cantidad_total = $this->obj_lupulo->cantidadLupuloByIdLupulo($lupulo->id_lupulo);

                echo '<tr id="row_lupulo_' . $lupulo->id_lupulo . '">';
                echo   '<td data-name="lupuname">' . $lupulo->nombre_lupulo . '</td>
                        <td>' . $lupulo->alfa_acidos . '</td>
                        <td><span class="badge">' . $lupulo_x_lote->total_usos . '</span></td>
                        <td>' . $cantidad_total->cantidad . '</td>
                        <td>' . $lupulo->notas_lupulo . '</td>
                        <td id="tdeditlupulo"><button id="boteditlupulo" class="btn btn-warning" onclick="editLupulo(' . $lupulo->id_lupulo . ')">Editar</button></td>
                        <td id="tddellupulo"><button id="botdellupulo" class="btn btn-danger" onclick="deleteLupulo(' . $lupulo->id_lupulo . ')">Eliminar</button></td>
                        ';
                echo '</tr>';
            }
            ?>
            </tbody>

        </table>

    </article>
</section>