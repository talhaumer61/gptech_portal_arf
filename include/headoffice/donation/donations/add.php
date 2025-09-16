<?php
    // SUBCATEGORIES
    $conCat = array ( 
                        'select'        =>  'subcat_id, subcat_name',
                        'where'         =>  array( 
                                                     'is_deleted'     => 0
                                                    ,'subcat_status' => 1
                                                ), 
                        'order_by' 		=>  'id_cat ASC',
                        'return_type'   =>  'all'
                    ); 
    $subcategories = $dblms->getRows(SUB_CATEGORIES, $conCat);
    // DONORS
    $conCat = array ( 
                        'select'        =>  'dv_id, dv_full_name,dv_donor_id',
                        'where'         =>  array( 
                                                     'is_deleted'     => 0
                                                    ,'dv_status' => 1
                                                ), 
                        'order_by' 		=>  'dv_id ASC',
                        'return_type'   =>  'all'
                    ); 
    $DONORS = $dblms->getRows(DONORS_VOLUNTREES, $conCat);

    echo '
    
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="mb-0">Add Donation</h4>
                </div>
                <form action="donations.php" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">  
                    <div class="card-body create-project-main">
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Donor <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" name="id_donor" data-placeholder="Select" required>
                                        <option label="Select"></option>';
                                        foreach ($DONORS as $donor):
                                            echo'<option value="'.$donor['dv_id'].'">'.$donor['dv_full_name'].' ( '.$donor['dv_donor_id'].' )</option>';
                                        endforeach;
                                        echo'
                                    </select>
                                </div>
                            </div>
                        </div>';
                        /*
                        echo '<div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="fullname" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">CNIC <span class="text-danger">*</span></label>
                                    <input type="text" name="cnic" id="cleave-cnic" placeholder="xxxxx-xxxxxxxx-x" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" id="cleave-phone" placeholder="xxxx-xxxxxxx" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>
                        </div>';
                        */
                        echo'
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Referrals</label>
                                    <input type="text" name="referrals" class="form-control" >
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Purpose <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" name="id_pc_subcat" data-placeholder="Select" required>
                                        <option label="Select"></option>';
                                        foreach ($subcategories as $subcat):
                                            echo'<option value="'.$subcat['subcat_id'].'">'.$subcat['subcat_name'].'</option>';
                                        endforeach;
                                        echo'
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Amount <span class="text-danger">*</span></label>
                                    <input type="number" name="amount" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" name="status" data-placeholder="Select" required>
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
                        <button type="submit" class="btn btn-primary" name="submit_add">Add Donation</button> 
                        <a href="packages_causes.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>';
?>