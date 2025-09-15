<?php
$condition = array ( 
                    'select'        =>  '*',
                    'where'         =>  array( 
                                                'is_deleted' => 0,
                                             ), 
                    'not_equal'     =>  array( 
                                                'ap_id' => ''
                                             ), 
                    'order_by' 		=>  'ap_id DESC',
                    'return_type'   =>  'all'
                   ); 
$Applicants 	= $dblms->getRows(APPLICANTS, $condition);

    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Applicant List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="btn btn-primary" href="applicants.php?view=add&step=1"><i class="ri-add-box-fill align-bottom me-1"></i>Applicants</a>
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
                                    <th class="bg-transparent border-bottom-0 wp-6">Ref. #</th>
                                    <th class="bg-transparent border-bottom-0">Name</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Phone</th>
                                    <th class="bg-transparent border-bottom-0 wp-7  text-center">Application Date</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($Applicants):
                                    $sr = 0;
                                    foreach($Applicants as $applicant):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">'.$applicant['ap_referenceno'].'</td>
                                            <td class="text-muted fs-14">
                                                <div class="d-flex align-items-center">
                                                    <span class="data-image avatar avatar-md rounded-circle" style="background-image: url(uploads/images/applicants/profile_images/'.$applicant['ap_photo'].')"></span>
                                                    <div class="user-details ms-2">
                                                        <h6 class="mb-0">'.$applicant['ap_fullname'].'</h6>
                                                        <span class="text-muted fs-12">'.$applicant['ap_email'].'</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted fs-14">'.$applicant['ap_phone'].'</td>
                                            <td class="text-muted fs-14  text-center">'.$applicant['ap_dated'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_applicationstatus($applicant['ap_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-xs btn-info me-2"  href="applicants.php?view=edit&ap_id='.$applicant['ap_id'].'&step=1">
                                                    <i class="fe fe-edit"></i></a>
                                                </a>
                                                <a class="btn btn-xs  btn-danger deleteModelClass" data-bs-target="#deleteModel" data-ap-id = "'.$applicant['ap_id'].'" data-bs-toggle="modal" href="javascript:void(0)">
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