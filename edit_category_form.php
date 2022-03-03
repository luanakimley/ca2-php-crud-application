<?php
require('database.php');

// Get category
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$query = 'SELECT *
          FROM categories
          WHERE categoryID = :category_id';
$statement = $db->prepare($query);
$statement->bindValue(':category_id', $category_id);
$statement->execute();
$category = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();

// Get all categories
$queryAllCategories = 'SELECT * FROM categories
WHERE parentID IS NULL
ORDER BY categoryID';
$statement = $db->prepare($queryAllCategories);
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
            <a class="nav-link collapsed" href="category_list.php">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Back to Categories List</span>
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
        <h1 class="h3 mb-0 text-gray-800 text-center">Edit Category</h1>
    </div>
        <form action="edit_category.php" method="post" enctype="multipart/form-data">

            <input type="hidden" name="category_id" value="<?php echo $category['categoryID']; ?>">
  
            <label>Category name:</label>
            <input type="input" name="categoryName" class="form-control" id="inputdefault" value="<?php echo $category['categoryName'] ?>" required>
            <br>

            <div class="form-group">
            <label class="w-100">Type:</label>
            <br>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="type" value="category" <?php if(empty($category['parentID'])) {echo "checked";} ?> >
            <p class="form-check-label" for="inlineRadio1">Category</p>
            </div>
            <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="type" value="subcategory" <?php if(!empty($category['parentID'])) {echo "checked";} ?>>
            <p class="form-check-label" for="inlineRadio2">Subcategory</p>
            </div>
            </div>

            <br>           

            <label>Choose parent category:</label>
            <select name="parentCategory" class="form-select" disabled>
            <option selected disabled >
            <?php foreach ($categories as $cat) : ?>
                <option value="<?php echo $cat['categoryID']; ?>" <?php if($cat['categoryID'] == $category['parentID']) echo "selected";?>>
                    <?php echo $cat['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select>

            <br>

            <label>Icon class name <em>(optional)</em>:</label>
            <input type="input" name="icon" class="form-control" id="inputdefault" value="<?php echo $category['icon']?>">
            
            <script>
                if($('input[name="type"]:checked').val() == "subcategory") {
                    $('select[name="parentCategory"]').removeAttr('disabled');
                };

                $('input[name="type"]').on('change', function() {
                    $('select[name="parentCategory"]').attr('disabled', this.value != "subcategory")
                });
            </script>
            
            <div class="form-group">
            <button type="submit" class="btn btn-outline-success mt-5 btn-block">Edit Category</button>

            </div> 
        </form>
    </div>
   
    <?php
include('includes/footer.php');
?>