<?php include('header.php'); ?>
<main class="sport">
    <section class="trending">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-trending">
                        <div class="content-left">
                            RESULT SEARCH
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <div class="row">
            <?php
                $sql = "SELECT id, banner, tittle_km, news_type, description, create_date FROM tbl_news ";
                $sql .= "WHERE news_type LIKE '{$_GET["query"]}%' OR news_type = '{$_GET["query"]}' OR tittle_km LIKE '{$_GET["query"]}%' OR tittle_km LIKE '%{$_GET["query"]}%' OR description LIKE '{$_GET["query"]}%' OR description LIKE '%{$_GET["query"]}%'";
                $query = $db->query($sql);
                $row = mysqli_fetch_assoc($query);
                if (empty($row)) {
                    echo '<h4 class="ml-3">Not Found..</h4>';
                } else {
                    do {
                        echo '
                        <div class="col-4">
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
                        </div>
                        ';
                    } while ($row = mysqli_fetch_assoc($query));
                }
            ?>

            </div>
        </div>
    </section>
</main>
<?php include('footer.php'); ?>