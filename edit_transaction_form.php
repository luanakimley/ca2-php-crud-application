<?php
require('database.php');

// Get expense
$expense_id = filter_input(INPUT_POST, 'expense_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM expenses
          WHERE expenseID = :expense_id';
$statement = $db->prepare($query);
$statement->bindValue(':expense_id', $expense_id);
$statement->execute();
$expenses = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();

// Get categories
$query2 = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement2 = $db->prepare($query2);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();


?>
<!-- the head section -->
 <!-- the head section -->

<?php
include('includes/header.php');
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" >

    <!-- Sidebar - Categories -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa-solid fa-icons"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Categories</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />


        <li class="nav-item active">
            <a class="nav-link collapsed" href="index.php">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Back to Homepage</span>
            </a>
        </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

</ul>
<!-- End of Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">

    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <h1 class="ml-2">Expense Tracker</h1>
</nav>

    <div class="container shadow mb-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-center">Edit Transaction</h1>
    </div>
        <form action="edit_transaction.php" method="post" enctype="multipart/form-data">

            <input type="hidden" name="original_image" value="<?php echo $expenses['image']; ?>" />
            <input type="hidden" name="expense_id" value="<?php echo $expenses['expenseID']; ?>">
  
            <label>Category:</label>
            <select name="category_id" class="form-select">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>" <?php if($category['categoryID'] == $expenses['categoryID']) echo "selected"?> >
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>
   

            <div class="form-group">
            <label>Amount:</label>
            <input type="input" name="amount" class="form-control" id="inputdefault" value="<?php echo $expenses['amount'] ?>" >
            <br>
            </div>

            <div class="form-group">
            <label>Note <em>(optional)</em>:</label>
            <input type="input" name="note" class="form-control" id="inputdefault" value="<?php echo $expenses['note'] ?>">
            <br>    
            </div>    

            <div class="form-group">
            <label>Date:</label>
            <input type="date" name="date" class="form-control" id="inputdefault" value="<?php echo $expenses['date'] ?>">
            <br>    
            </div>   
            
            <div class="form-group">
            <label>Image <em>(optional)</em>: </label>
            <input type="file" class="form-control" name="image" accept="image/*" />

            <?php if ($expenses['image'] != "") { ?>
            <img src="image_uploads/<?php echo $expenses['image']; ?>" class="mt-2 rounded text-center" />
            <?php } ?>

            <br>
            </div> 

            <br>
            

            <div class="form-group">
            <label class="w-100">Payment Type:</label>
            <br>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="paymentType" value="Debit Card" <?php if($expenses['paymentType'] == "Debit Card") {echo "checked";} ?> >
            <p class="form-check-label" for="inlineRadio1">Debit Card</p>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="paymentType" value="Credit Card" <?php if($expenses['paymentType'] == "Credit Card") {echo "checked";} ?>>
            <p class="form-check-label" for="inlineRadio2">Credit Card</p>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="paymentType" value="Cash" <?php if($expenses['paymentType'] == "Cash") {echo "checked";} ?>>
            <p class="form-check-label" for="inlineRadio3">Cash</p>
            </div>
            </div>
            
            <div class="form-group">
            <button type="submit" class="btn btn-outline-success mt-5 btn-block">Edit Transaction</button>
            <br>

            </div> 
        </form>
    </div>
   
    <?php
include('includes/footer.php');
?>