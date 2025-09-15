<?php
$condition  =   array( 
                        'select'        =>  ''.BUSINESSACT.'.businessact_id
                                            ,'.BUSINESSACT.'.businessact_status
                                            ,'.BUSINESSACT.'.businessact_name
                                            ,'.BUSINESSACT.'.businessact_number
                                            ,'.BUSINESSACT.'.businessact_cellno
                                            ,'.BUSINESSACT.'.businessact_description
                                            ,'.BUSINESSACT.'.id_bank
                                            ,'.BANKS.'.bank_name',

                        'join' 		    =>  'INNER JOIN '.BANKS.' ON '.BANKS.'.bank_id = '.BUSINESSACT.'.id_bank',
                        'where'         =>  array( 
                                                    ''.BUSINESSACT.'.is_deleted'    =>  0,
                                                ), 
                        'order_by' 		=>  ''.BUSINESSACT.'.businessact_id DESC',
                        'return_type'   =>  'all'
                    );
$BusinessAccounts 	= $dblms->getRows(BUSINESSACT, $condition);

    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Business Account List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="modal-effect btn btn-primary" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#add"><i class="ri-add-box-fill align-bottom me-1"></i>Business Account</a>
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
                                    <th class="bg-transparent border-bottom-0">Bank Name</th>
                                    <th class="bg-transparent border-bottom-0">Name</th>
                                    <th class="bg-transparent border-bottom-0">Acc. No</th>
                                    <th class="bg-transparent border-bottom-0">Cell No</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                            if($BusinessAccounts):
                                $sr = 0;
                                foreach($BusinessAccounts as $businessact):
                                    $sr++;
                                    echo '
                                    <tr>
                                        <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                        <td class="text-muted fs-14 fw-semibold">'.$businessact['bank_name'].'</td>
                                        <td class="text-muted fs-14 fw-semibold">'.$businessact['businessact_name'].'</td>
                                        <td class="text-muted fs-14 fw-semibold">'.$businessact['businessact_number'].'</td>
                                        <td class="text-muted fs-14 fw-semibold">'.$businessact['businessact_cellno'].'</td>
                                        <td class="text-muted fs-14 text-center">'.get_status($businessact['businessact_status']).'</td>
                                        <td class="text-muted fs-14 text-center">
                                            <a class="modal-effect btn btn-xs btn-info me-2 editModel" data-bs-effect="effect-scale" data-bs-toggle="modal"
                                            data-businessact-id = "'.$businessact['businessact_id'].'"
                                            data-businessact-status = "'.$businessact['businessact_status'].'"
                                            data-businessact-name = "'.$businessact['businessact_name'].'"
                                            data-businessact-number = "'.$businessact['businessact_number'].'"
                                            data-businessact-cellno = "'.$businessact['businessact_cellno'].'"
                                            data-businessact-description = "'.$businessact['businessact_description'].'"
                                            data-id-bank = "'.$businessact['id_bank'].'"
                                            href="#edit">
                                                <i class="fe fe-edit"></i></a>
                                            </a>

                                            <a class="btn btn-xs btn-danger deleteModel" data-bs-target="#delete" 
                                            data-businessact-id = "'.$businessact['businessact_id'].'" 
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