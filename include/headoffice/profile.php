
<?php
   echo '  
	<!-- TITLE -->
	<title>Manage Profile - '.TITLE_HEADER.'</title>
	<!--app-content open-->
	<div class="app-content main-content mt-0">
		<div class="side-app">
			<!-- CONTAINER -->
			<div class="main-container container-fluid">
				<div class="page-content">
					';
					include_once ('profile/query.php');
					include_once ('profile/view.php');
					echo '
				</div>
			</div>
		</div>
	</div>
	<!-- CONTAINER CLOSED -->
	</div>';
?>