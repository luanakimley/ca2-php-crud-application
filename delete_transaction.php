<?php
require_once('database.php');

// Get IDs
$expense_id = filter_input(INPUT_POST, 'expense_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

// Delete the product from the database
if ($expense_id != false && $category_id != false) {
    $query = "DELETE FROM expenses
              WHERE expenseID = :expense_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':expense_id', $expense_id);
    $statement->execute();
    $statement->closeCursor();
}

    // display the Product List page
    header("location: index.php");
    exit;
?>