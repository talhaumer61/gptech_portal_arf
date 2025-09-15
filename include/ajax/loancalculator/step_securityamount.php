<?php 
if(isset($_POST['assestcost'])) { 
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
	
echo '
	<div class="form-group">
		<label class="form-label" for="card-name">Security Amount </label>
		<input class="form-control" type="text" id="securityamount" name="securityamount" required onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" autocomplete="off" value="'.cal_percentage($_POST['assestcost'],PERCENTAGE).'" required>
	</div>
	
	<div class="form-group">
		<label class="form-label" for="card-name">Down Payment</label>
		<input class="form-control" type="text" id="downpayment" name="downpayment" required onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" autocomplete="off" onKeyUp="step_financingamount(this.value, '.$_POST['assestcost'].')" required>
	</div>
	
	<div id="stepfinancingamount">
		<div class="form-group">
			<label class="form-label" for="card-name">Financing Amount</label>
			<input class="form-control" type="text" id="financingamount" name="financingamount" required onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" autocomplete="off" readonly required>
		</div>

		<div class="form-group">
			<label class="form-label" for="card-name">Tenure (number of months)</label>
			<input class="form-control" type="text" id="tenure" name="tenure" required onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" autocomplete="off" readonly required>
		</div>

		<div class="form-group">
			<label class="form-label" for="card-name">Rent %</label>
			<input class="form-control" type="text" id="rent" name="rent" required onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" autocomplete="off" readonly required>
		</div>

	</div>';
}