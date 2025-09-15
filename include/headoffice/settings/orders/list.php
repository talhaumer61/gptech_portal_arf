<?php
$condition = array ( 
                    'select'        =>  ''.ORDERS.'.order_id
                                        ,'.ORDERS.'.order_no
                                        ,'.ORDERS.'.id_vendor
                                        ,'.ORDERS.'.id_business
                                        ,'.ORDERS.'.grand_total
                                        ,'.ORDERS.'.advance
                                        ,'.ORDERS.'.balance
                                        ,'.ORDERS.'.dated
                                        ,'.ORDERS.'.order_status
                                        ,'.VENDORS.'.vendor_name
                                        ,'.BUSINESS.'.business_name
                                        ,'.BUSINESS.'.business_logo',

                    'join'          =>  'INNER JOIN '.VENDORS.' ON '.VENDORS.'.vendor_id = '.ORDERS.'.id_vendor
                                        INNER JOIN '.BUSINESS.' ON '.BUSINESS.'.business_id = '.ORDERS.'.id_business',
                    'where'         =>  array( 
                                                ''.ORDERS.'.is_deleted'   =>  0
                                            ), 
                    'order_by' 		=>  ''.ORDERS.'.order_id DESC',
                    'return_type'   =>  'all'
                   ); 
$Orders 	= $dblms->getRows(ORDERS, $condition);

echo '
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header border-bottom">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="card-title mb-0 mt-3" >Order List</h3>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a class="btn btn-primary" href="orders.php?view=add"><i class="ri-add-box-fill align-bottom me-1"></i>Orders</a>
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
                                <th class="bg-transparent border-bottom-0 text center">Order_no</th>
                                <th class="bg-transparent border-bottom-0 text-center">Vendor</th>
                                <th class="bg-transparent border-bottom-0 text-center">Grand Total</th>
                                <th class="bg-transparent border-bottom-0 text-center">Advance</th>
                                <th class="bg-transparent border-bottom-0 text-center">Balance</th>
                                <th class="bg-transparent border-bottom-0 text-center">Date</th>
                                <th class="bg-transparent border-bottom-0 text-center wp-10">Status</th>
                                <th class="bg-transparent border-bottom-0 text-center wp-10">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">';
                        if ($Orders):
                            $sr = 0;
                            foreach($Orders as $order):
                                $sr++;
                                echo '
                                <tr>
                                    <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                    <td class="text-muted fs-14 fw-semibold text-center">'.$order['order_no'].'</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="data-image avatar p-1 border avatar-md rounded-circle" style="background-image: url(uploads/images/business-logo/'.$order['business_logo'].')"></span>
                                            <div class="user-details ms-2">
                                                <h6 class="mb-0">'.$order['business_name'].'</h6>
                                                <span class="text-muted fs-12">'.$order['vendor_name'].'</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-muted fs-14 fw-semibold">'.$order['grand_total'].'</td>
                                    <td class="text-muted fs-14 fw-semibold">'.$order['advance'].'</td>
                                    <td class="text-muted fs-14 fw-semibold">'.$order['balance'].'</td>
                                    <td class="text-muted fs-14 fw-semibold">'.$order['dated'].'</td>
                                    <td class="text-muted fs-14 text-center">'.get_complete($order['order_status']).'</td>
                                    <td class="text-muted fs-14 text-center">
                                        <a class="btn btn-xs btn-info me-2" href="orders.php?view=edit&order_id='.$order['order_id'].'">
                                            <i class="fe fe-edit"></i></a>
                                        </a>
                                        <a class="btn btn-xs btn-danger deleteModel" data-bs-target="#delete" 
                                        data-order-id = "'.$order['order_id'].'" 
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
</div>';
?>