<?php
$cat_condition = array ( 
    'select'        =>  'cat_id, cat_name',
    'where'         =>  array( 
                                'cat_status'    =>  1,
                                'is_deleted'    =>  0
                            ), 
    'order_by' 		=>  'cat_id DESC',
    'return_type'   =>  'all'
   ); 
$Categories 	= $dblms->getRows(PRODUCT_CAT, $cat_condition);

$brand_condition = array ( 
    'select'        =>  'brand_id, brand_name',
    'where'         =>  array( 
                                'brand_status'  =>  1,
                                'is_deleted'    =>  0
                            ), 
    'order_by' 		=>  'brand_id DESC',
    'return_type'   =>  'all'
   ); 
$Brands 	= $dblms->getRows(BRANDS, $brand_condition);

echo '
<!-- MODAL EFFECTS -->
<div class="modal fade" id="add">
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Add Product</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="products.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Name</label>
                                <input type="text" name="product_name" class="form-control" placeholder="Enter Name" required />
                            </div>
                            <div class="col">
                                <label class="form-label">Code</label>
                                <input type="text" name="product_code" class="form-control" placeholder="AL001" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label">Category</label>
                                <select class="form-control select2-show-search form-select" name="id_cat" id="id_cat" data-placeholder="Choose one" onchange="getSubCat(this.value)" required>
                                    <option label="Choose one"></option>';
                                        foreach ($Categories as $category):
                                            echo'<option value="'.$category['cat_id'].'">'.$category['cat_name'].'</option>';
                                        endforeach;
                                    echo'
                                </select>
                            </div>
                            <div class="col form-group">
                                <label class="form-label">Sub Category </label>
                                <select class="form-control select2-show-search form-select" name="id_subcat" id="id_subcat" data-placeholder="Choose one" required>
                                    <option label="Choose one"></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label">Brand</label>
                                <select class="form-control select2-show-search form-select" name="id_brand" data-placeholder="Choose one" required>
                                    <option label="Choose one"></option>';
                                        foreach ($Brands as $brand):
                                            echo'<option value="'.$brand['brand_id'].'">'.$brand['brand_name'].'</option>';
                                        endforeach;
                                    echo'
                                </select>
                            </div>
                            <div class="col form-group">
                                <label class="form-label">Status </label>
                                <select class="form-control select2-show-search form-select" name="product_status" data-placeholder="Choose one" required>
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
                        <label class="form-label">Product Image</label>
                        <input type="file" name="product_image" class="form-control" accept="image/*" required />
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit_add" >Add Product</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
</div>
';
?>