<?php
$condition = array ( 
                    'select'        =>  'brand_id, brand_status, brand_name, brand_code, brand_image, brand_description',
                    'where'         =>  array( 
                                                'is_deleted'    =>  0
                                            ), 
                    'order_by' 		=>  'brand_id DESC',
                    'return_type'   =>  'all'
                   ); 
$Brands 	= $dblms->getRows(BRANDS, $condition);

echo '
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header border-bottom">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="card-title mb-0 mt-3" >Brand List</h3>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a class="modal-effect btn btn-primary" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#add"><i class="ri-add-box-fill align-bottom me-1"></i>Brand</a>
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
                                <th class="bg-transparent border-bottom-0 text-center wp-10">Image</th>
                                <th class="bg-transparent border-bottom-0">Name</th>
                                <th class="bg-transparent border-bottom-0 text-center wp-10">code</th>
                                <th class="bg-transparent border-bottom-0 text-center wp-10">Status</th>
                                <th class="bg-transparent border-bottom-0 text-center wp-10">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">';
                        if($Brands):
                            $sr = 0;
                            foreach($Brands as $brand):
                                $sr++;
                                echo '
                                <tr>
                                    <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                    <td class="text-muted fs-14 fw-semibold text-center"><img src="uploads/images/brands/'.$brand['brand_image'].'" width="40" height="40" class="border"></td>
                                    <td class="text-muted fs-14 fw-semibold">'.$brand['brand_name'].'</td>
                                    <td class="text-muted fs-14 fw-semibold">'.$brand['brand_code'].'</td>
                                    <td class="text-muted fs-14 text-center">'.get_status($brand['brand_status']).'</td>
                                    <td class="text-muted fs-14 text-center">
                                        <a class="modal-effect btn btn-xs btn-info me-2 editModel" data-bs-effect="effect-scale" data-bs-toggle="modal" 
                                        data-brand-name = "'.$brand['brand_name'].'" 
                                        data-brand-code = "'.$brand['brand_code'].'"
                                        data-brand-image = "'.$brand['brand_image'].'"
                                        data-brand-description = "'.$brand['brand_description'].'"
                                        data-brand-status = "'.$brand['brand_status'].'"
                                        data-brand-id = "'.$brand['brand_id'].'" 
                                        href="#edit">
                                            <i class="fe fe-edit"></i></a>
                                        </a>
                                        <a class="btn btn-xs btn-danger deleteModel" data-bs-target="#delete" 
                                        data-brand-id = "'.$brand['brand_id'].'" 
                                        data-bs-toggle="modal" href="javascript:void(0)">
                                            <i class="fe fe-trash"></i>
                                        </a>
                                    </td>
                                </tr>';
                            endforeach;
                        endif;
                            echo'
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- COL END -->
</div>';
?>