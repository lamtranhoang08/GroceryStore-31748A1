<?php
class CategoryModel extends DB
{
    function getAll($keyword = '')
    {
        if (!empty($keyword)) {
            $sql = "SELECT * FROM category WHERE name like '%" . $keyword . "%' ORDER BY id";
        } else {
            $sql = "SELECT * FROM category ORDER BY id";
        }
        return $this->pdo_query($sql);
    }
    function getAllCl()
    {
        $sql = "SELECT category.name,category.id as id, count(products.category_id) as count_cate FROM category INNER JOIN products ON category.id = products.category_id GROUP BY category.name,category.id ORDER BY category.id";
        return $this->pdo_query($sql);
    }
    function insertCate($name)
    {
        $cate = "INSERT INTO category(name) VALUE('$name')";
        return $this->pdo_execute($cate);
    }

    function selectOneCate($id)
    {
        $select = "SELECT * FROM category WHERE id = '$id'";
        return $this->pdo_query_one($select);
    }

    function getNameCate($id)
    {

        $sql = "SELECT name FROM category WHERE id = $id";
        return $this->pdo_query_one($sql);
    }

    function updateCate($id, $name)
    {
        $cate = "UPDATE category SET name = '$name' WHERE id = '$id'";
        return $this->pdo_execute($cate);
    }

    function deleteCate($id)
    {
        $delete = "DELETE FROM category WHERE id = '$id'";
        return $this->pdo_execute($delete);
    }
}
