<?php 
    require_once("../../functions/functions.php");
    echo '
    <!-- MODAL EFFECTS -->
        <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
            <div class="modal-content modal-content-demo expanel expanel-primary">
                <div class="modal-header expanel-heading">
                    <h6 class="modal-title">Edit Currency</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="currencies.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="modal-body expanel-body text-start">
                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label" for="card-name">Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="currency_name" value="'.$_GET['currency_name'].'" id="currency_name" placeholder="Currency Name" required>
                                <input class="form-control" type="hidden" name="currency_id" value="'.$_GET['currency_id'].'" id="currency_id" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label" for="card-name">Ordering <span class="text-danger">*</span></label>
                                <input class="form-control" name="currency_ordering" value="'.$_GET['currency_ordering'].'" readonly type="number" required>
                            </div>
                            <div class="col form-group">
                                <label class="form-label" for="card-name">Code <span class="text-danger">*</span></label>
                                <input class="form-control" name="currency_code" id="currency_code" value="'.$_GET['currency_code'].'" type="text" placeholder="Currency Code" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label" for="card-name">Symbol <span class="text-danger">*</span></label>
                                <input class="form-control" name="currency_symbol" id="currency_symbol" value="'.$_GET['currency_symbol'].'" type="text" placeholder="Currency Symbol" required>
                            </div>
                            <div class="col form-group">
                                <label class="form-label" for="card-name">Fractional Unit <span class="text-danger">*</span></label>
                                <input class="form-control" name="currency_fractionalunits" value="'.$_GET['currency_fractionalunits'].'" id="currency_fractionalunits" type="text" placeholder="Fractional Unit" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label">Position <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search form-select" required id="currency_position" name="currency_position" data-placeholder="Choose one ">
                                    <option label="Choose one "></option>';
                                    $currency_postitions = get_currency_postition();
                                    foreach($currency_postitions as $key => $currency_postition):
                                        echo '
                                        <option value="'.$key.'" '.($_GET['currency_position'] == $key ? 'selected' : '').'>'.$currency_postition.'</option>';
                                    endforeach;
                                    echo '
                                </select>
                            </div>
                            <div class="col form-group">
                                <label class="form-label">Staus <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search form-select" required id="currency_status" name="currency_status" data-placeholder="Choose one">
                                    <option label="Choose one"></option>';
                                    $statuses = get_status();
                                    foreach($statuses as $key => $status):
                                        echo '
                                        <option value="'.$key.'" '.($_GET['currency_status'] == $key ? 'selected' : '').'>'.$status.'</option>';
                                    endforeach;
                                    echo '
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit_edit" >Edit Currency</button> 
                        <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                    </div>
                </form>
            </div>
        </div>
    ';
?>