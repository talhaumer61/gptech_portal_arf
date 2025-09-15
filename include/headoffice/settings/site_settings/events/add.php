<?php
    // ORDERING
    $conOrdering = array ( 
                            'select'        =>  'event_id',
                            'order_by' 		=>  'event_id DESC',
                            'return_type'   =>  'single'
                        ); 
    $dv  = $dblms->getRows(EVENTS, $conOrdering);
    if($dv){
        $ordering = $dv['event_id'] + 1;
    }else{
        $ordering = 1;
    }
    // ORGANIATIONS
    $conOrg = array ( 
        'select'        =>  '
                                org_id, 
                                org_name
                            ',
        'where'         =>  array(
                                    'org_status'        =>  1
                                    ,'is_deleted'       =>  0
                                ), 
        'order_by' 		=>  'org_id',
        'return_type'   =>  'all'
    ); 
    $organizAtions = $dblms->getRows(ORGANIZATIONS, $conOrg);
    echo '
    
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="mb-0">Add Event</h4>
                </div>
                <form action="events.php" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">  
                    <div class="card-body create-project-main">
                        <div class="row">                            
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Descriptive Title <span class="text-danger">*</span></label>
                                    <input type="text" name="event_brief_title" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Short Title <span class="text-danger">*</span></label>
                                    <input type="text" name="event_short_title" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Youtube Link <span class="text-danger">*</span></label>
                                    <input type="text" name="event_youtt_link" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Ordering <span class="text-danger">*</span></label>
                                    <input type="text" name="event_ordering" value="'.$ordering.'" readonly class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Start Date <span class="text-danger">*</span></label>
                                    <input type="date" name="event_start_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">End Date <span class="text-danger">*</span></label>
                                    <input type="date" name="event_end_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-control select2-show-search form-select" name="event_status" data-placeholder="Select" required>
                                        <option label="Select"></option>';
                                        $statuses = get_status();
                                        foreach ($statuses as $key => $status):
                                            echo'<option value="'.$key.'" '.($evEnts['event_status'] == $key ? 'selected' : '').'>'.$status.'</option>';
                                        endforeach;
                                        echo'
                                    </select>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Thumbnail <span class="text-danger">*</span><span class="ms-1 text-info">(500 * 300)</span></label>
                                    <input type="file" name="event_thumbnail" accept=".jpg, .jpeg, .png" class="dropify" data-bs-height="100" required/>
                                </div>
                            </div>
                        </div>            
                        <div class="row">
                            <div class="col">
                                <div class="mb-2">
                                    <label class="form-label">Photos <span class="text-danger">*</span><span class="ms-1 text-info">(1000 * 500)</span>  <button class="btn btn-primary btn-sm" id="duplicateButton" type="button"><i class="fa fa-plus align-bottom"></i></button></label>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="event_photo">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="event_photo[]" accept=".jpg, .jpeg, .png">
                                    <button class="btn btn-danger delete-button" disabled><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div id="targetDiv"></div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="summernote" name="event_description" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit_add">Add Event</button> 
                        <a href="events.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>';
?>