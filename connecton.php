<?php

class Database{

    public static  $connection;

    public static final function setUpConnection(){

        if (!isset(self::$connection)) {
            self::$connection = new  mysqli("localhost", "root", "Sahan@200212010", "krist_db");
        }
    }

    public static final function iud($q){

        self::setUpConnection();
        self::$connection->query($q);
    }

    public static final function search($q){

        self::setUpConnection();
        return self::$connection->query($q);
         
    }
}
?>