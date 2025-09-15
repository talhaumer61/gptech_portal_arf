<?php 
    require_once("../../dbsetting/lms_vars_config.php");
    require_once("../../dbsetting/classdbconection.php");
    require_once("../../functions/functions.php");
    $dblms = new dblms();
    // SLIDER
    $condition = array ( 
                            'select'        =>  'events_id, events_status, events_title, events_href, events_date, events_image, events_brief_detail, events_detail',
                            'where'         =>  array(
                                                        'events_id'  =>  $_GET['events_id']
                                                    ), 
                            'return_type'   =>  'single'
                       ); 
    $events = $dblms->getRows(EVENTS, $condition);

    echo '
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Edit Event</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="events.php" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Title <span class="text-danger">*</span></label>
                            <input class="form-control" type="hidden" value="'.$events['events_id'].'"  name="events_id" required>
                            <input class="form-control" type="text" value="'.$events['events_title'].'"  name="events_title" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Event Link <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" value="'.$events['events_href'].'" name="events_href" required>
                        </div>
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Event Date <span class="text-danger">*</span></label>
                            <input class="form-control" type="date" value="'.$events['events_date'].'" name="events_date" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Description </label>
                            <textarea name="events_brief_detail" rows="3" class="form-control">'.$events['events_brief_detail'].'</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Image </label>
                            <input type="file" name="events_img" accept="image/*" class="form-control"/>
                        </div>
                        <div class="col form-group">
                            <label class="form-label">Staus <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search form-select" required name="events_status" data-placeholder="Select">
                                <option label="Select"></option>';
                                $statuses = get_status();
                                foreach($statuses as $key => $status):
                                    echo '
                                    <option value="'.$key.'" '.($key == $events['events_status'] ? 'selected' : '').'>'.$status.'</option>';
                                endforeach;
                                echo '
                            </select>
                        </div>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit_edit" >Edit Event</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
    ';
?>