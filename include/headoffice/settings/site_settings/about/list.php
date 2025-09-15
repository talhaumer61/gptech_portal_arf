<?php
    $condition = array ( 
                        'select' 	=> "about_id, about_image, about_title, about_description, our_mission, our_vision, our_values",
                        'order_by' 		=> 'about_id ASC',
                        'return_type' 	=> 'all' 
                    ); 
    $about 	= $dblms->getRows(ABOUT, $condition);

    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >About List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <!--<a class="btn btn-primary" onclick="showAjaxModalZoom(\'include/modals/about/add.php\');"><i class="ri-add-box-fill align-bottom me-1"></i>About</a>-->
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
                                    <th class="bg-transparent border-bottom-0">Title</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($about):
                                    $sr = 0;
                                    foreach($about as $row):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">
                                                <div class="d-flex align-items-center">
                                                <span class="data-image avatar avatar-md rounded-circle" style="background-image: url(uploads/images/about/'.$row['about_image'].')"></span>
                                                    <div class="user-details ms-2">
                                                        <h6 class="mb-0">'.$row['about_title'].'</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-primary btn-xs" href="about.php?id='.$row['about_id'].'"><i class="fe fe-edit"></i></a>
                                                </a>
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