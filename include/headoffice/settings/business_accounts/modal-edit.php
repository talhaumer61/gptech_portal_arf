<?php
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
<div class="modal fade" id="edit">
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-info">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Edit Business Account</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="business_accounts.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Account Name</label>
                                <input type="hidden" name="businessact_id" id="businessact_id" class="form-control" required />
                                <input type="text" name="businessact_name" id="businessact_name" class="form-control" placeholder="Enter Name" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label">Bank</label>
                                <select class="form-control select2-show-search form-select" name="id_bank" id="id_bank" data-placeholder="Choose one" required>
                                    <option label="Choose one"></option>';
                                    foreach ($Banks as $bank):
                                        echo'<option value="'.$bank['bank_id'].'">'.$bank['bank_name'].'</option>';
                                    endforeach;
                                    echo'
                                </select>
                            </div>
                            <div class="col">
                                <label class="form-label">Account Number</label>
                                <input type="text" name="businessact_number" id="businessact_number" class="form-control" placeholder="Enter Account Number" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Cell No</label>
                                <input type="text" name="businessact_cellno" id="businessact_cellno" class="form-control" placeholder="Enter Cell No" required />
                            </div>
                            <div class="col form-group">
                                <label class="form-label">Status</label>
                                <select class="form-control select2-show-search form-select" name="businessact_status" id="businessact_status" data-placeholder="Choose one" required>
                                    <option label="Choose one"></option>';
                                    foreach ($status as $act_status):
                                        echo'<option value="'.$act_status['id'].'">'.$act_status['name'].'</option>';
                                    endforeach;
                                    echo'
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="businessact_description" id="businessact_description" class="form-control" placeholder="Enter Description"></textarea>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-info" name="submit_edit" >Edit Account</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        //---edit item link clicked-------
        $(".editModel").click(function(){
        
            //get variables from "edit link" data attributes
            
            var businessact_id          =   $(this).attr("data-businessact-id");
            var businessact_status      =   $(this).attr("data-businessact-status");
            var businessact_name        =   $(this).attr("data-businessact-name");
            var businessact_number      =   $(this).attr("data-businessact-number");
            var businessact_cellno      =   $(this).attr("data-businessact-cellno");
            var businessact_description =   $(this).attr("data-businessact-description");
            var id_bank                 =   $(this).attr("data-id-bank");

            //set modal input values dynamically
            $("#businessact_id").val(businessact_id);
            $("#businessact_name").val(businessact_name);
            $("#businessact_number").val(businessact_number);
            $("#businessact_cellno").val(businessact_cellno);
            $("#businessact_description").val(businessact_description);

            //pre-select data in pull down lists
            $("#id_bank").select2().select2("val", id_bank);
            $("#businessact_status").select2().select2("val", businessact_status);
        }); 
    });
</script>
';
?>