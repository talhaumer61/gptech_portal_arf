<?php 
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	// include "../functions/login_func.php";
	include "../functions/functions.php";
    
    if(isset($_POST['id_bank'])){
        $condition = array ( 
            'select'        =>  'businessact_id, businessact_number',
            'where'         =>  array(
                                        'id_bank'               =>  $_POST['id_bank']
                                        ,'businessact_status'   =>  1
                                        ,'is_deleted'           =>  0
                                    ), 
            'order_by' 		=>  'businessact_number',
            'return_type'   =>  'all'
           ); 
        $Businessaccounts = $dblms->getRows(BUSINESSACT, $condition);

        echo '
        <option label="Choose one"></option>';
        foreach ($Businessaccounts as $businessact):
            echo '<option value="'.$businessact['businessact_id'].'">'.$businessact['businessact_number'].'</option>';
        endforeach;
    }elseif(isset($_POST['id_business'])){
        $condition = array ( 
            'select'        =>  ''.LINKACCOUNT.'.id_businessact
                                ,'.BUSINESSACT.'.businessact_number
                                ,'.BUSINESSACT.'.businessact_id',
            'where'         =>  array(
                                        ''.LINKACCOUNT.'.id_business'   =>  cleanvars($_POST['id_business'])
                                        ,''.BUSINESSACT.'.is_deleted'   =>  0
                                    ), 
            'join'          =>  'INNER JOIN '.BUSINESSACT.' ON '.BUSINESSACT.'.businessact_id = '.LINKACCOUNT.'.id_businessact',
            'order_by' 		=>  ''.LINKACCOUNT.'.id',
            'return_type'   =>  'all'
           ); 
        $Businessaccounts = $dblms->getRows(LINKACCOUNT, $condition);

        echo '
        <option label="Choose one"></option>';
        foreach ($Businessaccounts as $businessact):
            echo '<option value="'.$businessact['businessact_id'].'">'.$businessact['businessact_number'].'</option>';
        endforeach;
    }
?>