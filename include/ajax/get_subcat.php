<?php 
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	// include "../functions/login_func.php";
	include "../functions/functions.php";
    
    if(isset($_POST['id_cat'])):
        $condition = array ( 
            'select'        =>  'subcat_id, subcat_name',
            'where'         =>  array(
                                        'id_cat'            =>  $_POST['id_cat']
                                        ,'subcat_status'    =>  1
                                        ,'is_deleted'       =>  0
                                    ), 
            'order_by' 		=>  'subcat_name',
            'return_type'   =>  'all'
           ); 
        $SubCategories = $dblms->getRows(PRODUCT_SUBCAT, $condition);

        echo '
        <option label="Choose one"></option>';
        foreach ($SubCategories as $subcat):
            echo '<option value="'.$subcat['subcat_id'].'">'.$subcat['subcat_name'].'</option>';
        endforeach;
    endif;
?>