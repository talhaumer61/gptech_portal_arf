<?php 
include_once ('donation/packages_causes/query.php');
echo '  
<!-- TITLE -->
<title>Manage Packages & Causes - '.TITLE_HEADER.'</title>
    <div class="app-content main-content mt-0">
        <div class="side-app">
            <div class="main-container container-fluid">
                <div class="page-header">
	                <div><h1 class="page-title">Packages & Causes</h1></div>
                    <div class="ms-auto pageheader-btn">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Donation</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Packages & Causes</li>
                        </ol>
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-lg-12">';
                        if(isset($_GET['add'])){
                            include_once ('donation/packages_causes/add.php');
                        }elseif(isset($_GET['id'])){
                            include_once ('donation/packages_causes/edit.php');
                        }else{
                            include_once ('donation/packages_causes/list.php');
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
        $.ajax( {
            url: url,
            success: function ( response ) {
                jQuery( \'#show_modal\' ).html( response );
                $("#show_modal").modal("show");
            }
        } );
    }
    function changeType(id_type) {
        if (id_type == "1") {
            $("#pc_start_date").removeAttr("style").hide();
            $("#pc_end_date").removeAttr("style").hide();
            $("#id_duration_type").removeAttr("style").show();
            $("#pc_duration").removeAttr("style").show();
        }
        if(id_type == "2"){
            $("#id_duration_type").removeAttr("style").hide();
            $("#pc_duration").removeAttr("style").hide();
            $("#pc_start_date").removeAttr("style").show();
            $("#pc_end_date").removeAttr("style").show();
        }
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