<?php
    require('db-connect.php');
    include('header.php'); 
    include('function.php'); 

    $sql = "SELECT * FROM tbl_news WHERE id =  '{$_GET["id"]}'";
    $query = mysqli_query($db, $sql);

    $row = mysqli_fetch_assoc($query);

    get_view();
?>
<main class="news-detail">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="main-news">
                        <div class="thumbnail">
                            <img src="https://res.cloudinary.com/dvsqwcz7u/image/upload/<?php echo $row["banner"] ?>.jpg">
                        </div>
                        <div class="detail">
                            <h3 class="title"><?php echo $row["tittle_km"] ?></h3>
                            <div class="date"><?php echo date('d/m/Y', strtotime( $row["create_date"]));?></div>
                            <div class="description">
                                <?php echo $row["description"]; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="relate-news">
                        <h3 class="main-title">Related News</h3>
                        <?php
                           latest_news($row["id"]); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('footer.php'); ?>