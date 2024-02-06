<?php
    require('db-connect.php');
    include("getMethod.php");
    include("sidebar.php");

    $offset = 0;
    if (isset($_GET['next'])) 
        $offset = $_GET['next'];
    
    $sql = "SELECT * FROM tbl_feedback ORDER BY id DESC LIMIT 5 OFFSET $offset";

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
  width: 115px;
  height: 35px;
  cursor: pointer;
  display: flex;
  align-items: center;
  border: 2px solid var(--main-color);
  background-color: var(--bg-color);
  border-radius: 10px;
  overflow: hidden;
  font-size: 12px;
}

.button, .button__icon, .button__text {
  transition: all 0.3s;
}

.button .button__text {
  transform: translateX(23px);
  color: var(--font-color);
  font-weight: 600;
}

.button .button__icon {
  position: absolute;
  transform: translateX(73px);
  height: 100%;
  width: 39px;
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
  width: 148px;
  transform: translateX(0);
}

.button:active {
  transform: translate(3px, 3px);
  box-shadow: 0px 0px var(--main-color);
}
</style>
                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3>All Web Logo</h3>
                        </div>
                        <div class="bottom view-post">
                            <figure>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="block-search">
                                        <input type="text" class="form-control" placeholder="SEARCH HERE">
                                        <button type="submit">
                                        <img src="search.png" alt="">
                                    </div>
                                    <table class="table" border="1px">
                                        <tr>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                            <th style="color: #E41B17; font-weight: bold;">Actions</th>
                                        </tr>
                                        <?php
                                            while ($row = mysqli_fetch_assoc($query)){
                                        ?>
                                        <tr>
                                            <td><?php $id = $row["username"]; echo $id ?></td>
                                            <td><?php echo $row["email"]; ?></td>
                                            <td><?php echo $row["phone_num"]; ?></td>
                                            <td><?php echo $row["address"]; ?></td>
                                            <td>
                                                <textarea name="" id="" cols="45" rows="5"><?php echo $row["message"]; ?></textarea>
                                            </td>
                                            <td><?php echo $row["date"]; ?></td>
                                            <td width="150px">
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
                                    </table>
                                    <ul class="pagination">
                                        <li>
                                            <a href="view-user-feedback.php?next=0">1</a>
                                            <a href="view-user-feedback.php?next=5">2</a>
                                            <a href="view-user-feedback.php?next=10">3</a>
                                            <a href="view-user-feedback.php?next=15">4</a>
                                        </li>
                                    </ul>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure to remove this feedback</h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" class="value_remove" name="remove_id">
                                                                <button name="accept_remove_feedback" type="submit" class="btn btn-danger">Yes</button>
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
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>