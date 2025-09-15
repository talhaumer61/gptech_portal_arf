<?php
$condition = array ( 
                    'select' 	=> "cat_id, cat_name, cat_ordering, cat_icon, cat_image, cat_status, cat_meta_keywords",
                    'where' 	=> array( 
                                        'is_deleted' => 0 ,
                                    ), 
                    'order_by' 		=> 'cat_ordering ASC',
                    'return_type' 	=> 'all' 
                   ); 
$categories 	= $dblms->getRows(CATEGORIES, $condition);
    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Category List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="btn btn-primary" onclick="showAjaxModalZoom(\'include/modals/categories/add.php\');"><i class="ri-add-box-fill align-bottom me-1"></i>Category</a>
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
                                    <th class="bg-transparent border-bottom-0 wp-10 text-center">Ordering</th>
                                    <th class="bg-transparent border-bottom-0 wp-10 text-center">Image</th>
                                    <th class="bg-transparent border-bottom-0 wp-10">Meta Keywords</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($categories):
                                    $sr = 0;
                                    foreach($categories as $row):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">
                                                <div class="d-flex align-items-center">
                                                    <span class="data-image avatar avatar-md rounded-circle" style="background-image: url(uploads/images/donation/categories/icons/'.$row['cat_icon'].')"></span>
                                                    <div class="user-details ms-2">
                                                        <h6 class="mb-0">'.$row['cat_name'].'</h6>
                                                    </div>
                                                </div>
                                            <td class="text-muted fs-14 text-center">'.$row['cat_ordering'].'</td>
                                            <td class="text-center">
                                                <span class="data-image avatar avatar-md" style="background-image: url(uploads/images/donation/categories/'.$row['cat_image'].')"></span>
                                            </td>
                                            <td class="text-muted fs-14">'.$row['cat_meta_keywords'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($row['cat_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/categories/edit.php?cat_id='.$row['cat_id'].'\');"><i class="fe fe-edit"></i></a>
                                                </a>
                                                <a class="btn btn-xs  btn-danger" onclick="confirm_modal(\'categories.php?deleteid='.$row['cat_id'].'\');"><i class="fe fe-trash"></i></a>
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