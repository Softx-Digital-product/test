

<div class="Modals">
    
<!-- ADD Court Modal -->
            <div class="modal fade" id="AddCourt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Add Court</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="continer border">
                                <input class="form-control" id="Tname" type="text" placeholder="Enter Court Name">

                                <button type="button" id="addT" class="btn btn-primary mt-2" >Add Court</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> 
            </div>



            <!-- Edit Court Modal -->
            <div class="modal fade" id="EditCourt" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Edit Court</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="continer border">
                                <label class="font-weight-bold">Select Court</label><br>
                                <select class="ModalSelect" style="width:100%;" id="editTC" placeholder="Choose Court..">
                                    <option value="" disabled selected>Choose Court...</option>

                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM CourtDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Court_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <input class="form-control mt-2" type="text"  id="RenameT" placeholder=" Edit Court">

                                <button type="button" id="EditT" class="btn btn-primary mt-2" >Edit Court</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>


            <!-- Delete Court Modal -->
            <div class="modal fade" id="DeleteCourt" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title font-weight-bold" id="exampleModalLabel">Delete Court</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="continer border">
                                <label class="font-weight-bold">Select Type</label><br>
                                <select  class="" style="width:100%;" id="DeleteT" placeholder="Choose Court..">
                                    <option value="" disabled selected>Please Choose Court</option>

                                    <?php
                                    include 'KnowledgeDb/Dp.php';
                                    $sql = mysqli_query($con, "SELECT * FROM CourtDb");
                                    while ($row = $sql->fetch_assoc()) {
                                        echo "<option value=" . $row['Sr_no'] . ">" . $row['Court_Name'] . "</option>";
                                    }
                                    ?>
                                </select>
                                <button type="button" id="DelT" class="btn btn-primary mt-1 ml-1" >Delete Court</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        </div>
                    </div>
                </div>
            </div>
            
            
            
</div>
