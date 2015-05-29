<?php
/**
 * Created by PhpStorm.
 * User: Younes
 * Date: 12/05/15
 * Time: 11:55
 */

namespace Website\Model;

class ProductManager
{
    function __construct($param)
    {
        $this->bdd = $param;
    }

    function listProducts()
    {
       $sql = 'SELECT p.id, p.name, c.name as class, s.name as subclass
                FROM products p
                LEFT JOIN subclass s ON s.id = p.subclass
                LEFT JOIN class c ON c.id = p.class';
        $statement = $this->bdd->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        foreach($result as $key => $value){
            $result[$key]['category']=[];
            $sql2 = 'SELECT cat.name
                      FROM categoriesProducts
                      RIGHT JOIN products ON products.id = idProduct
                      LEFT JOIN categories cat ON cat.id = idCategory
                      WHERE products.id = :id';
            $statement2 = $this->bdd->prepare($sql2);
            $statement2->execute([
                'id' => $value['id']
            ]);
            $category = $statement2->fetchAll();
            foreach($category as $value2){
                foreach($value2 as $value3){
                    $result[$key]['category'][]= $value3;
                }
            }

        }

        return $result;
    }
    function listIdProductsByCategory($id)
    {
        $sql = 'SELECT p.id as productId
                  FROM categoriesProducts
                  RIGHT JOIN products p ON p.id = idProduct
                  LEFT JOIN categories cat ON cat.id = idCategory
                  WHERE cat.id = :id';
        $statement = $this->bdd->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);



        $result = $statement->fetchAll();
        return $result;
    }

    function showProduct($id)
    {

        $sql = 'SELECT p.id, p.name, c.name as class, s.name as subclass
                FROM products p
                LEFT JOIN subclass s ON s.id = p.subclass
                LEFT JOIN class c ON c.id = p.class
                WHERE p.id = :id ';
        $statement = $this->bdd->prepare($sql);
        $statement->execute([
            'id' => $id
        ]);
        $result = $statement->fetch();

        $sql2 = 'SELECT cat.name
                      FROM categoriesProducts
                      RIGHT JOIN products ON products.id = idProduct
                      LEFT JOIN categories cat ON cat.id = idCategory
                      WHERE products.id = :id';
        $statement2 = $this->bdd->prepare($sql2);
        $statement2->execute([
            'id' => $id
        ]);
        $category = $statement2->fetchAll();
        foreach($category as $value2){
            foreach($value2 as $value3){
                $result['category'][]= $value3;
            }
        }
        return $result;
    }

    function addProduct($name, $detail, $email)
    {
        $sql = 'INSERT INTO Products (name, details)
                VALUES (:name, :details)';
        $statement = $this->bdd->prepare($sql);
        $statement->execute([
            'name' => $name,
            'details' => $detail
        ]);
    }

    function deleteProducts($name)
    {
        $this->bdd->delete('Products', array('name' => $name));
    }
}