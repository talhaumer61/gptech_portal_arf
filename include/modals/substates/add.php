<?php 
    require_once("../../dbsetting/lms_vars_config.php");
	require_once("../../dbsetting/classdbconection.php");
	require_once("../../functions/functions.php");
	$dblms = new dblms();
    $conOrdering = array ( 
                            'select'        =>  'substate_id',
                            'order_by' 		=>  'substate_id DESC',
                            'return_type'   =>  'single'
                        ); 
    $subState  = $dblms->getRows(SUB_STATES, $conOrdering);
    if($subState){
        $ordering = $subState['substate_id'] + 1;
    }else{
        $ordering = 1;
    }
    $countryCondition = array ( 
                                'select' 	=> "country_id, country_name",
                                'where' 	=> array( 
                                                        'is_deleted'        => 0 
                                                        ,'country_status'  =>  1
                                                    ), 
                                'return_type' 	=> 'all' 
                              ); 
    $Countries    =   $dblms->getRows(COUNTRIES, $countryCondition);
    echo '
        <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
            <div class="modal-content modal-content-demo expanel expanel-primary">
                <div class="modal-header expanel-heading">
                    <h6 class="modal-title">Add Sub State</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="substates.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="modal-body expanel-body text-start">
                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label">Sub State Name <span class="text-danger">*</span></label>
                                <input type="text" name="substate_name" class="form-control" required />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label" for="card-name">Ordering <span class="text-danger">*</span></label>
                                <input class="form-control" name="substate_ordering" value="'.$ordering.'" readonly type="number" required>
                            </div>
                            <div class="col form-group">
                                <label class="form-label">Country <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search form-select" name="id_country" id="id_country" onchange="getState(this.value)" data-placeholder="Select" required>
                                    <option label="Select"></option>';
                                    foreach($Countries as $country):
                                        echo'<option value="'.$country['country_id'].'">'.$country['country_name'].'</option>';
                                    endforeach;
                                    echo'
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col form-group">
                                    <label class="form-label">State <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select"  name="id_state" id="id_state" data-placeholder="Select" required>
                                        <option label="Select First Country"></option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">Latitude <span class="text-danger">*</span></label>
                                    <input type="text" name="substate_latitude" class="form-control" required />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label">Longitude <span class="text-danger">*</span></label>
                                <input type="text" name="substate_longitude" class="form-control" required />
                            </div>
                            <div class="col form-group">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search form-select" name="substate_status" data-placeholder="Select" required>
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
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit_add" >Add Sub State</button> 
                        <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                    </div>
                </form>
            </div>
        </div>
    ';
?>