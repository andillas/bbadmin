<?php
require_once 'model/lote.model.php';
require_once 'model/lupulo.model.php';
require_once 'model/malta.model.php';
require_once 'model/levadura.model.php';
include_once 'utils/output.class.php';

class LoteController
{
    private $model;

    public function __construct(){
        $this->model = new Lote();
    }

    public function index(){
        //all_lotes se usará en list_lote.php
        $all_lotes = $this->model->getAllLotes();

        require_once 'view/fragments/header.php';
        require_once 'view/lote/list_lote.php';
        require_once 'view/fragments/footer.php';
    }
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

        $new_lote_referencia = $this->getLoteReferencia()->ref_lote;

        require_once 'view/fragments/header.php';
        require_once 'view/lote/new_lote.php';
        require_once 'view/fragments/footer.php';
    }
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

            var_dump($nombre_nuevo_lote);
            var_dump($tipo_nuevo_lote);
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
            if(!$id_lote = $this->model->saveLote($lote_formdata))throw new Exception($id_lote);
            if(count($maltas) > 0)$this->model->saveLoteMalta($maltas, $id_lote);
            if(count($lupulos) > 0)$this->model->saveLoteLupulo($lupulos, $id_lote);

            Output::throwOk('tudo bem');

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }
    }
    public function deleteLote($id = null){
        try{
            $iddel = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

            $result_delete = $this->model->deleteLoteById($iddel);
            if($result_delete < 1)throw new Exception("No se pudo eliminar el registro.");

            Output::throwOk();

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }

    }
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

            echo $html_output;
            return true;

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }
    }
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
                <div class="col-lg-4">
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
                <div class="col-lg-3">
                    <label>Cantidad (Gramos)</label>
                    <input type="text" class="form-control" name="cantidad_lupulo_'.$orden.'">
                </div>
                <div class="col-lg-3">
                    <label>Tiempo (Minutos)</label>
                    <input type="text" class="form-control" name="tiempo_lupulo_'.$orden.'">
                </div>
                </div>
            ';

            echo $html_output;
            return true;

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }
    }
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
    private function getLoteReferencia(){
        try{
            if(!$all_lotes = $this->model->getAllLotes()->fetch_object())
                throw new Exception('No ha sido posible recuperar la referencia del lote anterior.');
            return $all_lotes;
        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }
    }
}//EOC