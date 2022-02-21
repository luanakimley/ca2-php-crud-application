<?php
    require_once('database.php');

    // Get all categories
    $query = 'SELECT * FROM categories
              ORDER BY categoryID';
    $statement = $db->prepare($query);
    $statement->execute();
    $categories = $statement->fetchAll();
    $statement->closeCursor();
?>
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
        <h1 class="h3 mb-0 text-gray-800 text-center">Manage Categories</h1>
    </div>

    <div class="table-responsive">
    <table class="table table-striped table-hover table-sm">
        <thead> 
            <th>Category ID</th>
            <th>Category Name</th>
            <th>Parent ID</th>
            <th></th>
            <th></th>
            <th>Icon</th>
        </thead>
        <tbody>
            <?php foreach ($categories as $category) : ?>
            <tr>
                <td><?php echo $category['categoryID']; ?></td>
                <td><?php echo $category['categoryName']; ?></td>
                <td><?php echo $category['parentID']; ?></td>
                <td>
                    <form action="edit_category_form.php" method="post">
                        <input type="hidden" name="category_id"
                            value="<?php echo $category['categoryID']; ?>">
                        <button class="btn btn-circle btn-sm" type="submit"> <i class="fa-solid fa-pencil"></i></button>
                    </form>
                </td>
                <td>
                    <form action="delete_category.php" method="post">
                        <input type="hidden" name="category_id" value="<?php echo $category['categoryID']; ?>">
                        <button class="btn btn-circle btn-sm" type="submit"><i class='fa-solid fa-trash-can'></i></button>
                    </form>
                </td>
                <td><?php echo $category['icon']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>

    <a href="add_category_form.php"><div id="addButton" class="btn btn-circle btn-primary btn-lg" data-toggle="tooltip" data-placement="left" title="Add Category">
    <i class="fa-solid fa-plus" style="color: white"></i>
    </div></a>

    </div>
   
    <?php
include('includes/footer.php');
?>