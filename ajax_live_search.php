<?php 
require_once "config/db.php";
if (isset($_POST['query'])) {
    $query = "SELECT * FROM categories WHERE name LIKE '{$_POST['query']}%' LIMIT 100";
    $result = mysqli_query($connection, $query);

   

      if (mysqli_num_rows($result) > 0) {
        echo "<div style='color:blue; margin-top: 10px; '>";
        echo 'show found &nbsp;'.'<b>'.mysqli_num_rows($result).'</b>'.'&nbspresult ';
        echo "</div>";
        echo "<table class='table table-hover  table-bordered' style='margin-top:100px'>";
        echo "<tr style='with:100%' >";
        echo "<th>#</th>";
        echo "<th style='text-align:center' >Category</th>";
        echo "<th style='width:20%' >Actions</th>";
        echo "</tr>";
      
        while ($res = mysqli_fetch_array($result)) {
          extract($res);
         
          echo "<tr>";
          echo "<td >{$id}</td>";
           echo"<td style='text-align:center'>{$name}</td>";
  
          echo "<td>";
          echo "<a href='read_one.php?id={$id}' class='btn btn-primary left-margin'>
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
    }
    else
    {
      echo "
      <div class='alert alert-danger mt-3 text-center' role='alert'>
          Song not found
      </div>
      ";
    }
}