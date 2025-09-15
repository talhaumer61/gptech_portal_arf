<?php
    $condition = array ( 
                        'select' 	=> "currency_id, currency_name,currency_code, currency_ordering, currency_symbol, currency_position, currency_fractionalunits, currency_status",
                        'where' 	=> array( 
                                            'is_deleted' => 0 ,
                                        ), 
                        'order_by' 		=> 'currency_ordering ASC',
                        'return_type' 	=> 'all' 
                    ); 
    $Currencies 	= $dblms->getRows(CURRENCIES, $condition);
    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Currency List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="btn btn-primary" onclick="showAjaxModalZoom(\'include/modals/currencies/add.php\');"><i class="ri-add-box-fill align-bottom me-1"></i>Currency</a>
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
                                    <th class="bg-transparent border-bottom-0 wp-8">Ordering</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Code</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Symbol</th>
                                    <th class="bg-transparent border-bottom-0 wp-7 text-center">Position</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Fraction Unit</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($Currencies):
                                    $sr = 0;
                                    foreach($Currencies as $currency):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">'.$currency['currency_name'].'</td>
                                            <td class="text-muted fs-14 text-center">'.$currency['currency_ordering'].'</td>
                                            <td class="text-muted fs-14">'.$currency['currency_code'].'</td>
                                            <td class="text-muted fs-14">'.$currency['currency_symbol'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_currency_postition($currency['currency_position']).'</td>
                                            <td class="text-muted fs-14">'.$currency['currency_fractionalunits'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($currency['currency_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-xs btn-primary" onclick="showAjaxModalZoom(\'include/modals/currencies/edit.php?currency_id='.$currency['currency_id'].'&currency_name='.$currency['currency_name'].'&currency_code='.$currency['currency_code'].'&currency_position='.$currency['currency_position'].'&currency_symbol='.$currency['currency_symbol'].'&currency_fractionalunits='.$currency['currency_fractionalunits'].'&currency_status='.$currency['currency_status'].'&currency_ordering='.$currency['currency_ordering'].'\');"> <i class="fe fe-edit"></i></a>

                                                <a class="btn btn-xs btn-danger" onclick="confirm_modal(\'currencies.php?deleteid='.$currency['currency_id'].'\');"><i class="fe fe-trash"></i></a>
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