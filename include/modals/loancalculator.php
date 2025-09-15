<?php 
echo '

<!-- MODAL EFFECTS -->
<div class="modal fade"  tabindex="-1" role="dialog" id="modalloancalculator">
	<div class="modal-dialog  modal-xl" role="dialog">
		<div class="modal-content  modal-dialog-scrollable expanel expanel-primary">
			<div class="modal-header expanel-heading">
				<h6 class="modal-title">Loan Calculator</h6>
				<button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
			</div>
				<div class="modal-body expanel-body text-start">
				
					<div class="form-group">
						<label class="form-label" for="card-name">Total Cost of Asset</label>
						<input class="form-control"  type="text" id="assestcost" name="assestcost" required onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" autocomplete="off" onKeyUp="step_securityamount(this.value)" required>
					</div>
					
					<div id="stepsecurityamount">
						<div class="form-group">
							<label class="form-label" for="card-name">Security Amount</label>
							<input class="form-control" type="text" id="securityamount" name="securityamount" required onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" autocomplete="off" readonly required>
						</div>
						<div class="form-group">
							<label class="form-label" for="card-name">Down Payment</label>
							<input class="form-control" type="text" id="downpayment" name="downpayment" required onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" autocomplete="off" readonly required>
						</div>
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

					</div>

				</div>
				<div class="expanel-footer modal-footer">
					<a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
				</div>
			
		</div>
	</div>
</div>

<script>
function step_securityamount(assestcost) {  
	$("#loading").html(\'loading...\');  
	$.ajax({  
		type: "POST",  
		url: "ajax/loancalculator/step_securityamount.php",  
		data: "assestcost="+assestcost,  
		success: function(msg){  
			$("#stepsecurityamount").html(msg); 
			$("#loading").html(\'\'); 
		}
	});  
}

function step_financingamount(downpayment,assestcost) {  
	$("#loading").html(\'loading...\');  
	$.ajax({  
		type: "POST",  
		url: "ajax/loancalculator/step_financingamount.php",  
		data: "downpayment="+downpayment+"&assestcost="+assestcost,  
		success: function(msg){  
			$("#stepfinancingamount").html(msg); 
			$("#loading").html(\'\'); 
		}
	});  
}

function step_tenure(financingamount) {  
	$("#loading").html(\'loading...\');  
	$.ajax({  
		type: "POST",  
		url: "ajax/loancalculator/step_tenure.php",  
		data: "financingamount="+financingamount,  
		success: function(msg){  
			$("#steptenure").html(msg); 
			$("#loading").html(\'\'); 
		}
	});  
}

function step_rent(tenure,financingamount) {  
	$("#loading").html(\'loading...\');  
	$.ajax({  
		type: "POST",  
		url: "ajax/loancalculator/step_rent.php",  
		data: "tenure="+tenure+"&financingamount="+financingamount,  
		success: function(msg){  
			$("#steprent").html(msg); 
			$("#loading").html(\'\'); 
		}
	});  
}

function step_loanmonthlyinstallment(rent, tenure,financingamount) {  
	$("#loading").html(\'loading...\');  
	$.ajax({  
		type: "POST",  
		url: "ajax/loancalculator/step_loanmonthlyinstallment.php",  
		data: "rent="+rent+"&tenure="+tenure+"&financingamount="+financingamount,  
		success: function(msg){  
			$("#steploanmonthlyinstallment").html(msg); 
			$("#loading").html(\'\'); 
		}
	});  
}


</script>';