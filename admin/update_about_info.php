<?php 
    require('db-connect.php');
    include('sidebar.php');
    include('getMethod.php');

    $sql = "SELECT * FROM tbl_about_us WHERE id = '{$_GET['id']}'";

    $query = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($query);
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Update About us Info</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea rows="10" placeholder="" required="" name="description" class="form-control"><?php echo $row["description"] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <a href="view-info.php?next=<?php echo $_GET["pre"]; ?>" class="btn btn-secondary">Back</a>
                                        <button type="submit" name="btn-update-info" class="btn btn-primary">Submit</button>
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