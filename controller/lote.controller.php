<?php
require_once 'model/lote.model.php';
require_once 'model/lupulo.model.php';
require_once 'model/malta.model.php';
require_once 'model/levadura.model.php';
include_once 'core/output.class.php';
include_once 'core/superlog.class.php';

class LoteController
{
    private $obj_lote;

    public function __construct(){
        $this->obj_lote = new Lote();
    }

    /**
     *Acción por defecto que carga el listado de lotes
     */
    public function index(){
        //all_lotes se usará en list_lote.php
        $all_lotes = $this->obj_lote->getAllLotes();

        require_once 'view/fragments/header.php';
        require_once 'view/lote/list_lote.php';
        require_once 'view/fragments/footer.php';
    }

    /**
     *Acción que muestra el listado actual de lotes
     */
    public function newLote(){
        $obj_levadura = new Levadura();
        $obj_lupulo = new Lupulo();
        $all_levaduras = [];
        $all_lupulos = [];

        $result_levaduras = $obj_levadura->getAllLevaduras();
        while ($levadura = $result_levaduras->fetch_object()){
            $all_levaduras[] = $levadura;
        }

        $result_lupulos = $obj_lupulo->getAllLupulos();
        while ($lupulo = $result_lupulos->fetch_object()){
            $all_lupulos[] = $lupulo;
        }

        $new_lote_referencia = $this->getLoteReferencia();

        require_once 'view/fragments/header.php';
        require_once 'view/lote/new_lote.php';
        require_once 'view/fragments/footer.php';
    }

    /**
     *Acción que guarda el formulario de nuevo lote
     */
    public function saveLote(){
        try{
//                $obj_malta = new Malta();
//                $obj_lupulo = new Lupulo();
/*
            $filters = array(
                'numero_nuevo_lote' => FILTER_VALIDATE_INT,
                'agua_macerado_nuevo_lote' => FILTER_VALIDATE_INT,
                'agua_lavado_nuevo_lote' => FILTER_VALIDATE_INT
            );

            $datos_lote = filter_input_array(INPUT_POST, $filters);
*/

//            var_dump($_POST);
/*
            if(!$nombre_nuevo_lote = filter_input(INPUT_POST, 'nombre_nuevo_lote'))throw new Exception('El nombre no es válido');
            if(!$tipo_nuevo_lote = filter_input(INPUT_POST, 'nombre_nuevo_lote'))throw new Exception('El nombre no es válido');
            if(!$numero_nuevo_lote = filter_input(INPUT_POST, 'tipo_nuevo_lote', FILTER_VALIDATE_FLOAT))throw new Exception('El valor de alfa ácidos no es válido.');
            if(!$cocinado_nuevo_lote = filter_input(INPUT_POST, 'tipo_nuevo_lote'))throw new Exception('El valor de alfa ácidos no es válido.');
            if(!DateTime::createFromFormat('d-m-Y', $cocinado_nuevo_lote))throw new Exception('Fecha de cocinado no válida.');
*/

$lote_formdata = [
                "nombre_nuevo_lote" => $_POST['nombre_nuevo_lote'],
                "tipo_nuevo_lote" => $_POST['tipo_nuevo_lote'],
                "referencia_nuevo_lote" => $_POST['referencia_nuevo_lote'],
                "cocinado_nuevo_lote" => $_POST['cocinado_nuevo_lote'],
                "embotellado_nuevo_lote" => $_POST['embotellado_nuevo_lote'],
                "agua_macerado_nuevo_lote" => $_POST['agua_macerado_nuevo_lote'],
                "agua_lavado_nuevo_lote" => $_POST['agua_lavado_nuevo_lote'],
                "tiempo_hervido_nuevo_lote" => $_POST['tiempo_hervido_nuevo_lote'],
                "total_maltas" => $_POST['total_maltas'],
                "total_lupulos" => $_POST['total_lupulos'],
                "levadura_nuevo_lote" => $_POST['levadura_nuevo_lote'],
                "azucar_nuevo_lote" => $_POST['azucar_nuevo_lote'],
                "di_nuevo_lote" => $_POST['di_nuevo_lote'],
                "df_nuevo_lote" => $_POST['df_nuevo_lote'],
                "litros_nuevo_lote" => $_POST['litros_nuevo_lote'],
                "alcohol_nuevo_lote" => $_POST['alcohol_nuevo_lote'],
                "atenuacion_nuevo_lote" => $_POST['atenuacion_nuevo_lote'],
                "ibus_nuevo_lote" => $_POST['ibus_nuevo_lote'],
                "incidencias_nuevo_lote" => $_POST['incidencias_nuevo_lote'],
            ];

            //genero objetos con las maltas y los lúpulos para guardarlos
            $maltas = $this->getAddedMaltas();
            $lupulos = $this->getAddedLupulos();

            //guardo lote y recupero el id generado para asociarle maltas y lúpulos en malta_x_lote y lupulo_x_lote
            if(!$id_lote = $this->obj_lote->saveLote($lote_formdata))throw new Exception('Se produjo un error en la inserción.');
            if(count($maltas) > 0){
                if(!$this->obj_lote->saveLoteMalta($maltas, $id_lote))Output::throwError('No ha sido posible guardar la malta.');
            }
            if(count($lupulos) > 0){
                if(!$this->obj_lote->saveLoteLupulo($lupulos, $id_lote))Output::throwError('No ha sido posible guardarr el lúpulo.');
            }

            Output::throwOk();

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }
    }

