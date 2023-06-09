<?php
include_once 'config/database.php';

include_once 'model/category.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// pass connection to objects

$category = new Category($db);

// set page headers
$page_title = "Add new category category";
include_once "view/layout_header.php";

// button back index.php
echo "<div class='right-button-margin' style='margin-top:20px'>
        <a href='index.php' class='btn btn-default pull-right'>Read category</a>
    </div>";

?>
<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
  
    // set category property values
    $category->name = $_POST['name'];
   
    
    $category->parent_id = $_POST['parent_id'];
  
    // create the category
    if($category->create()){
        echo "<div class='alert alert-success'>category was created.</div>";
    }
  
    // if unable to create the cate$category, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create category.</div>";
    }
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td> Category name</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>

        <tr>
            <td>Parent category</td>
            <td>
                <?php
                // read the category categories from the database
                 $stmt = $category->read();

                // put them in a select drop-down
                echo "<select class='form-control' name='parent_id'>";
                echo "<option>Select category...</option>";

                while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row_category);
                    echo "<option value='{$id}'>{$name}</option>";
                }

                echo "</select>";
                ?>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Submit</button>
            </td>
        </tr>

    </table>
</form>
<?php

// footer
include_once "view/layout_footer.php";
?>