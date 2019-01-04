<?php
/**
 * Created by PhpStorm.
 * User: eugenio
 * Date: 29/11/2018
 * Time: 12:56
 */
require_once 'conn.class.php';
require_once 'core/sqlpreparedviewer.class.php';

class Malta
{
    /**
     * @var mysqli
     */
    private $conn;

    /**
     * Malta constructor.
     */
    public function __construct()
    {
        $dbconn = Conn::getInstance();
        $this->conn = $dbconn->getConnection();
    }


    /**
     * @param $nombre
     * @param $tipo
     * @param $ebc
     * @param null $notas
     * @return mixed|string
     */
    public function saveNewMalta($nombre, $tipo, $ebc, $notas = NULL)
    {
        try {
            $sql = "INSERT INTO malta(nombre_malta, tipo_malta, ebc, notas_malta) VALUES(?, ?, ?, ?);";
            $qy = $this->conn->prepare($sql);
            $qy->bind_param('ssis', $nombre, $tipo, $ebc, $notas);
            if (!$qy->execute()) throw new Exception($qy->error);

            return $this->conn->insert_id;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param integer $id
     * @return object|stdClass|string
     */
    public function getMaltaById($id)
    {
        try {
            $sql = "SELECT * FROM malta WHERE id_malta = ? LIMIT 1;";
            $qy = $this->conn->prepare($sql);
            $qy->bind_param('i', $id);
            if (!$qy->execute()) throw new Exception($qy->error);

            return $qy->get_result()->fetch_object();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return bool|mysqli_result|string
     */
    public function getAllMaltas()
    {
        try {
            $sql = "SELECT * FROM malta WHERE 1 ORDER BY nombre_malta ASC;";
            $qy = $this->conn->prepare($sql);
            if (!$qy->execute()) throw new Exception($qy->error);

            return $qy->get_result();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteMaltaById($id)
    {
        try {
            $sql = "DELETE FROM malta WHERE id_malta = ?;";
            $qy = $this->conn->prepare($sql);
            $qy->bind_param('i', $id);

            if (!$qy->execute()) throw new Exception($qy->error);

            return $qy->affected_rows;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateMaltaById($id, $nombre, $tipo, $ebc, $notas){
        try{
            Superlog::log('updateMaltaById');
            $sql = 'UPDATE malta SET nombre_malta = ?, tipo_malta = ?, ebc = ?, notas_malta = ? WHERE id_malta = ?;';
            if(!$qy = $this->conn->prepare($sql)) throw new Exception($this->conn->error);
            if(!$qy->bind_param('ssdsi', $nombre, $tipo, $ebc, $notas, $id)) throw new Exception($qy->error);
            if(!$qy->execute()) throw new Exception($qy->error);

//            $pv = new SqlPreparedViewer($sql, 'ssdsi', [$nombre, $tipo, $ebc, $notas, $id]);
//            $s = $pv->getQuery();
//            Superlog::log($s);

            return $qy->affected_rows;

        }catch(Exception $e){
            Superlog::log($e->getMessage());
            return false;
        }
    }

    public function numeroUsosById($id_malta){
        try{
            $sql = "SELECT COUNT(*) AS total FROM malta_x_lote WHERE id_malta = ?;";
            if(!$qy = $this->conn->prepare($sql)) throw new Exception($this->conn->error);
            if(!$qy->bind_param('i', $id_malta)) throw new Exception($qy->error);
            if(!$qy->execute()) throw new Exception($qy->error);

            return $qy->get_result()->fetch_object();

        }catch(Exception $e){
            Superlog::log($e->getMessage());
            return false;
        }
    }

    public function cantidadUsadaById($id_malta){
        try{
            $sql = "SELECT SUM(cantidad) cantidad FROM malta_x_lote WHERE id_malta = ?;";
            if(!$qy = $this->conn->prepare($sql))throw new Exception($this->conn->error);
            if(!$qy->bind_param('i', $id_malta)) throw new Exception($qy->error);
            if(!$qy->execute()) throw new Exception($qy->error);

            return $qy->get_result()->fetch_object();

        }catch(Exception $e){
            Superlog::log($e->getMessage());
            return false;
        }
    }
}//EOC