<?php 
if(isset($_POST['tenure']) && isset($_POST['financingamount'])) { 
	include "../../dbsetting/lms_vars_config.php";
	include "../../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../../functions/login_func.php";
	include "../../functions/functions.php";
	checkCpanelLMSALogin();
	
echo '

			<div class="form-group">
				<label class="form-label" for="card-name">Rent %</label>
				<input class="form-control" type="text" id="rent" name="rent" required onblur="getFinance()" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" autocomplete="off" onKeyUp="step_loanmonthlyinstallment(this.value, '.$_POST['tenure'].', '.$_POST['financingamount'].')" required>
			</div>
		<div id="steploanmonthlyinstallment">
		 <div class="row mt-3">
            <div class="col">
                <div class="form-group">
                    <label for="monthly_installment">Equal Monthly Installment (Rs.)</label>
                    <input type="text" class="form-control" id="monthly_installment" name="monthly_installment" value="" readonly required>
                </div>
            </div>
        </div>
		</div>';
}