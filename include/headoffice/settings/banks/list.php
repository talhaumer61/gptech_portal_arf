<?php
$condition = array ( 
                    'select' 	=> "bank_id, bank_status, bank_code, bank_name",
                    'where' 	=> array( 
                                        'is_deleted' => 0 ,
                                    ), 
                    'order_by' 		=> 'bank_id DESC',
                    'return_type' 	=> 'all' 
                   ); 
$Banks 	= $dblms->getRows(BANKS, $condition);
    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Bank List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="modal-effect btn btn-primary" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#addBank"><i class="ri-add-box-fill align-bottom me-1"></i>Bank</a>
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
                                    <th class="bg-transparent border-bottom-0 wp-10">Code</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($Banks):
                                    $sr = 0;
                                    foreach($Banks as $bank):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">'.$bank['bank_name'].'</td>
                                            <td class="text-muted fs-14">'.$bank['bank_code'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($bank['bank_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="modal-effect btn btn-xs btn-info me-2 editBankModel" data-bs-effect="effect-scale" data-bs-toggle="modal" data-item-name = "'.$bank['bank_name'].'" data-item-code = "'.$bank['bank_code'].'" data-item-status = "'.$bank['bank_status'].'" data-item-id = "'.$bank['bank_id'].'" href="#editBank">
                                                    <i class="fe fe-edit"></i></a>
                                                </a>
                                                <a class="btn btn-xs  btn-danger deleteBankModel" data-bs-target="#deleteBank" data-item-id = "'.$bank['bank_id'].'" data-bs-toggle="modal" href="javascript:void(0)">
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