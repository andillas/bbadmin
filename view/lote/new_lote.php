<script src="assets/js/bootstrap-datepicker-1.6.4-dist/js/bootstrap-datepicker.js"></script>

<script>
    var maltas = 0;
    var adiciones = 0;

    $(function() {
        $('#cocinado_nuevo_lote').datepicker({
            format: "yyyy/mm/dd",
            todayBtn: "linked",
            clearBtn: true,
            language: "es",
            autoclose: true,
            todayHighlight: true
        });
        $('#embotellado_nuevo_lote').datepicker({
            format: "yyyy/mm/dd",
            todayBtn: "linked",
            clearBtn: true,
            language: "es",
            autoclose: true,
            todayHighlight: true
        });
    });
</script>
<section class="container">
    <header><h2>Nuevo Lote</h2></header>
    <article>
        <form>

                                    <!--************-->
                                    <!-- DATOS LOTE -->
                                    <!--************-->
            <fieldset>
                <legend>Datos cocinado</legend>
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
                            <label for="referencia_nuevo_lote">Referencia Lote</label>
                            <input type="text" class="form-control" id="referencia_nuevo_lote" name="referencia_nuevo_lote" value="<?php echo $new_lote_referencia;?>">
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
            </fieldset>

                                    <!--**********-->
                                    <!--  MALTAS  -->
                                    <!--**********-->
            <div class="row" style="padding: 5px;background-color: crimson">
            <fieldset class="col-lg-5" style="display: block">
                <legend>Maltas</legend>
                <div class="form-group row">
                        <div class="col-lg-2">
                            <a class="form-control btn btn-default" style="float: right" onclick="addNewMalta()">Añadir</a>
                        </div>
                        <div class="col-lg-2">
                            <a class="form-control btn btn-default" style="float: right" onclick="delNewMalta()">Quitar</a>
                            <input type="hidden" id="total_maltas" name="total_maltas" value="0">
                        </div>
                </div>
                <div class="form-group row" id="area_maltas"></div>
            </fieldset>

                                    <!--***********-->
                                    <!--  LÚPULOS  -->
                                    <!--***********-->

            <fieldset class="col-lg-5">
                <legend>Lúpulos</legend>
                <div class="form-group row">
                    <div class="col-lg-2">
                        <a class="form-control btn btn-default" style="float: right" onclick="addNewAdicion()">Añadir</a>
                    </div>
                    <div class="col-lg-2">
                        <a class="form-control btn btn-default" style="float: right" onclick="delNewAdicion()">Quitar</a>
                        <input type="hidden" id="total_lupulos" name="total_lupulos" value="0">
                    </div>
                </div>
                <div class="form-group row" id="area_lupulos"></div>
            </fieldset>
            </div>


                                <!--*********************-->
                                <!--  LEVADURA Y AZÚCAR  -->
                                <!--*********************-->
            <fieldset>
                <legend>Otros datos</legend>
                <div class="form-group row">
                        <div class="col-lg-4">
                            <label for="levadura_nuevo_lote">Levadura</label>
                            <select class="form-control" id="levadura_nuevo_lote" name="levadura_nuevo_lote">
                                <option value="">Elige levadura</option>
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
                            <input type="button" class="form-control" value="Calcular">
                        </div>
                        <div class="col-lg-4">
                            <label for="ibus_nuevo_lote">Amargor (IBU)</label>
                            <input type="text" class="form-control" id="ibus_nuevo_lote" name="ibus_nuevo_lote">
                        </div>
                        <div class="col-lg-12">
                            <label for="incidencias_nuevo_lote">Incidencias</label>
                            <textarea class="form-control" id="incidencias_nuevo_lote" name="incidencias_nuevo_lote"></textarea>
                        </div>
                </div>
            </fieldset>

                                    <!--*************-->
                                    <!--  BOTONERÍA  -->
                                    <!--*************-->

            <div class="form-group botonera">
                <button type="button" class="btn btn-default" onclick="saveLote(this.form)">Guardar</button>
                <button type="button" class="btn btn-checkout" onclick="window.location.href='?c=lote'">Cancelar</button>
            </div>
        </form>
    </article>
</section>