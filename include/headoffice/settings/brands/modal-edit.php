<?php
    echo '
    <!-- MODAL EFFECTS -->
    <div class="modal fade" id="edit">
        <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
            <div class="modal-content modal-content-demo expanel expanel-info">
                <div class="modal-header expanel-heading">
                    <h6 class="modal-title">Edit Brand</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="brands.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="modal-body expanel-body text-start">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Name</label>
                                    <input type="hidden" name="brand_id" id="brand_id" class="form-control" required />
                                    <input type="text" name="brand_name" id="brand_name" class="form-control" placeholder="Enter Name" required />
                                </div>
                                <div class="col">
                                    <label class="form-label">Code</label>
                                    <input type="text" name="brand_code" id="brand_code" class="form-control" placeholder="AL001" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" accept="image/*" />
                                </div>
                                <div class="col form-group">
                                    <label class="form-label">Status</label>
                                    <select class="form-control select2-show-search form-select" name="brand_status" id="brand_status" data-placeholder="Choose one" required>
                                        <option label="Choose one"></option>';
                                            foreach ($status as $brand_status):
                                                echo'<option value="'.$brand_status['id'].'">'.$brand_status['name'].'</option>';
                                            endforeach;
                                        echo'
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="brand_description" id="brand_description" class="form-control" placeholder="Brand Description"></textarea>
                        </div>
                    </div>
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-info" name="submit_edit" >Edit Brand</button> 
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
                
                var brand_id            =   $(this).attr("data-brand-id");
                var brand_name          =   $(this).attr("data-brand-name");
                var brand_code          =   $(this).attr("data-brand-code");
                var brand_image         =   $(this).attr("data-brand-image");
                var brand_description   =   $(this).attr("data-brand-description");
                var brand_status        =   $(this).attr("data-brand-status");


                //set modal input values dynamically
                $("#brand_id").val(brand_id);
                $("#brand_name").val(brand_name);
                $("#brand_code").val(brand_code);
                $("#brand_image").val(brand_image);
                $("#brand_description").val(brand_description);

                //pre-select data in pull down lists
                $("#brand_status").select2().select2("val", brand_status);
            }); 
        });
    </script>
    ';
?>