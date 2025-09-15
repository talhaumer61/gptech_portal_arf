<?php
    $condition = array ( 
                        'select' 	=> "*",
                        'where' 	=> array( 
                                                'is_deleted'         => 0 ,
                                                'id_event'         => cleanvars($_GET['id']) ,
                                            ), 
                        'return_type' 	=> 'all' 
                    ); 
    $EVENT_PHOTOS = $dblms->getRows(EVENT_PHOTOS, $condition);
    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" ><span class="text-primary">'.$_GET['title'].'</span> / Photos List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="btn btn-primary" onclick="showAjaxModalZoom(\'include/modals/events/add_photo.php?id_event='.$_GET['id'].'&title='.$_GET['title'].'\');"><i class="ri-add-box-fill align-bottom me-1"></i>Photo</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="data-table" class="table text-nowrap mb-0 table-bordered">
                            <thead class="table-head">
                                <tr>
                                    <th class="bg-transparent border-bottom-0 text-center wp-5">Sr#</th>
                                    <th class="bg-transparent border-bottom-0">Photo</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($EVENT_PHOTOS):
                                    $sr = 0;
                                    foreach($EVENT_PHOTOS as $row):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">
                                                <div class="d-flex align-items-center">
                                                    <span class="data-image avatar avatar-md rounded-circle" style="background-image: url(uploads/images/events/'.$row['event_photo'].')"></span>
                                                    <div class="user-details ms-2">
                                                        <h6 class="mb-0">'.$row['event_photo'].'</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted fs-14 text-center">'.get_status($row['photo_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/events/edit_photo.php?edit_id='.$row['id'].'&event_photo='.$row['event_photo'].'&photo_status='.$row['photo_status'].'&id_event='.$_GET['id'].'&title='.$_GET['title'].'\');"><i class="fe fe-edit"></i></a>
                                                <a class="btn btn-xs  btn-danger" onclick="confirm_modal(\'?deleteid_photo='.$row['id'].'&id_event='.$_GET['id'].'&title='.$_GET['title'].'\');"><i class="fe fe-trash"></i></a>
                                            </td>
                                        </tr>';
                                    endforeach;
                                endif;
                                echo '
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> ';
?>