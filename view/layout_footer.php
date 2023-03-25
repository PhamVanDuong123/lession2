</div>
<!-- /container -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- bootbox library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script>
// JavaScript for deleting product
$(document).on('click', '.delete-object', function() {

    var id = $(this).attr('delete-id');

    bootbox.confirm({
        message: "<h4>Are you sure?</h4>",
        buttons: {
            confirm: {
                label: '<span class="glyphicon glyphicon-ok"></span> Yes',
                className: 'btn-danger'
            },
            cancel: {
                label: '<span class="glyphicon glyphicon-remove"></span> No',
                className: 'btn-primary'
            }
        },
        callback: function(result) {

            if (result == true) {
                $.post('delete_category.php', {
                    object_id: id
                }, function(data) {
                    location.reload();
                }).fail(function() {
                    alert('Unable to delete.');
                });
            }
        }
    });

    return false;
});
$(document).on("click", "a.profile", function() {
    var pid = $(this).data("id");
    $.ajax({
        url: "/phpcrudajax/ajax.php",
        type: "GET",
        dataType: "json",
        data: {
            id: pid,
            action: "getuser"
        },
        success: function(player) {
            if (player) {
                const userphoto = player.photo ? player.photo : "default.png";
                const profile = `<div class="row">
                <div class="col-sm-6 col-md-4">
                  <img src="uploads/${userphoto}" class="rounded responsive" />
                </div>
                <div class="col-sm-6 col-md-8">
                  <h4 class="text-primary">${player.pname}</h4>
                  <p class="text-secondary">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i> ${player.email}
                    <br />
                    <i class="fa fa-phone" aria-hidden="true"></i> ${player.phone}
                  </p>
                </div>
              </div>`;
                $("#profile").html(profile);
            }
        },
        error: function() {
            console.log("something went wrong");
        },
    });
});
</script>
</body>

</html>