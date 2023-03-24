
<!-- profile modal start -->

<?php

if ($num > 0) {

    echo "<table class='table table-hover  table-bordered' style='margin-top:100px'>";
    echo "<tr style='with:100%' >";
    echo "<th>#</th>";
    echo "<th style='text-align:center' >Category</th>";
    echo "<th style='width:20%' >Actions</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);
       
        echo "<tr>";
        echo "<td >{$id}</td>";
         echo"<td style='text-align:center'>{$name}</td>";

        echo "<td>";
        echo "<a href='detail.php?id={$id}' class='btn btn-primary left-margin' >
        <span class='glyphicon glyphicon-copy'></span> 
            </a>
              
            <a href='update_category.php?id={$id}' class='btn btn-info left-margin'>
                <span class='glyphicon glyphicon-edit'></span> 
            </a>
              
            <a delete-id='{$id}' class='btn btn-danger delete-object'>
                <span class='glyphicon glyphicon-remove'></span> 
            </a>";
        echo "</td>";

        echo "</tr>";
    }

    echo "</table>";

    // paging buttons will be here
}

// tell the user there are no categorys
else {
    echo "<div class='alert alert-info'>No categorys found.</div>";
}

?>

