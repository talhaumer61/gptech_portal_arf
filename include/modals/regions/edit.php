<?php 
    require_once("../../functions/functions.php");
    echo '
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Edit Region</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="regions.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="region_name" value="'.$_GET['region_name'].'" id="region_name" placeholder="Enter Name" required>
                            <input class="form-control" type="hidden" name="region_id" value="'.$_GET['region_id'].'" id="region_id" required>
                        </div>
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Ordering <span class="text-danger">*</span></label>
                            <input class="form-control" name="region_ordering" value="'.$_GET['region_ordering'].'" readonly type="number" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Code (Digit) <span class="text-danger">*</span></label>
                            <input class="form-control" name="region_codedigit" id="region_codedigit" value="'.$_GET['region_codedigit'].'" type="number" placeholder="Enter Code (Digit)" required>
                        </div>
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Code (Alpha) <span class="text-danger">*</span></label>
                            <input class="form-control" name="region_codealpha" id="region_codealpha" value="'.$_GET['region_codealpha'].'" type="text" placeholder="Enter Code (Alpha)" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Parent Region <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search form-select" required name="id_parentregion" id="id_parentregion" data-placeholder="Choose one ">
                                <option label="Choose one "></option>';
                                $parentregiontypes = get_parentregiontypes();
                                foreach ($parentregiontypes as $key => $parentregion) :
                                    echo'<option value="'.$key.'" '.($_GET['id_parentregion'] == $key ? 'selected' : '').'>'.$parentregion.'</option>';
                                endforeach;
                                echo '
                            </select>
                        </div>
                        <div class="col form-group">
                            <label class="form-label">Staus <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search form-select" name="region_status" required id="region_status" data-placeholder="Choose one">
                                <option label="Choose one"></option>';
                                $statuses = get_status();
                                foreach($statuses as $key => $status):
                                    echo '<option value="'.$key.'" '.($_GET['region_status'] == $key ? 'selected' : '').'>'.$status.'</option>';
                                endforeach;
                                echo '
                            </select>
                        </div>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit_edit" >Edit Region</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
    ';
?>