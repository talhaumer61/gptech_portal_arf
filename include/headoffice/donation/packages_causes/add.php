<?php
    // ORDERING
    $conOrdering = array ( 
                            'select'        =>  'pc_id ',
                            'order_by' 		=>  'pc_id  DESC',
                            'return_type'   =>  'single'
                        ); 
    $pc  = $dblms->getRows(PACKAGES_CAUSES, $conOrdering);
    if($pc){
        $ordering = $pc['pc_id'] + 1;
    }else{
        $ordering = 1;
    }
    // CATEGORIES
    $conCat = array ( 
                        'select'        =>  'cat_id, cat_name',
                        'where'         =>  array( 
                                                    'is_deleted' => 0
                                                    ,'cat_status' => 1
                                                ), 
                        'order_by' 		=>  'cat_ordering ASC',
                        'return_type'   =>  'all'
                    ); 
    $categories = $dblms->getRows(CATEGORIES, $conCat);
    // ORGANIZATIONS
    $conOrg = array ( 
                        'select'        =>  'org_id, org_name',
                        'where'         =>  array( 
                                                     'is_deleted' => 0
                                                    ,'org_status' => 1
                                                ), 
                        'order_by' 		=>  'org_ordering ASC',
                        'return_type'   =>  'all'
                    ); 
    $organizations = $dblms->getRows(ORGANIZATIONS, $conOrg);

    echo '
    
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="mb-0">Add Package & Cause</h4>
                </div>
                <form action="packages_causes.php" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">  
                    <div class="card-body create-project-main">
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="pc_title" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Ordering <span class="text-danger">*</span></label>
                                    <input type="text" name="pc_ordering" value="'.$ordering.'" readonly class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" required name="id_cat" data-placeholder="Select">
                                        <option label="Select"></option>';
                                        foreach($categories as $cat):
                                            echo '
                                            <option value="'.$cat['cat_id'].'">'.$cat['cat_name'].'</option>';
                                        endforeach;
                                        echo '
                                    </select>
                                </div>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Type <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" required name="id_type" onchange="changeType(this.value)" data-placeholder="Select">
                                        <option label="Select"></option>';
                                        $types = get_DonationTypes();
                                        foreach ($types as $key => $value):
                                            echo'<option value="'.$key.'" '.($key == '1' ? 'selected' : '').'>'.$value.'</option>';
                                        endforeach;
                                        echo '
                                    </select>
                                </div>
                            </div>
                            <div class="col" id="id_duration_type">
                                <div class="form-group">
                                    <label class="form-label">Duration Type <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" name="id_duration_type" data-placeholder="Select">
                                        <option label="Select"></option>';
                                        $durationTypes = get_DurationTypes();
                                        foreach ($durationTypes as $key => $value):
                                            echo'<option value="'.$key.'">'.$value.'</option>';
                                        endforeach;
                                        echo '
                                    </select>
                                </div>
                            </div>
                            <div class="col" id="pc_duration">
                                <div class="form-group">
                                    <label class="form-label">Duration <span class="text-danger">*</span></label>
                                    <input type="text" name="pc_duration" class="form-control" >
                                </div>
                            </div>
                            <div class="col" id="pc_start_date" style="display:none">
                                <div class="form-group">
                                    <label class="form-label">Start Date <span class="text-danger">*</span></label>
                                    <input type="date" name="pc_start_date" class="form-control" >
                                </div>
                            </div>
                            <div class="col" id="pc_end_date" style="display:none">
                                <div class="form-group">
                                    <label class="form-label">End Date <span class="text-danger">*</span></label>
                                    <input type="date" name="pc_end_date" class="form-control" >
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Organization <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" required name="id_org" data-placeholder="Select">
                                        <option label="Select"></option>';
                                        foreach($organizations as $org):
                                            echo '
                                            <option value="'.$org['org_id'].'">'.$org['org_name'].'</option>';
                                        endforeach;
                                        echo '
                                    </select>
                                </div>
                            </div> 
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Amount <span class="text-danger">*</span></label>
                                    <input type="text" name="pc_amount" class="form-control" required>
                                </div>
                            </div>   
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" name="pc_status" data-placeholder="Select" required>
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
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Profile Image <span class="text-danger">*</span></label>
                                    <input type="file" name="pc_image" accept="image/*" class="dropify" data-bs-height="100" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea name="pc_description" class="form-control" id="summernote" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label">Meta Keywords <span class="text-danger">*</span></label>
                                <textarea name="pc_meta_keywords" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label">Meta Description <span class="text-danger">*</span></label>
                                <textarea name="pc_meta_description" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit_add">Add Package & Cause</button> 
                        <a href="packages_causes.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>';
?>