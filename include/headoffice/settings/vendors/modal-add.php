<?php
echo '
<!-- MODAL EFFECTS -->
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Add Vendor</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="vendors.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Name</label>
                                <input type="text" name="vendor_name" class="form-control" placeholder="Enter Name" required />
                            </div>
                            <div class="col">
                                <label class="form-label">CNIC Number</label>
                                <input type="text" name="vendor_cnic" class="form-control" placeholder="Enter CNIC" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Phone No</label>
                                <input type="text" name="vendor_phone" class="form-control" placeholder="Enter Phone Number" required />
                            </div>
                            <div class="col">
                                <label class="form-label">Mobile No</label>
                                <input type="text" name="vendor_mobile" class="form-control" placeholder="Enter Mobile Number" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="vendor_email" class="form-control" placeholder="Enter Email" required />
                            </div>
                            <div class="col form-group">
                                <label class="form-label">Status </label>
                                <select class="form-control select2-show-search form-select" name="vendor_status" data-placeholder="Choose one" required>
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
                        <textarea name="vendor_address" class="form-control" placeholder="Vendor Address"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="vendor_description" class="form-control" placeholder="Vendor Description"></textarea>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit_add" >Add Vendor</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
</div>
';
?>