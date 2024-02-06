<?php 
    require('db-connect.php');
    include('sidebar.php');
    include('getMethod.php');

    $sql = "SELECT * FROM tbl_social WHERE id = '{$_GET['id']}'";

    $query = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($query);
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Update Social</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                            <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="">Social Logo (png)</label>
                                        <div class="form-element">
                                            <input type="file" id="file" accept="image/*" class="d-none" name="new-social-logo">
                                            <input type="hidden" name="old-social-logo" value="<?php echo $row["social_logo"]; ?>">
                                            <label for="file">
                                                <img width="80" height="80" src="assets/icon/<?php echo $row["social_logo"]; ?>"  />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Social Name</label>                                        
                                        <input type="text" value="<?php echo $row["label"]; ?>" name="new-social-name" id="" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Social Link</label>                                        
                                        <input type="text" value="<?php echo $row["url"]; ?>" name="new-social-link" id="" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Location</label>                                        
                                        <select class="form-select" name="new-location">
                                            <option value="0">Contact</option>
                                            <option value="1">Footer</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <a href="view-social.php?next=<?php echo $_GET["pre"]; ?>" class="btn btn-danger">Back</a>
                                        <button type="submit" name="btn-update-social" class="btn btn-success">Submit</button>
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
<script src="assets/js/file.js"></script>
</html>