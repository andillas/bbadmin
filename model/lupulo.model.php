<?php
/**
 * Created by PhpStorm.
 * User: eugenio
 * Date: 29/11/2018
 * Time: 12:56
 */
require_once 'conn.class.php';

class Lupulo
{
    /**
     * @var mysqli
     */
    private $conn;
    /**
     * @var string
     */
    private $lupulo;
    /**
     * @var float
     */
    private $alfaacidos;

    /**
     * Lupulo constructor.
     */
    public function __construct(){
        $dbconn = Conn::getInstance();
        $this->conn = $dbconn->getConnection();
    }

    /**
     * @param string $nombre
     * @param float $aa
     * @param string $notas
     * @return mixed|string
     */
    public function saveNewLupulo($nombre, $aa, $notas = NULL){
        try{
            $sql = "INSERT INTO lupulo(nombre_lupulo, alfa_acidos, notas_lupulo) VALUES(?, ?, ?);";
            $qy = $this->conn->prepare($sql);
            $qy->bind_param('sds', $nombre, $aa, $notas);
            if(!$qy->execute())throw new Exception($qy->error);

            return $this->conn->insert_id;
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * @param integer $id
     * @return object|stdClass|string
     */
    public function getLupuloById($id){
        try{
            $sql = "SELECT * FROM lupulo WHERE id_lupulo = ? LIMIT 1;";
            $qy = $this->conn->prepare($sql);
            $qy->bind_param('i', $id);
            if(!$qy->execute())throw new Exception($qy->error);

            return $qy->get_result()->fetch_object();
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * @return bool|mysqli_result|string
     */
    public function getAllLupulos(){
        try{
            $sql = "SELECT * FROM lupulo WHERE 1 ORDER BY nombre_lupulo ASC;";
            $qy = $this->conn->prepare($sql);
            if(!$qy->execute()) throw new Exception($qy->error);

            return $qy->get_result();
        }catch (Exception $e){
            return $e->getMessage();
        }
    }
    public function deleteLupuloById($id){
        try{
            $sql = "DELETE FROM lupulo WHERE id_lupulo = ?;";
            $qy = $this->conn->prepare($sql);
            $qy->bind_param('i', $id);

            if(!$qy->execute())throw new Exception($qy->error);

            return $qy->num_rows;
        }catch (Exception $e){
            return $e->getMessage();
        }
    }
    public function usosLupuloByIdLupulo($id_lupulo){
        try{
            $sql = "SELECT COUNT(*) AS total_usos FROM lupulo_x_batch WHERE id_lupulo = ?;";
            if(!$qy = $this->conn->prepare($sql)) throw new Exception($this->conn->error);
            if(!$qy->bind_param('i', $id_lupulo)) throw new Exception($qy->error);
            if(!$qy->execute()) throw new Exception($qy->error);

            return $qy->get_result()->fetch_object();

        }catch(Exception $e){
            Superlog::log($e->getMessage());
            return false;
        }
    }
    public function cantidadLupuloByIdLupulo($id_lupulo){
        try{
            $sql = "SELECT SUM(cantidad) cantidad FROM lupulo_x_batch WHERE id_lupulo = ?;";
            if(!$qy = $this->conn->prepare($sql))throw new Exception($this->conn->error);
            if(!$qy->bind_param('i', $id_lupulo)) throw new Exception($qy->error);
            if(!$qy->execute()) throw new Exception($qy->error);

            return $qy->get_result()->fetch_object();

        }catch(Exception $e){
            Superlog::log($e->getMessage());
            return false;
        }
    }

    //GETTERS Y SETTERS

    /**
     * @return mixed
     */
    public function getLupulo()
    {
        return $this->lupulo;
    }

    /**
     * @param mixed $lupulo
     */
    public function setLupulo($lupulo)
    {
        $this->lupulo = $lupulo;
    }

    /**
     * @return mixed
     */
    public function getAlfaacidos()
    {
        return $this->alfaacidos;
    }

    /**
     * @param mixed $alfaacidos
     */
    public function setAlfaacidos($alfaacidos)
    {
        $this->alfaacidos = $alfaacidos;
    }
}