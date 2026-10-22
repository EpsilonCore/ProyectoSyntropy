<?php
class Database
{
    public static function conectar()
    {
        return mysqli_connect(
            getenv('DB_HOST'),
            getenv('DB_USER'),
            getenv('DB_PASSWORD'),
            getenv('DB_NAME'),
            getenv('DB_PORT') ?: 3306
        );
    }
}