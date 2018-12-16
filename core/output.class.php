<?php
/**
 * Created by PhpStorm.
 * User: eugenio
 * Date: 03/12/2018
 * Time: 21:23
 */

class Output
{
    /**
     * @param string $msg
     */
    public static function throwError($msg = null){
        $output = [
          "status" => "error",
          "message" => $msg
        ];
        header("content-type: application/json");
        echo json_encode($output);
    }

    /**
     * @param string|array $msg
     */
    public static function throwContent($msg = null){
        $output = [
            "status" => "ok",
            "content" => $msg
        ];
        header("content-type: application/json");
        echo json_encode($output);
    }

    /**
     * @param string $msg
     */
    public static function throwOk($msg = null){
        $output = [
          "status" => "ok",
          "message" => $msg
        ];
        header("content-type: application/json");
        echo json_encode($output);
    }
}