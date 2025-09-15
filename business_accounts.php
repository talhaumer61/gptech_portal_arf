
<?php 
	include "include/dbsetting/lms_vars_config.php";
	include "include/dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "include/functions/login_func.php";
	include "include/functions/functions.php";
	checkCpanelLMSALogin();
	include "include/title-meta.php";
//-----------------------------------------------
echo '  
<!-- TITLE -->
<title>Manage Business Bank Accounts - '.TITLE_HEADER.'</title>
<!-- BOOTSTRAP CSS -->
<link id="style" href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<!-- STYLE CSS -->
<link href="assets/css/style.css" rel="stylesheet" />
<link href="assets/css/skin-modes.css" rel="stylesheet" />
<!--- FONT-ICONS CSS -->
<link href="assets/plugins/icons/icons.css" rel="stylesheet" />

<!-- Toaster -->
<link href="assets/css/toastr.css" rel="stylesheet" />
<script src="assets/js/jquery-1.9.1.min.js"></script>
<script src="assets/js/toastr.js"></script>

</head>
<body class="ltr app light-mode horizontal dark-menu dark-header">';
if(isset($_SESSION['msg'])){
    echo "<script type='text/javascript'>toastr.".$_SESSION['msg']['type']."('".$_SESSION['msg']['text']."','".$_SESSION['msg']['title']."')</script>";
    unset($_SESSION['msg']);
}
echo '
<!-- GLOBAL-LOADER -->
<div id="global-loader">
	<img src="assets/images/loader.svg" class="loader-img" alt="Loader">
</div>
<!-- /GLOBAL-LOADER -->
<!-- PAGE -->
<div class="page">
<div class="page-main">';
//---------------------------------------
	include "include/menu.php";
//---------------------------------------
echo '
<!--app-content open-->
<div class="app-content main-content mt-0">
<div class="side-app">
<!-- CONTAINER -->
<div class="main-container container-fluid">
<!-- PAGE-HEADER -->
<div class="page-header">
	<div><h1 class="page-title">Business Accounts</h1></div>
	<div class="ms-auto pageheader-btn">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="index.php">Home</a></li>
			<li class="breadcrumb-item"><a href="javascript:void(0);">Vendor</a></li>
			<li class="breadcrumb-item active" aria-current="page">Business Bank Accounts</li>
		</ol>
	</div>
</div>
<!-- PAGE-HEADER END -->
<!-- ROW OPEN -->
<div class="row row-sm">
<div class="col-lg-12">';
//------------------------------------------
	include_once ('include/settings/business_accounts/query.php');
    include_once ('include/settings/business_accounts/list.php');
	include_once("include/settings/business_accounts/modal-add.php");
//-----------------------------------------
echo '
</div>
</div>
<!-- ROW CLOSED -->                        
</div>
</div>
</div>
<!-- CONTAINER CLOSED -->
</div>';
//------------------------------------------
	include_once("include/footer.php");
//-----------------------------------------
echo '
    <!-- JQUERY JS -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    
    <!-- BOOTSTRAP JS -->
    <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- SIDE-MENU JS -->
    <script src="assets/plugins/sidemenu/sidemenu.js"></script>
    
    <!-- Perfect SCROLLBAR JS-->
    <script src="assets/plugins/p-scroll/perfect-scrollbar.js"></script>
    <script src="assets/plugins/p-scroll/pscroll.js"></script>
    
    <!-- STICKY JS -->
    <script src="assets/js/sticky.js"></script>
    
    <!-- SELECT2 JS -->
    <script src="assets/plugins/select2/select2.full.min.js"></script>
    
    <!-- INTERNAL DATA-TABLES JS-->
    <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="assets/plugins/datatable/dataTables.responsive.min.js"></script>
    
    <!-- INDEX JS -->
    <script src="assets/js/index1.js"></script>
    <script src="assets/js/index.js"></script>
    
    <!-- CUSTOM JS -->
    <script src="assets/js/custom.js"></script>

    <!-- FILE UPLOAD JS -->
    <script src="assets/plugins/fileuploads/js/fileupload.js"></script>
    <script src="assets/plugins/fileuploads/js/file-upload.js"></script>

    <!-- FORM ELEMENTS JS -->
    <script src="assets/js/formelementadvnced.js"></script>
    
    <script>
        function getBusiness(val) {
            console.log(val)
            $.ajax({
                type: "POST",
                url: "ajax/get_business.php",
                data: "id_vendor=" + val,
                success: function(data) {
                    console.log(data)
                    $("#id_business").html(data);
                }
            });
        }
    </script>
    ';

	include_once("include/settings/business_accounts/modal-edit.php");
	include_once("include/settings/business_accounts/modal-delete.php");
	echo'
</body>
</html>';
?>