    /**
     * Elimina el lote con el id dado
     * @param integer $id
     */
    public function deleteLote($id = null){
        try{
            $iddel = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

            $result_delete = $this->obj_lote->deleteLoteById($iddel);
            if($result_delete < 1)throw new Exception("No se pudo eliminar el registro.");

            Output::throwOk();

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }

    }

    public function editLote(){
        try{
            Superlog::log(__METHOD__);
            if(!$id_lote = filter_input(INPUT_GET, 'id_lote', FILTER_VALIDATE_INT)) throw new Exception('El id no es válido');
            $obj_levadura = new Levadura();
            $obj_lupulo = new Lupulo();
            $all_levaduras = [];
            $all_lupulos = [];
            $maltas_x_lote = [];
            $lupulos_x_lote = [];
            $html_maltas = '';
            $html_lupulos = '';

            $result_levaduras = $obj_levadura->getAllLevaduras();
            while ($levadura = $result_levaduras->fetch_object()){
                $all_levaduras[] = $levadura;
            }

            $result_lupulos = $obj_lupulo->getAllLupulos();
            while ($lupulo = $result_lupulos->fetch_object()){
                $all_lupulos[] = $lupulo;
            }

            $result_maltas_lote = $this->obj_lote->getMaltas_x_Lote($id_lote);
            while ($maltalote = $result_maltas_lote->fetch_object()){
                $maltas_x_lote[] = $maltalote;
            }

            $result_lupulos_lote = $this->obj_lote->getLupulos_x_Lote($id_lote);
            while ($lupulolote = $result_lupulos_lote->fetch_object()){
                $lupulos_x_lote[] = $lupulolote;
            }

            $html_maltas = $this->getEditMaltaHtml($maltas_x_lote);
            $html_lupulos = $this->getEditAdicionHtml($lupulos_x_lote);

            $lote_data = $this->obj_lote->getLoteById($id_lote);

            require_once "view/fragments/header.php";
            require_once "view/lote/edit_lote.php";
            require_once "view/fragments/footer.php";
        }catch (Exception $e){
            Superlog::log($e->getMessage());
            Output::throwError($e->getMessage());
        }
        exit;
    }

