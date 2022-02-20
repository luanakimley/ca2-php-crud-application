<?php

// Get the product data
$expense_id = filter_input(INPUT_POST, 'expense_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT);
$note = filter_input(INPUT_POST, 'note');
$date = filter_input(INPUT_POST, 'date');
$paymentType = filter_input(INPUT_POST, 'paymentType');

// Validate inputs
if ($expense_id == NULL || $category_id == null || $category_id == false ||
    $amount == null || $note == null || $date == false || $paymentType == null) {
    $error = "Invalid product data. Check all fields and try again.";
    include('error.php');
    exit();
} else {


    /**************************** Image upload ****************************/

    $imgFile = $_FILES['image']['name'];
    $tmp_dir = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];
    $original_image = filter_input(INPUT_POST, 'original_image');

    if ($imgFile) {
    $upload_dir = 'image_uploads/'; // upload directory	
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    $image = rand(1000, 1000000) . "." . $imgExt;
    if (in_array($imgExt, $valid_extensions)) {
        if ($imgSize < 5000000) {
            if (filter_input(INPUT_POST, 'original_image') !== "") {
                unlink($upload_dir . $original_image);                    
            }
                move_uploaded_file($tmp_dir, $upload_dir . $image);
        } else {
                $errMSG = "Sorry, your file is too large it should be less then 5MB";
            }
    } else {
        $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
    } else {
    // if no image selected the old image remain as it is.
        $image = $original_image; // old image from database
    }

    /************************** End Image upload **************************/

    // If valid, update the record in the database
    require_once('database.php');

    $query =   "UPDATE expenses
                SET categoryID = :category_id,
                    amount = :amount,
                    note = :note,
                    date = :date,
                    paymentType = :paymentType,
                    image = :image
                WHERE expenseID = :expense_id";

    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':amount', $amount);
    $statement->bindValue(':note', $note);
    $statement->bindValue(':date', $date);
    $statement->bindValue(':paymentType', $paymentType);
    $statement->bindValue(':image', $image);
    $statement->bindValue(':expense_id', $expense_id);
    $statement->execute();
    $statement->closeCursor();

    // Display the Product List page
    header("location: index.php");
    exit;
}
?>