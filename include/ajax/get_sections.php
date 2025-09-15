<?php 
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	// include "../functions/login_func.php";
	include "../functions/functions.php";
    
    if(isset($_POST['id_category'])):
        echo '
        <option value="">-- Select --</option>';
        $sqllmsCat	= $dblms->querylms("SELECT section_id , section_name
                                        FROM ".SECTIONS."
                                        WHERE id_category = '".$_POST['id_category']."' 
                                        AND id_deleted = '0' 
                                        AND section_status = '1' "
                                      );
                            
        while($rowvalues = mysqli_fetch_array($sqllmsCat)):
            echo '<option value="'.$rowvalues['section_id'].'">'.$rowvalues['section_name'].'</option>';
        endwhile;
    endif;
?>