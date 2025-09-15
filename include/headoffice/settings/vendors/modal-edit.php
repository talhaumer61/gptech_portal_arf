<?php
    echo '
    <!-- MODAL EFFECTS -->
    <div class="modal fade" id="edit">
        <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
            <div class="modal-content modal-content-demo expanel expanel-info">
                <div class="modal-header expanel-heading">
                    <h6 class="modal-title">Edit Vendor</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="vendors.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="modal-body expanel-body text-start">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Name</label>
                                    <input type="hidden" name="vendor_id" id="vendor_id" class="form-control" required />
                                    <input type="text" name="vendor_name" id="vendor_name" class="form-control" placeholder="Enter Name" required />
                                </div>
                                <div class="col">
                                    <label class="form-label">CNIC Number</label>
                                    <input type="text" name="vendor_cnic" id="vendor_cnic" class="form-control" placeholder="Enter CNIC" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Phone No</label>
                                    <input type="text" name="vendor_phone" id="vendor_phone" class="form-control" placeholder="Enter Phone Number" required />
                                </div>
                                <div class="col">
                                    <label class="form-label">Mobile No</label>
                                    <input type="text" name="vendor_mobile" id="vendor_mobile" class="form-control" placeholder="Enter Mobile Number" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="vendor_email" id="vendor_email" class="form-control" placeholder="Enter Email" required />
                                </div>
                                <div class="col form-group">
                                    <label class="form-label">Status </label>
                                    <select class="form-control select2-show-search form-select" name="vendor_status" id="vendor_status" data-placeholder="Choose one" required>
                                        <option label="Choose one"></option>';
                                            foreach ($status as $v_s):
                                                echo'<option value="'.$v_s['id'].'">'.$v_s['name'].'</option>';
                                            endforeach;
                                        echo'
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <textarea name="vendor_address" id="vendor_address" class="form-control" placeholder="Vendor Address"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="vendor_description" id="vendor_description" class="form-control" placeholder="Vendor Description"></textarea>
                        </div>
                    </div>
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-info" name="submit_edit" >Edit Vendor</button> 
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
                
                var vendor_id           =   $(this).attr("data-vendor-id");
                var vendor_name         =   $(this).attr("data-vendor-name");
                var vendor_phone        =   $(this).attr("data-vendor-phone");
                var vendor_mobile       =   $(this).attr("data-vendor-mobile");
                var vendor_email        =   $(this).attr("data-vendor-email");
                var vendor_cnic         =   $(this).attr("data-vendor-cnic");
                var vendor_address      =   $(this).attr("data-vendor-address");
                var vendor_description  =   $(this).attr("data-vendor-description");
                var vendor_status       =   $(this).attr("data-vendor-status");


                //set modal input values dynamically
                $("#vendor_id").val(vendor_id);
                $("#vendor_name").val(vendor_name);
                $("#vendor_phone").val(vendor_phone);
                $("#vendor_mobile").val(vendor_mobile);
                $("#vendor_email").val(vendor_email);
                $("#vendor_cnic").val(vendor_cnic);
                $("#vendor_address").val(vendor_address);
                $("#vendor_description").val(vendor_description);

                //pre-select data in pull down lists
                $("#vendor_status").select2().select2("val", vendor_status);
            }); 
        });
    </script>
    ';
?>