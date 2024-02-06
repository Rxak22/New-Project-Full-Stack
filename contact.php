<?php
    require('db-connect.php');
     include('header.php');
     include('function.php');
     $sql = "SELECT social_logo, label, url FROM tbl_social WHERE location = 0 ORDER BY id DESC LIMIT 7";

    $query = mysqli_query($db, $sql);
 ?>
    <div class="content contact">
        <section class="trending">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="content-trending">
                            <div class="content-left">
                                CONTACT US
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <div class="wrap-follow">
                            <h4 class="title">FOLLOW US</h4>
                            <ul>
                                <?php
                                    while ($row = mysqli_fetch_assoc($query)){
                                ?>
                                <li>
                                   <img width="40" height="40" src="https://res.cloudinary.com/dvsqwcz7u/image/upload/<?php echo $row["social_logo"]; ?>.jpg" width="40px"> <a href="<?php echo $row["url"]; ?>" target="_blank"><?php echo $row["label"] ?></a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="wrap-contact">
                            <h4 class="title">FEEDBACK TO US</h4>
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="label">Username</div>
                                        <input type="text" class="box" placeholder="Username" required name="username">
                                    </div>
                                    <div class="col-6">
                                        <div class="label">Email</div>
                                        <input type="email" class="box" placeholder="Email" required name="email">
                                    </div>
                                    <div class="col-6">
                                        <div class="label">Telephone</div>
                                        <input type="tel" class="box" placeholder="Telephone" required minlength="9" maxlength="10" name="telephone">
                                    </div>
                                    <div class="col-6">
                                        <div class="label">Address</div>
                                        <input type="text" class="box" placeholder="Address" required name="address">
                                    </div>
                                    <div class="col-12">
                                        <div class="label">Message</div>
                                        <textarea cols="30" rows="10" placeholder="Message Here" required name="message"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <div class="wrap-btn">
                                            <button type="submit" name="btn-submit-message"><i class="fab fa-telegram-plane"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php include('footer.php'); ?>