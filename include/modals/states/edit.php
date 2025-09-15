<?php
    require_once("../../dbsetting/lms_vars_config.php");
	require_once("../../dbsetting/classdbconection.php");
	require_once("../../functions/functions.php");
	$dblms = new dblms();
    $condition = array ( 
                            'select'        =>  'country_id, country_name',
                            'where'         =>  array(
                                                        'country_status'    =>  1
                                                        ,'is_deleted'       =>  0
                                                    ), 
                            'order_by' 		=>  'country_name',
                            'return_type'   =>  'all'
                        ); 
    $Countries = $dblms->getRows(COUNTRIES, $condition);
    echo '
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Edit State</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="states.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <label class="form-label">State Name <span class="text-danger">*</span></label>
                                <input type="hidden" name="state_id" id="state_id" value="'.$_GET['state_id'].'" class="form-control" required />
                                <input type="text" name="state_name" id="state_name" value="'.$_GET['state_name'].'" class="form-control" required />
                            </div>
                            <div class="col">
                                <label class="form-label" for="card-name">Ordering <span class="text-danger">*</span></label>
                                <input class="form-control" name="state_ordering" value="'.$_GET['state_ordering'].'" readonly type="number" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label">Code (Digit) <span class="text-danger">*</span></label>
                                <input type="number" name="state_codedigit" value="'.$_GET['state_codedigit'].'" class="form-control" required />
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Code (Alpha) <span class="text-danger">*</span></label>
                                <input type="text" name="state_codealpha" value="'.$_GET['state_codealpha'].'" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label">Latitude <span class="text-danger">*</span></label>
                                <input type="text" name="state_latitude" value="'.$_GET['state_latitude'].'" class="form-control" required />
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Longitude <span class="text-danger">*</span></label>
                                <input type="text" name="state_longitude" value="'.$_GET['state_longitude'].'" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label class="form-label">Country <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search form-select" required name="id_country" data-placeholder="Select">
                                    <option label="Select"></option>';
                                    foreach ($Countries as $country):
                                        echo'<option value="'.$country['country_id'].'" '.($_GET['id_country'] == $country['country_id'] ? 'selected' : '').'>'.$country['country_name'].'</option>';
                                    endforeach;
                                    echo'
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="form-label">Status  <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search form-select" required name="state_status" data-placeholder="Select">
                                    <option label="Select"></option>';
                                    $statuses = get_status();
                                    foreach ($statuses as $key => $status):
                                        echo'<option value="'.$key.'" '.($_GET['state_status'] == $key ? 'selected' : '').'>'.$status.'</option>';
                                    endforeach;
                                    echo'
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit_edit" >Edit States</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
    ';
?>