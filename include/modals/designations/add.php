<?php 
    require_once("../../dbsetting/lms_vars_config.php");
    require_once("../../dbsetting/classdbconection.php");
    require_once("../../functions/functions.php");
    $dblms = new dblms();
    $conOrdering = array ( 
                            'select'        =>  'des_id',
                            'order_by' 		=>  'des_id DESC',
                            'return_type'   =>  'single'
                       ); 
    $des  = $dblms->getRows(DESIGNATIONS, $conOrdering);
    if($des){
        $ordering = $des['des_id'] + 1;
    }else{
        $ordering = 1;
    }
    echo '
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Add Designation</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="designations.php" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">

                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input class="form-control" name="des_name" type="text" required>
                        </div>
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Ordering <span class="text-danger">*</span></label>
                            <input class="form-control" name="des_ordering" value="'.$ordering.'" readonly type="number" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Code <span class="text-danger">*</span></label>
                            <input class="form-control" name="des_code" type="text" required>
                        </div>
                        <div class="col form-group">
                            <label class="form-label">Staus <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search form-select" required name="des_status" data-placeholder="Choose one">
                                <option label="Choose one"></option>';
                                $statuses = get_status();
                                foreach($statuses as $key => $status):
                                    echo '
                                    <option value="'.$key.'">'.$status.'</option>';
                                endforeach;
                                echo '
                            </select>
                        </div>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit_add" >Add Designation</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
    ';
?>