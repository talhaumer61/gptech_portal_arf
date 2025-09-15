<?php 
    require_once("../../dbsetting/lms_vars_config.php");
    require_once("../../dbsetting/classdbconection.php");
    require_once("../../functions/functions.php");
    $dblms = new dblms();
    $conSubCat = array ( 
                        'select'        =>  'subcat_id, subcat_status, subcat_ordering, subcat_name, subcat_description, subcat_meta_keywords, subcat_meta_description, id_cat',
                        'where'         =>  array( 
                                                    'subcat_id' => $_GET['subcat_id']
                                                ), 
                        'return_type'   =>  'single'
                    ); 
    $row = $dblms->getRows(SUB_CATEGORIES, $conSubCat);
    $conCat = array ( 
                        'select'        =>  'cat_id, cat_name',
                        'where'         =>  array( 
                                                     'is_deleted' => 0
                                                    ,'cat_status' => 1
                                                ), 
                        'order_by' 		=>  'cat_ordering ASC',
                        'return_type'   =>  'all'
                    ); 
    $categories = $dblms->getRows(CATEGORIES, $conCat);
    echo '
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Edit Sub Category</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="subcategories.php" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="subcat_name" value="'.$row['subcat_name'].'" required>
                            <input class="form-control" type="hidden" name="subcat_id" value="'.$row['subcat_id'].'" required>
                        </div>
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Ordering <span class="text-danger">*</span></label>
                            <input class="form-control" name="subcat_ordering"  value="'.$row['subcat_ordering'].'" readonly type="number" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Icon</label>
                            <input type="file" name="subcat_icon" accept="image/*" class="form-control" />
                        </div>
                        <div class="col form-group">
                            <label class="form-label">Image</label>
                            <input type="file" name="subcat_image" accept="image/*" class="form-control" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea name="subcat_description" class="form-control" required>'.$row['subcat_description'].'</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Meta Keywords <span class="text-danger">*</span></label>
                            <textarea name="subcat_meta_keywords" class="form-control" required>'.$row['subcat_meta_keywords'].'</textarea>
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
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search form-select"  name="id_cat" data-placeholder="Select">
                                <option label="Select"></option>';
                                foreach($categories as $cat):
                                    echo '
                                    <option value="'.$cat['cat_id'].'" '.($row['id_cat'] == $cat['cat_id'] ? 'selected' : '').'>'.$cat['cat_name'].'</option>';
                                endforeach;
                                echo '
                            </select>
                        </div>
                        <div class="col form-group">
                            <label class="form-label">Staus <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search form-select" required name="subcat_status" data-placeholder="Select">
                                <option label="Select"></option>';
                                $statuses = get_status();
                                foreach($statuses as $key => $status):
                                    echo '
                                    <option value="'.$key.'" '.($row['subcat_status'] == $key ? 'selected' : '').'>'.$status.'</option>';
                                endforeach;
                                echo '
                            </select>
                        </div>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit_edit" >Edit Sub Category</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
    ';
?>