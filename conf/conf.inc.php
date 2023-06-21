<?php
    // // Configuração do Banco de Dados
    // define('HOST', 'localhost');  
    // define('DBNAME', 'php');    
    // define('USER', 'root');  
    // define('PASSWORD', '');
    // define('DRIVER', 'mysql'); 
    // define('CHARSET', 'utf8');
    // define('TRIANGULO', 'triangulo');

    // // URL Base - Usado para o Menu, links, ...
    // define('URL_BASE', 'http://localhost/Web/');
    
    // // Configuração da Aplicação (dev ou prod)
    // // dev mostra os erros e prod não mostra os erros
    // define('PERFIL', 'dev');
    
    define ('MYSQL_HOST','localhost');
    define ('MYSQL_USUARIO','root');
    define ('MYSQL_SENHA','');
    define ('MYSQL_DB','php');
    define ('MYSQL_PORT','3306');
    define ('TRIANGULO', 'triangulo');

    define ('MYSQL_DSN',"mysql:host=".MYSQL_HOST.";port=".MYSQL_PORT.";dbname=".MYSQL_DB.";charset=UTF8");

?>
