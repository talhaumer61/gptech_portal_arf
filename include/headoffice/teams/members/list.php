<?php
$condition = array ( 
                    'select' 	=> ''.TEAM_MEMBERS.'.id, '.TEAM_MEMBERS.'.status, '.TEAM_MEMBERS.'.ordering, '.TEAM_MEMBERS.'.full_name, '.TEAM_MEMBERS.'.id_des, '.TEAM_MEMBERS.'.profile_image, '.DESIGNATIONS.'.des_name',
                    'join' 		=> 'INNER JOIN '.DESIGNATIONS.' ON '.DESIGNATIONS.'.des_id = '.TEAM_MEMBERS.'.id_des',
                    'where' 	=> array( 
                                        ''.TEAM_MEMBERS.'.is_deleted' => 0 ,
                                    ), 
                    'order_by' 		=> ''.TEAM_MEMBERS.'.ordering  ASC',
                    'return_type' 	=> 'all' 
                   ); 
$teamMembers 	= $dblms->getRows(TEAM_MEMBERS, $condition);
    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Team Member List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="btn btn-primary" onclick="showAjaxModalZoom(\'include/modals/team_members/add.php\');"><i class="ri-add-box-fill align-bottom me-1"></i>Team Member</a>
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
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($teamMembers):
                                    $sr = 0;
                                    foreach($teamMembers as $row):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">
                                                <div class="d-flex align-items-center">
                                                    <span class="data-image avatar avatar-md rounded-circle" style="background-image: url(uploads/images/team_members/'.$row['profile_image'].')"></span>
                                                    <div class="user-details ms-2">
                                                        <h6 class="mb-0">'.$row['full_name'].'</h6>
                                                        <span class="text-muted fs-12">'.$row['des_name'].'</span>
                                                    </div>
                                                </div>
                                            <td class="text-muted fs-14 text-center">'.$row['ordering'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($row['status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/team_members/edit.php?id='.$row['id'].'&full_name='.$row['full_name'].'&id_des='.$row['id_des'].'&status='.$row['status'].'&ordering='.$row['ordering'].'\');"><i class="fe fe-edit"></i></a>
                                                </a>
                                                <a class="btn btn-xs  btn-danger" onclick="confirm_modal(\'team_members.php?deleteid='.$row['id'].'\');"><i class="fe fe-trash"></i></a>
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