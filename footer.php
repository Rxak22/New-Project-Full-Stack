<?php 
    require('db-connect.php');

    $sql = "SELECT tbl_logo.thumnail, tbl_about_us.description FROM tbl_logo INNER JOIN tbl_about_us WHERE tbl_about_us.status = 0 AND tbl_logo.location = 'footer' ORDER BY tbl_logo.id DESC LIMIT 1";

    $query = $db->query($sql);
    $result = mysqli_fetch_assoc($query);
?> 
    <footer>
        <div class="container">
            <div class="logo">
                <a href="">
                    <img width="120" height="120" src="https://res.cloudinary.com/dvsqwcz7u/image/upload/<?php echo $result["thumnail"];?>.jpg" alt="footer">
                </a>
            </div>
            <div class="about">
                <div class="description">
                    <?php echo $result["description"]?>
                </div>
            </div>
            <div class="connect">
                <ul>
                    <?php
                        $sql_query = "SELECT social_logo, url FROM tbl_social WHERE location = 1 LIMIT 3";
                        $reault_query = mysqli_query($db, $sql_query);
                        while ($row = mysqli_fetch_assoc($reault_query)){
                    ?>
                        <li>
                            <a href="<?php echo $row["url"] ?>" target="_blank"><img width="40" height="40" src="https://res.cloudinary.com/dvsqwcz7u/image/upload/<?php echo $row["social_logo"] ?>.jpg" alt=""></a>
                        </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </footer> 
</body>
<!-- @slick slider -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<!-- @theme js -->
<script src="assets/script/theme.js"></script>
<!-- @funcy box -->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>