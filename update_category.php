<?php
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// include database and object files
include_once 'config/database.php';

include_once 'model/category.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare objects

$category = new Category($db);
$category->id = $id;
$category->readOne();

// set page header
$page_title = "Update Category";
include_once "view/layout_header.php";
echo "<div class='right-button-margin' style='margin-bottom:20px'>
     </div>";
     if($_POST){
  
        // set category property values
        $category->name = $_POST['name'];
     
        $category->parent_id = $_POST['parent_id'];
      
        // update the category
        if($category->update()){
            echo "<div class='alert alert-success alert-dismissable'>";
                echo "category was updated.";
            echo "</div>";
        }
      
        // if unable to update the category, tell the user
        else{
            echo "<div class='alert alert-danger alert-dismissable'>";
                echo "Unable to update category.";
            echo "</div>";
        }
    }
    ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value='<?php echo $category->name; ?>' class='form-control' /></td>
        </tr>


        <tr>
            <td>Category</td>
            <td>
                <?php
                    $stmt = $category->read();
    
                    // put them in a select drop-down
                    echo "<select class='form-control' name='parent_id'>";
    
                    echo "<option>Please select...</option>";
                    while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $parent_id = $row_category['id'];
                        $category_name = $row_category['name'];
    
                        // current category of the category must be selected
                        if ($category->parent_id == $parent_id) {
                            echo "<option value='$parent_id' selected>";
                        } else {
                            echo "<option value='$parent_id'>";
                        }
    
                        echo "$category_name</option>";
                    }
                    echo "</select>";
                    ?>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href='index.php' class='btn btn-default pull-right'>Back</a>
            </td>
        </tr>

    </table>
</form>



<?php 
include_once "view/layout_footer.php";
?>