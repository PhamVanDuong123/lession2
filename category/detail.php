<?php

$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
  
// include database and object files
include_once 'config/database.php';

include_once 'objects/category.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare objects
$category = new Category($db);
  
// set ID property of product to be read
$category->id = $id;
  
// read the details of product to be read
$category->readOne();
$page_title = "View detail";
include_once "layout_header.php";

echo "<table class='table table-hover table-responsive table-bordered' style='margin-top: 10px'>";
  
    echo "<tr>";
        echo "<td>Name</td>";
        echo "<td>{$category->name}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Category</td>";
        echo "<td>";
            // display category name
            $category->id=$category->id;
            $category->readName();
            echo $category->name;
        echo "</td>";
    echo "</tr>";
  
echo "</table>";
// read category button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read list category";
    echo "</a>";
echo "</div>";
  
// set footer
include_once "layout_footer.php";
?>