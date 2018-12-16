<?php
/**
 * Created by PhpStorm.
 * User: eugenio
 * Date: 29/11/2017
 * Time: 11:56
 */

class Superlog
{
    static $dir = '';
    static $filename = '';
    static $filename_path = '';
    static $now = '';
    static $one_logfile = false;//genera un solo archivo donde se vuelca el log hasta el infinito y más allá
    static $log_one_day = false;//limpia el contenido del logfile cuando se cambia de día

    public static function log($txtlog, $dir = NULL){//si recibe $dir, guardará el log en ese directorio
        self::$now = new DateTime();
        self::setDir($dir);
        self::setFilename();
        self::setFilePath();

        //crea el directorio si no existe
        self::checkStorageFolder();

        //si está configurado para borrarse cada día
        if(true === self::$log_one_day)self::makeOneDayLog();

        //escribe log
        self::writeLog($txtlog);
    }
    private static function setDir($dir){
        self::$dir = $dir ? $dir.'/logs/' : './logs/';
    }
    private static function setFilename(){
        if(true === self::$one_logfile){
            self::$filename = 'logfile.log';
        }else{
            self::$filename = 'log_' . self::$now->format('Y_m_d') . '.log';
        }
    }
    private static function setFilePath(){
        self::$filename_path = self::$dir . self::$filename;
    }

    //comprueba si existe el directorio donde se guardarán los logs
    //si no, lo crea
    private static function checkStorageFolder(){
        if(!is_dir(self::$dir)){
            if(!mkdir(self::$dir, 0777, true))die("no se creó el directorio para guardar los logs ".self::$dir);
        }
    }

    //escribe en el archivo de log
    private static function writeLog($msg){

        if(is_array($msg)){
            $msg = '( array ): '.json_encode($msg);
        }

        $str_msg = "[" . self::$now->format('Y-m-d H:i:s') . "] " . $msg . "\r\n";

        $f = fopen(self::$filename_path, 'a');
        fwrite($f, $str_msg);
        fclose($f);
//        file_put_contents(self::$filename_path, $str_msg, FILE_APPEND);

    }

    //si el archivo se modificó antes de hoy, se borra
    private static function makeOneDayLog(){

        //compruebo fecha de última modificacion
        $ts_last_file_mod = date('d-m-Y', filemtime(self::$filename_path));
        $hoy = date('d-m-Y');

        //si la fecha de hoy no es la misma que la de creación, borro el contenido
        if($hoy !== $ts_last_file_mod)file_put_contents(self::$filename_path, '');

    }

}//EOC