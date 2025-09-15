<?php
    // EVENTS
    $conEvents = array ( 
                        'select'        =>  'event_id, event_status, id_org, event_ordering, event_short_title, event_brief_title, event_thumbnail, event_image, event_description, event_start_date, event_end_date, event_start_time, event_end_time, event_address, event_youtube_link ',
                        'where'         =>  array(
                                                    'event_id'  =>  $_GET['id']
                                                ), 
                        'return_type'   =>  'single'
                      ); 
    $evEnts = $dblms->getRows(EVENTS, $conEvents);

    // ORGANIATIONS
    $conOrg = array ( 
                            'select'        =>  ' org_id, org_name',
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
                    <h4 class="mb-0">Edit Event</h4>
                </div>
                <form action="events.php" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">  
                    <div class="card-body create-project-main">
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Descriptive Title <span class="text-danger">*</span></label>
                                    <input type="text" name="event_brief_title" value="'.$evEnts['event_brief_title'].'" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Short Title <span class="text-danger">*</span></label>
                                    <input type="text" name="event_short_title" value="'.$evEnts['event_short_title'].'" class="form-control" required>
                                    <input type="hidden" name="event_id" value="'.$evEnts['event_id'].'" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Youtube Link <span class="text-danger">*</span></label>
                                    <input type="text" name="event_youtube_link" value="'.$evEnts['event_youtube_link'].'" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Ordering <span class="text-danger">*</span></label>
                                    <input type="text" name="event_ordering" value="'.$evEnts['event_ordering'].'" readonly class="form-control" required>
                                </div>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Start Date <span class="text-danger">*</span></label>
                                    <input type="date" name="event_start_date" value="'.$evEnts['event_start_date'].'" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">End Date <span class="text-danger">*</span></label>
                                    <input type="date" name="event_end_date" value="'.$evEnts['event_end_date'].'" class="form-control" required>
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
                                    <label class="form-label">Thumbnail</label>
                                    <input type="file" name="event_thumbnail" accept=".jpg, .jpeg, .png" class="dropify" data-bs-height="100"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="summernote" name="event_description" required>'.html_entity_decode($evEnts['event_description']).'</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit_edit">Edit Event</button> 
                        <a href="events.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>';
?>