<?php
$business_condition = array ( 
    'select'        =>  'business_id, business_name',
    'where'         =>  array(
                                'business_status'   =>  1
                                ,'is_deleted'   =>  0
                            ), 
    'order_by' 		=>  'business_name',
    'return_type'   =>  'all'
   ); 
$Businesses = $dblms->getRows(BUSINESS, $business_condition);

$bank_condition = array ( 
    'select'        =>  'bank_id, bank_name',
    'where'         =>  array(
                                'bank_status'   =>  1
                                ,'is_deleted'   =>  0
                            ), 
    'order_by' 		=>  'bank_name',
    'return_type'   =>  'all'
   ); 
$Banks = $dblms->getRows(BANKS, $bank_condition);

echo '
<!-- MODAL EFFECTS -->
<div class="modal fade" id="addLinkAccount">
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-warning">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Link Account</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="businesses.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Bank</label>
                            <select class="form-control select2-show-search form-select" name="id_bank" id="id_bank" data-placeholder="Choose one" onchange="getBusinessact(this.value)">
                                <option label="Choose one"></option>';
                                foreach ($Banks as $bank):
                                    echo'<option value="'.$bank['bank_id'].'">'.$bank['bank_name'].'</option>';
                                endforeach;
                                echo'
                            </select>
                        </div>
                        <div class="col form-group">
                            <label class="form-label">Business Account</label>
                            <select class="form-control select2-show-search form-select" name="id_businessact" id="id_businessact" data-placeholder="Choose one" >
                                <option label="Choose one"></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Business</label>
                            <select class="form-control select2-show-search form-select" name="id_business" data-placeholder="Choose one" required>
                                <option label="Choose one"></option>';
                                foreach ($Businesses as $business):
                                    echo'<option value="'.$business['business_id'].'">'.$business['business_name'].'</option>';
                                endforeach;
                                echo'
                            </select>
                        </div>
                        <div class="col form-group">
                            <label class="form-label">Set Deafult</label>
                            <select class="form-control select2-show-search form-select" name="is_default" data-placeholder="Choose one">
                                <option label="Choose one"></option>';
                                foreach ($statusyesno as $yesno):
                                    echo'<option value="'.$yesno['id'].'">'.$yesno['name'].'</option>';
                                endforeach;
                                echo'
                            </select>
                        </div>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-warning" name="submit_link" >Link Account</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
</div>
';
?>