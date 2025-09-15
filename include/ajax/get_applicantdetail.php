<?php 
include "../dbsetting/lms_vars_config.php";
include "../dbsetting/classdbconection.php";
$dblms = new dblms();
include "../functions/login_func.php";
include "../functions/functions.php";

if(isset($_POST['refrence_no'])) {

	$conditionApplicant	=	array ( 
										'select'        =>  'ap_id, ap_fullname',
										'where'         =>  array( 
																	'ap_status'   		=>  1
																	,'ap_referenceno'	=>	cleanvars($_POST['refrence_no'])
																),
										'return_type'   =>  'single'
								  ); 
	$Applicant =   $dblms->getRows(APPLICANTS, $conditionApplicant);

	if($Applicant){
		//APPLICANT PRODUCT COMPLETE RECORD
		$cond_assignedProducts  =   array ( 
												'select'        =>  ''.PRODUCTS.'.product_name ,'.PRODUCTS.'.product_id,'.APPLICANT_PRODUCTS.'.ap_products_id',
												'join' 		    =>  'INNER JOIN '.PRODUCTS.' ON '.PRODUCTS.'.product_id = '.APPLICANT_PRODUCTS.'.id_product',
												'where'         =>  array( 
																			''.APPLICANT_PRODUCTS.'.id_applicant'   =>  cleanvars($Applicant['ap_id'])
																		),
												'return_type'   =>  'all'
										  ); 
		$assignedProducts =   $dblms->getRows(APPLICANT_PRODUCTS, $cond_assignedProducts);
		echo ' 
		<div class="row">
			<div class="col">
				<div class="form-group">
					<label class="form-label" > Applicant Name</label>
					<input type="text"  name="ap_fullname" class="form-control" value="'.$Applicant['ap_fullname'].'" readonly>
					<input type="hidden"  name="ap_id" class="form-control" value="'.$Applicant['ap_id'].'" readonly>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<label class="form-label">Products <span class="text-danger">*</span></label>
					<select class="form-control select2-show-search" name="ap_products_id" onchange="get_productdetail(this.value)" id="ap_products_id" data-placeholder="Choose one" required>
						<option label="Choose one"></option>';
						if($assignedProducts):
							foreach($assignedProducts as $product):
								echo'<option value="'.$product['ap_products_id'].'">'.$product['product_name'].'</option>';
							endforeach;
						endif;
						echo'
					</select>
				</div>
			</div>
		</div>
		<div id="getproductdetail"></div>';
		

		
	}else{
		echo '
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-body">
						<div class="">
							<div class="alert alert-danger" role="alert">
								No Record Found / Application isn\'t approved yet!
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>';
	}
}
?>