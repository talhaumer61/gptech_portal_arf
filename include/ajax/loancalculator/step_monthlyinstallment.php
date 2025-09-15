<?php 
if(isset($_POST['tenure']) && isset($_POST['financingamount'])  && isset($_POST['rent'])) { 
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
	
	$monthlyInstallment = round(PMT($_POST['rent'], $_POST['tenure'], $_POST['financingamount']));
	
echo '
<div class="row mt-3">
	<div class="col">
		<div class="form-group">
			<label for="monthly_installment">Equal Monthly Installment (Rs.)</label>
			<input type="text" class="form-control" id="monthly_installment" name="monthly_installment" value="'.$monthlyInstallment.'" readonly required>
		</div>
	</div>
</div>';
}