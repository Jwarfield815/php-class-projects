<?php
    $category_name = filter_input(INPUT_POST, 'name');

    if (!$category_name) {
        $error = 'You must enter valid data for your new category name';
        include('error.php');
    } else {
        require_once('database.php');
        $query = 'INSERT INTO categories (categoryName) VALUES (:category_name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_name', $category_name);
        $statement-> execute();
        $statement->closeCursor();

        include('category_list.php');
    }
?>