<?php 
    require_once("../../dbsetting/lms_vars_config.php");
    require_once("../../dbsetting/classdbconection.php");
    require_once("../../functions/functions.php");
    $dblms = new dblms();
    $conOrdering = array ( 
                            'select'        =>  'gal_id ',
                            'order_by' 		=>  'gal_id  DESC',
                            'return_type'   =>  'single'
                       ); 
    $organization  = $dblms->getRows(GALLERY, $conOrdering);
    if($organization){
        $ordering = $organization['gal_id'] + 1;
    }else{
        $ordering = 1;
    }
    // CATEGORIES
    $conCat = array ( 
                        'select'        =>  'cat_id, cat_name',
                        'where'         =>  array( 
                                                    'is_deleted' => 0
                                                    ,'cat_status' => 1
                                                ), 
                        'order_by' 		=>  'cat_ordering ASC',
                        'return_type'   =>  'all'
                    ); 
    $categories = $dblms->getRows(CATEGORIES, $conCat);
    // DISTRIBUTION PLACES
    $conPlaces  = array ( 
                            'select'        =>  'place_id, place_address',
                            'where'         =>  array( 
                                                         'is_deleted'    =>  0
                                                        ,'place_status' =>  1
                                                    ), 
                            'order_by' 		=>  'place_ordering ASC',
                            'return_type'   =>  'all'
                        ); 
    $places     = $dblms->getRows(DISTRIBUTION_PLACES, $conPlaces);
    echo '
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Add Gallery</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="gallery.php" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Title <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="gal_title" required>
                        </div>
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Ordering <span class="text-danger">*</span></label>
                            <input class="form-control" name="gal_ordering" value="'.$ordering.'" readonly type="number" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Date <span class="text-danger">*</span></label>
                            <input class="form-control" name="gal_dated" type="date" required>
                        </div>
                        <div class="col form-group">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search form-select" required name="id_cat" data-placeholder="Select">
                                <option label="Select"></option>';
                                foreach($categories as $cat):
                                    echo '
                                    <option value="'.$cat['cat_id'].'">'.$cat['cat_name'].'</option>';
                                endforeach;
                                echo '
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Distribution Place <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search form-select" required name="id_place"  data-placeholder="Select">
                                <option label="Select"></option>';
                                foreach($places as $place):
                                    echo '
                                    <option value="'.$place['place_id'].'" >'.$place['place_address'].'</option>';
                                endforeach;
                                echo '
                            </select>
                        </div>
                        <div class="col form-group">
                            <label class="form-label">File Type <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search form-select" required name="id_file_type" onchange="changeFileType(this.value)" data-placeholder="Select">
                                <option label="Select"></option>';
                                $fileTypes = get_FileTypes();
                                foreach($fileTypes as $key => $type):
                                    echo '
                                    <option value="'.$key.'" '.($key == '1' ? 'selected' : '').'>'.$type.'</option>';
                                endforeach;
                                echo '
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group" id="image">
                            <label class="form-label">Image <span class="text-danger">*</span></label>
                            <input type="file" name="gal_image_video" id="image_field" accept="image/*" class="form-control" required/>
                        </div>
                        <div class="col form-group" id="video" style="display:none;">
                            <label class="form-label">Youtube Code <span class="text-danger">*</span></label>
                            <input type="text" name="gal_image_video" id="video_field" class="form-control" />
                        </div>
                        <div class="col form-group">
                            <label class="form-label">Staus <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search form-select" required name="gal_status" data-placeholder="Select">
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
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Description </label>
                            <textarea name="gal_description" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit_add" >Add Gallery</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
    ';
?>