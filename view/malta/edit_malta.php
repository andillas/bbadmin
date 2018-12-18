<section class="container">
    <header><h2>Editar Malta</h2></header>
    <article>
        <form>
            <input type="hidden" id="id_editar_malta" name="id_editar_malta" value="<?php echo $malta_data->id_malta; ?>">
            <div class="form-group">
                <label for="nombre_editar_malta">Nombre</label>
                <input type="text" class="form-control" id="nombre_editar_malta" name="nombre_editar_malta" value="<?php echo $malta_data->nombre_malta; ?>">
            </div>
            <div class="form-group">
                <label for="tipo_editar_malta">Tipo malta</label>
                <select id="tipo_editar_malta" name="tipo_editar_malta" class="form-control">
                    <option value="null">Selecciona tipo</option>
                    <?php
                        $tipos = ['base' => 'Base', 'especial' => 'Especial'];
                        foreach ($tipos as $key => $tipo){
                            $sel = $key === $malta_data->tipo_malta ? 'selected' : '';
                            echo '<option value="'.$key.'" '.$sel.'>'.$tipo.'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="ebc_editar_malta">EBC</label>
                <input type="text" class="form-control" id="ebc_editar_malta" name="ebc_editar_malta" value="<?php echo $malta_data->ebc; ?>">
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-default" onclick="updateMalta(this.form)">Guardar</button>
                <button type="button" class="btn btn-checkout" onclick="window.location.href='?c=malta'">Cancelar</button>
            </div>
        </form>
    </article>
</section>