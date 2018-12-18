<section class="container">
    <header><h2>Editar lúpulo</h2></header>
    <article>
        <form>
            <input type="hidden" id="id_editar_lupulo" name="id_editar_lupulo" value="<?php echo $lupulo_data->id_lupulo; ?>">
            <div class="form-group">
                <label for="nombre_editar_lupulo">Nombre</label>
                <input type="text" class="form-control" id="nombre_editar_lupulo" name="nombre_editar_lupulo" value="<?php echo $lupulo_data->nombre_lupulo; ?>">
            </div>
            <div class="form-group">
                <label for="alfaacidos_editar_lupulo">Alfa Ácidos</label>
                <input type="text" class="form-control" id="alfaacidos_editar_lupulo" name="alfaacidos_editar_lupulo" value="<?php echo $lupulo_data->alfa_acidos; ?>">
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-default" onclick="updateLupulo(this.form)">Guardar</button>
                <button type="button" class="btn btn-checkout" onclick="window.location.href='?c=lupulo'">Cancelar</button>
            </div>
        </form>
    </article>
</section>