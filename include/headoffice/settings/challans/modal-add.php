<?php
echo '
<!-- MODAL EFFECTS -->
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Add Challan</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="challans.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="refrence_no">Applicant Refrence # <span class="text text-danger"> *</span></label>
                                <input type="text" class="form-control" id="refrence_no" name="refrence_no" onchange="get_applicantdetail(this.value)" required>
                            </div>
                        </div>
                    </div>
                    <div id="getapplicantdetail"></div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-primary" name="create_single_challan" >Create Challan</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
</div>
';
?>
