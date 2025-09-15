<?php 
    require_once("../../dbsetting/lms_vars_config.php");
    require_once("../../dbsetting/classdbconection.php");
    require_once("../../functions/functions.php");
    $dblms = new dblms();

    
    $fileInfo = pathinfo($_GET['event_photo']);
    $fileName = $fileInfo['filename'];
    echo '    
    <!-- FILE UPLOAD JS -->
    <script src="assets/plugins/fileuploads/js/fileupload.js"></script>
    <script src="assets/plugins/fileuploads/js/file-upload.js"></script>

    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Edit Photo</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <input type="hidden" name="id" value="'.$_GET['edit_id'].'"required/>
                <input type="hidden" name="id_event" value="'.$_GET['id_event'].'"required/>
                <input type="hidden" name="title" value="'.$_GET['title'].'"required/>
                <input type="hidden" name="filename" value="'.$fileName.'"required/>
                <div class="modal-body expanel-body">
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search form-select" required name="photo_status" data-placeholder="Select">
                                <option label="Select"></option>';
                                foreach(get_status() as $key => $value):
                                    echo '<option value="'.$key.'" '.($key == $_GET['photo_status'] ? 'selected' : '').'>'.$value.'</option>';
                                endforeach;
                                echo'
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Photo <span class="text-info">(1000 * 500)</span></label>
                            <input type="file" name="event_photo" accept=".jpg, .jpeg, .png" class="dropify" data-bs-height="100"/>
                        </div>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit_edit_photo" >Edit Photo</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>';
?>