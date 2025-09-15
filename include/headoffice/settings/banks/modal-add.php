<?php 
    echo '
    <!-- MODAL EFFECTS -->
    <div class="modal fade"  id="addBank">
        <div class="modal-dialog modal-dialog-centered text-center modal-lg" role="document">
            <div class="modal-content modal-content-demo expanel expanel-primary">
                <div class="modal-header expanel-heading">
                    <h6 class="modal-title">Add Bank</h6><button aria-label="Close" class="btn-close text-white" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="banks.php" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="modal-body expanel-body text-start">
                        <div class="form-group">
                            <label class="form-label" for="card-name">Bank Name</label>
                            <input class="form-control" id="card-name" type="text" name="bank_name" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="card-name">Bank Code</label>
                            <input class="form-control" id="card-name" name="bank_code" type="text" placeholder="Enter Code" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Staus</label>
                            <select class="form-control select2-show-search form-select" id="mySelect2" name="bank_status" data-placeholder="Choose one">
                                <option label="Choose one"></option>';
                                foreach($status as $stats):
                                    echo '
                                    <option value="'.$stats['id'].'">'.$stats['name'].'</option>';
                                endforeach;
                                echo '
                            </select>
                        </div>
                    </div>
                    <div class="expanel-footer modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit_add" >Add Bank</button> 
                        <a class="btn btn-danger" data-bs-dismiss="modal" >Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    ';
?>