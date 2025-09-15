<?php 
	include "../dbsetting/lms_vars_config.php";
	include "../dbsetting/classdbconection.php";
	$dblms = new dblms();
	include "../functions/login_func.php";
	include "../functions/functions.php";
    
    if(isset($_POST['ap_job_status']) && $_POST['ap_job_status'] == 1){
        // GET DATA FOR EDIT INFORMATION
        $condition    =   array ( 
                                    'select'        =>  'ap_profession, ap_organization, ap_organization_type, ap_doj, ap_office_phone, ap_office_email, ap_office_address, ap_monthly_income, ap_previous_loan, ap_previous_loan_deduction',
                                    'where'         =>  array( 
                                                                'ap_id' => cleanvars($_GET['ap_id']),
                                                            ), 
                                    'return_type'   =>  'single'
                                ); 
        $editApplicant =   $dblms->getRows(APPLICANTS, $condition);
        if($editApplicant){
            echo'
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="form-label">Occupation/Profession <span class="text-danger">*</span></label>
                        <input type="text" name="ap_profession" value="'.$editApplicant['ap_profession'].'" class="form-control" placeholder="Profession Name" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="form-label">Name of Organization <span class="text-danger">*</span></label>
                        <input type="text" name="ap_organization" value="'.$editApplicant['ap_organization'].'" class="form-control" placeholder="Organization Name" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="form-label">Organization Type <span class="text-danger">*</span></label>
                        <select class="form-control select2-show-search" name="ap_organization_type" data-placeholder="Choose one" required>
                            <option label="Choose one"></option>';
                            foreach ($organizationtypes as $organization):
                                echo'<option value="'.$organization['id'].'" '.($editApplicant['ap_organization_type']==$organization['id'] ? "selected" : "").'>'.$organization['name'].'</option>';
                            endforeach;
                            echo'
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="form-label">Date of Joining <span class="text-danger">*</span></label>
                        <input type="date" name="ap_doj" value="'.$editApplicant['ap_doj'].'" class="form-control" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="form-label">Office Phone <span class="text-danger">*</span></label>
                        <input type="text" name="ap_office_phone" value="'.$editApplicant['ap_office_phone'].'" class="form-control" placeholder="Office Phone" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="form-label">Office Email <span class="text-danger">*</span></label>
                        <input type="email" name="ap_office_email" value="'.$editApplicant['ap_office_email'].'" class="form-control" placeholder="example@domain.com" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label class="form-label">Office Address </label>
                    <textarea name="ap_office_address" class="form-control" placeholder="Office Address">'.$editApplicant['ap_office_address'].'</textarea>
                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="form-label">Salary/Monthly Income Details <span class="text-danger">*</span></label>
                        <input type="text" name="ap_monthly_income" value="'.$editApplicant['ap_monthly_income'].'" class="form-control" placeholder="Enter Amount" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="form-label">Previous Loan Amount <span class="text-danger">*</span></label>
                        <input type="text" name="ap_previous_loan" value="'.$editApplicant['ap_previous_loan'].'" class="form-control" placeholder="Enter Amount" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="form-label">Deduction of Loan (if any) <span class="text-danger">*</span></label>
                        <input type="text" name="ap_previous_loan_deduction" value="'.$editApplicant['ap_previous_loan_deduction'].'" class="form-control" placeholder="Enter Amount" required>
                    </div>
                </div>
            </div>
            ';
        }
    }else{}
?>