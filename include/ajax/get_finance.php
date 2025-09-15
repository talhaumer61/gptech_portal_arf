<?php 
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../functions/functions.php";
    
    if(isset($_POST['number_of_months']) && isset($_POST['interest'])  && isset($_POST['loan_amount']) && isset($_POST['actual_price'])):
        $ap_actual_price    = $_POST['actual_price'];
        $months             = $_POST['number_of_months'];
      //  $interest           = $_POST['interest'] / 1200;
       // $amount             = $interest * -$_POST['loan_amount'] * pow((1 + $interest), $months) / (1 - pow((1 + $interest), $months));
        $monthlyInstallment = round(PMT($_POST['interest'], $_POST['number_of_months'], $_POST['loan_amount']));
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
                                <th class="bg-transparent border-bottom-0">'.number_format($_POST['loan_amount']).'</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">';
							
                            	$monthlyInstallmentGrandTotal 	= 0;
                                $ServiceChargesGrandTotal 		= 0;
                                $principalRepaymentGrandTotal 	= 0;
                                $remainingLoanAmountGrandTotal	= 0;
								$chargesamount 					= 0;
								$Principalamount 				= ($_POST['loan_amount']);

                             for($i=1; $i<=$_POST['number_of_months']; $i++){ 
													
													
								$PrincipalOS 		= ($Principalamount - $principalRepaymentGrandTotal);
								$ServiceCharges 	= ((($_POST['interest']/12) * $PrincipalOS)/100);
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
        </div>
        ';
    endif;
?>