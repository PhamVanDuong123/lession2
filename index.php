<?php
include_once 'config/core.php';
include_once 'config/database.php';
include_once 'model/category.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

$category = new Category($db);

$page = isset($_GET['page']) ? $_GET['page'] : 1;

// set number of records per page
$records_per_page = 10;

$from_record_num = ($records_per_page * $page) - ($records_per_page);
// retrieve records here
$page_title = "Categorys";
$stmt = $category->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// specify the page where paging is used

include_once "view/layout_header.php";
include_once "search.php";
include_once "view/read_template.php";
include_once "view/form.php";
include_once 'model/sub_category.php';

// count total rows - used for pagination
$total_rows = $category->countAll();

$page_url = "index.php?";
include_once 'view/pagging.php';
// layout_footer.php holds our javascript and closing html tags
include_once "view/layout_footer.php";