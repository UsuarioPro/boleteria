<?php
//use Exception;
class Log{
    public function __construct()
    {
        $this->path     = "log/" . date("Y");
        $this->pathfull = $this->path  . "/" . date("m") ;
        $this->filename = "log-";
        $this->date     = date("Y-m-d");
        $this->hour     = date('H:i:s');
        $this->ip       = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : 0;
    }

    public function insert($text, $location)
    {
        $log    = $this->date . " " . $this->hour . "[UTC -5] [ip] " . $this->ip . " [location] " . $location . " [text] " . $text . PHP_EOL;
        if(is_dir($this->pathfull))
        {
            $result = (file_put_contents($this->pathfull . "/" . $this->filename . $this->date . ".txt", $log, FILE_APPEND)) ? 1 : 0;
        } 
        else 
        {
            if(is_dir($this->path))
            {
                mkdir($this->pathfull, 0700);
                $result = (file_put_contents($this->pathfull . "/" . $this->filename . $this->date . ".txt", $log, FILE_APPEND)) ? 1 : 0;
            } 
            else 
            {
                mkdir($this->path, 0700, true);
                mkdir($this->pathfull, true);
                $result = (file_put_contents($this->pathfull . "/" . $this->filename . $this->date . ".txt", $log, FILE_APPEND)) ? 1 : 0;
            }
        }
        return $result;
    }

}