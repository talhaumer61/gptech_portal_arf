<?php
$condition = array ( 
                    'select'        =>  ''.PRODUCT_SUBCAT.'.subcat_id
                                        ,'.PRODUCT_SUBCAT.'.subcat_status
                                        ,'.PRODUCT_SUBCAT.'.subcat_name
                                        ,'.PRODUCT_SUBCAT.'.subcat_code
                                        ,'.PRODUCT_SUBCAT.'.subcat_description
                                        ,'.PRODUCT_SUBCAT.'.id_cat
                                        ,'.PRODUCT_CAT.'.cat_name',
                    'join'          =>  'INNER JOIN '.PRODUCT_CAT.' ON '.PRODUCT_CAT.'.cat_id = '.PRODUCT_SUBCAT.'.id_cat',
                    'where'         =>  array( 
                                                ''.PRODUCT_SUBCAT.'.is_deleted'    =>  0
                                            ), 
                    'order_by' 		=>  ''.PRODUCT_SUBCAT.'.subcat_id DESC',
                    'return_type'   =>  'all'
                   ); 
$SubCategories 	= $dblms->getRows(PRODUCT_SUBCAT, $condition);

echo '
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header border-bottom">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="card-title mb-0 mt-3" >Sub Cateory List</h3>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a class="modal-effect btn btn-primary" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#add"><i class="ri-add-box-fill align-bottom me-1"></i>Sub Category</a>
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
                                <th class="bg-transparent border-bottom-0">Name</th>
                                <th class="bg-transparent border-bottom-0">Category</th>
                                <th class="bg-transparent border-bottom-0 text-center wp-10">code</th>
                                <th class="bg-transparent border-bottom-0 text-center">Description</th>
                                <th class="bg-transparent border-bottom-0 text-center wp-10">Status</th>
                                <th class="bg-transparent border-bottom-0 text-center wp-10">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">';
                        if ($SubCategories):
                            $sr = 0;
                            foreach($SubCategories as $subcat):
                                $sr++;
                                echo '
                                <tr>
                                    <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                    <td class="text-muted fs-14 fw-semibold">'.$subcat['subcat_name'].'</td>
                                    <td class="text-muted fs-14 fw-semibold">'.$subcat['cat_name'].'</td>
                                    <td class="text-muted fs-14 fw-semibold">'.$subcat['subcat_code'].'</td>
                                    <td class="text-muted fs-14 fw-semibold">'.$subcat['subcat_description'].'</td>
                                    <td class="text-muted fs-14 text-center">'.get_status($subcat['subcat_status']).'</td>
                                    <td class="text-muted fs-14 text-center">
                                        <a class="modal-effect btn btn-xs btn-info me-2 editModel" data-bs-effect="effect-scale" data-bs-toggle="modal" 
                                        data-subcat-id = "'.$subcat['subcat_id'].'" 
                                        data-subcat-name = "'.$subcat['subcat_name'].'"
                                        data-subcat-code = "'.$subcat['subcat_code'].'"
                                        data-subcat-description = "'.$subcat['subcat_description'].'"
                                        data-subcat-status = "'.$subcat['subcat_status'].'"
                                        data-id-cat = "'.$subcat['id_cat'].'"
                                        href="#edit">
                                            <i class="fe fe-edit"></i></a>
                                        </a>
                                        <a class="btn btn-xs btn-danger deleteModel" data-bs-target="#delete" 
                                        data-subcat-id = "'.$subcat['subcat_id'].'" 
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