<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin</title>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'
          integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <!-- Bootstrap core JavaScript -->
    <script src="./jquery/jquery.js"></script>
    <script src="./bootstrap/js/bootstrap.bundle.js"></script>

</head>
<body>
<nav style="height: 45px; background-color: #4e7197" class="navbar navbar-expand-sm">
    <a class="navbar-brand" href="#" style=" color: white; font-size: 15px; font-weight: bold;">NTQ Solution Admin</a>
</nav>
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading position-relative">
            <img src="../public/stroge/ac032319a03f44611d2e.jpg"
                 style="width:100px;height:100px; padding: 2px; border: 1px solid silver;">
            <a href="#" class="position-absolute" style="color: black; font-size: 12px;"><i class="fas fa-cog"></i>
                Update Profile</a>
            <a href="index.php?controllers=Login&action=logout" class="position-static"
               style="color: black; font-size: 12px;"><i class="fas fa-share-square"></i> Logout</a>
        </div>
        <div class="list-group list-group-flush">
            <a href="index.php?controllers=Categories&&action=listCategories" class="list-group-item list-group-item-action"
               style="font-size: 14px; background-color: #4e7197; color: white;"><i class='fab fa-microsoft'></i>&nbsp;&nbsp;&nbsp;Categories</a>
            <a href="index.php?controllers=Product&&action=listProduct" class="list-group-item list-group-item-action"
               style="font-size: 14px;background-color: #4e7197; color: white;"><i class='fas fa-tasks'></i>&nbsp;&nbsp;&nbsp;Products</a>
            <a href="index.php?controllers=User&&action=listUser" class="list-group-item list-group-item-action"
               style="font-size: 14px;background-color: #4e7197; color: white;"><i class='fas fa-user-edit'></i>&nbsp;&nbsp;&nbsp;Users</a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom mt-4 ml-4" style="width: 95%;">
            <form action="index.php?controllers=<?php echo $_GET["controllers"]; ?>&action=search" method="post" class="col-md-12 form-inline">
                <input type="text" class=" form-control col-md-10" id="email" placeholder="Some text for search" name="search_name"
                       style="font-size: 12px;">
                <button class="btn btn-info"
                        style="  margin: 20px ; background-color: #4e7197; color: white; font-size: 12px;">
                    Search
                </button>

            </form>

        </nav>

        <!-- content -->
        <div class="container-fluid">