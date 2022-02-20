<?php
require_once('database.php');

// Get category ID
if (!isset($category_id)) {
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
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
$category_icon = $category['icon'];

// Get all categories
$queryAllCategories = 'SELECT * FROM categories
WHERE parentID IS NULL
ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get records for selected category
$queryRecords = "SELECT * FROM expenses e, categories c
WHERE e.categoryID = c.categoryID AND 
(e.categoryID = :category_id OR c.parentID = :category_id)
ORDER BY e.date;";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$records = $statement3->fetchAll();
$statement3->closeCursor();

?>

<?php include('includes/header.php'); ?>

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
                <i class="fas fa-fw fa-cog"></i>
                <span>Manage Categories</span>
            </a>
        </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Categories List -->
    <?php foreach ($categories as $category) : ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            <?php echo $category['categoryName']; ?>
        </div>
    <li class="nav-item active">
        <a class="nav-link collapsed" href=".?category_id=<?php echo $category['categoryID']; ?>" >
            <i class="<?php echo $category['icon'];?>"></i>
            <span><?php echo $category['categoryName']; ?></span>
        </a>
        
            <?php 
                $querySubcategories = 'SELECT * FROM categories
                WHERE parentID IS NOT NULL AND parentID = :category_id
                ORDER BY categoryID';
                $statement4 = $db->prepare($querySubcategories);
                $statement4->bindValue(':category_id', $category['categoryID']);
                $statement4->execute();
                $subcategories = $statement4->fetchAll();
                $statement4->closeCursor();
            
                foreach ($subcategories as $subcategory) : 
            ?>
                <a class="nav-link opacity-75"  href=".?category_id=<?php echo $subcategory['categoryID'];?>" >
                    <span ><?php echo $subcategory['categoryName']; ?></span>
                </a>
            <?php endforeach; ?>
     
 
    </li>

    <hr class="sidebar-divider">
    <?php endforeach; ?>



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
    <h1 class="ml-2">Expense Tracker</h1>
</nav>

<!-- End of Topbar -->


 <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="<?php echo $category_icon; ?> mr-3"></i><?php echo $category_name; ?></h1>
    </div>

    <div class="row">
    
    <?php foreach ($records as $record) : ?>
        <!-- Expense Card -->
        <div class="col-xl-3 col-md-6 mb-4 ">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="h5 mb-0 text-xs text-gray-500 mb-2">
                                <?php echo $record['date']; ?>
                            </div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <?php echo $record['categoryName']; ?>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                €<?php echo $record['amount']; ?>
                            </div>
                            <p class="mt-3"><?php echo $record['note']; ?></p>
                        </div>
                        <div class="col-auto">
                            <i class="<?php echo $record['icon']; ?> fa-2x text-gray-300"></i>
                        </div>
   
                        
                        <img src="<?php 
                            if ($record['image'] != NULL) {echo "image_uploads/".$record["image"];} else {echo "image_uploads/error.png";} ?>" >
                    </div>
                </div>
            </div>
        </div>
        
        <?php endforeach; ?>

        <div id="addButton" class="btn btn-circle btn-primary btn-lg" data-toggle="tooltip" data-placement="left" title="Add Transaction">
        <a href="add_record_form.php"><i class="fa-solid fa-plus" style="color: white"></i></a>
        </div>

    </div>
<!-- /.container-fluid -->
</div>   

<?php include('includes/footer.php');?>