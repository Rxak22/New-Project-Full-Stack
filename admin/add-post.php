<?php 
    include('sidebar.php');
    include('getMethod.php');
?>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>Add News Post</h3>
                        </div>
                        <div class="bottom">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Title Khmer</label>
                                        <input type="text" class="form-control" name="tittle_km" placeholder="" required="" >
                                    </div>
                                    <div class="form-group">
                                        <label>News Type</label>
                                        <select class="form-select" name="news_type">
                                            <option value="sport">Sport</option>
                                            <option value="social">Social</option>
                                            <option value="intertainment">Intertainment</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-select" name="category">
                                            <option value="national">National</option>
                                            <option value="international">International</option>
                                        </select>
                                    </div>
                                    <div class="form-group">                        
                                        <label>Thumnail Post (730x415)</label>
                                        <div class="form-element">
                                            <input type="file" id="file" accept="image/*" class="d-none" name="thumnail" required="">
                                            <label for="file">
                                                <img width="80" height="80" src="https://sgame.etsisi.upm.es/pictures/12946.png?1608547866/"  />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">                        
                                        <label>Banner Post (350x200)</label>
                                        <div class="form-element">
                                            <input type="file" id="files" accept="image/*" class="d-none" name="banner" required="">
                                            <label for="files">
                                                <img width="80" height="80" src="https://sgame.etsisi.upm.es/pictures/12946.png?1608547866/"  />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea placeholder="" required="" name="description" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <a href="index.php" class="btn btn-danger">Cancel</a>
                                        <button type="submit" name="btn-add-post" class="btn btn-success">Submit</button>
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