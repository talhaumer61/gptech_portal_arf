<?php                 
    // COUNTRIES
    $condition = array ( 
                            'select'        =>  'country_id, country_name',
                            'where'         =>  array(
                                                        'country_status'    =>  1
                                                        ,'is_deleted'       =>  0
                                                    ), 
                            'order_by' 		=>  'country_name',
                            'return_type'   =>  'all'
                        ); 
    $Countries = $dblms->getRows(COUNTRIES, $condition);
    echo '
    
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="mb-0">Add Donor</h4>
                </div>
                <form action="donors.php" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">  
                    <div class="card-body create-project-main">
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="dv_full_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Father Name <span class="text-danger">*</span></label>
                                    <input type="text" name="dv_father_name" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Donor ID <span class="text-danger">*</span></label>
                                    <input type="text" name="dv_donor_id" id="dv_donor_id" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Password <span class="text-danger">*</span></label>
                                    <input type="text" name="donor_pass" id="donor_pass" class="form-control" required>
                                </div>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">CNIC <span class="text-danger">*</span></label>
                                    <input type="text" name="dv_cnic" id="cleave-cnic" placeholder="xxxxx-xxxxxxxx-x" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                    <input type="date" name="dv_dob" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Gender <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search" name="dv_gender" data-placeholder="Choose one" required>
                                        <option label="Choose one"></option>';
                                        $gendertypes = get_gendertypes();
                                        foreach ($gendertypes as $key => $value):
                                        echo'<option value="'.$key.'">'.$value.'</option>';
                                        endforeach;
                                        echo'
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="dv_email" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="dv_phone" id="cleave-phone" placeholder="xxxx-xxxxxxx" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Whatsapp <span class="text-danger">*</span></label>
                                    <input type="text" name="dv_whatsapp" id="cleave-whatsapp" placeholder="xxxx-xxxxxxx" class="form-control">
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">File <span class="text-danger">*</span></label>
                                    <input type="file" name="dv_file" accept="image/*" class="dropify" data-bs-height="100" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Country <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" id="id_country" name="id_country" data-placeholder="Select" onchange="getState(this.value)" required>
                                        <option label="Select"></option>';
                                        foreach ($Countries as $country):
                                            echo'<option value="'.$country['country_id'].'">'.$country['country_name'].'</option>';
                                        endforeach;
                                        echo'
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">State <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" id="id_state" name="id_state" data-placeholder="Select" onchange="getSubState(this.value)" required>
                                        <option>Select Country First</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Sub State <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" id="id_substate" name="id_substate" onchange="getCity(this.value)" data-placeholder="Select" required>
                                        <option>Select State First</option>
                                    </select>
                                </div>
                            </div>
                            
                        </div> 
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">City <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" id="id_city" name="id_city" data-placeholder="Select" required>
                                        <option>Select Sub State First</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Is Volunteer <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search" name="is_volunteer" data-placeholder="Select" required>
                                        <option label="Select"></option>';
                                        $yesNoStatus = get_YesNoStatus();
                                        foreach ($yesNoStatus as $key => $value):
                                            echo'<option value="'.$key.'">'.$value.'</option>';
                                        endforeach;
                                        echo'
                                    </select>
                                </div>
                            </div>   
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" name="dv_status" data-placeholder="Select" required>
                                        <option label="Select"></option>';
                                        $statuses = get_status();
                                        foreach ($statuses as $key => $status):
                                            echo'<option value="'.$key.'">'.$status.'</option>';
                                        endforeach;
                                        echo'
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit_add">Add Donor</button> 
                        <a href="donors.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>';
?>