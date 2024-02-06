<?php 
    require('db-connect.php');
    include('getMethod.php');
    include('sidebar.php');
    $offset = 0;
    if (isset($_GET['next'])) 
        $offset = $_GET['next'];
    
    $sql = "SELECT tbl_users.firstName AS firstName, tbl_users.lastName AS lastName, tbl_news.* ";
    $sql .= "FROM tbl_users INNER JOIN tbl_news ON tbl_users.id = tbl_news.publisher_id LIMIT 5 OFFSET $offset";
 
    $query = $db->query($sql);
?>

<style>
    .button {
  --main-focus: #E41B17;
  --font-color: #E41B17;
  --bg-color-sub: #dedede;
  --bg-color: #eee;
  --main-color: #E41B17;
  position: relative;
  width: 95px;
  height: 35px;
  cursor: pointer;
  display: flex;
  align-items: center;
  border: 2px solid var(--main-color);
  background-color: var(--bg-color);
  border-radius: 10px;
  overflow: hidden;
}

.button, .button__icon, .button__text {
  transition: all 0.3s;
}

.button .button__text {
  transform: translateX(8px);
  color: var(--font-color);
  font-weight: 600;
  font-size: 12px;
}

.button .button__icon {
  position: absolute;
  transform: translateX(52px);
  height: 100%;
  width: 15px;
  color: #E41B17;
  background-color: var(--bg-color-sub);
  display: flex;
  align-items: center;
  justify-content: center;
}

.button .svg {
  width: 20px;
  fill: var(--main-color);
}

.button:hover {
  background: var(--bg-color);
}

.button:hover .button__text {
  color: transparent;
}

.button:hover .button__icon {
  width: 128px;
  transform: translateX(-26.5%);
}

.button:active {
  transform: translate(3px, 3px);
  box-shadow: 0px 0px var(--main-color);
}
</style>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>All News Post</h3>
                        </div>
                        <div class="bottom view-post">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="block-search">
                                        <input type="text" class="form-control" placeholder="SEARCH HERE">
                                        <button type="submit">
                                        <img src="search.png" alt=""></button>
                                    </div>
                                    <table class="table" style="table-layout: fixed;" border="1px">
                                        <tr>
                                            <th>News Type</th>
                                            <th>Categories</th>
                                            <th>Thumbnail</th>
                                            <th>Banner</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Publisher</th>
                                            <th>Publish Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    <tbody>
                                        <?php
                                            while ($row = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row["news_type"]; ?></td>
                                                <td><?php echo $row["category"]; ?></td>
                                                <td><img width="80" height="80" src="https://res.cloudinary.com/dvsqwcz7u/image/upload/<?php echo $row["thumnail"]; ?>.jpg"/></td>
                                                <td><img width="80" height="80" src="https://res.cloudinary.com/dvsqwcz7u/image/upload/<?php echo $row["banner"]; ?>.jpg"/></td>
                                                <td class="tda"><article style="
                                                    overflow: hidden;
                                                    display: -webkit-box;
                                                    -webkit-line-clamp: 2;
                                                            line-clamp: 2;
                                                    -webkit-box-orient: vertical;
                                                                padding: 0;"
                                                ><?php echo $row["tittle_km"]; ?></article></td>
                                                
                                                <td class="td"><article style="
                                                    overflow: hidden;
                                                    display: -webkit-box;
                                                    -webkit-line-clamp: 2;
                                                            line-clamp: 2;
                                                    -webkit-box-orient: vertical;
                                                                padding: 0;"
                                                ><?php echo $row["description"]; ?></article></td>

                                                <td><?php echo $row["firstName"]. " ". $row["lastName"]; ?></td>
                                                <td><?php echo $row["create_date"]; ?></td>
                                                <td width="150px" class="d-flex">
                                                    <a href="update_post.php?pre=<?php echo $offset; ?>&id=<?php echo $row["id"]; ?>"class="btn btn-primary" style="margin-right: 7px;">Modify</a>
                                                    <button type="button" remove-id="<?php echo $row["id"]; ?>" class="button btn-remove" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        <span class="button__text">Remove</span>
                                                        <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="512" viewBox="0 0 512 512" height="512" class="svg"><title></title><path style="fill:none;stroke:#E41B17;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" d="M112,112l20,320c.95,18.49,14.4,32,32,32H348c17.67,0,30.87-13.51,32-32l20-320"></path><line y2="112" y1="112" x2="432" x1="80" style="stroke:#E41B17;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px"></line><path style="fill:none;stroke:#E41B17;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" d="M192,112V72h0a23.93,23.93,0,0,1,24-24h80a23.93,23.93,0,0,1,24,24h0v40"></path><line y2="400" y1="176" x2="256" x1="256" style="fill:none;stroke:#E41B17;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line y2="400" y1="176" x2="192" x1="184" style="fill:none;stroke:#E41B17;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line><line y2="400" y1="176" x2="320" x1="328" style="fill:none;stroke:#E41B17;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></line></svg></span>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                            mysqli_free_result($query);
                                            mysqli_close($db);
                                        ?>
                                    </tbody>
                                    </table>
                                    <ul class="pagination">
                                        <li>
                                            <a href="view-post.php?next=0">1</a>
                                            <a href="view-post.php?next=5">2</a>
                                            <a href="view-post.php?next=10">3</a>
                                            <a href="view-post.php?next=15">4</a>
                                        </li>
                                    </ul>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure to remove this post?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                        <input type="hidden" class="value_remove" name="remove_id">
                                                        <button type="submit" class="btn btn-danger" name="accept_remove_post">Yes</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button> 
                                                </div>
                                            </div>
                                        </div>
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