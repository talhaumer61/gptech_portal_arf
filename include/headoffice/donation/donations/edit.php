<?php
    // DONATION
    $condition = array ( 
                        'select'        =>  'id, status, id_type, id_pc_subcat, dated, fullname, cnic, phone, email, referrals, amount',
                        'where'         =>  array( 
                                                    'id'        => $_GET['id']
                                                ), 
                        'return_type'   =>  'single'
                    ); 
    $row = $dblms->getRows(DONATIONS, $condition);
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

    echo '
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="mb-0">Edit Donation</h4>
                </div>
                <form action="donations.php" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">  
                    <div class="card-body create-project-main">
                        
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="fullname" value="'.$row['fullname'].'" class="form-control" required>
                                <input type="hidden" name="id" value="'.$row['id'].'" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">CNIC <span class="text-danger">*</span></label>
                                <input type="text" name="cnic" id="cleave-cnic" value="'.$row['cnic'].'" placeholder="xxxxx-xxxxxxxx-x" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" name="phone" id="cleave-phone" value="'.$row['phone'].'" placeholder="xxxx-xxxxxxx" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="'.$row['email'].'" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Referrals</label>
                                <input type="text" name="referrals" value="'.$row['referrals'].'" class="form-control" >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Purpose <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search form-select" name="id_pc_subcat" data-placeholder="Select" required>
                                    <option label="Select"></option>';
                                    foreach ($subcategories as $subcat):
                                        echo'<option value="'.$subcat['subcat_id'].'" '.($subcat['subcat_id'] == $row['id_pc_subcat'] ? 'selected' : '').'>'.$subcat['subcat_name'].'</option>';
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
                                <input type="number" name="amount" value="'.$row['amount'].'" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search form-select" name="status" data-placeholder="Select" required>
                                    <option label="Select"></option>';
                                    $statuses = get_status();
                                    foreach ($statuses as $key => $status):
                                        echo'<option value="'.$key.'" '.($key == $row['status'] ? 'selected' : '').'>'.$status.'</option>';
                                    endforeach;
                                    echo'
                                </select>
                            </div>
                        </div>
                    </div>

                    </div>
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit_edit">Edit Donation</button> 
                        <a href="packages_causes.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>';
?>