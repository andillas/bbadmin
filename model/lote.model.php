<?php
/**
 * Created by PhpStorm.
 * User: eugenio
 * Date: 29/11/2018
 * Time: 12:56
 */
require_once 'conn.class.php';
include_once 'utils/sqlpreparedviewer.class.php';

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

    public function saveLote($lote_data)
    {
        try {
            Superlog::log('SaveLote');
            $sql = "INSERT INTO lote(
                 ref_lote,
                 nombre, 
                 tipo, 
                 fecha_cocinado, 
                 fecha_embotellado, 
                 densidad_inicial, 
                 tiempo_hervido, 
                 agua_macerado, 
                 agua_lavado, 
                 levadura, 
                 azucar, 
                 densidad_final, 
                 graduacion, 
                 atenuacion, 
                 litros_embotellados, 
                 ibus, 
                 incidencias) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $qy = $this->conn->prepare($sql);
            $qy->bind_param('sssssiiiiiiidddds',
                $lote_data['referencia_nuevo_lote'],
                $lote_data['nombre_nuevo_lote'],
                $lote_data['tipo_nuevo_lote'],
                $lote_data['cocinado_nuevo_lote'],
                $lote_data['embotellado_nuevo_lote'],
                $lote_data['di_nuevo_lote'],
                $lote_data['tiempo_hervido_nuevo_lote'],
                $lote_data['agua_macerado_nuevo_lote'],
                $lote_data['agua_lavado_nuevo_lote'],
                $lote_data['levadura_nuevo_lote'],
                $lote_data['azucar_nuevo_lote'],
                $lote_data['df_nuevo_lote'],
                $lote_data['alcohol_nuevo_lote'],
                $lote_data['atenuacion_nuevo_lote'],
                $lote_data['litros_nuevo_lote'],
                $lote_data['ibus_nuevo_lote'],
                $lote_data['incidencias_nuevo_lote']
                );
            if (!$qy->execute()) throw new Exception($qy->error);

            return $this->conn->insert_id;
        } catch (Exception $e) {
            Superlog::log($e->getMessage());
            return false;
        }
    }
    public function saveLoteMalta($malta, $id_lote){
        try{
            Superlog::log('saveLoteMalta');
            $tipo_malta = '';
            $cantidad_malta = '';


            $sql = "INSERT INTO malta_x_lote(id_lote, id_malta, cantidad) VALUES(?, ?, ?);";
            if(!$qy = $this->conn->prepare($sql))throw new Exception($this->conn->error);
            if(!$qy->bind_param('iii', $id_lote, $tipo_malta, $cantidad_malta))throw new Exception($qy->error);

            foreach ($malta as $m){
                $tipo_malta = $m['tipo'];
                $cantidad_malta = $m['cantidad'];
                if(!$qy->execute())throw new Exception($qy->error);
            }
            return true;
        }catch (Exception $e){
            Superlog::log($e->getMessage());
            return false;
        }
    }
    public function saveLoteLupulo($lupulo, $id_lote){
        try{
            $tipo_lupulo = '';
            $cantidad_lupulo = 0;
            $tiempo_lupulo = 0;

            $sql = "INSERT INTO lupulo_x_lote(id_lote, id_lupulo, cantidad, tiempo) values(?, ?, ?, ?);";
            if(!$qy = $this->conn->prepare($sql))throw new Exception($this->conn->error);

            if(!$qy->bind_param('iiii', $id_lote, $tipo_lupulo, $cantidad_lupulo, $tiempo_lupulo))throw new Exception($qy->error);
            foreach ($lupulo as $l){
                $tipo_lupulo = $l['tipo'];
                $cantidad_lupulo = $l['cantidad'];
                $tiempo_lupulo = $l['tiempo'];

                if(!$qy->execute())throw new Exception($qy->error);
            }
            return true;
        }catch (Exception $e){
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