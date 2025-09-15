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
    <div class="modal fade" id="edit">
        <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
            <div class="modal-content modal-content-demo expanel expanel-info">
                <div class="modal-header expanel-heading">
                    <h6 class="modal-title">Edit Product</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="products.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="modal-body expanel-body text-start">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Name</label>
                                    <input type="hidden" name="product_id" id="product_id" class="form-control" required />
                                    <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Enter Name" required />
                                </div>
                                <div class="col">
                                    <label class="form-label">Code</label>
                                    <input type="text" name="product_code" id="product_code" class="form-control" placeholder="AL001" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col form-group">
                                    <label class="form-label">Category</label>
                                    <select class="form-control select2-show-search form-select" name="id_cat" id="edit_id_cat" data-placeholder="Choose one" onchange="getSubCatEdit(this.value)" required>
                                        <option label="Choose one"></option>';
                                            foreach ($Categories as $category):
                                                echo'<option value="'.$category['cat_id'].'">'.$category['cat_name'].'</option>';
                                            endforeach;
                                        echo'
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label class="form-label">Sub Category </label>
                                    <select class="form-control select2-show-search form-select" name="id_subcat" id="edit_id_subcat" data-placeholder="Choose one" required>
                                        <option label="Choose one"></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col form-group">
                                    <label class="form-label">Brand</label>
                                    <select class="form-control select2-show-search form-select" name="id_brand" id="id_brand" data-placeholder="Choose one" required>
                                        <option label="Choose one"></option>';
                                            foreach ($Brands as $brand):
                                                echo'<option value="'.$brand['brand_id'].'">'.$brand['brand_name'].'</option>';
                                            endforeach;
                                        echo'
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label class="form-label">Status </label>
                                    <select class="form-control select2-show-search form-select" name="product_status" id="product_status" data-placeholder="Choose one" required>
                                        <option label="Choose one"></option>';
                                            foreach ($status as $product_status):
                                                echo'<option value="'.$product_status['id'].'">'.$product_status['name'].'</option>';
                                            endforeach;
                                        echo'
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Product Image</label>
                            <input type="file" name="product_image" id="product_image" class="form-control" accept="image/*" />
                        </div>
                    </div>
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-info" name="submit_edit" >Edit Product</button> 
                        <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //---edit item link clicked-------
            $(".editModel").click(function(){
            
                //get variables from "edit link" data attributes
                
                var product_id      =   $(this).attr("data-product-id");
                var product_name    =   $(this).attr("data-product-name");
                var product_code    =   $(this).attr("data-product-code");
                var product_image   =   $(this).attr("data-product-image");
                var id_cat          =   $(this).attr("data-id-cat");
                var id_subcat       =   $(this).attr("data-id-subcat");
                var id_brand        =   $(this).attr("data-id-brand");
                var product_status  =   $(this).attr("data-product-status");

                //set modal input values dynamically
                $("#product_id").val(product_id);
                $("#product_name").val(product_name);
                $("#product_code").val(product_code);

                //pre-select data in pull down lists
                $("#edit_id_cat").select2().select2("val", id_cat);
                $("#edit_id_subcat").select2().select2("val", id_subcat);
                $("#id_brand").select2().select2("val", id_brand);
                $("#product_status").select2().select2("val", product_status);
            }); 
        });
    </script>
    ';
?>