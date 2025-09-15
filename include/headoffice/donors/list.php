<?php
$condition = array ( 
                    'select' 	=> 'dv.dv_id, dv.dv_status, dv.dv_full_name, dv.dv_cnic, dv.dv_dob, dv.dv_email, dv.dv_whatsapp, dv.dv_file, c.city_name',
                    'join' 		=> 'INNER JOIN '.CITIES.' c ON c.city_id = dv.id_city',
                    'where' 	=> array( 
                                        'dv.is_deleted' => 0 ,
                                    ), 
                    'order_by' 		=> 'dv.dv_ordering  ASC',
                    'return_type' 	=> 'all' 
                   ); 
$donors = $dblms->getRows(DONORS_VOLUNTREES.' dv', $condition);
    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Donor List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a href="donors.php?add" class="btn btn-primary"><i class="ri-add-box-fill align-bottom me-1"></i>Donor</a>
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
                                    <th class="bg-transparent border-bottom-0 wp-10 text-center">Date of Birh</th>
                                    <th class="bg-transparent border-bottom-0 wp-10 text-center">CNIC</th>
                                    <th class="bg-transparent border-bottom-0 wp-10 text-center">Whatsapp</th>
                                    <th class="bg-transparent border-bottom-0 wp-10 text-center">City</th>
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
                                                    <span class="data-image avatar avatar-md rounded-circle" style="background-image: url(uploads/images/donors/'.$row['dv_file'].')"></span>
                                                    <div class="user-details ms-2">
                                                        <h6 class="mb-0">'.$row['dv_full_name'].'</h6>
                                                        <span class="text-muted fs-12">'.$row['dv_email'].'</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted fs-14 text-center">'.date('d M, Y', strtotime($row['dv_dob'])).'</td>
                                            <td class="text-muted fs-14 text-center">'.$row['dv_cnic'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$row['dv_whatsapp'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$row['city_name'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($row['dv_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-primary btn-xs" href="donors.php?id='.$row['dv_id'].'"><i class="fe fe-edit"></i></a>
                                                </a>
                                                <a class="btn btn-xs  btn-danger" onclick="confirm_modal(\'donors.php?deleteid='.$row['dv_id'].'\');"><i class="fe fe-trash"></i></a>
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