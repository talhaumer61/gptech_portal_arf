<?php
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
                            'select'        =>  'place_id',
                            'order_by' 		=>  'place_id  DESC',
                            'return_type'   =>  'single'
                        ); 
    $place  = $dblms->getRows(DISTRIBUTION_PLACES, $conOrdering);
    if($place){
        $ordering = $place['place_id'] + 1;
    }else{
        $ordering = 1;
    }
    echo '
    
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="mb-0">Add Distribution Place</h4>
                </div>
                <form action="distribution_places.php" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">  
                    <div class="card-body create-project-main">
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Latitude <span class="text-danger">*</span></label>
                                    <input type="text" name="place_latitude" class="form-control" required />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Longitude <span class="text-danger">*</span></label>
                                    <input type="text" name="place_longitude" class="form-control" required />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Ordering <span class="text-danger">*</span></label>
                                    <input type="text" name="place_ordering" value="'.$ordering.'" readonly class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea name="place_address" rows="4" class="form-control" required></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col form-group">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea name="place_description"  id="summernote" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Profile Image <span class="text-danger">*</span></label>
                                    <input type="file" name="place_image" accept="image/*" class="dropify" data-bs-height="100" required/>
                                </div>
                            </div>
                        </div>

                        

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="place_phone" id="cleave-phone" placeholder="xxxx-xxxxxxx" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Geo Location <span class="text-danger">*</span></label>
                                    <input type="text" name="place_geo_location" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Youtube Code <span class="text-danger">*</span></label>
                                    <input type="text" name="place_youtube_code" class="form-control" required>
                                </div>
                            </div> 
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">People Fed <span class="text-danger">*</span></label>
                                    <input type="number" name="place_people_fed" class="form-control" required />
                                </div>
                            </div>
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
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" name="place_status" data-placeholder="Select" required>
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
                        <button type="submit" class="btn btn-primary" name="submit_add">Add Distribution Place</button> 
                        <a href="distribution_places.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>';
?>