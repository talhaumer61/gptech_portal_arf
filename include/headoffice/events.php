<?php 
include_once ('settings/site_settings/events/query.php');
echo '  
<!-- TITLE -->
<title>Manage Events - '.TITLE_HEADER.'</title>
    <div class="app-content main-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
	                <div><h1 class="page-title">Events</h1></div>
                    <div class="ms-auto pageheader-btn">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Site Settings</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Events</li>
                        </ol>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-lg-12">';
                        if(isset($_GET['add'])){
                            include_once ('settings/site_settings/events/add.php');
                        }elseif($_GET['view'] == 'photos'){
                            include_once ('settings/site_settings/events/photos.php');
                        }elseif($_GET['view'] == 'edit'){
                            include_once ('settings/site_settings/events/edit.php');
                        }else{
                            include_once ('settings/site_settings/events/list.php');
                        }
                        echo '
                    </div>
                </div>                     
            </div>
        </div>
    </div>
</div>
<!-- INCLUDES MODAL -->
<script type="text/javascript">
    function showAjaxModalZoom(url) {
        jQuery( \'#show_modal\' ).html( \'<div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document"><div style="text-align:center; "><img src="assets/images/preloader.gif"/></div></div>\' );
        $.ajax( {
            url: url,
            success: function ( response ) {
                jQuery( \'#show_modal\' ).html( response );
                $("#show_modal").modal("show");
            }
        } );
    }
</script>
<!-- (STYLE AJAX MODAL)-->
<div class="modal fade"  id="show_modal"></div>
<script type="text/javascript">
    function confirm_modal( delete_url ) {
        swal( {
            title: "Are you sure?",
            text: "Are you sure that you want to delete this information?",
            type: "warning",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
            confirmButtonColor: "#181B1F"
        }, function () {
            $.ajax( {
                url: delete_url,
                type: "POST"
            } )
            .done( function ( data ) {
                swal( {
                    title: "Deleted",
                    text: "Information has been successfully deleted",
                    type: "success"
                }, function () {
                    location.reload();
                } );
            } )
            .error( function ( data ) {
                swal( "Oops", "We couldn\'t\ connect to the server!", "error" );
            } );
        } );
    }
</script>';
?>
<script>
document.getElementById("duplicateButton").addEventListener("click", function() {
    event.preventDefault();
    // Create clone
    var event_photo = document.getElementById("event_photo");
    var clonedDiv = event_photo.cloneNode(true);

    // Reset input values in the cloned div
    var clonedInput = clonedDiv.querySelector("input[name='event_photo[]']");
    clonedInput.value = ''; // Clear the input value

    // Add delete button to the cloned div
    var deleteButton = clonedDiv.querySelector(".delete-button");
    deleteButton.style.display = "inline-block"; // Show delete button
    deleteButton.disabled = false; // Enable the delete button
    deleteButton.addEventListener("click", function() {
        clonedDiv.remove(); // Remove the cloned div when delete button is clicked
    });

    var targetDiv = document.getElementById('targetDiv');
    targetDiv.appendChild(clonedDiv);
});

document.addEventListener("DOMContentLoaded", function() {
    var deleteButtons = document.querySelectorAll(".delete-button");    
    deleteButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            var index = parseInt(button.getAttribute("data-index"));
            var row = button.closest(".row");
            row.remove();
        });
    });
});
</script>