<?php 
include_once ('organizations/query.php');
echo '  
<!-- TITLE -->
<title>Manage Organizations - '.TITLE_HEADER.'</title>
    <div class="app-content main-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
	                <div><h1 class="page-title">Organizations</h1></div>
                    <div class="ms-auto pageheader-btn">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Organizations</li>
                        </ol>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-lg-12">';
                        include_once ('organizations/list.php');
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
    function getState(val) {
        $.ajax({
            type: "POST",
            url: "include/ajax/get_state.php",
            data: "id_country=" + val,
            success: function(data) {
                $("#id_state").html(data);
            }
        });
    }
    function getSubState(val) {
        $.ajax({
            type: "POST",
            url: "include/ajax/get_substate.php",
            data: "id_state=" + val,
            success: function(data) {
                $("#id_substate").html(data);
            }
        });
    }
    function getCity(val) {
        $.ajax({
            type: "POST",
            url: "include/ajax/get_city.php",
            data: "id_substate=" + val,
            success: function(data) {
                $("#id_city").html(data);
            }
        });
    }
</script>';