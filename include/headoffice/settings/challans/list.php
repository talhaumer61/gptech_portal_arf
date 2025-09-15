<?php
$condition = array ( 
                    'select'        =>  ''.CHALLANS.'.challan_id
                                        ,'.CHALLANS.'.id_applicant
                                        ,'.CHALLANS.'.challan_no
                                        ,'.CHALLANS.'.total_amount
                                        ,'.CHALLANS.'.paid_amount
                                        ,'.CHALLANS.'.issue_date
                                        ,'.CHALLANS.'.due_date
                                        ,'.CHALLANS.'.status
                                        ,'.APPLICANTS.'.ap_referenceno
                                        ,'.APPLICANTS.'.ap_fullname
                                        ,'.APPLICANTS.'.ap_photo',
                    'join' 		    =>  'INNER JOIN '.APPLICANTS.' ON '.APPLICANTS.'.ap_id = '.CHALLANS.'.id_applicant',
                    'not_equal'     =>  array( 
                                                ''.CHALLANS.'.challan_id'    =>  ''
                                            ), 
                    'order_by' 		=>  ''.CHALLANS.'.challan_id DESC',
                    'return_type'   =>  'all'
                   ); 
$Challans 	= $dblms->getRows(CHALLANS, $condition);

    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Challan List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="modal-effect btn btn-primary" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#add"><i class="ri-add-box-fill align-bottom me-1"></i>Challan</a>
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
                                    <th class="bg-transparent border-bottom-0 text-center wp-10">Challan</th>
                                    <th class="bg-transparent border-bottom-0">Applicant</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Total Amount</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Paid Amount</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Issue Date</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Due Date</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                            if ($Challans):
                                $sr = 0;
                                foreach($Challans as $challan):
                                    $sr++;
                                    echo '
                                    <tr>
                                        <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                        <td class="text-muted fs-14 fw-semibold text-center">'.$challan['challan_no'].'</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="data-image avatar p-1 border avatar-md rounded-circle" style="background-image: url(uploads/images/applicants/profile_images/'.$challan['ap_photo'].')"></span>
                                                <div class="user-details ms-2">
                                                    <h6 class="mb-0">'.$challan['ap_fullname'].'</h6>
                                                    <span class="text-muted fs-12">'.$challan['ap_referenceno'].'</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-muted fs-14 fw-semibold">'.$challan['total_amount'].'</td>
                                        <td class="text-muted fs-14 fw-semibold">'.$challan['paid_amount'].'</td>
                                        <td class="text-muted fs-14 fw-semibold">'.$challan['issue_date'].'</td>
                                        <td class="text-muted fs-14 fw-semibold">'.$challan['due_date'].'</td>
                                        <td class="text-muted fs-14 text-center">'.get_challanstatus($challan['status']).'</td>
                                        <td class="text-muted fs-14 text-center">';
                                            if($challan['status'] != 1):
                                                echo '
                                                <a class="btn btn-xs btn-info me-2" href="challans.php?view=edit&id_challan='.$challan['challan_id'].'">
                                                    <i class="fe fe-edit"></i></a>
                                                </a>';
                                            endif;
                                            echo '
                                            <a class="btn btn-xs btn-light" target="_blank" href="challan_print.php?id_challan='.$challan['challan_id'].'">
                                                <i class="fe fe-printer"></i>
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