<section class="container">
    <header>
        <h2>Maltas
                <a class="btn btn-primary float-right" href="?c=malta&a=newMalta">Nueva Malta</a>
        </h2>

    </header>
    <article>
        <table class="table table-hover">
            <thead>
            <th>Nombre</th>
            <th>EBC</th>
            <th>Tipo</th>
            <th>Lotes</th>
            <th>Comentarios</th>
            <th></th>
            </thead>
            <tbody>
            <?php
            while ($malta = $all_maltas->fetch_object()){
                echo '<tr id="row_malta_' . $malta->id_malta . '">';
                echo   '<td data-name="maltaname">' . $malta->nombre_malta . '</td>
                        <td>' . $malta->ebc . '</td>
                        <td>' . $malta->tipo_malta . '</td>
                        <td><span class="badge">5</span></td>
                        <td>' . $malta->notas_malta . '</td>
                        <td id="tddelmalta"><button id="botdelmalta" class="btn btn-danger" onclick="deleteMalta(' . $malta->id_malta . ', ' . $malta->id_malta . ')">Eliminar</button></td>
                        ';
                echo '</tr>';
            }
            ?>
            </tbody>

        </table>

    </article>
</section>