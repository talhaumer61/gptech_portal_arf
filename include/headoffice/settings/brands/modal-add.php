<?php
echo '
<!-- MODAL EFFECTS -->
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Add Brand</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="brands.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Name</label>
                                <input type="text" name="brand_name" class="form-control" placeholder="Enter Name" required />
                            </div>
                            <div class="col">
                                <label class="form-label">Code</label>
                                <input type="text" name="brand_code" class="form-control" placeholder="AL001" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Brand Image</label>
                                <input type="file" name="brand_image"  class="form-control" accept="image/*" required />
                            </div>
                            <div class="col form-group">
                                <label class="form-label">Status </label>
                                <select class="form-control select2-show-search form-select" name="brand_status" data-placeholder="Choose one" required>
                                    <option label="Choose one"></option>';
                                        foreach ($status as $brand_status):
                                            echo'<option value="'.$brand_status['id'].'">'.$brand_status['name'].'</option>';
                                        endforeach;
                                    echo'
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="brand_description" class="form-control" placeholder="Brand Description"></textarea>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit_add" >Add Brand</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
</div>
';
?>