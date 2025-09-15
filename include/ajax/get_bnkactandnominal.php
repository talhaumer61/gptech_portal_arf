<?php 
include "../dbsetting/lms_vars_config.php";
include "../dbsetting/classdbconection.php";
$dblms = new dblms();
include "../functions/login_func.php";
include "../functions/functions.php";

if(isset($_POST['id_company'])):
    echo '
    <div class="col">
        <label class="form-label">Bank Account <span class="text-danger">*</span></label>
        <select name="id_bnkact" class="form-control" required>
            <option value="">-- Select --</option>';
            $sqllmsBankAccount = $dblms->querylms("SELECT bnkact_id, bnkact_name
                                                    FROM ".BANK_ACCUONTS."
                                                    WHERE id_company = '".$_POST['id_company']."'
                                                    AND id_deleted = '0'
                                                    AND bnkact_status = '1'
                                                    ORDER BY bnkact_id DESC");
            while($valuesBankAccount = mysqli_fetch_array($sqllmsBankAccount)):
                echo'<option value="'.$valuesBankAccount['bnkact_id'].'">'.$valuesBankAccount['bnkact_name'].'</option>';
            endwhile;
            echo'
        </select>
    </div>
    <div class="col">
        <label class="form-label">Nominal Account <span class="text-danger">*</span></label>
        <select name="id_account" class="form-control" required>
            <option value="">-- Select --</option>';
            $sqllmsNominalAccount = $dblms->querylms("SELECT account_id, account_name
                                                    FROM ".NOMINAL_ACCOUNTS."
                                                    WHERE id_company = '".$_POST['id_company']."'
                                                    AND id_deleted = '0'
                                                    AND account_status = '1'
                                                    ORDER BY account_id DESC");
            while($valuesNominalAccount = mysqli_fetch_array($sqllmsNominalAccount)):
                echo'<option value="'.$valuesNominalAccount['account_id'].'">'.$valuesNominalAccount['account_name'].'</option>';
            endwhile;
            echo'
        </select>
    </div>';
endif;
?>