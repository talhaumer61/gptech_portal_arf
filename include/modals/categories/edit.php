<?php 
    require_once("../../dbsetting/lms_vars_config.php");
    require_once("../../dbsetting/classdbconection.php");
    require_once("../../functions/functions.php");
    $dblms  = new dblms();
    $conCat = array ( 
                            'select'        =>  'cat_id, cat_status, cat_ordering, cat_name, cat_description, cat_meta_keywords, cat_meta_description',
                            'where' 	=> array( 
                                                    'cat_id' => $_GET['cat_id']
                                                ), 
                            'return_type'   =>  'single'
                       ); 
    $row    = $dblms->getRows(CATEGORIES, $conCat);
    echo '
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Edit Category</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="categories.php" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="cat_name" value="'.$row['cat_name'].'" required>
                            <input class="form-control" type="hidden" name="cat_id" value="'.$row['cat_id'].'" required>
                            
                        </div>
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Ordering <span class="text-danger">*</span></label>
                            <input class="form-control" name="cat_ordering" value="'.$row['cat_ordering'].'" readonly type="number" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Icon</label>
                            <input type="file" name="cat_icon" accept="image/*" class="form-control"/>
                        </div>
                        <div class="col form-group">
                            <label class="form-label">Image</label>
                            <input type="file" name="cat_image" accept="image/*" class="form-control"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea name="cat_description" class="form-control" required>'.$row['cat_description'].'</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Meta Keywords <span class="text-danger">*</span></label>
                            <textarea name="cat_meta_keywords" class="form-control" required>'.$row['cat_meta_keywords'].'</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Meta Description <span class="text-danger">*</span></label>
                            <textarea name="cat_meta_description" class="form-control" required>'.$row['cat_meta_description'].'</textarea>
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
                                    <option value="'.$key.'" '.($row['cat_status'] == $key ? 'selected' : '').'>'.$status.'</option>';
                                endforeach;
                                echo '
                            </select>
                        </div>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit_edit" >Edit Category</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
    ';
?>