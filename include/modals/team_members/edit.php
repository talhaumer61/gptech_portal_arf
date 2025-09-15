<?php 
    require_once("../../dbsetting/lms_vars_config.php");
    require_once("../../dbsetting/classdbconection.php");
    require_once("../../functions/functions.php");
    $dblms = new dblms();
    $conCat = array ( 
                        'select'        =>  'des_id, des_name',
                        'where'         =>  array( 
                                                    'is_deleted' => 0
                                                    ,'des_status' => 1
                                                ), 
                        'order_by' 		=>  'des_ordering ASC',
                        'return_type'   =>  'all'
                    ); 
    $designations = $dblms->getRows(DESIGNATIONS, $conCat);
    echo '
    <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
        <div class="modal-content modal-content-demo expanel expanel-primary">
            <div class="modal-header expanel-heading">
                <h6 class="modal-title">Edit Team Member</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="team_members.php" autocomplete="off" class="form-validate"  enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body expanel-body text-start">
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Full Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="full_name" value="'.$_GET['full_name'].'" required>
                            <input class="form-control" type="hidden" name="id" value="'.$_GET['id'].'" required>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label" for="card-name">Ordering <span class="text-danger">*</span></label>
                            <input class="form-control" name="ordering" value="'.$_GET['ordering'].'" readonly type="number" required>
                        </div>
                        <div class="col form-group">
                            <label class="form-label">Designation <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search form-select" required name="id_des" data-placeholder="Select">
                                <option label="Select"></option>';
                                foreach($designations as $des):
                                    echo '
                                    <option value="'.$des['des_id'].'"  '.($_GET['id_des'] == $des['des_id'] ? 'selected' : '').'>'.$des['des_name'].'</option>';
                                endforeach;
                                echo '
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label class="form-label">Profile Image <span class="text-info">(300 * 300)</span></label>
                            <input type="file" name="profile_image" accept="image/*" class="form-control" />
                        </div>
                        <div class="col form-group">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-control select2-show-search form-select" required name="status" data-placeholder="Select">
                                <option label="Select"></option>';
                                $statuses = get_status();
                                foreach($statuses as $key => $status):
                                    echo '
                                    <option value="'.$key.'" '.($_GET['status'] == $key ? 'selected' : '').'>'.$status.'</option>';
                                endforeach;
                                echo '
                            </select>
                        </div>
                    </div>
                </div>
                <div class="expanel-footer modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit_edit" >Edit Team Member</button> 
                    <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                </div>
            </form>
        </div>
    </div>
    ';
?>