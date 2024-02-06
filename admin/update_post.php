<?php 
    require('db-connect.php');
    include('sidebar.php');
    include('getMethod.php');

    $sql = "SELECT * FROM tbl_news WHERE id = '{$_GET['id']}'";

    $query = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($query);

    // control selected news type
    $sport = "";
    $social = "";
    $intertainment = "";
    if ($row['news_type'] == 'Sports') $sport = "Selected";
    else if ($row['news_type'] == 'Social') $social = "Selected";
    else if ($row['news_type'] == 'Intertainment') $intertainment = "Selected";

    // contron selected news category
    $national = "";
    $international = "";
    if ($row['category'] == 'National') $national = "Selected";
    else if ($row['category'] == 'International') $international = "Selected";
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Add Sport News</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Title Khmer</label>
                                        <input type="text" class="form-control" value="<?php echo $row["tittle_km"] ?>" name="new_tittle_km" placeholder="" required="" >
                                    </div>
                                    <div class="form-group">
                                        <label>News Type</label>
                                        <select class="form-select" name="new_news_type">
                                            <option <?php echo $sport ?> value="sport">Sport</option>
                                            <option <?php echo $social ?> value="social">Social</option>
                                            <option <?php echo $intertainment ?> value="intertainment">Intertainment</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-select" name="new_category">
                                            <option <?php echo $national;?> value="national">National</option>
                                            <option <?php echo $international;?> value="international">International</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Thumnail Post (730x415)</label>
                                        <div class="form-element">
                                            <input type="file" id="file" accept="image/*" class="d-none" name="new_thumnail">
                                            <input type="hidden" name="old_thumnail" value="<?php echo $row["thumnail"]; ?>">
                                            <label for="file">
                                                <img width="80" height="80" src="assets/news_image/<?php echo $row["thumnail"] ?>"  />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Banner Post (350x200)</label>
                                        <div class="form-element">
                                            <input type="file" id="files" accept="image/*" class="d-none" name="new_banner">
                                            <input type="hidden" name="old_banner" value="<?php echo $row["banner"]; ?>">
                                            <label for="files">
                                                <img width="80" height="80" src="assets/news_image/<?php echo $row["banner"];?>"  />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="new_description" class="form-control"><?php echo $row["description"] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <a href="view-post.php?next=<?php echo $_GET["pre"]; ?>" class="btn btn-secondary">Back</a>
                                        <button type="submit" name="btn-update-post" class="btn btn-primary">Submit</button>
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