    /**
     * Devuelve el código HTML con los campos necesarios para añadir una nueva malta al lote.
     * @return string
     */
    public function getNewMaltaHtml(){
        try{
            $orden = $_POST['orden'];
            $html_output = '';
            $all_maltas = [];
            $obj_malta = new Malta();
            $result_malta = $obj_malta->getAllMaltas();

            while ($malta = $result_malta->fetch_object()){
                $all_maltas[] = $malta;
            }

            $html_output .= '
                <div id="malta_'.$orden.'">
                <div class="col-lg-5">
                <label>Nombre Malta '.$orden.'</label>
                <select class="form-control" name="malta_'.$orden.'">
                <option value="null">Elige Malta</option>';

            if($all_maltas){
                foreach ($all_maltas as $malta) {
                    $html_output .= '<option value="' . $malta->id_malta . '">' . $malta->nombre_malta . '</option>';
                }
            }

            $html_output .= '
                </select>
                </div>
                <div class="col-lg-4">
                    <label>Cantidad (Gramos)</label>
                    <input type="text" class="form-control" name="cantidad_malta_'.$orden.'">
                </div>
                </div>
            ';

            Output::throwContent($html_output);

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }
    }




       public function getEditMaltaHtml($maltas){
        try{
            //Superlog::log(__METHOD__);
            $orden = 0;
            $html_output = '';
            $all_maltas = [];
            $obj_malta = new Malta();
            $result_malta = $obj_malta->getAllMaltas();

            while ($malta = $result_malta->fetch_object()){
                $all_maltas[] = $malta;
            }

            foreach ($maltas as $mlt) {
                $orden ++;

                $html_output .= '
                    <div id="malta_'.$orden.'">
                    <div class="col-lg-5">
                    <label>Nombre Malta '.$orden.'</label>
                    <select class="form-control" name="malta_'.$orden.'">
                    <option value="null">Elige Malta</option>';

                if($all_maltas){
                    foreach ($all_maltas as $malta) {
                        $sel = $mlt->id_malta === $malta->id_malta ? 'selected' : '';
                        $html_output .= '<option value="' . $malta->id_malta . '" '.$sel.'>' . $malta->nombre_malta . '</option>';
                    }
                }

                $html_output .= '
                    </select>
                    </div>
                    <div class="col-lg-4">
                        <label>Cantidad (Gramos)</label>
                        <input type="text" class="form-control" name="cantidad_malta_'.$orden.'" value="'.$mlt->cantidad.'">
                    </div>
                    </div>
                ';

            }


            return $html_output;

        }catch (Exception $e){
            Superlog::log(__METHOD__);
            Superlog::log($e->getMessage());
            Output::throwError($e->getMessage());
        }
        exit;
    }





    /**
     * @return bool
     */
    public function getNewAdicionHtml(){
        try{
            $orden = $_POST['orden'];
            $html_output = '';
            $all_lupulos = [];
            $obj_lupulo = new Lupulo();
            $result_lupulo = $obj_lupulo->getAllLupulos();

            while ($lupulo = $result_lupulo->fetch_object()){
                $all_lupulos[] = $lupulo;
            }

            $html_output .= '
                <div id="lupulo_'.$orden.'">
                <div class="col-lg-5">
                <label>Nombre Lúpulo '.$orden.'</label>
                <select class="form-control" name="lupulo_'.$orden.'">
                <option value="null">Elige lúpulo</option>';

            if($all_lupulos){
                foreach ($all_lupulos as $lupulo) {
                    $html_output .= '<option value="' . $lupulo->id_lupulo . '">' . $lupulo->nombre_lupulo . '</option>';
                }
            }

            $html_output .= '
                </select>
                </div>
                <div class="col-lg-2">
                    <label>Cantidad (Gramos)</label>
                    <input type="text" class="form-control" name="cantidad_lupulo_'.$orden.'">
                </div>
                <div class="col-lg-2">
                    <label>Tiempo (Minutos)</label>
                    <input type="text" class="form-control" name="tiempo_lupulo_'.$orden.'">
                </div>
                </div>
            ';

            Output::throwContent($html_output);

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }
    }
    public function getEditAdicionHtml($lupulos){
        try{
            Superlog::log(__METHOD__);

            $orden = 0;
            $html_output = '';
            $all_lupulos = [];
            $obj_lupulo = new Lupulo();
            $result_lupulo = $obj_lupulo->getAllLupulos();

            while ($lupulo = $result_lupulo->fetch_object()){
                $all_lupulos[] = $lupulo;
            }

            foreach ($lupulos as $lpl) {

                $orden ++;

                $html_output .= '
                    <div id="lupulo_'.$orden.'">
                    <div class="col-lg-5">
                    <label>Nombre Lúpulo '.$orden.'</label>
                    <select class="form-control" name="lupulo_'.$orden.'">
                    <option value="null">Elige lúpulo</option>';

                if($all_lupulos){
                    foreach ($all_lupulos as $lupulo) {
                        $sel = $lpl->id_lupulo === $lupulo->id_lupulo ? 'selected' : '';
                        $html_output .= '<option value="' . $lupulo->id_lupulo . '" '.$sel.'>' . $lupulo->nombre_lupulo . '</option>';
                    }
                }

                $html_output .= '
                    </select>
                    </div>
                    <div class="col-lg-2">
                        <label>Cantidad (Gramos)</label>
                        <input type="text" class="form-control" name="cantidad_lupulo_'.$orden.'" value="'.$lpl->cantidad.'">
                    </div>
                    <div class="col-lg-2">
                        <label>Tiempo (Minutos)</label>
                        <input type="text" class="form-control" name="tiempo_lupulo_'.$orden.'" value="'.$lpl->tiempo.'">
                    </div>
                    </div>
                ';
            }

            return $html_output;

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }
    }

