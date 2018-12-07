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

        require_once 'view/fragments/header.php';
        require_once 'view/lote/new_lote.php';
        require_once 'view/fragments/footer.php';
    }
    public function saveLote(){
//        $new_lupulo_data = filter_input_array(INPUT_POST, )

        try{
            if(!$new_lupulo_name = filter_input(INPUT_POST, 'nombre'))throw new Exception('El nombre no es válido');
            if(!$new_lupulo_alfa = filter_input(INPUT_POST, 'alfaacidos', FILTER_VALIDATE_FLOAT))throw new Exception('El valor de alfa ácidos no es válido.');


            echo $this->model->saveNewLote($new_lupulo_name, $new_lupulo_alfa);

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
                <select class="form-control">
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
                    <label>Cantidad (Kilogramos)</label>
                    <input type="text" class="form-control">
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
                <select class="form-control">
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
                    <input type="text" class="form-control">
                </div>
                <div class="col-lg-3">
                    <label>Tiempo (Minutos)</label>
                    <input type="text" class="form-control">
                </div>
                </div>
            ';

            echo $html_output;
            return true;

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }
    }
}//EOC