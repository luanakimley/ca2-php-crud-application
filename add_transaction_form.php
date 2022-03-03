<?php
require('database.php');
$query = 'SELECT *
          FROM categories
          ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>
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
        <h1 class="h3 mb-0 text-gray-800 text-center">Add Transaction</h1>
    </div>
        <form action="add_transaction.php" method="post" enctype="multipart/form-data">

  
            <label>Category:</label>
            <select name="category_id" class="form-select">
            <?php foreach ($categories as $category) : ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>
   

            <div class="form-group">
            <label>Amount:</label>
            <input type="input" name="amount" class="form-control" id="amount" required onBlur="amountValidation(); inputsAllValid()">
            <p class="text-danger mt-2" id="amountError"></p>
            </div>

            <div class="form-group">
            <label>Note <em>(optional)</em>:</label>
            <input placeholder="Some details about the transaction" type="input" name="note" class="form-control" id="note">
 
            </div>    

            <div class="form-group">
            <label>Date:</label>
            <input type="date" name="date" class="form-control" id="date" required onBlur="dateValidation(); inputsAllValid()" max="<?php echo date("Y-m-d"); ?>">
            <p class="text-danger mt-2" id="dateError"></p>
            </div>   
            
            <div class="form-group">
            <label>Image <em>(optional)</em>:</label>
            <input type="file" class="form-control" name="image" accept="image/*"  />
            <br>
            </div> 
            

            <div class="form-group">
            <label class="w-100">Payment Type:</label>
            <br>
            <div class="form-check form-check-inline">
            <input onBlur="paymentTypeValidation(); inputsAllValid()" class="form-check-input" type="radio" name="paymentType" value="Debit Card" id="debitCard">
            <p class="form-check-label" for="inlineRadio1">Debit Card</p>
            </div>
            <div class="form-check form-check-inline">
            <input onBlur="paymentTypeValidation(); inputsAllValid()" class="form-check-input" type="radio" name="paymentType" value="Credit Card" id="creditCard">
            <p class="form-check-label" for="inlineRadio2">Credit Card</p>
            </div>
            <div class="form-check form-check-inline">
            <input onBlur="paymentTypeValidation(); inputsAllValid()" class="form-check-input" type="radio" name="paymentType" value="Cash" id="cash">
            <p class="form-check-label" for="inlineRadio3">Cash</p>
            </div>
            <p class="text-danger mt-2" id="paymentTypeError"></p>
            </div>
            
            <div class="form-group">
            <button id="submitButton" type="submit" class="btn btn-outline-success mt-5 btn-block">Add Transaction</button>
            <br>

            

            </div> 
        </form>
    </div>
   
    <?php
include('includes/footer.php');
?>