    /**
     * @return array
     */
    private function getAddedMaltas(){
        $maltas = [];
        $total_maltas = (integer)$_POST['total_maltas'];

        for($m = 1; $total_maltas >= $m; $m ++){
            $newmalta = [];
            $newmalta['tipo'] = (integer)$_POST['malta_'.$m];
            $newmalta['cantidad'] = (integer)$_POST['cantidad_malta_'.$m];

            $maltas[] = $newmalta;
        }
        return $maltas;
    }

    /**
     * @return array
     */
    private function getAddedLupulos(){
        $lupulos = [];
        $total_lupulos = (integer)$_POST['total_lupulos'];

        for($m = 1; $total_lupulos >= $m; $m ++){
            $newlupulo = [];
            $newlupulo['tipo'] = (integer)$_POST['lupulo_'.$m];
            $newlupulo['cantidad'] = (integer)$_POST['cantidad_lupulo_'.$m];
            $newlupulo['tiempo'] = (integer)$_POST['tiempo_lupulo_'.$m];

            $lupulos[] = $newlupulo;
        }
        return $lupulos;
    }

    /**
     * Devuelve la referencia del nuevo lote calculada en base a la anterior generada
     * El formato es: 0012/007-18.
     * Cuatro dígitos para el número total de lote.
     * Tres dígitos para el parcial de lotes para el año corriente.
     * Dos dígitos para el año corriente.
     * @return string
     */
    private function getLoteReferencia(){
        try{

            //Recupero todos los lotes y extraigo el más reciente. Lo recorto en lote general, parcial y año.
            //Si ha cambiado de año, reseteo el parcial anual
            $arr_lotes = [];
            if(!$all_lotes = $this->obj_lote->getAllLotes())
                throw new Exception('No ha sido posible recuperar la referencia del lote anterior.');
            while($lote = $all_lotes->fetch_object()){
                $arr_lotes[] = $lote;
            }
            $last_lote = end($arr_lotes);

            $obj_date = new DateTime();
            $anio = $obj_date->format('y');

            $ref_parts = explode('/', $last_lote->ref_lote);
            $ref_total_lotes = $ref_parts[0];
            $ref_anio_last_lote = explode('-', $ref_parts[1])[1];
            $ref_lotes_anio = $ref_anio_last_lote === $anio ? explode('-', $ref_parts[1])[0] : 0;

            $ref_new_lote = (str_pad($ref_total_lotes + 1, 4, '0', STR_PAD_LEFT))
                            . '/' . (str_pad($ref_lotes_anio + 1, 3, '0', STR_PAD_LEFT))
                            . '-' . $anio;

            return $ref_new_lote;
        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }
    }
}//EOC