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

    $stateCondition = array ( 
                                'select' 	=> "state_id, state_name",
                                'where' 	=> array( 
                                                        'is_deleted'    =>  0 
                                                        ,'state_status'  =>  1
                                                        ,'id_country'    =>  $_GET['id_country']
                                                    ), 
                                'return_type' 	=> 'all' 
                            ); 
    $States    =   $dblms->getRows(STATES, $stateCondition);

    $substateCondition = array ( 
                                    'select' 	=> "substate_id, substate_name",
                                    'where' 	=> array( 
                                                            'is_deleted'        =>  0 
                                                            ,'substate_status'  =>  1
                                                            ,'id_state'         =>  $_GET['id_state']
                                                        ), 
                                    'return_type' 	=> 'all' 
                                ); 
    $subStates    =   $dblms->getRows(SUB_STATES, $substateCondition);

    echo '
        <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
            <div class="modal-content modal-content-demo expanel expanel-primary">
                <div class="modal-header expanel-heading">
                    <h6 class="modal-title">Edit City</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="cities.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="modal-body expanel-body text-start">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">City Name <span class="text-danger">*</span></label>
                                    <input type="hidden" name="city_id" id="city_id" value="'.$_GET['city_id'].'" class="form-control" required />
                                    <input type="text" name="city_name" id="city_name" value="'.$_GET['city_name'].'" class="form-control" required />
                                </div>
                                <div class="col">
                                    <label class="form-label">Ordering <span class="text-danger">*</span></label>
                                    <input class="form-control" name="city_ordering" value="'.$_GET['city_ordering'].'" readonly type="number" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label">Latitude <span class="text-danger">*</span></label>
                                    <input type="text" name="city_latitude" value="'.$_GET['city_latitude'].'" class="form-control" required />
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">Longitude <span class="text-danger">*</span></label>
                                    <input type="text" name="city_longitude" value="'.$_GET['city_longitude'].'" class="form-control" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label class="form-label">Code (Digit) <span class="text-danger">*</span></label>
                                    <input type="text" name="city_codedigit" value="'.$_GET['city_codedigit'].'" class="form-control" required />
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label">Code (Alpha) <span class="text-danger">*</span></label>
                                    <input type="text" name="city_codealpha" value="'.$_GET['city_codealpha'].'" class="form-control" required />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label class="form-label">Country <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search form-select" id="id_country" name="id_country" data-placeholder="Select" onchange="getState(this.value)" required>
                                    <option label="Select"></option>';
                                    foreach ($Countries as $country):
                                        echo'<option value="'.$country['country_id'].'" '.($_GET['id_country'] == $country['country_id'] ? 'selected' : '').'>'.$country['country_name'].'</option>';
                                    endforeach;
                                    echo'
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="form-label">State <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search form-select" id="id_state" name="id_state" data-placeholder="Select" onchange="getSubState(this.value)" required>
                                    <option label="Select"></option>';
                                    foreach ($States as $state):
                                        echo'<option value="'.$state['state_id'].'" '.($_GET['id_state'] == $state['state_id'] ? 'selected' : '').'>'.$state['state_name'].'</option>';
                                    endforeach;
                                    echo '
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label class="form-label">Sub State <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search form-select" id="id_substate" name="id_substate" data-placeholder="Select" required>
                                    <option label="Select"></option>';
                                    foreach ($subStates as $substate):
                                        echo'<option value="'.$substate['substate_id'].'" '.($_GET['id_substate'] == $substate['substate_id'] ? 'selected' : '').'>'.$substate['substate_name'].'</option>';
                                    endforeach;
                                echo '
                                </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search form-select" name="city_status" data-placeholder="Select" required>
                                    <option label="Select"></option>';
                                    $statuses = get_status();
                                    foreach ($statuses as $key => $status):
                                        echo'<option value="'.$key.'" '.($_GET['city_status'] == $key ? 'selected' : '').'>'.$status.'</option>';
                                    endforeach;
                                    echo'
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit_edit" >Edit City</button> 
                        <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                    </div>
                </form>
            </div>
        </div>
    ';
?>