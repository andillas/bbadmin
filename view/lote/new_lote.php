<section class="container">
    <header><h2>Nuevo Lote</h2></header>
    <article>
        <form>
            <div class="form-group row">
                    <div class="col-lg-5">
                        <label for="nombre_nuevo_lote">Nombre</label>
                        <input type="text" class="form-control" id="nombre_nuevo_lote" name="nombre_nuevo_lote">
                    </div>
                    <div class="col-lg-5">
                        <label for="tipo_nuevo_lote">Tipo</label>
                        <input type="text" class="form-control" id="tipo_nuevo_lote" name="tipo_nuevo_lote">
                    </div>
                    <div class="col-lg-2">
                        <label for="numero_nuevo_lote">Nº Lote</label>
                        <input type="text" class="form-control" id="numero_nuevo_lote" name="numero_nuevo_lote">
                    </div>
            </div>

            <div class="form-group row">
                    <div class="col-lg-6">
                        <label for="cocinado_nuevo_lote">Fecha Cocinado</label>
                        <input type="text" class="form-control" id="cocinado_nuevo_lote" name="cocinado_nuevo_lote">
                    </div>
                    <div class="col-lg-6">
                        <label for="embotellado_nuevo_lote">Fecha Embotellado</label>
                        <input type="text" class="form-control" id="embotellado_nuevo_lote" name="embotellado_nuevo_lote">
                    </div>
            </div>

            <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="agua_macerado_nuevo_lote">Agua Macerado (Litros)</label>
                        <input type="text" class="form-control" id="agua_macerado_nuevo_lote" name="agua_macerado_nuevo_lote">
                    </div>
                    <div class="col-lg-4">
                        <label for="agua_lavado_nuevo_lote">Agua Lavado (Litros)</label>
                        <input type="text" class="form-control" id="agua_lavado_nuevo_lote" name="agua_lavado_nuevo_lote">
                    </div>
                    <div class="col-lg-4">
                        <label for="tiempo_hervido_nuevo_lote">Tiempo Hervido (Minutos)</label>
                        <input type="text" class="form-control" id="tiempo_hervido_nuevo_lote" name="tiempo_hervido_nuevo_lote">
                    </div>
            </div>
            <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="levadura_nuevo_lote">Levadura</label>
                        <select class="form-control" id="levadura_nuevo_lote" name="levadura_nuevo_lote">
                            <option value="null">Elige levadura</option>
                            <?php
                                if($all_levaduras){
                                    foreach ($all_levaduras as $leva) {
                                        echo '<option value="' . $leva->id_levadura . '">' . $leva->nombre_levadura . '</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label for="azucar_nuevo_lote">Azúcar</label>
                        <input type="text" class="form-control" id="azucar_nuevo_lote" name="azucar_nuevo_lote">
                    </div>
            </div>
            <div class="form-group row" id="area_lupulos">
                <div class="col-lg-5">
                    <label>Nombre</label>
                    <select class="form-control" id="lupulo_adicion_0" name="lupulo_adicion_0">
                        <option value="null">Elige lúpulo</option>
                        <?php
                            if($all_lupulos){
                                foreach ($all_lupulos as $lupulo) {
                                    echo '<option value="' . $lupulo->id_levadura . '">' . $lupulo->nombre_lupulo . '</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="col-lg-3">
                    <label>Cantidad (Gramos)</label>
                    <input type="text" class="form-control" id="cantidad_adicion_0" name="cantidad_adicion_0">
                </div>
                <div class="col-lg-3">
                    <label>Tiempo (Minutos)</label>
                    <input type="text" class="form-control" id="tiempo_adicion_0" name="tiempo_adicion_0">
                </div>
                <div class="col-lg-1">
                    <label>&nbsp;</label>
                    <a class="form-control btn btn-default" onclick="addNewAdicion()">Añadir</a>
                </div>
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-default" onclick="saveLupulo(this.form)">Guardar</button>
                <button type="button" class="btn btn-checkout" onclick="window.location.href='?c=lupulo'">Cancelar</button>
            </div>
        </form>
    </article>
</section>