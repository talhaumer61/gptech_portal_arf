<?php 
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../functions/functions.php";
    
    if(isset($_POST['id_substate'])):
        echo '
        <option value="">Select</option>';
        $sqllms	= $dblms->querylms("SELECT city_id, city_name 
                                    FROM ".CITIES."
                                    WHERE id_substate = '".$_POST['id_substate']."'
                                    AND id_deleted = '0' AND city_status = '1'
                                    ORDER BY city_id ASC    
                                  ");
                            
        while($rowvalues = mysqli_fetch_array($sqllms)):
            echo '<option value="'.$rowvalues['city_id'].'">'.$rowvalues['city_name'].'</option>';
        endwhile;
    endif;
?>