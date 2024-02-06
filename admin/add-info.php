<?php
    include('sidebar.php');
    include('getMethod.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Add About us Info</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Description</label>                                        
                                        <textarea rows="10" placeholder="" required="" name="description" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <a href="index.php" class="btn btn-danger">Cancel</a>
                                        <button type="submit" name="btn-add-info" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>