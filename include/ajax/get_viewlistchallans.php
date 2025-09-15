<?php 
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	// include "../functions/login_func.php";
	include "../functions/functions.php";
    
    if(isset($_POST['id_ap_products']) && !empty($_POST['id_ap_products']) && isset($_POST['id_applicant']) && !empty($_POST['id_applicant'])):
        $condition = array ( 
            'select'        =>  'challan_id
                                ,status
                                ,challan_no
                                ,total_amount
                                ,paid_amount
                                ,issue_date
                                ,paid_date',
            'where'         =>  array(
                                        'id_ap_products'    =>  cleanvars($_POST['id_ap_products'])
                                        ,'id_applicant'     =>  cleanvars($_POST['id_applicant'])
                                    ), 
            'order_by' 		=>  'challan_id',
            'return_type'   =>  'all'
           ); 
        $ListChallans = $dblms->getRows(CHALLANS, $condition);
        if($ListChallans){
            $sr = 0;
            echo'
            <thead class="table-head">
                <tr>
                    <th class="bg-transparent border-bottom-0 text-center wp-5">Sr#</th>
                    <th class="bg-transparent border-bottom-0">Challan No</th>
                    <th class="bg-transparent border-bottom-0 text-center wp-10">Total Amount</th>
                    <th class="bg-transparent border-bottom-0 text-center wp-10">Paid Amount</th>
                    <th class="bg-transparent border-bottom-0 text-center wp-10">Issue Date</th>
                    <th class="bg-transparent border-bottom-0 text-center wp-10">Paid Date</th>
                    <th class="bg-transparent border-bottom-0 text-center wp-7">Status</th>
                </tr>
            </thead>
            <tbody class="table-body">
            ';
            foreach($ListChallans as $challans):
                $sr++;
                echo'
                <tr>
                    <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                    <td class="text-muted fs-14 fw-semibold">'.$challans['challan_no'].'</td>
                    <td class="text-muted fs-14 fw-semibold">'.$challans['total_amount'].'</td>
                    <td class="text-muted fs-14 fw-semibold">'.$challans['paid_amount'].'</td>
                    <td class="text-muted fs-14 fw-semibold">'.$challans['issue_date'].'</td>
                    <td class="text-muted fs-14 fw-semibold">'.$challans['paid_date'].'</td>
                    <td class="text-muted fs-14 text-center">'.get_challanstatus($challans['status']).'</td>
                </tr>';
            endforeach;
            echo'
            </tbody>';
        }else{
            echo '
            <tr>
                <td class="text-muted fs-14 fw-semibold text-center text-red p-7">No Challans Exist...</td>
            </tr>';
        }
    endif;
?>