<?php 
    include('header.php');
    include('function.php');

    $offset = 0;
    if (isset($_GET["next"]))
        $offset = $_GET["next"];
?>
<style>
    .limit_tittle {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* number of lines to show */
            line-clamp: 2; 
    -webkit-box-orient: vertical;
}
</style>
<main class="sport">
    <section class="trending">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-trending">
                        <div class="content-left">
                            <?php
                                $text = strtoupper($_GET["news"]);
                                echo $text;
                            ?>
                            NEWS
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
                    get_allnews_by_category($offset);
                ?>

            </div>
            <div class="row pagination">
                <div class="col-12">
                    <ul>
                        <li>
                            <a href="news-category.php?news=<?php echo $_GET["news"]; ?>&category=<?php echo $_GET["category"]; ?>&next=0">1</a>
                        </li>
                        <li>
                            <a href="news-category.php?news=<?php echo $_GET["news"]; ?>&category=<?php echo $_GET["category"]; ?>&next=9">2</a>
                        </li>
                        <li>
                            <a href="news-category.php?news=<?php echo $_GET["news"]; ?>&category=<?php echo $_GET["category"]; ?>&next=17">3</a>
                        </li>
                    </ul>   
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('footer.php'); ?>