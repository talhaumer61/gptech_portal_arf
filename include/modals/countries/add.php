<?php 
    require_once("../../dbsetting/lms_vars_config.php");
	require_once("../../dbsetting/classdbconection.php");
	require_once("../../functions/functions.php");
	$dblms = new dblms();
    $currencyCondition = array ( 
                                    'select' 	=> "currency_id, currency_name",
                                    'where' 	=> array( 
                                                            'is_deleted'        => 0 
                                                            ,'currency_status'  =>  1
                                                        ), 
                                    'return_type' 	=> 'all' 
                                ); 
    $Curriencies    =   $dblms->getRows(CURRENCIES, $currencyCondition);
    $regionCondition = array ( 
                                'select' 	=> "region_id, region_name",
                                'where' 	=> array( 
                                                        'is_deleted'        => 0 
                                                        ,'region_status'  =>  1
                                                    ), 
                                'return_type' 	=> 'all' 
                            ); 
    $Regions    =   $dblms->getRows(REGIONS, $regionCondition);
    // ORDERING
    $conOrdering = array ( 
                            'select'        =>  'country_id',
                            'order_by' 		=>  'country_id DESC',
                            'return_type'   =>  'single'
                        ); 
    $con  = $dblms->getRows(COUNTRIES, $conOrdering);
    if($con){
        $ordering = $con['country_id'] + 1;
    }else{
        $ordering = 1;
    }
    echo '
        <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
            <div class="modal-content modal-content-demo expanel expanel-primary">
                <div class="modal-header expanel-heading">
                    <h6 class="modal-title">Add Country</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="countries.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="modal-body expanel-body text-start">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Country Name <span class="text-danger">*</span></label>
                                    <input type="text" name="country_name" class="form-control" required />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Ordering <span class="text-danger">*</span></label>
                                    <input class="form-control" name="country_ordering" value="'.$ordering.'" readonly type="number" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">Calling Code <span class="text-danger">*</span></label>
                                    <input type="text" name="country_callingcode" class="form-control" required />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label">ISO (2 Digit) <span class="text-danger">*</span></label>
                                    <input type="text" name="country_iso2digit" class="form-control" required />
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">ISO (3 Digit) <span class="text-danger">*</span></label>
                                    <input type="text" name="country_iso3digit" class="form-control" required />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label">Latitude <span class="text-danger">*</span></label>
                                    <input type="text" name="country_latitude" class="form-control" required />
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">Longitude <span class="text-danger">*</span></label>
                                    <input type="text" name="country_longitude" class="form-control"  required />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-lg-6  form-group">
                                    <label class="form-label">Timezone  <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" required name="id_timezone" data-placeholder="Select">
                                        <option label="Select"></option>';
                                            $timezonetypes = get_timezonetypes();
                                            foreach ($timezonetypes as $key => $timezone):
                                                echo'<option value="'.$key.'">'.$timezone.'</option>';
                                            endforeach;
                                        echo'
                                    </select>
                                </div>
                                <div class="col-lg-6  form-group">
                                    <label class="form-label">Currency <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" required name="id_currency" data-placeholder="Select">
                                        <option label="Select"></option>';
                                        foreach($Curriencies as $currency):
                                            echo'<option value="'.$currency['currency_id'].'">'.$currency['currency_name'].'</option>';
                                        endforeach;
                                        echo'
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label class="form-label">Region <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" required name="id_region" data-placeholder="Select">
                                        <option label="Select"></option>';
                                        foreach($Regions as $region):
                                            echo'<option value="'.$region['region_id'].'">'.$region['region_name'].'</option>';
                                        endforeach;
                                        echo'
                                    </select>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label class="form-label">Status  <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" required name="country_status" data-placeholder="Select">
                                        <option label="Select"></option>';
                                        $statuses = get_status();
                                        foreach ($statuses as $key => $status):
                                            echo'<option value="'.$key.'">'.$status.'</option>';
                                        endforeach;
                                        echo'
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit_add" >Add Country</button> 
                        <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                    </div>
                </form>
            </div>
        </div>
    ';
?>