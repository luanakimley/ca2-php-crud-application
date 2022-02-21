<?php
// Get the category data
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$name = filter_input(INPUT_POST, 'categoryName');
$type = filter_input(INPUT_POST, 'type');
$parentID = filter_input(INPUT_POST, 'parentCategory', FILTER_VALIDATE_INT);
$icon = filter_input(INPUT_POST, 'icon');

// Validate inputs
if ($name == null || type == null) {
    $error = "Invalid category data. Check all fields and try again.";
    include('error.php');
} else {
    require_once('database.php');

    if ($type == 'subcategory') 
    {
        // Add the category to the database
        $query = "UPDATE categories 
                SET categoryName = :name,
                parentID = :parent_id,
                icon = :icon
                WHERE categoryID = :category_id
                ";
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':parent_id', $parentID);
        $statement->bindValue(':icon', $icon);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $statement->closeCursor();
    }
    else {
        // Add the category to the database
        $query = "UPDATE categories 
                SET categoryName = :name,
                parentID = NULL,
                icon = :icon
                WHERE categoryID = :category_id
                ";
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':icon', $icon);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $statement->closeCursor();
    }

    // Display the Category List page
    header("location: category_list.php");
    exit;
}
?>

