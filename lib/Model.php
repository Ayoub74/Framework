<?php

namespace lib\Model;
use PDO;

abstract class Model{


    protected static $pdo;
    private $_driver = '';
    private $_host = '';
    private $_dbname = '';
    private $_root = '';
    private $_password = '';
    private $_socket = '';

    public function __construct()
    {
         $_userInfo = parse_ini_file(dirname(__FILE__)."/../app/config.ini");
        $this->_driver = $_userInfo['driver'];
        $this->_host = $_userInfo['host'];
        $this->_dbname = $_userInfo['dbname'];
        $this->_root = $_userInfo['root'];
        $this->_password = $_userInfo['password'];
        $this->_socket = $_userInfo['socket'];

        try
        {
            if (!empty($_socket)) {

                self::$pdo = new PDO($this->_driver.':host='.$this->_host.';dbname='.$this->_dbname.';unix_socket='.$_socket, $this->_root, $this->_password);

            } else {

                self::$pdo = new PDO($this->_driver.':host='.$this->_host.';dbname='.$this->_dbname, $this->_root, $this->_password);
            }
        }
        catch(Exception $e)
        {
            die('Erreur :' .$e->getMessage());
        }
        
    }
}


