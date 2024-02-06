<!-- @import jquery & sweet alert  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php 
    require('db-connect.php');

    function submit_message() {
        global $db;
        if (isset($_POST["btn-submit-message"])) {

            $sql = "INSERT INTO `tbl_feedback`(`username`, `email`, `phone_num`, `address`, `message`) VALUES ('{$_POST["username"]}','{$_POST["email"]}','{$_POST["telephone"]}','{$_POST["address"]}','{$_POST["message"]}')";
            
            $query = $db->query($sql);
            if ($query){
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Success",
                            text: "Thanks for your feedback.",
                            icon: "success",
                        });
                    })
                </script>
            ';
            } else {
                echo '
                <script>
                    $(document).ready(function(){
                        swal({
                            title: "Error",
                            text: "something went wrong.",
                            icon: "error",
                        });
                    })
                </script>
            ';
            }
        }
    }
    submit_message();

    function get_news_by_type ($type) {
        global $db;
        $sql = "SELECT * FROM tbl_news WHERE news_type = '$type' ORDER BY id DESC LIMIT 6";

        $query = mysqli_query($db, $sql);
        while ($row = mysqli_fetch_assoc($query)){
            echo '
                <div class="col-4">
                    <figure>
                        <a href="news-detail.php?news_type='.$row["news_type"].'&id='. $row["id"]. '">
                            <div class="thumbnail">
                                <img width="350" height="200" src="https://res.cloudinary.com/dvsqwcz7u/image/upload/'. $row["thumnail"].'.jpg" alt="">
                            <div class="title">
                                '. $row["tittle_km"]. '
                            </div>
                            </div>
                        </a>
                    </figure>
                </div>
            ';
        }
    }

    function get_view() {
        global $db;
        $sql = "UPDATE tbl_news SET views = views + 1 WHERE id = '{$_GET['id']}'";

        $query = $db->query($sql);
    }
    // show on top slider
    function must_news_views() {
        global $db;
        $sql = "SELECT id, tittle_km, news_type FROM tbl_news ORDER BY views DESC LIMIT 2";

        $query = $db->query($sql);
        
        $row = mysqli_fetch_assoc($query);
        $row2 = mysqli_fetch_assoc($query);

        echo '
            <i class="fas fa-angle-double-right"></i>
            <a href="news-detail.php?news_type='.$row["news_type"].'&id='. $row["id"]. '">'.$row["tittle_km"] . ' </a> &ensp;
            <i class="fas fa-angle-double-right"></i>
            <a href="news-detail.php?news_type='.$row["news_type"].'&id='. $row2["id"]. '">'. $row2["tittle_km"]. ' </a>
        ';
    }
    static $isId = 0;
    function get_mustview_or_latest_news($type) {
        global $db;
        global $isId;
        if ($type == 'trending') {
            $sql = "SELECT thumnail, tittle_km, id, news_type FROM tbl_news ORDER BY views DESC LIMIT 1";
            $query = $db->query($sql);

            $row = mysqli_fetch_assoc($query);
            $isId = $row["id"];
            echo'
                <figure>
                    <a href="news-detail.php?news_type='.$row["news_type"].'&id='. $row["id"]. '">
                        <div class="thumbnail">
                            <img width="730" height="415" src="https://res.cloudinary.com/dvsqwcz7u/image/upload/'. $row["thumnail"].'.jpg" alt="">
                            <div class="title">
                                '. $row["tittle_km"].'
                            </div>
                        </div>
                    </a>
                </figure>
            ';
        } else if ($type == 'latest') {
            global $isId;

            $sql = "SELECT banner, tittle_km, id, news_type FROM tbl_news WHERE id NOT IN ($isId) ORDER BY id DESC LIMIT 2";
            $query = $db->query($sql);

            while ($row = mysqli_fetch_assoc($query)){
                echo '
                <div class="col-12">
                    <figure>
                        <a href="news-detail.php?news_type='.$row["news_type"].'&id='. $row["id"]. '">
                           <div class="thumbnail">
                           <img width="350" height="200" src="https://res.cloudinary.com/dvsqwcz7u/image/upload/'. $row["banner"].'.jpg" alt="">
                                <div class="title">
                                '. $row["tittle_km"].'
                                </div>
                            </div>
                        </a>
                    </figure>
                 </div>
            ';
            }
        }
    }

    function get_allnews_by_category($offset){
        global $db;

        $sql = "SELECT id, banner, tittle_km, create_date, news_type, description FROM tbl_news WHERE news_type = '{$_GET["news"]}' AND category = '{$_GET["category"]}' ORDER BY id DESC LIMIT 6 OFFSET $offset";
        $query = $db->query($sql);

        while ($row = mysqli_fetch_assoc($query)){
            echo '
            <div class="col-4">
            <figure>
                <a href="news-detail.php?news_type='.$row["news_type"].'&id='. $row["id"]. '">
                    <div class="thumbnail">
                        <img width="350" height="200" src="https://res.cloudinary.com/dvsqwcz7u/image/upload/'. $row["banner"]. '.jpg" alt="">
                    </div>
                    <div class="detail">
                        <h3 class="title"><span class="limit_tittle">'. $row["tittle_km"]. '</span></h3>
                        <div class="date">'. date('d/m/Y', strtotime($row["create_date"])). '</div>
                        <div class="description">
                            '. $row["description"]. '
                        </div>
                    </div>
                </a>
            </figure>
        </div>
            ';
        }
    }

    function latest_news($news_id) {
        global $db;
        $sql = "SELECT id, banner, tittle_km, news_type, description, create_date FROM tbl_news WHERE news_type= '{$_GET["news_type"]}' AND id NOT IN ($news_id) ORDER BY id DESC LIMIT 2";
        $query = mysqli_query($db, $sql);

        while ($row = mysqli_fetch_assoc($query)){
            echo '
                <figure>
                <a href="news-detail.php?news_type='.$row["news_type"].'&id='. $row["id"].'">
                    <div class="thumbnail">
                        <img width="350" height="200" src="https://res.cloudinary.com/dvsqwcz7u/image/upload/'. $row["banner"]. '.jpg" alt="">
                    </div>
                    <div class="detail">
                        <h3 class="title">'. $row["tittle_km"].'</h3>
                        <div class="date">'. date('d/m/Y', strtotime($row["create_date"])). '</div>
                        <div class="description">
                            '. $row["description"]. '
                        </div>
                    </div>
                </a>
            </figure>
            ';
        }
    }