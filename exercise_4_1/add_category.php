<?php
    // get the new categories name from the request
    $category_name = filter_input(INPUT_POST, 'name');

    // check if it's valid
    if (!$category_name) {
        $error = 'You must enter valid data for your new category name';
        // displays error page with given error message
        include('error.php');
    } else {
        // pulls the variable information from the database.php file
        require_once('database.php');
        $query = 'INSERT INTO categories (categoryName) VALUES (:category_name)';

        // executes query string
        $statement = $db->prepare($query);
        $statement->bindValue(':category_name', $category_name);
        $statement-> execute();
        $statement->closeCursor();

        // displays the page with the newly added items
        include('category_list.php');
    }
?>