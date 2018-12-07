<?php
/**
 * Created by PhpStorm.
 * User: eugenio
 * Date: 05/12/2018
 * Time: 12:06
 */
require_once 'conn.class.php';
class Levadura
{
    private $conn;

    public function __construct(){
        $db_con = Conn::getInstance();
        $this->conn = $db_con->getConnection();
    }

    public function getAllLevaduras(){
        try{
            $sql = "SELECT * FROM levadura WHERE 1;";
            $qy = $this->conn->prepare($sql);
            if(!$qy->execute())throw new Exception($qy->error);

            return $qy->get_result();
        }catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
    }
    public function deleteLevaduraById($id){
        try{
            $sql = "DELETE FROM levadura WHERE id_levadura = ?;";
            $qy = $this->conn->prepare($sql);
            $qy->bind_param('i', $id);

            if(!$qy->execute())throw new Exception($qy->error);
            return true;
        }catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
    }
}