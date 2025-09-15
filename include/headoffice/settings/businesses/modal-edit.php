<?php
$condition = array ( 
    'select'        =>  'vendor_id, vendor_name',
    'where'         =>  array(
                                'vendor_status' =>  1
                                ,'is_deleted'   =>  0
                            ), 
    'order_by' 		=>  'vendor_name',
    'return_type'   =>  'all'
   ); 
$Vendors = $dblms->getRows(VENDORS, $condition);

    echo '
    <!-- MODAL EFFECTS -->
    <div class="modal fade" id="edit">
        <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
            <div class="modal-content modal-content-demo expanel expanel-info">
                <div class="modal-header expanel-heading">
                    <h6 class="modal-title">Edit Business</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="businesses.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="modal-body expanel-body text-start">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Business Name</label>
                                    <input type="hidden" name="business_id" id="business_id" class="form-control" required />
                                    <input type="text" name="business_name" id="business_name" class="form-control" placeholder="Enter Name" required />
                                </div>
                                <div class="col">
                                    <label class="form-label">Website</label>
                                    <input type="url" name="business_website" id="business_website" class="form-control" placeholder="Enter Website Link" required />
                                </div>
                                <div class="col form-group">
                                    <label class="form-label">Vendor</label>
                                    <select class="form-control select2-show-search form-select" name="id_vendor" id="id_vendor" data-placeholder="Choose one" required>
                                        <option label="Choose one"></option>';
                                        foreach ($Vendors as $vendor):
                                            echo'<option value="'.$vendor['vendor_id'].'">'.$vendor['vendor_name'].'</option>';
                                        endforeach;
                                        echo'
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Contact Person</label>
                                    <input type="text" name="business_contactperson" id="business_contactperson" class="form-control" placeholder="Enter Contact Person" required />
                                </div>
                                <div class="col">
                                    <label class="form-label">Contact Person Mobile</label>
                                    <input type="text" name="business_contactperson_mobile" id="business_contactperson_mobile" class="form-control" placeholder="Enter Number" required />
                                </div>
                                <div class="col">
                                    <label class="form-label">Contact Person Email</label>
                                    <input type="email" name="business_contactperson_email" id="business_contactperson_email" class="form-control" placeholder="Enter Email" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">STN</label>
                                    <input type="text" name="business_stn" id="business_stn" class="form-control" placeholder="Enter STN" required />
                                </div>
                                <div class="col">
                                    <label class="form-label">NTN</label>
                                    <input type="text" name="business_ntn" id="business_ntn" class="form-control" placeholder="Enter NTN" required />
                                </div>
                                <div class="col form-group">
                                    <label class="form-label">Status </label>
                                    <select class="form-control select2-show-search form-select" name="business_status" id="business_status" data-placeholder="Choose one">
                                        <option label="Choose one"></option>';
                                        foreach ($status as $business_status):
                                            echo'<option value="'.$business_status['id'].'">'.$business_status['name'].'</option>';
                                        endforeach;
                                        echo'
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Business Logo</label>
                            <input type="file" name="business_logo" accept="image/*" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <textarea name="business_address" id="business_address" class="form-control" placeholder="Enter Address"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="business_description" id="business_description" class="form-control" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-info" name="submit_edit" >Edit Business</button> 
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
                
                var business_id                     =   $(this).attr("data-business-id");
                var business_name                   =   $(this).attr("data-business-name");
                var business_website                =   $(this).attr("data-business-website");
                var id_vendor                       =   $(this).attr("data-id-vendor");
                var business_contactperson          =   $(this).attr("data-business-contactperson");
                var business_contactperson_mobile   =   $(this).attr("data-business-contactperson-mobile");
                var business_contactperson_email    =   $(this).attr("data-business-contactperson-email");
                var business_stn                    =   $(this).attr("data-business-stn");
                var business_ntn                    =   $(this).attr("data-business-ntn");
                var business_logo                   =   $(this).attr("data-business-logo");
                var business_address                =   $(this).attr("data-business-address");
                var business_description            =   $(this).attr("data-business-description");
                var business_status                 =   $(this).attr("data-business-status");

                console.log(id_vendor);

                //set modal input values dynamically
                $("#business_id").val(business_id);
                $("#business_name").val(business_name);
                $("#business_website").val(business_website);
                $("#business_contactperson").val(business_contactperson);
                $("#business_contactperson_mobile").val(business_contactperson_mobile);
                $("#business_contactperson_email").val(business_contactperson_email);
                $("#business_stn").val(business_stn);
                $("#business_ntn").val(business_ntn);
                $("#business_logo").val(business_logo);
                $("#business_address").val(business_address);
                $("#business_description").val(business_description);

                //pre-select data in pull down lists
                $("#id_vendor").select2().select2("val", id_vendor);
                $("#business_status").select2().select2("val", business_status);
            }); 
        });
    </script>
    ';
?>