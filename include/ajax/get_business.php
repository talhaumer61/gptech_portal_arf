<?php 
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	// include "../functions/login_func.php";
	include "../functions/functions.php";
    
    if(isset($_POST['id_vendor'])):
        $condition = array ( 
            'select'        =>  'business_id, business_name',
            'where'         =>  array(
                                        'id_vendor'         =>  $_POST['id_vendor']
                                        ,'business_status'  =>  1
                                        ,'is_deleted'       =>  0
                                    ), 
            'order_by' 		=>  'business_name',
            'return_type'   =>  'all'
           ); 
        $Businesses = $dblms->getRows(BUSINESS, $condition);

        echo '
        <option label="Choose one"></option>';
        foreach ($Businesses as $business):
            echo '<option value="'.$business['business_id'].'">'.$business['business_name'].'</option>';
        endforeach;
    endif;
?>