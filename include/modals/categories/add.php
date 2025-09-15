<?php 
    require_once("../../dbsetting/lms_vars_config.php");
    require_once("../../dbsetting/classdbconection.php");
    require_once("../../functions/functions.php");
    $dblms = new dblms();
    $condition = array ( 
                            'select'        =>  'cat_id',
                            'order_by' 		=>  'cat_id DESC',
                            'return_type'   =>  'single'
                        ); 
    $category  = $dblms->getRows(CATEGORIES, $condition);
    if($category){
        $ordering = $category['cat_id'] + 1;
    }else{
        $ordering = 1;
    }
    echo '
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Add Category</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="categories.php" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="cat_name" required>
                            
                        </div>
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Ordering <span class="text-danger">*</span></label>
                            <input class="form-control" name="cat_ordering" value="'.$ordering.'" readonly type="number" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Icon <span class="text-danger">*</span></label>
                            <input type="file" name="cat_icon" accept="image/*" class="form-control" required/>
                        </div>
                        <div class="col form-group">
                            <label class="form-label">Image <span class="text-danger">*</span></label>
                            <input type="file" name="cat_image" accept="image/*" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea name="cat_description" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Meta Keywords <span class="text-danger">*</span></label>
                            <textarea name="cat_meta_keywords" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Meta Description <span class="text-danger">*</span></label>
                            <textarea name="cat_meta_description" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Staus <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search form-select" required name="cat_status" data-placeholder="Select">
                                <option label="Select"></option>';
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
                    <button type="submit" class="btn btn-primary" name="submit_add" >Add Category</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
    ';
?>