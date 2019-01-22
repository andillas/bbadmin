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
        exit;
    }
    public function newLupulo(){
        require_once 'view/fragments/header.php';
        require_once 'view/lupulo/new_lupulo.php';
        require_once 'view/fragments/footer.php';
        exit;
    }
    public function saveLupulo(){
//        $new_lupulo_data = filter_input_array(INPUT_POST, )

        try{
            if(!$new_lupulo_name = filter_input(INPUT_POST, 'nombre'))throw new Exception('El nombre no es válido');
            if(!$new_lupulo_alfa = filter_input(INPUT_POST, 'alfaacidos', FILTER_VALIDATE_FLOAT))throw new Exception('El valor de alfa ácidos no es válido.');

            $last_id = $this->obj_lupulo->saveNewLupulo($new_lupulo_name, $new_lupulo_alfa);
            if(!$last_id > 0){
                throw new Exception("Ocurrió un error en la inserción.");
            }else{
                Output::throwContent($last_id);
            }

        }catch (Exception $e){
            Output::throwError($e->getMessage());
        }
        exit;
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
        exit;
    }

    public function editLupulo(){
        try{
            if(!$id_lupulo = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) throw new Exception('El id no es válido.');
            $lupulo_data = $this->obj_lupulo->getLupuloById($id_lupulo);

            require_once "view/fragments/header.php";
            require_once "view/lupulo/edit_lupulo.php";
            require_once "view/fragments/footer.php";

        }catch(Exception $e){
            Output::throwError($e->getMessage());
        }
        exit;
    }

    public function saveEditedLupulo(){
        try{

            if(!$id = filter_input(INPUT_POST, 'id_editar_lupulo', FILTER_VALIDATE_INT))throw new Exception('El id no es válido');
            if(!$nombre = filter_input(INPUT_POST, 'nombre_editar_lupulo'))throw new Exception('El nombre no es válido');
            if(!$alfaacidos = filter_input(INPUT_POST, 'alfaacidos_editar_lupulo', FILTER_VALIDATE_FLOAT))throw new Exception('El valor de Alfa Ácidos no es válido');
            $notas = null;

            $update = $this->obj_lupulo->updateLupuloById($id, $nombre, $alfaacidos, $notas);
            if($update < 1){
                Output::throwError('No ha sido posible actualizar el lúpulo.' . $update);
            }else{
                Output::throwOk();
            }
        }catch(Exception $e){
            Output::throwError($e->getMessage());
        }
        exit;
    }
}