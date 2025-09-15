<?php
$condition = array ( 
                    'select' 	=> ''.ORGANIZATIONS.'.org_id, '.ORGANIZATIONS.'.org_status, '.ORGANIZATIONS.'.org_ordering, '.ORGANIZATIONS.'.org_name, '.ORGANIZATIONS.'.org_email, '.ORGANIZATIONS.'.org_phone, '.ORGANIZATIONS.'.org_image, '.CITIES.'.city_name',
                    'join' 		=> 'INNER JOIN '.CITIES.' ON '.CITIES.'.city_id = '.ORGANIZATIONS.'.id_city',
                    'where' 	=> array( 
                                        ''.ORGANIZATIONS.'.is_deleted' => 0 ,
                                    ), 
                    'order_by' 		=> ''.ORGANIZATIONS.'.org_ordering  ASC',
                    'return_type' 	=> 'all' 
                   ); 
$organizations 	= $dblms->getRows(ORGANIZATIONS, $condition);
    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Organization List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="btn btn-primary" onclick="showAjaxModalZoom(\'include/modals/organizations/add.php\');"><i class="ri-add-box-fill align-bottom me-1"></i>Organization</a>
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
                                    <th class="bg-transparent border-bottom-0">Full Name</th>
                                    <th class="bg-transparent border-bottom-0 wp-10 text-center">Ordering</th>
                                    <th class="bg-transparent border-bottom-0 wp-10 text-center">Phone</th>
                                    <th class="bg-transparent border-bottom-0 wp-10 text-center">City</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($organizations):
                                    $sr = 0;
                                    foreach($organizations as $row):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">
                                                <div class="d-flex align-items-center">
                                                    <span class="data-image avatar avatar-md rounded-circle" style="background-image: url(uploads/images/organizations/'.$row['org_image'].')"></span>
                                                    <div class="user-details ms-2">
                                                        <h6 class="mb-0">'.$row['org_name'].'</h6>
                                                        <span class="text-muted fs-12">'.$row['org_email'].'</span>
                                                    </div>
                                                </div>
                                            <td class="text-muted fs-14 text-center">'.$row['org_ordering'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$row['org_phone'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$row['city_name'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($row['org_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/organizations/edit.php?org_id='.$row['org_id'].'\');"><i class="fe fe-edit"></i></a>
                                                </a>
                                                <a class="btn btn-xs  btn-danger" onclick="confirm_modal(\'organizations.php?deleteid='.$row['org_id'].'\');"><i class="fe fe-trash"></i></a>
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