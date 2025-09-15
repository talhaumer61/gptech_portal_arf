<?php
$condition = array ( 
                    'select'        =>  'vendor_id, vendor_status, vendor_name, vendor_phone, vendor_mobile, vendor_email, vendor_cnic, vendor_address, vendor_description',
                    'where'         =>  array( 
                                                'is_deleted'    =>  0
                                            ), 
                    'order_by' 		=>  'vendor_id DESC',
                    'return_type'   =>  'all'
                   ); 
$Vendors 	= $dblms->getRows(VENDORS, $condition);

    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Vendor List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="modal-effect btn btn-primary" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#add"><i class="ri-add-box-fill align-bottom me-1"></i>Vendor</a>
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
                                    <th class="bg-transparent border-bottom-0 wp-10">Phone</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Mobile</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">email</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">CNIC</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                            if ($Vendors):
                                $sr = 0;
                                foreach($Vendors as $vendor):
                                    $sr++;
                                    echo '
                                    <tr>
                                        <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                        <td class="text-muted fs-14 fw-semibold">'.$vendor['vendor_name'].'</td>
                                        <td class="text-muted fs-14 fw-semibold">'.$vendor['vendor_phone'].'</td>
                                        <td class="text-muted fs-14 fw-semibold">'.$vendor['vendor_mobile'].'</td>
                                        <td class="text-muted fs-14 fw-semibold">'.$vendor['vendor_email'].'</td>
                                        <td class="text-muted fs-14 fw-semibold">'.$vendor['vendor_cnic'].'</td>
                                        <td class="text-muted fs-14 text-center">'.get_status($vendor['vendor_status']).'</td>
                                        <td class="text-muted fs-14 text-center">
                                            <a class="modal-effect btn btn-xs btn-info me-2 editModel" data-bs-effect="effect-scale" data-bs-toggle="modal" 
                                            data-vendor-name = "'.$vendor['vendor_name'].'" 
                                            data-vendor-phone = "'.$vendor['vendor_phone'].'"
                                            data-vendor-mobile = "'.$vendor['vendor_mobile'].'"
                                            data-vendor-email = "'.$vendor['vendor_email'].'"
                                            data-vendor-cnic = "'.$vendor['vendor_cnic'].'"
                                            data-vendor-address = "'.$vendor['vendor_address'].'"
                                            data-vendor-description = "'.$vendor['vendor_description'].'"
                                            data-vendor-status = "'.$vendor['vendor_status'].'"
                                            data-vendor-id = "'.$vendor['vendor_id'].'" 
                                            href="#edit">
                                                <i class="fe fe-edit"></i></a>
                                            </a>
                                            <a class="btn btn-xs btn-danger deleteModel" data-bs-target="#delete" data-vendor-id = "'.$vendor['vendor_id'].'" data-bs-toggle="modal" href="javascript:void(0)">
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