<?php
$condition = array ( 
    'select'        =>  'cat_id, cat_name',
    'where'         =>  array( 
                                'cat_status'    =>  1,
                                'is_deleted'    =>  0
                            ), 
    'order_by' 		=>  'cat_id DESC',
    'return_type'   =>  'all'
   ); 
$Categories 	= $dblms->getRows(PRODUCT_CAT, $condition);

echo '
<!-- MODAL EFFECTS -->
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Add Sub Category</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="product_subcategories.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Name</label>
                                <input type="text" name="subcat_name" class="form-control" placeholder="Enter Name" required />
                            </div>
                            <div class="col">
                                <label class="form-label">Code</label>
                                <input type="text" name="subcat_code" class="form-control" placeholder="AL001" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label">Category</label>
                                <select class="form-control select2-show-search form-select" name="id_cat" data-placeholder="Choose one" required>
                                    <option label="Choose one"></option>';
                                        foreach ($Categories as $category):
                                            echo'<option value="'.$category['cat_id'].'">'.$category['cat_name'].'</option>';
                                        endforeach;
                                    echo'
                                </select>
                            </div>
                            <div class="col form-group">
                                <label class="form-label">Status </label>
                                <select class="form-control select2-show-search form-select" name="subcat_status" data-placeholder="Choose one" required>
                                    <option label="Choose one"></option>';
                                        foreach ($status as $subcat_status):
                                            echo'<option value="'.$subcat_status['id'].'">'.$subcat_status['name'].'</option>';
                                        endforeach;
                                    echo'
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="subcat_description" class="form-control" placeholder="Category Description"></textarea>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit_add" >Add Sub Category</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
</div>
';
?>