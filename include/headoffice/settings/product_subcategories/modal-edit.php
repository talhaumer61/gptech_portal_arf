<?php
    echo '
    <!-- MODAL EFFECTS -->
    <div class="modal fade" id="edit">
        <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
            <div class="modal-content modal-content-demo expanel expanel-info">
                <div class="modal-header expanel-heading">
                    <h6 class="modal-title">Edit Sub Category</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="product_subcategories.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="modal-body expanel-body text-start">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Name</label>
                                    <input type="text" name="subcat_id" id="subcat_id" class="form-control" placeholder="Enter Name" required />
                                    <input type="text" name="subcat_name" id="subcat_name" class="form-control" placeholder="Enter Name" required />
                                </div>
                                <div class="col">
                                    <label class="form-label">Code</label>
                                    <input type="text" name="subcat_code" id="subcat_code" class="form-control" placeholder="AL001" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col form-group">
                                    <label class="form-label">Category</label>
                                    <select class="form-control select2-show-search form-select" name="id_cat" id="id_cat" data-placeholder="Choose one" required>
                                        <option label="Choose one"></option>';
                                            foreach ($Categories as $category):
                                                echo'<option value="'.$category['cat_id'].'">'.$category['cat_name'].'</option>';
                                            endforeach;
                                        echo'
                                    </select>
                                </div>
                                <div class="col form-group">
                                    <label class="form-label">Status </label>
                                    <select class="form-control select2-show-search form-select" name="subcat_status" id="subcat_status" data-placeholder="Choose one" required>
                                        <option label="Choose one"></option>';
                                            foreach ($status as $subcat_status):
                                                echo'<option value="'.$subcat_status['id'].'">'.$subcat_status['name'].'</option>';
                                            endforeach;
                                        echo'
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="subcat_description" id="subcat_description" class="form-control" placeholder="Category Description"></textarea>
                        </div>
                    </div>
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-info" name="submit_edit" >Edit Sub Category</button> 
                        <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //---edit item link clicked-------
            $(".editModel").click(function(){
            
                //get variables from "edit link" data attributes
                
                var subcat_id           =   $(this).attr("data-subcat-id");
                var subcat_name         =   $(this).attr("data-subcat-name");
                var subcat_code         =   $(this).attr("data-subcat-code");
                var subcat_description  =   $(this).attr("data-subcat-description");
                var id_cat              =   $(this).attr("data-id-cat");
                var subcat_status       =   $(this).attr("data-subcat-status");


                //set modal input values dynamically
                $("#subcat_id").val(subcat_id);
                $("#subcat_name").val(subcat_name);
                $("#subcat_code").val(subcat_code);
                $("#subcat_description").val(subcat_description);

                //pre-select data in pull down lists
                $("#id_cat").select2().select2("val", id_cat);
                $("#subcat_status").select2().select2("val", subcat_status);
            }); 
        });
    </script>
    ';
?>