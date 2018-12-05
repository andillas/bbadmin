<?php
require_once 'model/malta.model.php';
include_once 'utils/output.class.php';

class MaltaController
{
    private $model;

    public function __construct(){
        $this->model = new Malta();
    }

    public function index(){
        $all_maltas = $this->model->getAllMaltas();

        require_once 'view/fragments/header.php';
        require_once 'view/malta/list_malta.php';
        require_once 'view/fragments/footer.php';
    }
    public function newMalta(){
        require_once 'view/fragments/header.php';
        require_once 'view/malta/new_malta.php';
        require_once 'view/fragments/footer.php';
    }
    public function saveMalta(){
//        $new_malta_data = filter_input_array(INPUT_POST, )

        try{
            if(!$new_malta_name = filter_input(INPUT_POST, 'nombre'))throw new Exception('El nombre no es válido');
            if(!$new_malta_tipo = filter_input(INPUT_POST, 'tipo'))throw new Exception('El tipo no es válido');
            if(!$new_malta_ebc = filter_input(INPUT_POST, 'ebc', FILTER_VALIDATE_FLOAT))throw new Exception('El valor de alfa ácidos no es válido.');


            echo $this->model->saveNewMalta($new_malta_name, $new_malta_tipo, $new_malta_ebc);

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }
    }
    public function deleteMalta($id = null){
        try{
            $iddel = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

            $result_delete = $this->model->deleteMaltaById($iddel);
            if($result_delete < 1)throw new Exception("No se pudo eliminar el registro.");

            Output::throwOk();

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }

    }
}//EOC