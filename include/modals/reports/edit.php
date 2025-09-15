<?php 
require_once("../../dbsetting/lms_vars_config.php");
require_once("../../dbsetting/classdbconection.php");
require_once("../../functions/functions.php");
$dblms = new dblms();

$condition = array ( 
                        'select'        =>  'id, status, type, title, file',
                        'where'         =>  array(
                                                    'id'  =>  $_GET['id']
                                                ), 
                        'return_type'   =>  'single'
                    ); 
$row = $dblms->getRows(REPORTS_DOWNLOADS, $condition);
echo '
<!-- FILE UPLOAD JS -->
<script src="assets/plugins/fileuploads/js/fileupload.js"></script>
<script src="assets/plugins/fileuploads/js/file-upload.js"></script>

<div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
    <div class="modal-content modal-content-demo expanel expanel-primary">
        <div class="modal-header expanel-heading">
            <h6 class="modal-title">Edit Report</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
        </div>
        <form autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <input type="hidden" name="id" class="form-control" value="'.$row['id'].'" required/>
            <div class="modal-body expanel-body text-start">
                <div class="row">
                    <div class="col form-group">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-control select2-show-search form-select" required name="status" data-placeholder="Select">
                            <option label="Select"></option>';
                            foreach(get_status() as $key => $status):
                                echo '<option value="'.$key.'" '.($key == $row['status'] ? 'selected' : '').'>'.$status.'</option>';
                            endforeach;
                            echo '
                        </select>
                    </div>
                    <div class="col form-group">
                        <label class="form-label">Type <span class="text-danger">*</span></label>
                        <select class="form-control select2-show-search form-select" required name="type" data-placeholder="Select">
                            <option label="Select"></option>';
                            foreach(get_report_type() as $key => $value):
                                echo'<option value="'.$key.'" '.($key == $row['type'] ? 'selected' : '').'>'.$value.'</option>';
                            endforeach;
                            echo '
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="'.$row['title'].'" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col form-group">
                        <label class="form-label">File <span class="ms-1 text-info">(accept pdf only)</span></label>
                        <input type="file" name="file" accept=".pdf" class="dropify" data-bs-height="100"/>
                    </div>
                </div>
            </div>
            <div class="expanel-footer modal-footer">
                <button type="submit" class="btn btn-primary" name="submit_edit" >Edit Report</button> 
                <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
            </div>
        </form>
    </div>
</div>';
?>