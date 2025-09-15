<?php
$condition = array ( 
                    'select' 	=> ''.FAQS.'.faq_id, '.FAQS.'.faq_status, '.FAQS.'.faq_ordering, '.FAQS.'.faq_question, '.FAQS.'.faq_answer, '.FAQS.'.id_cat, '.CATEGORIES.'.cat_name',
                    'join' 		=> 'INNER JOIN '.CATEGORIES.' ON '.CATEGORIES.'.cat_id = '.FAQS.'.id_cat',
                    'where' 	=> array( 
                                        ''.FAQS.'.is_deleted' => 0 
                                    ), 
                    'order_by' 		=> ''.FAQS.'.faq_ordering ASC',
                    'return_type' 	=> 'all' 
                   ); 
$faqs 	= $dblms->getRows(FAQS, $condition);
    echo '
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title mb-0 mt-3" >Faqs List</h3>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class="btn btn-primary" onclick="showAjaxModalZoom(\'include/modals/faqs/add.php\');"><i class="ri-add-box-fill align-bottom me-1"></i>Faqs</a>
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
                                    <th class="bg-transparent border-bottom-0 wp-10">Category</th>
                                    <th class="bg-transparent border-bottom-0">Question</th>
                                    <th class="bg-transparent border-bottom-0">Answer</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Status</th>
                                    <th class="bg-transparent border-bottom-0 text-center  wp-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">';
                                if($faqs):
                                    $sr = 0;
                                    foreach($faqs as $faq):
                                        $sr++;
                                        echo '
                                        <tr>
                                            <td class="text-muted fs-14 fw-semibold text-center">'.$sr.'</td>
                                            <td class="text-muted fs-14 fw-semibold">'.$faq['cat_name'].'</td>
                                            <td class="text-muted fs-14">'.$faq['faq_question'].'</td>
                                            <td class="text-muted fs-14">'.$faq['faq_answer'].'</td>
                                            <td class="text-muted fs-14 text-center">'.get_status($faq['faq_status']).'</td>
                                            <td class="text-muted fs-14 text-center">
                                                <a class="btn btn-primary btn-xs" onclick="showAjaxModalZoom(\'include/modals/faqs/edit.php?faq_id='.$faq['faq_id'].'\');"><i class="fe fe-edit"></i></a>
                                                </a>
                                                <a class="btn btn-xs  btn-danger" onclick="confirm_modal(\'faqs.php?deleteid='.$faq['faq_id'].'\');"><i class="fe fe-trash"></i></a>
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