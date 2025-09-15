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
    // ORDERING
    $conOrdering = array ( 
                            'select'        =>  'place_id ',
                            'order_by' 		=>  'place_id  DESC',
                            'return_type'   =>  'single'
                        ); 
    $place  = $dblms->getRows(DISTRIBUTION_PLACES, $conOrdering);
    if($place){
        $ordering = $place['place_id '] + 1;
    }else{
        $ordering = 1;
    }

    echo '
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Add Distribution Place</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="distribution_places.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" name="place_phone" id="cleave-phone" class="form-control" required />
                            </div>
                            <div class="col">
                                <label class="form-label">Ordering <span class="text-danger">*</span></label>
                                <input class="form-control" name="place_ordering" value="'.$ordering.'" readonly type="number" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label">Latitude <span class="text-danger">*</span></label>
                                <input type="text" name="place_latitude" class="form-control" required />
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Longitude <span class="text-danger">*</span></label>
                                <input type="text" name="place_longitude" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label">Code (Digit) <span class="text-danger">*</span></label>
                                <input type="text" name="city_codedigit" class="form-control" required />
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label">Code (Alpha) <span class="text-danger">*</span></label>
                                <input type="text" name="city_codealpha" class="form-control" required />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Country <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search form-select" id="id_country" name="id_country" data-placeholder="Select" onchange="getState(this.value)" required>
                                    <option label="Select"></option>';
                                    foreach ($Countries as $country):
                                        echo'<option value="'.$country['country_id'].'">'.$country['country_name'].'</option>';
                                    endforeach;
                                    echo'
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">State <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search form-select" id="id_state" name="id_state" data-placeholder="Select" onchange="getSubState(this.value)" required>
                                    <option>Select Country First</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">Sub State <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search form-select" id="id_substate" name="id_substate" onchange="getCity(this.value)" data-placeholder="Select" required>
                                    <option>Select State First</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="form-label">City <span class="text-danger">*</span></label>
                                <select class="form-control select2-show-search form-select" id="id_city" name="id_city" data-placeholder="Select" required>
                                    <option>Select Sub State First</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Image <span class="text-danger">*</span></label>
                            <input type="file" name="org_image" accept="image/*" class="form-control" required/>
                        </div>
                        <div class="col form-group">
                            <label class="form-label">Staus <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search form-select" required name="place_status" data-placeholder="Select">
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
                    <button type="submit" class="btn btn-primary" name="submit_add">Add City</button> 
                    <button class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
';
?>