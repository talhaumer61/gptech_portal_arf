<?php
$condition = array ( 
                    'select'        =>  'cat_id, cat_status, cat_name, cat_code, cat_description',
                    'where'         =>  array( 
                                                'is_deleted'    =>  0
                                            ), 
                    'order_by' 		=>  'cat_id DESC',
                    'return_type'   =>  'all'
                   ); 
$Categories 	= $dblms->getRows(PRODUCT_CAT, $condition);

echo '
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header border-bottom">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="card-title mb-0 mt-3" >Cateory List</h3>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a class="modal-effect btn btn-primary" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#add"><i class="ri-add-box-fill align-bottom me-1"></i>Category</a>
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
                                <th class="bg-transparent border-bottom-0 text-center wp-10">code</th>
                                <th class="bg-transparent border-bottom-0 text-center">Description</th>
                                <th class="bg-transparent border-bottom-0 text-center wp-10">Status</th>
                                <th class="bg-transparent border-bottom-0 text-center wp-10">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">';
                        if($Categories):
                            $sr = 0;
                            foreach($Categories as $category):
                                $sr++;
                                echo '
                                <tr>
                                    <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                    <td class="text-muted fs-14 fw-semibold">'.$category['cat_name'].'</td>
                                    <td class="text-muted fs-14 fw-semibold">'.$category['cat_code'].'</td>
                                    <td class="text-muted fs-14 fw-semibold">'.$category['cat_description'].'</td>
                                    <td class="text-muted fs-14 text-center">'.get_status($category['cat_status']).'</td>
                                    <td class="text-muted fs-14 text-center">
                                        <a class="modal-effect btn btn-xs btn-info me-2 editModel" data-bs-effect="effect-scale" data-bs-toggle="modal" 
                                        data-cat-id = "'.$category['cat_id'].'" 
                                        data-cat-name = "'.$category['cat_name'].'"
                                        data-cat-code = "'.$category['cat_code'].'"
                                        data-cat-description = "'.$category['cat_description'].'"
                                        data-cat-status = "'.$category['cat_status'].'"
                                        href="#edit">
                                            <i class="fe fe-edit"></i></a>
                                        </a>
                                        <a class="btn btn-xs btn-danger deleteModel" data-bs-target="#delete" 
                                        data-cat-id = "'.$category['cat_id'].'" 
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