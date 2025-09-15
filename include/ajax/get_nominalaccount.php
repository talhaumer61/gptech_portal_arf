<?php 
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	// include "../functions/login_func.php";
	include "../functions/functions.php";
    
    if(isset($_POST['id_company'])):
        echo '
        <option value="">-- Select --</option>';
        $sqllms	= $dblms->querylms("SELECT account_id, account_name 
                                    FROM ".NOMINAL_ACCOUNTS."
                                    WHERE id_company = '".$_POST['id_company']."'
                                    AND id_deleted = '0' AND account_status = '1'
                                    ORDER BY account_id ASC");
                            
        while($rowvalues = mysqli_fetch_array($sqllms)):
            echo '<option value="'.$rowvalues['account_id'].'">'.$rowvalues['account_name'].'</option>';
        endwhile;
    endif;
?>