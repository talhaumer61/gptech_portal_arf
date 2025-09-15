<?php
$vendor_condition = array ( 
    'select'        =>  'vendor_id, vendor_name',
    'where'         =>  array(
                                'vendor_status' =>  1
                                ,'is_deleted'   =>  0
                            ), 
    'order_by' 		=>  'vendor_name',
    'return_type'   =>  'all'
   ); 
$Vendors = $dblms->getRows(VENDORS, $vendor_condition);

echo '
<!-- MODAL EFFECTS -->
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Add Business</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="businesses.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Business Name</label>
                                <input type="text" name="business_name" class="form-control" placeholder="Enter Name" required />
                            </div>
                            <div class="col form-group">
                                <label class="form-label">Vendor</label>
                                <select class="form-control select2-show-search form-select" name="id_vendor" data-placeholder="Choose one" required>
                                    <option label="Choose one"></option>';
                                    foreach ($Vendors as $vendor):
                                        echo'<option value="'.$vendor['vendor_id'].'">'.$vendor['vendor_name'].'</option>';
                                    endforeach;
                                    echo'
                                </select>
                            </div>
                            <div class="col">
                                <label class="form-label">Website</label>
                                <input type="url" name="business_website" class="form-control" placeholder="Enter Website Link" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Contact Person</label>
                                <input type="text" name="business_contactperson" class="form-control" placeholder="Enter Contact Person" required />
                            </div>
                            <div class="col">
                                <label class="form-label">Contact Person Mobile</label>
                                <input type="text" name="business_contactperson_mobile" class="form-control" placeholder="Enter Number" required />
                            </div>
                            <div class="col">
                                <label class="form-label">Contact Person Email</label>
                                <input type="email" name="business_contactperson_email" class="form-control" placeholder="Enter Email" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="form-label">STN</label>
                                <input type="text" name="business_stn" class="form-control" placeholder="Enter STN" required />
                            </div>
                            <div class="col">
                                <label class="form-label">NTN</label>
                                <input type="text" name="business_ntn" class="form-control" placeholder="Enter NTN" required />
                            </div>
                            <div class="col form-group">
                                <label class="form-label">Status </label>
                                <select class="form-control select2-show-search form-select" name="business_status" data-placeholder="Choose one">
                                    <option label="Choose one"></option>';
                                    foreach ($status as $business_status):
                                        echo'<option value="'.$business_status['id'].'">'.$business_status['name'].'</option>';
                                    endforeach;
                                    echo'
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Business Logo</label>
                            <input type="file" name="business_logo" accept="image/*" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Address</label>
                        <textarea name="business_address" class="form-control" placeholder="Enter Address"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="business_description" class="form-control" placeholder="Enter Description"></textarea>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit_add" >Add Business</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
</div>
';
?>