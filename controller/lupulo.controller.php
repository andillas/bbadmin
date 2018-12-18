<?php
require_once 'model/lupulo.model.php';
include_once 'core/output.class.php';

class LupuloController
{
    private $obj_lupulo;

    public function __construct(){
        $this->obj_lupulo = new Lupulo();
    }

    public function index(){
        $all_lupulos = $this->obj_lupulo->getAllLupulos();

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


            echo $this->obj_lupulo->saveNewLupulo($new_lupulo_name, $new_lupulo_alfa);

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }
    }
    public function deleteLupulo($id = null){
        try{
            $iddel = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

            $result_delete = $this->obj_lupulo->deleteLupuloById($iddel);
            if($result_delete < 1)throw new Exception("No se pudo eliminar el registro.");

            Output::throwOk();

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }

    }

    public function editLuplo(){
        try{
            if(!$id_lupulo = filter_input(INPUT_GET, 'id_lupulo', FILTER_VALIDATE_INT)) throw new Exception('El id no es válido.');
            $lupulo_data = $this->obj_lupulo->getLupuloById($id_lupulo);

            require_once "view/fragments/header.php";
            require_once "view/lupulo/edit_lupulo.php";
            require_once "view/fragments/footer.php";

        }catch(Exception $e){
            Output::throwError($e->getMessage());
        }
    }

    public function saveEditedLupulo(){
        try{

            if(!$id = filter_input(INPUT_POST, 'id_editar_lupulo', FILTER_VALIDATE_INT))throw new Exception('El id no es válido');
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
}