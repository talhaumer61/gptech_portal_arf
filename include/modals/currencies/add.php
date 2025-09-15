<?php 
    require_once("../../dbsetting/lms_vars_config.php");
    require_once("../../dbsetting/classdbconection.php");
    require_once("../../functions/functions.php");
    $dblms = new dblms();
    $conOrdering = array ( 
                            'select'        =>  'currency_id',
                            'order_by' 		=>  'currency_id DESC',
                            'return_type'   =>  'single'
                       ); 
    $currency  = $dblms->getRows(CURRENCIES, $conOrdering);
    if($currency){
        $ordering = $currency['currency_id'] + 1;
    }else{
        $ordering = 1;
    }
    echo '
        <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
            <div class="modal-content modal-content-demo expanel expanel-primary">
                <div class="modal-header expanel-heading">
                    <h6 class="modal-title">Add Currency</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="currencies.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="modal-body expanel-body text-start">
                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label" for="card-name">Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="currency_name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label" for="card-name">Ordering <span class="text-danger">*</span></label>
                                <input class="form-control" name="currency_ordering" value="'.$ordering.'" readonly type="number" required>
                            </div>
                            <div class="col form-group">
                                <label class="form-label" for="card-name">Code <span class="text-danger">*</span></label>
                                <input class="form-control" name="currency_code" type="text" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label" for="card-name">Symbol <span class="text-danger">*</span></label>
                                <input class="form-control" name="currency_symbol" type="text" required>
                            </div>
                            <div class="col form-group">
                                <label class="form-label" for="card-name">Fractional Unit <span class="text-danger">*</span></label>
                                <input class="form-control" name="currency_fractionalunits" type="text" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label">Position <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search form-select" id="mySelect2" required name="currency_position" data-placeholder="Select ">
                                    <option label="Select "></option>';
                                    $currency_postitions = get_currency_postition();
                                    foreach($currency_postitions as $key => $currency_postition):
                                        echo '
                                        <option value="'.$key.'">'.$currency_postition.'</option>';
                                    endforeach;
                                    echo '
                                </select>
                            </div>
                            <div class="col form-group">
                                <label class="form-label">Staus <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search form-select" id="mySelect2" required name="currency_status" data-placeholder="Select">
                                    <option label="Select"></option>';
                                    $statuses = get_status();
                                    foreach($statuses as $key => $status):
                                        echo '
                                        <option value="'.$key.'">'.$status.'</option>';
                                    endforeach;
                                    echo '
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit_add" >Add Currency</button> 
                        <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                    </div>
                </form>
            </div>
        </div>
    ';
?>