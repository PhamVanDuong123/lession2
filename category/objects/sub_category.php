<?php
 
 $conn = mysqli_connect('localhost', 'root', '', 'demo');
 
 $sql = 'SELECT * FROM categories';
  
 $result = mysqli_query($conn, $sql);
  
 $categories = array();
  
 while ($row = mysqli_fetch_assoc($result)){
     $categories[] = $row;
 }
  
 // BƯỚC 2: HÀM ĐỆ QUY HIỂN THỊ CATEGORIES
 function showCategories($categories, $parent_id = 0, $char = '')
 {
     foreach ($categories as $key => $item)
     {
         // Nếu là chuyên mục con thì hiển thị
         if ($item['parent_id'] == $parent_id)
         {
             echo '<tr>';
                 echo '<td>';
                     echo $char . $item['name'];
                 echo '</td>';
             echo '</tr>';
              
             // Xóa chuyên mục đã lặp
             unset($categories[$key]);
              
             // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
             showCategories($categories, $item['id'], $char.'|---');
         }
     }
 }
?>