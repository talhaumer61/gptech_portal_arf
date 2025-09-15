<?php 
 echo '
	<!-- BOOTSTRAP JS -->
	<script src="assets/plugins/bootstrap/js/popper.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

	<!-- PNOTIFY NOTIFICATIONS JS -->
	<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
	
	<!-- SIDE-MENU JS -->
	<script src="assets/plugins/sidemenu/sidemenu.js"></script>
	
	<!-- Perfect SCROLLBAR JS-->
	<!-- <script src="assets/plugins/p-scroll/perfect-scrollbar.js"></script>
	<script src="assets/plugins/p-scroll/pscroll.js"></script> -->
	
	<!-- STICKY JS -->
	<script src="assets/js/sticky.js"></script>
	
	<!-- SELECT2 JS -->
	<script src="assets/plugins/select2/select2.full.min.js"></script>
	
	<!-- INTERNAL SELECT2 JS -->
	<script src="assets/plugins/select2/select2.full.min.js"></script>

	
    <!-- FILE UPLOAD JS -->
    <script src="assets/plugins/fileuploads/js/fileupload.js"></script>
    <script src="assets/plugins/fileuploads/js/file-upload.js"></script>
	
	<!-- INTERNAL DATA-TABLES JS-->
	<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
	<script src="assets/plugins/datatable/dataTables.responsive.min.js"></script>
	
	<!-- INDEX JS -->
	<script src="assets/js/index1.js"></script>
	<script src="assets/js/index.js"></script>
	
	<!-- CUSTOM JS -->
	<script src="assets/js/custom.js"></script>

	<!-- SELECT2 JS -->
	<script src="assets/plugins/select2/select2.full.min.js"></script>

	<!-- FORM ELEMENTS JS -->
	<script src="assets/js/formelementadvnced.js"></script>
	
	<!-- summernote -->
    <script src="assets/plugins/summernote-editor/summernote1.js"></script>
	<script src="assets/js/projects-new.js"></script>
	
	<!-- cleave.js -->
    <script src="assets/libs/cleave.js/cleave.min.js"></script>

    <!-- form masks init -->
    <script src="assets/js/form-masks.init.js"></script>';

 	echo'
	</body>
</html>';
include_once("modals/loancalculator.php");
echo '
<!-- FOOTER -->
<footer class="footer">
	<div class="container">
		<div class="row align-items-center flex-row-reverse">
			<div class="col-md-12 col-sm-12 text-center">
				'.COPY_RIGHTS_ORG.' <br>
				Powered by: <a href="'.COPY_RIGHTS_URL.'">'.COPY_RIGHTS.'</a> <small>v1.0</small>
			</div>
		</div>
	</div>
</footer>
<!-- FOOTER CLOSED -->
</div>
<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>';