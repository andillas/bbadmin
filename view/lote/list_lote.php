<section class="container">
    <header>
        <h2>Lotes
                <a class="btn btn-primary float-right" href="?c=lote&a=newLote">Nuevo Lote</a>
        </h2>

    </header>
    <article>
        <table class="table table-hover">
            <thead>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Fecha cocinado</th>
            <th>Alcohol</th>
            <th></th>
            </thead>
            <tbody>
            <?php
            while ($lote = $all_lotes->fetch_object()){
                echo '<tr id="row_lote_' . $lote->id_lote . '">';
                echo   '<td data-name="lotename">' . $lote->nombre . '</td>
                        <td>' . $lote->tipo . '</td>
                        <td>' . $lote->fecha_cocinado . '</td>
                        <td>' . $lote->graduacion . '</td>
                        <td id="tddellote"><button id="botdellote" class="btn btn-danger" onclick="deleteLupulo(' . $lote->id_lote . ', ' . $lote->id_lote . ')">Eliminar</button></td>
                        ';
                echo '</tr>';
            }
            ?>
            </tbody>

        </table>

    </article>
</section>