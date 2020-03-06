<?php
    // gets the id from the request and validates that it's an integer
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

    // displays error if it isn't valid
    if (!$category_id) {
        $error = $category_id;
        include('error.php');
    } else {
        // pulls variable information from database.php
        require_once('database.php');
        $query = 'DELETE FROM categories WHERE categoryID = :category_id';
        // executes query string
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $statement->closeCursor();

        // rerenders the page without the deleted item
        include('category_list.php');
    }
?>