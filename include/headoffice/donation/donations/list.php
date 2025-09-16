<?php
    $condition = array ( 
                        'select' 	=> ''.DONATIONS.'.is_by_portal,'.DONATIONS.'.id_donor,'.DONATIONS.'.id, '.DONATIONS.'.status, '.DONATIONS.'.id_type, '.DONATIONS.'.id_added, '.DONATIONS.'.dated, '.DONATIONS.'.fullname, '.DONATIONS.'.cnic, '.DONATIONS.'.phone, '.DONATIONS.'.email, '.DONATIONS.'.referrals, '.DONATIONS.'.amount, '.DONATIONS.'.is_byfast, '.SUB_CATEGORIES.'.subcat_name, '.PACKAGES_CAUSES.'.pc_title',
                        'join' 		=> 'LEFT JOIN '.SUB_CATEGORIES.' ON '.SUB_CATEGORIES.'.subcat_id = '.DONATIONS.'.id_pc_subcat
                                        LEFT JOIN '.PACKAGES_CAUSES.' ON '.PACKAGES_CAUSES.'.pc_id = '.DONATIONS.'.id_pc_subcat',
                        'where' 	=> array( 
                                            ''.DONATIONS.'.is_deleted' => 0 ,
                                        ),  
                        'not_equal' 	=> array( 
                                                    ''.DONATIONS.'.status' => 3 ,
                                        ), 
                        'order_by' 		=> ''.DONATIONS.'.id  DESC',
                        'return_type' 	=> 'all' 
                    ); 
    $donations = $dblms->getRows(DONATIONS, $condition);
    // echo '<pre>'; print_r($donations); exit;
    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Donation List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a href="donations.php?add" class="btn btn-primary"><i class="ri-add-box-fill align-bottom me-1"></i>Donation</a>
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
                                    <th class="bg-transparent border-bottom-0 wp-10 text-center">Date</th>
                                    <th class="bg-transparent border-bottom-0">Name</th>
                                    <th class="bg-transparent border-bottom-0 wp-10 text-center">Phone</th>
                                    <th class="bg-transparent border-bottom-0 wp-10 text-center">Amount</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Purpose</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($donations):
                                    $sr = 0;
                                    foreach($donations as $row):
                                        if($row['is_by_portal'] == '1') {
                                            // DONORS
                                            $conCat = array ( 
                                                                'select'        =>  'dv_id, dv_full_name,dv_donor_id, dv_email, dv_phone',
                                                                'where'         =>  array( 
                                                                                            'is_deleted'     => 0
                                                                                            ,'dv_status' => 1
                                                                                            ,'dv_id' => $row['id_donor']
                                                                                        ), 
                                                                'limit' 		=>  1,
                                                                'return_type'   =>  'single'
                                                            ); 
                                            $DONOR = $dblms->getRows(DONORS_VOLUNTREES, $conCat);
                                        }
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.date('d M, Y', strtotime($row['dated'])).'</td>
                                            <td class="text-muted fs-14 fw-semibold">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-details ms-2">
                                                        <h6 class="mb-0">'.($row['is_by_portal'] == '1'? $DONOR['dv_full_name']:$row['fullname']).'</h6>
                                                        <span class="text-muted fs-12">'.($row['is_by_portal'] == '1'? $DONOR['dv_email']:$row['email']).'</span>
                                                    </div>
                                                </div>
                                            <td class="text-muted fs-14 text-center">'.($row['is_by_portal'] == '1'? $DONOR['dv_phone']:$row['phone']).'</td>
                                            <td class="text-muted fs-14 text-center">'.$row['amount'].'</td>
                                            <td class="text-muted fs-14 text-center">'.($row['id_type'] == '3' ? $row['subcat_name'] : $row['pc_title']).'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($row['status']).'</td>
                                            <td class="text-muted fs-14 text-center">';
                                                if($row['id_added'] != '0' && $row['is_byfast'] == '0'){
                                                    echo '<a class="btn btn-primary btn-xs" href="donations.php?id='.$row['id'].'"><i class="fe fe-edit"></i></a>
                                                    </a>';
                                                }
                                                echo '
                                                <a class="btn btn-xs  btn-info" target="_blank" href="printdonationslip.php?id='.$row['id'].'"><i class="ri-printer-line align-middle fs-11 "></i></a>';
                                                if($row['is_byfast'] == '0'){
                                                    echo '<a class="btn btn-xs  btn-danger" onclick="confirm_modal(\'donations.php?deleteid='.$row['id'].'\');"><i class="fe fe-trash"></i></a>';
                                                }
                                                echo '
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