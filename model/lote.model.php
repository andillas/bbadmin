<?php
/**
 * Created by PhpStorm.
 * User: eugenio
 * Date: 29/11/2018
 * Time: 12:56
 */
require_once 'conn.class.php';

class Lote
{
    /**
     * @var mysqli
     */
    private $conn;

    /**
     * Lote constructor.
     */
    public function __construct()
    {
        $dbconn = Conn::getInstance();
        $this->conn = $dbconn->getConnection();
    }

    public function saveNewLote($nombre, $aa, $notas = NULL)
    {
        try {
            $sql = "INSERT INTO lupulo(nombre_lupulo, alfa_acidos, notas_lupulo) VALUES(?, ?, ?);";
            $qy = $this->conn->prepare($sql);
            $qy->bind_param('sds', $nombre, $aa, $notas);
            if (!$qy->execute()) throw new Exception($qy->error);

            return $this->conn->insert_id;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getLoteById($id)
    {
        try {
            $sql = "SELECT * FROM lote WHERE id_lote = ? LIMIT 1;";
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
    public function getAllLotes()
    {
        try {
            $sql = "SELECT * FROM lote WHERE 1 ORDER BY id_lote ASC;";
            $qy = $this->conn->prepare($sql);
            if (!$qy->execute()) throw new Exception($qy->error);

            return $qy->get_result();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteLoteById($id)
    {
        try {
            $sql = "DELETE FROM lote WHERE id_lote = ?;";
            $qy = $this->conn->prepare($sql);
            $qy->bind_param('i', $id);

            if (!$qy->execute()) throw new Exception($qy->error);

            return $qy->num_rows;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}//EOC