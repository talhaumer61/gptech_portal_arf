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
</div> 
<div class="expanel expanel-warning mt-3">
            <div class="expanel-heading">
                <h3 class="expanel-title">Finance</h3>
            </div>
            <div class="expanel-body">
                <div class="table-responsive">
                    <table id="data-table" class="table text-nowrap mb-0 table-bordered
                        <thead class="table-head">
                            <tr>
                                <th class="bg-transparent border-bottom-0 text-center wp-5">Month</th>
                                <th class="bg-transparent border-bottom-0">EMI</th>
                                <th class="bg-transparent border-bottom-0">Service Charges</th>
                                <th class="bg-transparent border-bottom-0">Principal Repayment</th>
                                <th class="bg-transparent border-bottom-0">Principal O/S</th>
                            </tr>
							 <tr>
                                <th class="bg-transparent border-bottom-0 text-center wp-5"></th>
                                <th class="bg-transparent border-bottom-0"></th>
                                <th class="bg-transparent border-bottom-0"></th>
                                <th class="bg-transparent border-bottom-0"></th>
                                <th class="bg-transparent border-bottom-0">'.number_format($_POST['financingamount']).'</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">';
							
                            	$monthlyInstallmentGrandTotal 	= 0;
                                $ServiceChargesGrandTotal 		= 0;
                                $principalRepaymentGrandTotal 	= 0;
                                $remainingLoanAmountGrandTotal	= 0;
								$chargesamount 					= 0;
								$Principalamount 				= ($_POST['financingamount']);

                             for($i=1; $i<=$_POST['tenure']; $i++){ 
													
													
								$PrincipalOS 		= ($Principalamount - $principalRepaymentGrandTotal);
								$ServiceCharges 	= ((($_POST['rent']/12) * $PrincipalOS)/100);
								$PrincipalRepayment = ceil($monthlyInstallment - floor($ServiceCharges));
                                echo '
                                <tr>
                                    <th scope="row" style="text-align:center; width:70px;">'.$i.'</th>
                                     <td>'.number_format($monthlyInstallment).'</td>
                                     <td>'.number_format($ServiceCharges).'</td>
                                     <td>'.number_format($PrincipalRepayment).'</td>
                                     <td>'.number_format($PrincipalOS-$PrincipalRepayment).'</td>
                                </tr>';
								$principalRepaymentGrandTotal 	= ($principalRepaymentGrandTotal + $PrincipalRepayment);
								$monthlyInstallmentGrandTotal 	= ($monthlyInstallmentGrandTotal + $monthlyInstallment);
								$ServiceChargesGrandTotal 		= ($ServiceChargesGrandTotal + $ServiceCharges);
								$remainingLoanAmountGrandTotal  = ($remainingLoanAmountGrandTotal + ($PrincipalOS));
                            }
                           
                            echo '
                                 <tr>
                                 	<th></th>
									<th>'.number_format($monthlyInstallmentGrandTotal).'</th>
									<th>'.number_format($ServiceChargesGrandTotal).'</th>
									<th>'.number_format($principalRepaymentGrandTotal).'</th>
									<th>'.number_format($principalRepaymentGrandTotal + $ServiceChargesGrandTotal).'</th>
								</tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>';
	
	
}