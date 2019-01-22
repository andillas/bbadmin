<script src="assets/js/bootstrap-datepicker-1.6.4-dist/js/bootstrap-datepicker.js"></script>

<script>
    var maltas = 0;
    maltas = <?php echo count($maltas_x_lote);?>;
    var adiciones = 0;
    adiciones = <?php echo count($lupulos_x_lote);?>;

    $(function() {
        $('#cocinado_edited_lote').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: "linked",
            clearBtn: true,
            language: "es",
            autoclose: true,
            todayHighlight: true
        });
        $('#embotellado_edited_lote').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: "linked",
            clearBtn: true,
            language: "es",
            autoclose: true,
            todayHighlight: true
        });
    });
</script>
<section class="container">
    <header><h2>Editar Lote</h2></header>
    <article>
        <form>
            <input type="hidden" id="id_editar_lote" name="id_editar_lote" value="<?php echo $lote_data->id_lote; ?>">

                                    <!--************-->
                                    <!-- DATOS LOTE -->
                                    <!--************-->
            <fieldset>
                <legend>Datos cocinado</legend>
                <div class="form-group row">
                        <div class="col-lg-5">
                            <label for="nombre_edited_lote">Nombre</label>
                            <input type="text" class="form-control" id="nombre_edited_lote" name="nombre_edited_lote" value="<?php echo $lote_data->nombre; ?>">
                        </div>
                        <div class="col-lg-5">
                            <label for="tipo_edited_lote">Tipo</label>
                            <input type="text" class="form-control" id="tipo_edited_lote" name="tipo_edited_lote" value="<?php echo $lote_data->tipo; ?>">
                        </div>
                        <div class="col-lg-2">
                            <label for="referencia_edited_lote">Referencia Lote</label>
                            <input type="text" class="form-control" id="referencia_edited_lote" name="referencia_edited_lote" value="<?php echo $lote_data->ref_lote;?>">
                        </div>
                </div>

                <div class="form-group row">
                        <div class="col-lg-5">
                            <label for="cocinado_edited_lote">Fecha Cocinado</label>
                            <input type="text" class="form-control" id="cocinado_edited_lote" name="cocinado_edited_lote" value="<?php echo $lote_data->fecha_cocinado; ?>">
                        </div>
                        <div class="col-lg-7">
                            <label for="embotellado_edited_lote">Fecha Embotellado</label>
                            <input type="text" class="form-control" id="embotellado_edited_lote" name="embotellado_edited_lote" value="<?php echo $lote_data->fecha_embotellado; ?>">
                        </div>
                </div>

                                        <!--******-->
                                        <!-- AGUA -->
                                        <!--******-->

            <div class="form-group row">
                    <div class="col-lg-4">
                        <label for="agua_macerado_edited_lote">Agua Macerado (Litros)</label>
                        <input type="text" class="form-control" id="agua_macerado_edited_lote" name="agua_macerado_edited_lote"value="<?php echo $lote_data->agua_macerado; ?>">
                    </div>
                    <div class="col-lg-4">
                        <label for="agua_lavado_edited_lote">Agua Lavado (Litros)</label>
                        <input type="text" class="form-control" id="agua_lavado_edited_lote" name="agua_lavado_edited_lote" value="<?php echo $lote_data->agua_lavado; ?>">
                    </div>
                    <div class="col-lg-4">
                        <label for="tiempo_hervido_edited_lote">Tiempo Hervido (Minutos)</label>
                        <input type="text" class="form-control" id="tiempo_hervido_edited_lote" name="tiempo_hervido_edited_lote" value="<?php echo $lote_data->tiempo_hervido; ?>">
                    </div>
            </div>
            </fieldset>

                                    <!--**********-->
                                    <!--  MALTAS  -->
                                    <!--**********-->
            <fieldset>
                <legend>Maltas</legend>
                <div class="form-group row">
                        <div class="col-lg-2">
                            <a class="form-control btn btn-default" style="float: right" onclick="addNewMalta()">Añadir</a>
                        </div>
                        <div class="col-lg-2">
                            <a class="form-control btn btn-default" style="float: right" onclick="delNewMalta()">Quitar</a>
                            <input type="hidden" id="total_maltas" name="total_maltas" value="<?php echo count($maltas_x_lote);?>">
                        </div>
                </div>
                <div class="form-group row" id="area_maltas">
                    <?php echo $html_maltas; ?>
                </div>
            </fieldset>

                                    <!--***********-->
                                    <!--  LÚPULOS  -->
                                    <!--***********-->

            <fieldset>
                <legend>Lúpulos</legend>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <a class="form-control btn btn-default" style="float: right" onclick="addNewAdicion()">Añadir</a>
                    </div>
                    <div class="col-lg-2">
                        <a class="form-control btn btn-default" style="float: right" onclick="delNewAdicion()">Quitar</a>
                        <input type="hidden" id="total_lupulos" name="total_lupulos" value="<?php echo count($lupulos_x_lote);?>">
                    </div>
                </div>
                <div class="form-group row" id="area_lupulos">
                    <?php echo $html_lupulos; ?>
                </div>
            </fieldset>

                                <!--*********************-->
                                <!--  LEVADURA Y AZÚCAR  -->
                                <!--*********************-->
            <fieldset>
                <legend>Otros datos</legend>
                <div class="form-group row">
                        <div class="col-lg-4">
                            <label for="levadura_edited_lote">Levadura</label>
                            <select class="form-control" id="levadura_edited_lote" name="levadura_edited_lote">
                                <option value="">Elige levadura</option>
                                <?php
                                    if($all_levaduras){
                                        foreach ($all_levaduras as $leva) {
                                            $sel = $lote_data->levadura === $leva->id_levadura ? 'selected' : '';
                                            echo '<option value="' . $leva->id_levadura . '" ' . $sel . '>' . $leva->nombre_levadura . '</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label for="azucar_edited_lote">Azúcar (Gramos)</label>
                            <input type="text" class="form-control" id="azucar_edited_lote" name="azucar_edited_lote" value="<?php echo $lote_data->azucar; ?>">
                        </div>
                </div>

                                    <!--**************-->
                                    <!--  RESULTADOS  -->
                                    <!--**************-->

                <div class="form-group row">
                        <div class="col-lg-4">
                            <label for="di_edited_lote">Densidad Inicial</label>
                            <input type="text" class="form-control" id="di_edited_lote" name="di_edited_lote" value="<?php echo $lote_data->densidad_inicial; ?>">
                        </div>
                        <div class="col-lg-4">
                            <label for="df_edited_lote">Densidad Final</label>
                            <input type="text" class="form-control" id="df_edited_lote" name="df_edited_lote" value="<?php echo $lote_data->densidad_final; ?>">
                        </div>
                        <div class="col-lg-4">
                            <label for="litros_edited_lote">Litros Embotellados</label>
                            <input type="text" class="form-control" id="litros_edited_lote" name="litros_edited_lote" value="<?php echo $lote_data->litros_embotellados; ?>">
                        </div>
                </div>

                <div class="form-group row">
                        <div class="col-lg-4">
                            <label for="alcohol_edited_lote">Graduación Alcohólica</label>
                            <input type="text" class="form-control" id="alcohol_edited_lote" name="alcohol_edited_lote" value="<?php echo $lote_data->graduacion; ?>">
                        </div>
                        <div class="col-lg-4">
                            <label for="atenuacion_edited_lote">Atenuación</label>
                            <input type="text" class="form-control" id="atenuacion_edited_lote" name="atenuacion_edited_lote" value="<?php echo $lote_data->atenuacion; ?>">
                            <input type="button" class="form-control" value="Calcular">
                        </div>
                        <div class="col-lg-4">
                            <label for="ibus_edited_lote">Amargor (IBU)</label>
                            <input type="text" class="form-control" id="ibus_edited_lote" name="ibus_edited_lote" value="<?php echo $lote_data->ibus; ?>">
                        </div>
                        <div class="col-lg-12">
                            <label for="incidencias_edited_lote">Incidencias</label>
                            <textarea class="form-control" id="incidencias_edited_lote" name="incidencias_edited_lote"><?php echo $lote_data->incidencias; ?></textarea>
                        </div>
                </div>
            </fieldset>

                                    <!--*************-->
                                    <!--  BOTONERÍA  -->
                                    <!--*************-->

            <div class="form-group botonera">
                <button type="button" class="btn btn-default" onclick="saveEditedLote(this.form)">Guardar</button>
                <button type="button" class="btn btn-checkout" onclick="window.location.href='./lote'">Cancelar</button>
            </div>
        </form>
    </article>
</section>