<?php
    // ABOUT
    $condition  = array ( 
                            'select'        =>  'about_id, about_image, about_title, about_description, our_mission, our_vision, our_values',
                            'where'         =>  array(
                                                        'about_id'  =>  $_GET['id']
                                                    ), 
                            'return_type'   =>  'single'
                        ); 
    $row        = $dblms->getRows(ABOUT, $condition);

    echo '
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="mb-0">Edit About</h4>
                </div>
                <form action="about.php" enctype="multipart/form-data" autocomplete="off" method="post" accept-charset="utf-8">  
                    <div class="card-body create-project-main">
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="about_title" value="'.$row['about_title'].'" class="form-control" required>
                                    <input type="hidden" name="about_id" value="'.$row['about_id'].'" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Image </label>
                                    <input type="file" name="about_image" accept="image/*" class="dropify" data-bs-height="100"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Description </label>
                                    <textarea name="about_description" class="form-control" id="summernote" required>'.$row['about_description'].'</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Our Mission </label>
                                    <textarea name="our_mission" class="form-control" rows="5" required>'.$row['our_mission'].'</textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Our Vision </label>
                                    <textarea name="our_vision" class="form-control" rows="5" required>'.$row['our_vision'].'</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Our Values </label>
                                    <textarea name="our_values" class="form-control" rows="5" required>'.$row['our_values'].'</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit_edit">Edit About</button> 
                        <a href="packages_causes.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>';
?>