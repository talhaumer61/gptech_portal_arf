<?php
$condition = array ( 
                    'select'        =>  ''.PRODUCTS.'.product_id
                                        ,'.PRODUCTS.'.product_status
                                        ,'.PRODUCTS.'.product_name
                                        ,'.PRODUCTS.'.product_code
                                        ,'.PRODUCTS.'.product_image
                                        ,'.PRODUCTS.'.id_subcat
                                        ,'.PRODUCTS.'.id_cat
                                        ,'.PRODUCTS.'.id_brand
                                        ,'.PRODUCT_SUBCAT.'.subcat_name
                                        ,'.PRODUCT_CAT.'.cat_name
                                        ,'.BRANDS.'.brand_name',

                    'join'          =>  'INNER JOIN '.PRODUCT_SUBCAT.' ON '.PRODUCT_SUBCAT.'.subcat_id = '.PRODUCTS.'.id_subcat
                                        INNER JOIN '.PRODUCT_CAT.' ON '.PRODUCT_CAT.'.cat_id = '.PRODUCTS.'.id_cat
                                        INNER JOIN '.BRANDS.' ON '.BRANDS.'.brand_id = '.PRODUCTS.'.id_brand',
                    'where'         =>  array( 
                                                ''.PRODUCTS.'.is_deleted'   =>  0
                                            ), 
                    'order_by' 		=>  ''.PRODUCTS.'.product_id DESC',
                    'return_type'   =>  'all'
                   ); 
$Products 	= $dblms->getRows(PRODUCTS, $condition);

echo '
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header border-bottom">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="card-title mb-0 mt-3" >Product List</h3>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a class="modal-effect btn btn-primary" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#add"><i class="ri-add-box-fill align-bottom me-1"></i>Product</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data-table" class="table text-nowrap mb-0 table-bordered">
                        <thead class="table-head">
                            <tr>
                                <th class="bg-transparent border-bottom-0 text-center wp-5">Sr#</th>
                                <th class="bg-transparent border-bottom-0 text center">Product</th>
                                <th class="bg-transparent border-bottom-0">Sub Category</th>
                                <th class="bg-transparent border-bottom-0">Category</th>
                                <th class="bg-transparent border-bottom-0">Brand</th>
                                <th class="bg-transparent border-bottom-0 text-center wp-10">Status</th>
                                <th class="bg-transparent border-bottom-0 text-center wp-10">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">';
                        if ($Products):
                            $sr = 0;
                            foreach($Products as $product):
                                $sr++;
                                echo '
                                <tr>
                                    <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="data-image avatar p-1 border avatar-md rounded-circle" style="background-image: url(uploads/images/products/'.$product['product_image'].')"></span>
                                            <div class="user-details ms-2">
                                                <h6 class="mb-0">'.$product['product_name'].'</h6>
                                                <span class="text-muted fs-12">'.$product['product_code'].'</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-muted fs-14 fw-semibold">'.$product['subcat_name'].'</td>
                                    <td class="text-muted fs-14 fw-semibold">'.$product['cat_name'].'</td>
                                    <td class="text-muted fs-14 fw-semibold">'.$product['brand_name'].'</td>
                                    <td class="text-muted fs-14 text-center">'.get_status($product['product_status']).'</td>
                                    <td class="text-muted fs-14 text-center">
                                        <a class="modal-effect btn btn-xs btn-info me-2 editModel" data-bs-effect="effect-scale" data-bs-toggle="modal" 
                                        data-product-id = "'.$product['product_id'].'" 
                                        data-product-name = "'.$product['product_name'].'"
                                        data-product-code = "'.$product['product_code'].'"
                                        data-product-image = "'.$product['product_image'].'"
                                        data-product-status = "'.$product['product_status'].'"
                                        data-id-cat = "'.$product['id_cat'].'"
                                        data-id-subcat = "'.$product['id_subcat'].'"
                                        data-id-brand = "'.$product['id_brand'].'"
                                        href="#edit">
                                            <i class="fe fe-edit"></i></a>
                                        </a>
                                        <a class="btn btn-xs btn-danger deleteModel" data-bs-target="#delete" 
                                        data-product-id = "'.$product['product_id'].'" 
                                        data-bs-toggle="modal" href="javascript:void(0)">
                                            <i class="fe fe-trash"></i>
                                        </a>
                                    </td>
                                </tr>';
                            endforeach;
                        endif;
                            echo '
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- COL END -->
</div>';
?>