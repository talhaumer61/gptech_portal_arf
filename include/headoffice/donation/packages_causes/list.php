<?php
$condition = array ( 
                    'select' 	=> ''.PACKAGES_CAUSES.'.pc_id, '.PACKAGES_CAUSES.'.pc_status, '.PACKAGES_CAUSES.'.pc_ordering, '.PACKAGES_CAUSES.'.id_type, '.PACKAGES_CAUSES.'.pc_title, '.PACKAGES_CAUSES.'.pc_amount, '.PACKAGES_CAUSES.'.id_duration_type, '.PACKAGES_CAUSES.'.pc_duration, '.PACKAGES_CAUSES.'.pc_start_date, '.PACKAGES_CAUSES.'.pc_end_date, '.PACKAGES_CAUSES.'.pc_image, '.PACKAGES_CAUSES.'.pc_duration, '.PACKAGES_CAUSES.'.pc_duration, '.CATEGORIES.'.cat_name, '.ORGANIZATIONS.'.org_name',
                    'join' 		=> 'INNER JOIN '.CATEGORIES.' ON '.CATEGORIES.'.cat_id = '.PACKAGES_CAUSES.'.id_cat
                                    INNER JOIN '.ORGANIZATIONS.' ON '.ORGANIZATIONS.'.org_id = '.PACKAGES_CAUSES.'.id_org   ',
                    'where' 	=> array( 
                                        ''.PACKAGES_CAUSES.'.is_deleted' => 0 ,
                                    ), 
                    'order_by' 		=> ''.PACKAGES_CAUSES.'.pc_ordering  ASC',
                    'return_type' 	=> 'all' 
                   ); 
$donors = $dblms->getRows(PACKAGES_CAUSES, $condition);
    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Package & Cause List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a href="packages_causes.php?add" class="btn btn-primary"><i class="ri-add-box-fill align-bottom me-1"></i>Package & Cause</a>
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
                                    <th class="bg-transparent border-bottom-0">Package & Causes</th>
                                    <th class="bg-transparent border-bottom-0 wp-10 text-center">Ordering</th>
                                    <th class="bg-transparent border-bottom-0 wp-10 text-center">Amount</th>
                                    <th class="bg-transparent border-bottom-0 wp-10 text-center">Duration</th>
                                    <th class="bg-transparent border-bottom-0 wp-10 text-center">Organization</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($donors):
                                    $sr = 0;
                                    foreach($donors as $row):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">
                                                <div class="d-flex align-items-center">
                                                    <span class="data-image avatar avatar-md rounded-circle" style="background-image: url(uploads/images/packages_causes/'.$row['pc_image'].')"></span>
                                                    <div class="user-details ms-2">
                                                        <h6 class="mb-0">'.$row['pc_title'].'</h6>
                                                        <span class="text-muted fs-12">'.$row['cat_name'].'('.get_DonationTypes($row['id_type']).')</span>
                                                    </div>
                                                </div>
                                            <td class="text-muted fs-14 text-center">'.$row['pc_ordering'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$row['pc_amount'].'</td>
                                            <td class="text-muted fs-14 text-center">'.($row['id_type'] == 1 ? $row['pc_duration'].' '.get_DurationTypes($row['id_duration_type']) : date('d M, Y', strtotime($row['pc_start_date'])).'-'.date('d M, Y', strtotime($row['pc_end_date']))).'</td>
                                            <td class="text-muted fs-14 text-center">'.$row['org_name'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($row['pc_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-primary btn-xs" href="packages_causes.php?id='.$row['pc_id'].'"><i class="fe fe-edit"></i></a>
                                                </a>
                                                <a class="btn btn-xs  btn-danger" onclick="confirm_modal(\'packages_causes.php?deleteid='.$row['pc_id'].'\');"><i class="fe fe-trash"></i></a>
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
        </div>
    </div> ';
?>