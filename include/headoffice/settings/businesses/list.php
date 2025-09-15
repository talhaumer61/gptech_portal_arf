<?php
$condition = array ( 
                    'select'        =>  ''.BUSINESS.'.business_id
                                        ,'.BUSINESS.'.business_status
                                        ,'.BUSINESS.'.business_name
                                        ,'.BUSINESS.'.business_contactperson
                                        ,'.BUSINESS.'.business_contactperson_mobile
                                        ,'.BUSINESS.'.business_contactperson_email
                                        ,'.BUSINESS.'.business_address
                                        ,'.BUSINESS.'.business_description
                                        ,'.BUSINESS.'.business_stn
                                        ,'.BUSINESS.'.business_ntn
                                        ,'.BUSINESS.'.business_logo
                                        ,'.BUSINESS.'.business_website
                                        ,'.BUSINESS.'.id_vendor
                                        ,'.VENDORS.'.vendor_name',

                    'join' 		    =>  'INNER JOIN '.VENDORS.' ON '.VENDORS.'.vendor_id = '.BUSINESS.'.id_vendor',
                    'where'         =>  array( 
                                                ''.BUSINESS.'.is_deleted' => 0,
                                            ), 
                    'order_by' 		=>  ''.BUSINESS.'.business_id DESC',
                    'return_type'   =>  'all'
                   ); 
$Businesses 	= $dblms->getRows(BUSINESS, $condition);

    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Vendor Business List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="modal-effect btn btn-warning" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#addLinkAccount"><i class="ri-link align-bottom me-1"></i>Link Account</a>
                                <a class="modal-effect btn btn-primary" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#add"><i class="ri-add-box-fill align-bottom me-1"></i>Business</a>
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
                                    <th class="bg-transparent border-bottom-0">Business</th>
                                    <th class="bg-transparent border-bottom-0">Contact Person</th>
                                    <th class="bg-transparent border-bottom-0">Mobile No</th>
                                    <th class="bg-transparent border-bottom-0">Vendor</th>
                                    <th class="bg-transparent border-bottom-0">STN</th>
                                    <th class="bg-transparent border-bottom-0">NTN</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                            if($Businesses):
                                $sr = 0;
                                foreach($Businesses as $business):
                                    $sr++;
                                    echo '
                                    <tr>
                                        <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="data-image avatar p-1 border avatar-md rounded-circle" style="background-image: url(uploads/images/business-logo/'.$business['business_logo'].')"></span>
                                                <div class="user-details ms-2">
                                                    <h6 class="mb-0">
                                                        <a class="modal-effect viewLinkAccountModel" data-bs-effect="effect-scale" data-bs-toggle="modal" 
                                                        data-business-id    =   "'.$business['business_id'].'" 
                                                        href="#viewLinkAccount">
                                                            '.$business['business_name'].'
                                                        </a>
                                                    </h6>
                                                    <span class="text-muted fs-12"><a href="'.$business['business_website'].'" target="_blank">'.$business['business_website'].'</a></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-details ms-2">
                                                    <h6 class="mb-0">'.$business['business_contactperson'].'</h6>
                                                    <span class="text-muted fs-12"><a href="mailto:'.$business['business_contactperson_email'].'" target="_blank">'.$business['business_contactperson_email'].'</a></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-muted fs-14 fw-semibold">'.$business['business_contactperson_mobile'].'</td>
                                        <td class="text-muted fs-14 fw-semibold">'.$business['vendor_name'].'</td>
                                        <td class="text-muted fs-14 fw-semibold">'.$business['business_stn'].'</td>
                                        <td class="text-muted fs-14 fw-semibold">'.$business['business_ntn'].'</td>
                                        <td class="text-muted fs-14 text-center">'.get_status($business['business_status']).'</td>
                                        <td class="text-muted fs-14 text-center">
                                            <a class="modal-effect btn btn-xs btn-info me-2 editModel" data-bs-effect="effect-scale" data-bs-toggle="modal" 
                                            data-business-id                    =   "'.$business['business_id'].'" 
                                            data-business-name                  =   "'.$business['business_name'].'" 
                                            data-business-website               =   "'.$business['business_website'].'"
                                            data-id-vendor                      =   "'.$business['id_vendor'].'"
                                            data-business-contactperson         =   "'.$business['business_contactperson'].'"
                                            data-business-contactperson-mobile  =   "'.$business['business_contactperson_mobile'].'"
                                            data-business-contactperson-email   =   "'.$business['business_contactperson_email'].'"
                                            data-business-stn                   =   "'.$business['business_stn'].'"
                                            data-business-ntn                   =   "'.$business['business_ntn'].'"
                                            data-business-status                =   "'.$business['business_status'].'"
                                            data-business-logo                  =   "'.$business['business_logo'].'"
                                            data-business-address               =   "'.$business['business_address'].'"
                                            data-business-description           =   "'.$business['business_description'].'"
                                            href="#edit">
                                                <i class="fe fe-edit"></i></a>
                                            </a>
                                            <a class="btn btn-xs btn-danger deleteModel" data-bs-target="#delete" 
                                            data-business-id                    =   "'.$business['business_id'].'"
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
    </div> ';
?>