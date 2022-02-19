<?php
require_once('database.php');

// Get category ID
if (!isset($category_id)) {
$category_id = filter_input(INPUT_GET, 'category_id', 
FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
$category_id = 1;
}
}

// Get name for current category
$queryCategory = "SELECT * FROM categories
WHERE categoryID = :category_id";
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$statement1->closeCursor();
$category_name = $category['categoryName'];

// Get all categories
$queryAllCategories = 'SELECT * FROM categories
ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get records for selected category
$queryRecords = "SELECT * FROM records
WHERE categoryID = :category_id
ORDER BY recordID";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$records = $statement3->fetchAll();
$statement3->closeCursor();
?>

<?php include('includes/header.php'); ?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Categories -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-icons"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Categories</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Categories List -->
    <?php foreach ($categories as $category) : ?>
    <li class="nav-item active">
        <a class="nav-link" href=".?category_id=<?php echo $category['categoryID']; ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span><?php echo $category['categoryName']; ?></span>
        </a>
    </li>
    <?php endforeach; ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->


<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <h1 class="ml-2">Expenses Tracker</h1>
</nav>

<!-- End of Topbar -->



<section>
<!-- display a table of records -->
<h2><?php echo $category_name; ?></h2>
    <table>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        <?php foreach ($records as $record) : ?>
        <tr>
            <td>
                <img src="image_uploads/<?php echo $record['image']; ?>" width="100px" height="100px" />
            </td>
            <td>
                <?php echo $record['name']; ?>
            </td>
            <td class="right">
                <?php echo $record['price']; ?>
            </td>
            <td>
                <form action="delete_record.php" method="post" id="delete_record_form">
                    <input type="hidden" name="record_id"value="<?php echo $record['recordID']; ?>">
                    <input type="hidden" name="category_id"value="<?php echo $record['categoryID']; ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
            <td>
                <form action="edit_record_form.php" method="post" id="delete_record_form">
                    <input type="hidden" name="record_id"value="<?php echo $record['recordID']; ?>">
                    <input type="hidden" name="category_id"value="<?php echo $record['categoryID']; ?>">
                    <input type="submit" value="Edit">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<p><a href="add_record_form.php">Add Record</a></p>
<p><a href="category_list.php">Manage Categories</a></p>
</section>

<?php include('includes/footer.php');?>