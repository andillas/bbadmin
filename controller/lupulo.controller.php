<?php
require_once 'model/lupulo.model.php';
include_once 'utils/output.class.php';

class LupuloController
{
    private $model;

    public function __construct(){
        $this->model = new Lupulo();
    }

    public function index(){
        $all_lupulos = $this->model->getAllLupulos();

        require_once 'view/fragments/header.php';
        require_once 'view/lupulo/list_lupulo.php';
        require_once 'view/fragments/footer.php';
    }
    public function newLupulo(){
        require_once 'view/fragments/header.php';
        require_once 'view/lupulo/new_lupulo.php';
        require_once 'view/fragments/footer.php';
    }
    public function saveLupulo(){
//        $new_lupulo_data = filter_input_array(INPUT_POST, )

        try{
            if(!$new_lupulo_name = filter_input(INPUT_POST, 'nombre'))throw new Exception('El nombre no es válido');
            if(!$new_lupulo_alfa = filter_input(INPUT_POST, 'alfaacidos', FILTER_VALIDATE_FLOAT))throw new Exception('El valor de alfa ácidos no es válido.');


            echo $this->model->saveNewLupulo($new_lupulo_name, $new_lupulo_alfa);

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }
    }
    public function deleteLupulo($id = null){
        try{
            $iddel = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

            $result_delete = $this->model->deleteLupuloById($iddel);
            if($result_delete < 1)throw new Exception("No se pudo eliminar el registro.");

            Output::throwOk();

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }

    }
}