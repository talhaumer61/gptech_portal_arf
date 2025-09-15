<?php 
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	// include "../functions/login_func.php";
	include "../functions/functions.php";
    
    if(isset($_POST['id_business'])):
        $condition = array ( 
            'select'        =>  ''.LINKACCOUNT.'.id
                                ,'.LINKACCOUNT.'.id_bank
                                ,'.LINKACCOUNT.'.id_businessact
                                ,'.LINKACCOUNT.'.is_default
                                ,'.BANKS.'.bank_name
                                ,'.BUSINESSACT.'.businessact_number',
            
            'join' 		    =>  'INNER JOIN '.BANKS.' ON '.BANKS.'.bank_id = '.LINKACCOUNT.'.id_bank
                                INNER JOIN '.BUSINESSACT.' ON '.BUSINESSACT.'.businessact_id = '.LINKACCOUNT.'.id_businessact',
            'where'         =>  array(
                                        ''.LINKACCOUNT.'.id_business'   =>  $_POST['id_business']
                                    ), 
            'order_by' 		=>  ''.LINKACCOUNT.'.id',
            'return_type'   =>  'all'
           ); 
        $LinkAccounts = $dblms->getRows(LINKACCOUNT, $condition);

        if($LinkAccounts){
            $sr = 0;
            echo'
            <thead class="table-head">
                <tr>
                    <th class="bg-transparent border-bottom-0 text-center wp-5">Sr#</th>
                    <th class="bg-transparent border-bottom-0">Bank</th>
                    <th class="bg-transparent border-bottom-0">Account No.</th>
                    <th class="bg-transparent border-bottom-0 text-center wp-7">Is Default</th>
                    <th class="bg-transparent border-bottom-0 text-center wp-7">Action</th>
                </tr>
            </thead>
            <tbody class="table-body">
            ';
            foreach($LinkAccounts as $accounts):
                $sr++;
                echo '
                <tr>
                    <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                    <td class="text-muted fs-14 fw-semibold">'.$accounts['bank_name'].'</td>
                    <td class="text-muted fs-14 fw-semibold">'.$accounts['businessact_number'].'</td>
                    <td class="text-muted fs-14 text-center">'.get_statusyesno($accounts['is_default']).'</td>
                    <td class="text-muted fs-14 text-center">
                        <a class="btn btn-xs btn-danger deleteModel" data-bs-target="#delete" 
                        data-business-id    =   "'.$accounts['id'].'"
                        data-bs-toggle="modal" href="javascript:void(0)">
                            <i class="fe fe-trash"></i>
                        </a>
                    </td>
                </tr>';
            endforeach;
            echo'
            </tbody>';
        }else{
            echo '
            <tr>
                <td class="text-muted fs-14 fw-semibold text-center text-red p-7">No Linked Accounts Exist...</td>
            </tr>';
        }
    endif;
?>