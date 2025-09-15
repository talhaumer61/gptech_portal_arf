<?php 
include "../dbsetting/lms_vars_config.php";
include "../dbsetting/classdbconection.php";
$dblms = new dblms();
include "../functions/login_func.php";
include "../functions/functions.php";

if(isset($_POST['ap_products_id'])) {

	$conditionProductDetail	=	array ( 
										'select'        =>  'id_applicant, number_of_months,interest_rate, monthly_installment, financing_amount, ap_products_id, installment_due_date',
										'where'         =>  array( 
																	'ap_products_id'	=>	cleanvars($_POST['ap_products_id'])
																 ),
										'return_type'   =>  'single'
									  ); 
	$productDetail =   $dblms->getRows(APPLICANT_PRODUCTS, $conditionProductDetail);

	if($productDetail){

		//Total Received from Applicant
		$conditionChallan	=	array ( 
										'select'        =>  'COUNT(challan_id) as totalInstallments, SUM(paid_amount) as totalReceived',
										'where'         =>  array( 
																	'challan_type'	=>	2
																	,'id_ap_products'	=>	cleanvars($_POST['ap_products_id'])
																),
										'return_type'   =>  'single'
									  ); 
		$ChallanInfo =   $dblms->getRows(CHALLANS, $conditionChallan);

		$installmentNo = ($ChallanInfo['totalInstallments'] + 1);
		if($ChallanInfo['totalReceived'] == ''){
			$totalReceived = 0;
		} else {
			$totalReceived = $ChallanInfo['totalReceived'];
		}
		if($installmentNo == 1){ 
			$serviceChages 		= 	round((($productDetail['interest_rate'] /12) /100) * $productDetail['financing_amount']);
			$principalAmount 	= 	round($productDetail['monthly_installment'] - $serviceChages);
			$principalReAmount 	= 	round($productDetail['financing_amount'] - $principalAmount);	
		}else{
			//Total Received from Applicant
			$previousChallanChallan	=	array ( 
												'select'        =>  'principal_os',
												'where'         =>  array( 
																			'challan_type'	=>	2
																			,'id_ap_products'	=>	cleanvars($_POST['ap_products_id'])
																		),
												'order_by'   =>  'challan_id DESC',						
												'return_type'   =>  'single'
											  ); 
			$previousChallan =   	$dblms->getRows(CHALLANS, $previousChallanChallan);
			$serviceChages 		= 	round((($productDetail['interest_rate'] /12) /100) * $previousChallan['principal_os']);
			$principalAmount 	= 	round($productDetail['monthly_installment'] - $serviceChages);
			$principalReAmount 	= 	round($previousChallan['principal_os'] - $principalAmount);
			
		}
		
		$totalReceiveable = ($productDetail['monthly_installment']*$productDetail['number_of_months']);

		//Check if Installment # is equal to Applicant's Total Installments
		if($productDetail['number_of_months'] == $installmentNo){
			$installmentAmount = ($totalReceiveable - $totalReceived);
		} else {
			$installmentAmount = $productDetail['monthly_installment'];
		}
		echo ' 
		<div class="row">
			<div class="col">
				<div class="form-group">
					<label for="ap_doj"> Total Financing Amount</label>
					<input type="text" id="ap_financing_amount" name="ap_financing_amount" class="form-control" value="'.$productDetail['financing_amount'].'" readonly>
				</div>
			</div>

			<div class="col">
				<div class="form-group">
					<label for="total_received"> Total Received Amount</label>
					<input type="text" id="total_received" name="total_received" class="form-control" value="'.$totalReceived.'" readonly>
				</div>
			</div>

		</div>
		<div class="row">
			<div class="col">
				<div class="form-group">
					<label for="installment"> Installment #</label>
					<input type="text" id="installment_no" name="installment_no" class="form-control" value="'.$installmentNo.'" readonly>
				</div>
			</div>

			<div class="col">
				<div class="form-group">
					<label for="installment"> Installment Amount</label>
					<input type="text" id="total_amount" name="installment_amount" class="form-control" value="'.$installmentAmount.'" readonly>
					<input type="hidden" name="principal_amount" class="form-control" value="'.$principalReAmount.'" readonly>
				</div>
			</div>
		</div>

		<div class="row">';
			foreach($challanHeads as $head):
				echo '
				<div class="col-lg-4">
					<div class="form-group">
						<label for="challan_heads"> '.$head['name'].'</label>
						<input type="number" id="challan_heads" name="challan_heads['.$head['id'].']" class="form-control challanHeads" onchange="calculateSum()" '.($head['id'] == 2 ||  $head['id'] == 3 ? 'readonly' : '').'  value="'.($head['id'] == 2 ? $principalAmount : ($head['id'] == 3 ? $serviceChages : '' )).'" >
					</div>
				</div>';
			endforeach;
			echo'
		</div>
		

		<div class="row">
			
			<div class="col">
				<div class="form-group">
					<label for="issue_date">Total Payable <span class="text text-danger"> *</span></label>
					<input type="text" id="grand_total" name="grand_total" class="form-control" value="'.$installmentAmount.'" required readonly>
				</div>
			</div>

			<div class="col">
				<div class="form-group">
					<label for="issue_date"> Issue Date<span class="text text-danger"> *</span></label>
					<input type="date" id="issue_date" name="issue_date" class="form-control" required value="'.date('Y-m-d').'" readonly>
				</div>
			</div>

			<div class="col">
				<div class="form-group">
					<label class="form-id_month">For Month <span class="text-danger">*</span></label>
					<select class="form-control select2-show-search" name="id_month" id="id_month" data-placeholder="Choose one" required>
						<option label="Choose one"></option>';
						foreach($monthTypes as $month):
							echo'<option value="'.$month['id'].'">'.$month['name'].'</option>';
						endforeach;
						echo'
					</select>
				</div>
			</div>

		</div>';

		if($totalReceived < $totalReceiveable){
			echo 
			'<input type="hidden" name="id_applicant" value="'.$productDetail['id_applicant'].'">
			 <input type="hidden" name="id_ap_products" value="'.$productDetail['ap_products_id'].'">';
		}else{
			echo '
			<div class="row">
				<div class="col">
					<div class="card">
						<div class="card-body">
                            <div class="alert alert-danger" role="alert">
                                Total amount has already been received.
                            </div>
						</div>
					</div>
				</div>
			</div>';
		}
	}
}
?>