<?php
    include("getMethod.php");
    include("sidebar.php");
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Add Web Logo</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Location</label>
                                        <select class="form-select" name="location">
                                            <option value="header">Header</option>
                                            <option value="footer">Footer</option>
                                        </select>
                                    </div>
                                    <div class="form-group">                        
                                        <label>Logo Here</label>
                                        <div class="form-element">
                                            <input type="file" id="file" accept="image/*" class="d-none" name="logo" required="">
                                            <label for="file">
                                                <img width="80" height="80" src="https://sgame.etsisi.upm.es/pictures/12946.png?1608547866/"  />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <a href="index.php" class="btn btn-danger">Cancel</a>
                                        <button type="submit" class="btn btn-success" name="apply_logo">Apply</button>
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