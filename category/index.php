<?php
// core.php holds pagination variables
include_once 'config/core.php';

// include database and object files
include_once 'config/database.php';

include_once 'objects/category.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

$category = new Category($db);

$page = isset($_GET['page']) ? $_GET['page'] : 1;

// set number of records per page
$records_per_page = 10;

// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - ($records_per_page);
// retrieve records here
$page_title = "Read categorys";
$stmt = $category->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();
// specify the page where paging is used

include_once "layout_header.php";
include_once "search.php";
include_once "read_template.php";

include_once "form.php";

include_once 'objects/sub_category.php';



// query categorys


// count total rows - used for pagination
$total_rows = $category->countAll();

$page_url = "index.php?";
include_once 'pagging.php';
// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
