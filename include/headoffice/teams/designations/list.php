<?php
$condition = array ( 
                    'select' 	=> "des_id, des_name, des_code, des_status, des_ordering",
                    'where' 	=> array( 
                                        'is_deleted' => 0 ,
                                    ), 
                    'order_by' 		=> 'des_ordering  ASC',
                    'return_type' 	=> 'all' 
                   ); 
$designations 	= $dblms->getRows(DESIGNATIONS, $condition);
    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Designation List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="btn btn-primary" onclick="showAjaxModalZoom(\'include/modals/designations/add.php\');"><i class="ri-add-box-fill align-bottom me-1"></i>Designation</a>
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
                                    <th class="bg-transparent border-bottom-0 wp-10">Ordering</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Code</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($designations):
                                    $sr = 0;
                                    foreach($designations as $row):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">'.$row['des_name'].'</td>
                                            <td class="text-muted fs-14">'.$row['des_ordering'].'</td>
                                            <td class="text-muted fs-14">'.$row['des_code'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($row['des_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/designations/edit.php?des_id='.$row['des_id'].'&des_name='.$row['des_name'].'&des_code='.$row['des_code'].'&des_status='.$row['des_status'].'&des_ordering='.$row['des_ordering'].'\');"><i class="fe fe-edit"></i></a>
                                                </a>
                                                <a class="btn btn-xs  btn-danger" onclick="confirm_modal(\'designations.php?deleteid='.$row['des_id'].'\');"><i class="fe fe-trash"></i></a>
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