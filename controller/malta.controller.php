<?php
require_once 'model/malta.model.php';
include_once 'core/output.class.php';
include_once 'core/superlog.class.php';

class MaltaController
{
    private $obj_malta;

    public function __construct(){
        $this->obj_malta = new Malta();
    }

    public function index(){
        $all_maltas = $this->obj_malta->getAllMaltas();

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

            $result = $this->obj_malta->saveNewMalta($new_malta_name, $new_malta_tipo, $new_malta_ebc);

            if($result){
                Output::throwOk();
            }else{
                throw new Exception('No ha sido posible registrar la malta.');
            }

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }
    }
    public function deleteMalta($id = null){
        try{
            $iddel = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

            $result_delete = $this->obj_malta->deleteMaltaById($iddel);
            if($result_delete < 1)throw new Exception("No se pudo eliminar el registro.");

            Output::throwOk();

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }

    }

    public function editMalta(){
        try{
            if(!$id_malta = filter_input(INPUT_GET, 'id_malta', FILTER_VALIDATE_INT)) throw new Exception('El id no es válido.');
            $malta_data = $this->obj_malta->getMaltaById($id_malta);

            require_once "view/fragments/header.php";
            require_once "view/malta/edit_malta.php";
            require_once "view/fragments/footer.php";

        }catch(Exception $e){
            Output::throwError($e->getMessage());
        }
    }

    public function saveEditedMalta(){
        try{

            if(!$id = filter_input(INPUT_POST, 'id_editar_malta', FILTER_VALIDATE_INT))throw new Exception('El id no es válido');
            if(!$nombre = filter_input(INPUT_POST, 'nombre_editar_malta'))throw new Exception('El nombre no es válido');
            if(!$tipo = filter_input(INPUT_POST, 'tipo_editar_malta'))throw new Exception('El tipo no es válido');
            if(!$ebc = filter_input(INPUT_POST, 'ebc_editar_malta', FILTER_VALIDATE_FLOAT))throw new Exception('El valor de alfa ácidos no es válido.');
            $notas = null;

            $update = $this->obj_malta->updateMaltaById($id, $nombre, $tipo, $ebc, $notas);
            if($update < 1){
                Output::throwError('No ha sido posible actualizar la malta.' . $update);
            }else{
                Output::throwOk();
            }


        }catch(Exception $e){
            Output::throwError($e->getMessage());
        }
    }

}//EOC