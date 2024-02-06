<?php
    include('sidebar.php');
    include('getMethod.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Add New Social Media</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="">Social Logo (png)</label>
                                        <div class="form-element">
                                            <input type="file" id="file" accept="image/*" class="d-none" name="social-logo" required="">
                                            <label for="file">
                                                <img width="80" height="80" src="https://sgame.etsisi.upm.es/pictures/12946.png?1608547866/"  />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Social Name</label>                                        
                                        <input type="text" name="social-name" id="" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Social Link</label>                                        
                                        <input type="text" name="social-link" id="" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Location</label>                                        
                                        <select class="form-select" name="location">
                                            <option value="0">Contact</option>
                                            <option value="1">Footer</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <a href="index.php" class="btn btn-danger">Cancel</a>
                                        <button type="submit" name="btn-add-social" class="btn btn-success">Submit</button>
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