<?php 
    require_once("../../dbsetting/lms_vars_config.php");
    require_once("../../dbsetting/classdbconection.php");
    require_once("../../functions/functions.php");
    $dblms = new dblms();
    // SLIDER
    $condition = array ( 
                            'select'        =>  'about_id, about_status, about_image, about_title, about_description, about_btn_text, about_btn_href',
                            'where'         =>  array(
                                                        'about_id'  =>  $_GET['about_id']
                                                    ), 
                            'return_type'   =>  'single'
                       ); 
    $slider = $dblms->getRows(ABOUT, $condition);

    echo '
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Edit About</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="about.php" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Title <span class="text-danger">*</span></label>
                            <input class="form-control" type="hidden" value="'.$slider['about_id'].'"  name="about_id" required>
                            <input class="form-control" type="text" value="'.$slider['about_title'].'"  name="about_title" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Button Text <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" value="'.$slider['about_btn_text'].'" name="about_btn_text" required>
                        </div>
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Youtube Video Link <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" value="'.$slider['about_btn_href'].'" name="about_btn_href" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Description </label>
                            <textarea name="about_description" rows="3" class="form-control">'.$slider['about_description'].'</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Image </label>
                            <input type="file" name="about_img" accept="image/*" class="form-control"/>
                        </div>
                        <div class="col form-group">
                            <label class="form-label">Staus <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search form-select" required name="about_status" data-placeholder="Select">
                                <option label="Select"></option>';
                                $statuses = get_status();
                                foreach($statuses as $key => $status):
                                    echo '
                                    <option value="'.$key.'" '.($key == $slider['about_status'] ? 'selected' : '').'>'.$status.'</option>';
                                endforeach;
                                echo '
                            </select>
                        </div>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit_edit" >Edit About</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
    ';
?>