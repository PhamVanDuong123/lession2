<?php
// search form
echo "<form role='search' action='search.php' style='margin-top:20px'>";
  
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input type='text' class='form-control' placeholder='Type product name or description...' name='s' id='srch-term' required {$search_value} />";
        echo "<div class='input-group-btn'>";
            echo "<button class='btn btn-primary'  type='submit'><i class='glyphicon glyphicon-search'></i></button>";
        echo "</div>";
    
echo "</form>";
  
// create product button
echo "<div class='right-button-margin'>";
    echo "<a href='create_product.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> ";
    echo "</a>";
echo "</div>";
?>
