<?php
$condition = array ( 
                    'select' 	=> "id, status, type, file",
                    'where' 	=> array( 
                                        'is_deleted' => 0 ,
                                    ), 
                    'order_by' 		=> 'id ASC',
                    'return_type' 	=> 'all' 
                   ); 
$REPORTS_DOWNLOADS = $dblms->getRows(REPORTS_DOWNLOADS, $condition);
echo '
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
            <div class="card-header border-bottom">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="card-title mb-0 mt-3" >List</h3>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a class="btn btn-primary" onclick="showAjaxModalZoom(\'include/modals/reports/add.php\');"><i class="ri-add-box-fill align-bottom me-1"></i>Report / Download</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data-table" class="table text-nowrap mb-0 table-bordered">
                        <thead class="table-head">
                            <tr>
                                <th class="bg-transparent border-bottom-0 text-center wp-5">Sr.</th>
                                <th class="bg-transparent border-bottom-0">Type</th>
                                <th class="bg-transparent border-bottom-0">File</th>
                                <th class="bg-transparent border-bottom-0 text-center wp-7">Status</th>
                                <th class="bg-transparent border-bottom-0 text-center wp-7">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">';
                            if($REPORTS_DOWNLOADS):
                                $sr = 0;
                                foreach($REPORTS_DOWNLOADS as $row):
                                    $sr++;
                                    echo '
                                    <tr>
                                        <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                        <td class="text-muted fs-14">'.get_report_type($row['type']).'</td>
                                        <td class="text-muted fs-14">'.$row['file'].'</td>
                                        <td class="text-muted fs-14 text-center">'.get_status($row['status']).'</td>
                                        <td class="text-muted fs-14 text-center">
                                            <a class="btn btn-info btn-xs" href="'.SITE_URL.'uploads/files/reports/'.$row['file'].'" target="_blank"><i class="fe fe-eye"></i></a>
                                            <a class="btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/reports/edit.php?id='.$row['id'].'\');"><i class="fe fe-edit"></i></a>
                                            <a class="btn btn-xs  btn-danger" onclick="confirm_modal(\'?deleteid='.$row['id'].'\');"><i class="fe fe-trash"></i></a>
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