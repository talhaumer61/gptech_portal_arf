<?php
$condition = array ( 
                    'select' 	=> "slider_id, slider_status, slider_img, slider_title, slider_btn_href, slider_btn_text",
                    'where' 	=> array( 
                                        'is_deleted' => 0 ,
                                    ), 
                    'order_by' 		=> 'slider_id ASC',
                    'return_type' 	=> 'all' 
                   ); 
$sliders 	= $dblms->getRows(SLIDER, $condition);
    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Slider List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="btn btn-primary" onclick="showAjaxModalZoom(\'include/modals/slider/add.php\');"><i class="ri-add-box-fill align-bottom me-1"></i>Slider</a>
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
                                    <th class="bg-transparent border-bottom-0 wp-8">Button Text</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Youtube Video Link</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($sliders):
                                    $sr = 0;
                                    foreach($sliders as $row):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">
                                                <div class="d-flex align-items-center">
                                                    <span class="data-image avatar avatar-md rounded-circle" style="background-image: url(uploads/images/slider/'.$row['slider_img'].')"></span>
                                                    <div class="user-details ms-2">
                                                        <h6 class="mb-0">'.$row['slider_title'].'</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted fs-14">'.$row['slider_btn_text'].'</td>
                                            <td class="text-muted fs-14">'.$row['slider_btn_href'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($row['slider_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/slider/edit.php?slider_id='.$row['slider_id'].'\');"><i class="fe fe-edit"></i></a>
                                                </a>
                                                <a class="btn btn-xs  btn-danger" onclick="confirm_modal(\'slider.php?deleteid='.$row['slider_id'].'\');"><i class="fe fe-trash"></i></a>
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