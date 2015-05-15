<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 15/05/15
 * Time: 20:39
 */
namespace Website\Controller;
use Symfony\Component\Yaml\Parser;

abstract class AbstractBaseController{
    protected function getConnection(){
        $config = new \Doctrine\DBAL\Configuration();
        $yaml = new Parser();
        $connectionParams = $yaml->parse(file_get_contents('app/config/config_prod.yml'));
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams['doctrine'], $config);
        return $conn;
    }
}
