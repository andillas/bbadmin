<section class="container">
    <header><h2>Nuevo Lote</h2></header>
    <article>
        <form>

                                    <!--************-->
                                    <!-- DATOS LOTE -->
                                    <!--************-->

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
                    <div class="col-lg-5">
                        <label for="cocinado_nuevo_lote">Fecha Cocinado</label>
                        <input type="text" class="form-control" id="cocinado_nuevo_lote" name="cocinado_nuevo_lote">
                    </div>
                    <div class="col-lg-7">
                        <label for="embotellado_nuevo_lote">Fecha Embotellado</label>
                        <input type="text" class="form-control" id="embotellado_nuevo_lote" name="embotellado_nuevo_lote">
                    </div>
            </div>

                                    <!--******-->
                                    <!-- AGUA -->
                                    <!--******-->

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

                                    <!--***********-->
                                    <!--  MALTAS  -->
                                    <!--***********-->

            <div class="form-group row">
                    <div class="col-lg-3">
                        <label>Maltas</label>
                        <a class="form-control btn btn-default" style="float: right" onclick="addNewMalta()">Añadir</a>
                        <a class="form-control btn btn-default" style="float: right" onclick="delNewMalta()">Quitar</a>
                    </div>
            </div>
            <div class="form-group row" id="area_maltas"></div>


                                <!--*********************-->
                                <!--  LEVADURA Y AZÚCAR  -->
                                <!--*********************-->

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
                        <label for="azucar_nuevo_lote">Azúcar (Gramos)</label>
                        <input type="text" class="form-control" id="azucar_nuevo_lote" name="azucar_nuevo_lote">
                    </div>
            </div>

                                    <!--***********-->
                                    <!--  LÚPULOS  -->
                                    <!--***********-->

            <div class="form-group row">
                    <div class="col-lg-1">
                        <label>Lúpulos</label>
                        <a class="form-control btn btn-default" style="float: right" onclick="addNewAdicion()">Añadir</a>
                        <a class="form-control btn btn-default" style="float: right" onclick="delNewAdicion()">Quitar</a>
                    </div>
            </div>
            <div class="form-group row" id="area_lupulos"></div>

                                    <!--**************-->
                                    <!--  RESULTADOS  -->
                                    <!--**************-->

            <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="di_nuevo_lote">Densidad Inicial</label>
                        <input type="text" class="form-control" id="di_nuevo_lote" name="di_nuevo_lote">
                    </div>
                    <div class="col-lg-4">
                        <label for="df_nuevo_lote">Densidad Final</label>
                        <input type="text" class="form-control" id="df_nuevo_lote" name="df_nuevo_lote">
                    </div>
                    <div class="col-lg-4">
                        <label for="litros_nuevo_lote">Litros Embotellados</label>
                        <input type="text" class="form-control" id="litros_nuevo_lote" name="litros_nuevo_lote">
                    </div>
            </div>

            <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="alcohol_nuevo_lote">Graduación Alcohólica</label>
                        <input type="text" class="form-control" id="alcohol_nuevo_lote" name="alcohol_nuevo_lote">
                    </div>
                    <div class="col-lg-4">
                        <label for="atenuacion_nuevo_lote">Atenuación</label>
                        <input type="text" class="form-control" id="atenuacion_nuevo_lote" name="atenuacion_nuevo_lote">
                    </div>
                    <div class="col-lg-4">
                        <label for="ibus_nuevo_lote">Amargor (IBU)</label>
                        <input type="text" class="form-control" id="ibus_nuevo_lote" name="ibus_nuevo_lote">
                    </div>
            </div>
            <div class="form-group row">
                <label for="incidencias_nuevo_lote">Incidencias</label>
                <textarea class="form-control" id="incidencias_nuevo_lote" name="incidencias_nuevo_lote"></textarea>
            </div>

                                    <!--*************-->
                                    <!--  BOTONERÍA  -->
                                    <!--*************-->

            <div class="form-group">
                <button type="button" class="btn btn-default" onclick="saveLupulo(this.form)">Guardar</button>
                <button type="button" class="btn btn-checkout" onclick="window.location.href='?c=lote'">Cancelar</button>
            </div>
        </form>
    </article>
</section>