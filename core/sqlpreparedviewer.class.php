<?php
/**
 * Created by PhpStorm.
 * User: eugenio
 * Date: 21/08/2018
 * Time: 13:31
 */

class SqlPreparedViewer
{
    protected $sql;
    protected $types;
    protected $params;

    public function __construct($sql, $types, $params){
        $this->sql = $sql;
        $this->types = str_split($types);
        $this->params = $params;
    }
    public function getQuery(){
        foreach ($this->params as $key => $param){
            $param_position = strpos($this->sql, "?");
            $param_type = $this->getFormedParam($param, $this->types[$key]);
            $this->sql = substr_replace($this->sql, $param_type, $param_position, 1);
        }

        return $this->sql . chr(10);
    }
    private function getFormedParam($param, $type){
        return $type === "s" ? '"' . $param . '"' : $param;
    }
}