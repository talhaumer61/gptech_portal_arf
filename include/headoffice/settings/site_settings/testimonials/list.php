<?php
$condition = array ( 
                    'select' 	=> "testimonials_id, testimonials_status, testimonials_image, testimonials_name, testimonials_title, testimonials_description",
                    'where' 	=> array( 
                                        'is_deleted' => 0 ,
                                    ), 
                    'order_by' 		=> 'testimonials_id ASC',
                    'return_type' 	=> 'all' 
                   ); 
$testimonials 	= $dblms->getRows(TESTIMONIALS, $condition);
    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Testimonials List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="btn btn-primary" onclick="showAjaxModalZoom(\'include/modals/testimonials/add.php\');"><i class="ri-add-box-fill align-bottom me-1"></i>Testimonials</a>
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
                                    <th class="bg-transparent border-bottom-0">Name</th>
                                    <th class="bg-transparent border-bottom-0 wp-8">Designation</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($testimonials):
                                    $sr = 0;
                                    foreach($testimonials as $row):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">
                                                <div class="d-flex align-items-center">
                                                    <span class="data-image avatar avatar-md rounded-circle" style="background-image: url(uploads/images/testimonials/'.$row['testimonials_image'].')"></span>
                                                    <div class="user-details ms-2">
                                                        <h6 class="mb-0">'.$row['testimonials_name'].'</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted fs-14">'.$row['testimonials_title'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($row['testimonials_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/testimonials/edit.php?testimonials_id='.$row['testimonials_id'].'\');"><i class="fe fe-edit"></i></a>
                                                </a>
                                                <a class="btn btn-xs  btn-danger" onclick="confirm_modal(\'testimonials.php?deleteid='.$row['testimonials_id'].'\');"><i class="fe fe-trash"></i></a>
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