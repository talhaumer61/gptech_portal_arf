<?php 
    require_once("../../dbsetting/lms_vars_config.php");
    require_once("../../dbsetting/classdbconection.php");
    require_once("../../functions/functions.php");
    $dblms = new dblms();
    // SLIDER
    $condition = array ( 
                            'select'        =>  'slider_id, slider_status, slider_img, slider_title, slider_description, slider_btn_href, slider_btn_text',
                            'where'         =>  array(
                                                        'slider_id'  =>  $_GET['slider_id']
                                                    ), 
                            'return_type'   =>  'single'
                       ); 
    $slider = $dblms->getRows(SLIDER, $condition);

    echo '
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Edit Slider</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="slider.php" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Title <span class="text-danger">*</span></label>
                            <input class="form-control" type="hidden" value="'.$slider['slider_id'].'"  name="slider_id" required>
                            <input class="form-control" type="text" value="'.$slider['slider_title'].'"  name="slider_title" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Button Text <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" value="'.$slider['slider_btn_text'].'" name="slider_btn_text" required>
                        </div>
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Youtube Video Link <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" value="'.$slider['slider_btn_href'].'" name="slider_btn_href" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Description </label>
                            <textarea name="slider_description" rows="3" class="form-control">'.$slider['slider_description'].'</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Image <span class="ms-1 text-info">(1920 * 980)</span></label>
                            <input type="file" name="slider_img" accept="image/*" class="form-control"/>
                        </div>
                        <div class="col form-group">
                            <label class="form-label">Staus <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search form-select" required name="slider_status" data-placeholder="Select">
                                <option label="Select"></option>';
                                $statuses = get_status();
                                foreach($statuses as $key => $status):
                                    echo '
                                    <option value="'.$key.'" '.($key == $slider['slider_status'] ? 'selected' : '').'>'.$status.'</option>';
                                endforeach;
                                echo '
                            </select>
                        </div>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit_edit" >Edit Slider</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
    ';
?>