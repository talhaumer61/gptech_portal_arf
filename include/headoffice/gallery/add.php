<?php
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
$places = $dblms->getRows(DISTRIBUTION_PLACES, $conPlaces);

echo'
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="mb-0">Add Gallery</h4>
            </div>
            <form autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="card-body expanel-body text-start">
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
                            <label class="form-label">Status <span class="text-danger">*</span></label>
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
                            <label class="form-label">Thumbnail <span class="text-danger">*</span><span class="ms-1 text-info">(500 * 350)</span></label>
                            <input type="file" name="gal_image_video" accept=".jpg, .jpeg, .png" class="dropify" data-bs-height="100" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-2">
                                <label class="form-label">Photos <span class="text-danger">*</span><span class="ms-1 text-info">(500 * 350)</span>  <button class="btn btn-primary btn-sm" id="duplicateButton" type="button"><i class="fa fa-plus align-bottom"></i></button></label>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="gal_photo">
                        <div class="col">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="gal_photo[]" accept=".jpg, .jpeg, .png">
                                <button class="btn btn-danger delete-button" disabled><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    <div id="targetDiv"></div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Description </label>
                            <textarea name="gal_description" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit_add">Add Gallery</button> 
                    <a href="gallery.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>';
?>