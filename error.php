
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

    <div class="  mb-4">
    <div class="container-fluid">

    <!-- 404 Error Text -->
    <div class="no-transactions-found">
        <div class="error mx-auto position-relative" data-text="Error">Error</div>
        <p class="lead text-gray-800 mb-5 mt-3 "><?php echo $error ?></p>
       
    </div>


    </div>

    </div>
    
   
    <?php
include('includes/footer.php');
?>