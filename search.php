<?php 
include_once  'config/database.php';
include_once 'model/category.php';
include_once "view/layout_header.php";
?>
<div class="container mt-5" style="max-width: 555px; margin-top:50px">

</div>
<form action="search.php">
    <input type="text" class="form-control" name="live_search" id="live_search" autocomplete="off"
        placeholder="Search ...">
    <a href="search.php"></a>
</form>

<div id="search_result"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
//search ajax
$(document).ready(function() {
    $("#live_search").keyup(function() {
        var query = $(this).val();
        if (query != "") {
            $.ajax({
                url: 'ajax_live_search.php',
                method: 'POST',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#search_result').html(data);
                    $('#search_result').css('display', 'block');
                    $("#live_search").focusout(function() {
                        $('#search_result').css('display', 'none');
                    });
                    $("#live_search").focusin(function() {
                        $('#search_result').css('display', 'block');
                    });
                }
            });
        } else {
            $('#search_result').css('display', 'none');
        }
    });
});
</script>