<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
    require('db-connect.php');

    // handle upload image to cloudinary server
    use Cloudinary\Configuration\Configuration;
    use Cloudinary\Api\Upload\UploadApi;
    require '../vendor/autoload.php';
    function handleUploadImage($image) {
          
        Configuration::instance([
        'cloud' => [
            'cloud_name' => 'dvsqwcz7u', 
            'api_key' => '372777487356172', 
            'api_secret' => '9efxfTI7wqFOIpCy3KxZwEYXeFc'],
        'url' => [
            'secure' => true]]);

        $data = (new UploadApi())->upload($image);
        
        return $data["public_id"];
    }
    // register admin
    function insert() {
        global $db;
        $isTrue = false;
        if (isset($_POST["btn_register"])) {
            $query = "SELECT email FROM tbl_users";
            $result = mysqli_query($db, $query);
            while ($row = mysqli_fetch_assoc($result)){
                if ($_POST["email"] == $row["email"]) {
                    echo '
                    <script>
                        $(document).ready(function() {
                            swal({
                                title: "Error",
                                text: "Your emial already registered",
                                icon: "error",
                                button: "ok",
                            });
                        });
                    </script>
                    ';
                    $isTrue = true; 
                    break;
                }
            }
            if ($isTrue == false){
                if ($_POST["c_password"] == $_POST["password"]) {

                    $password = md5($_POST["password"]);
                
                    // $profile = $_FILES["profile"]["name"];
                    // $random = rand(0, 999999);
                    // $profile_name = date("Y-m-d").'-' . $random. $profile;

                    // move_uploaded_file($_FILES["profile"]["tmp_name"], "assets/admin_profile/". $profile_name);
                    //upload to cloudinary
                    $profile_name = handleUploadImage($_FILES["profile"]["tmp_name"]);

                    $sql = "INSERT INTO `tbl_users`(`firstName`,`lastName`, `email`, `password`, `profile`) ";
                    $sql .= "VALUES ('{$_POST["firstName"]}','{$_POST["lastName"]}','{$_POST["email"]}','$password','$profile_name')";
                    $result = $db->query($sql);
                    if ($result) {
                        echo  '
                            <script>
                                $(document).ready(function() {
                                    swal({
                                        title: "Success",
                                        text: "Your account has been created",
                                        icon: "success",
                                        button: "done",
                                    });
                                });
                            </script>
                        ';
                    } else {
                        echo '
                            <script>
                                $(document).ready(function() {
                                    swal({
                                        title: "Error",
                                        text: "Create a new account failed",
                                        icon: "error",
                                        button: "done",
                                    });
                                });
                            </script>
                        ';
                    }
                    
                } else {
                    echo '
                        <script>
                            $(document).ready(function() {
                                swal("Warning", "Password and Confirm password nt match.", "warning");
                            });
                       </script>
                    ';
                }
            }
        }
    }
    insert();

    // add logo to database
    function addLogo() {
        global $db;
        if (isset($_POST["apply_logo"])) {
            // upload img with move uploaded file
            // $logo_name = date("Y-m-d"). '_'. rand(1, 9999999). $_FILES["logo"]["name"];
            // $logo_path = 'assets/icon/'. $logo_name;

            // move_uploaded_file($_FILES["logo"]["tmp_name"], $logo_path);

            // upload with cloudinary
            $file = $_FILES["logo"]["tmp_name"];
            $public_id = handleUploadImage($file);

            $sql = "INSERT INTO tbl_logo (`location`, `thumnail`)";
            $sql .= "VALUES ('{$_POST["location"]}', '$public_id')";

            $query = $db->query($sql);
            if ($query){
                echo '
                    <script>
                        $(document).ready(function() {
                            swal({
                                title: "Success",
                                text: "Logo Uploaded",
                                icon: "success",
                                button: "done",
                            });
                        });
                    </script>
                ';
            } else {
                echo '
                    <script>
                        $ (document).ready(function() {
                            swal({
                                title: "Error",
                                text: "Something went wrong!",
                                icon: "error",
                                button: "done",
                            });
                        });
                    </script>
                ';
            }
        }
    }
    addLogo();

    // accept remove logo'
    function logo_delete_post(){
        global $db;
        if(isset($_POST['accept_delete_logo'])){
            $remove_id = $_POST['remove_id'];

            $sql = "DELETE FROM tbl_logo WHERE id='$remove_id'";

            $result = $db->query($sql);
            
            if($result){
                echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Success",
                                    text: "Logo has been removed",
                                    icon: "success",
                                });
                            })
                        </script>
                    ';
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error",
                                text: "Somethings went wrong.",
                                icon: "error",
                            });
                        })
                    </script>
                    ';
            }
        }
    }
    logo_delete_post();

    // control move uploaded file 
    function upload_file($file, $path) {
        $name = date('Y-m-d'). '_'. rand(0, 999999). '_ '. $_FILES[$file]['name'];

        move_uploaded_file($_FILES[$file]['tmp_name'], $path. $name);

        return $name;
    }
    // add news post
    function add_news_post() {
        global $db;
        if (isset($_POST['btn-add-post'])){
                $publisher_id = $_SESSION['id'];
                // upload with cloudinary
                $thumnail = $_FILES["thumnail"]["tmp_name"];
                $banner = $_FILES["banner"]["tmp_name"];
                $thumnail_id = handleUploadImage($thumnail);
                $banner_id = handleUploadImage($banner);
                
                $sql_query = "INSERT INTO `tbl_news`(`thumnail`, `banner`, `tittle_km`, `description`, `news_type`, `category`, `publisher_id`) ";
                $sql_query .= "VALUES ('$thumnail_id','$banner_id','{$_POST["tittle_km"]}','{$_POST["description"]}','{$_POST["news_type"]}','{$_POST["category"]}', '$publisher_id') ";
                
                $rs_query = $db->query($sql_query);

                if  ($rs_query) {
                    echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Success",
                                    text: "News has been published",
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
                                    text: "Something went wrong, News cannot be published",
                                    icon: "error",
                                });
                            })
                        </script>
                    ';
                }
        }
    }
    add_news_post();

    // update news post 
    function update_news_post() {
        global $db;
        if (isset($_POST['btn-update-post'])) {
            // control update thumnails
            $thumnail = "";
            if (!empty($_FILES["new_thumnail"]["name"])) $thumnail = handleUploadImage($_FILES["new_thumnail"]["tmp_name"]);
            else $thumnail = $_POST["old_thumnail"];
            // control update banner
            $banner = "";
            if (!empty($_FILES["new_banner"]["name"])) $banner = handleUploadImage($_FILES["new_banner"]["tmp_name"]);
            else $banner = $_POST["old_banner"];

            // $sql_update = "UPDATE tbl_news ";
            // $sql_update .= "SET tittle_km= '{$_POST["new_tittle_km"]}', news_type= '{$_POST["new_news_type"]}', category= '{$_POST["new_category"]}', thumnail= '$thumnail', banner= '$banner', description= '{$_POST["new_description"]}' ";
            // $sql_update .= "WHERE id = '{$_GET["id"]}'";
            
            // $query_update = $db->query($sql_update);

            // Prepare the SQL query with placeholders
            $sql_update = "UPDATE tbl_news SET tittle_km = ?, news_type = ?, category = ?, thumnail = ?, banner = ?, description = ? WHERE id = ?";

            // Create a prepared statement
            $stmt = $db->prepare($sql_update);

            // Check if the statement was created successfully
            if ($stmt) {
                // Bind the parameters to the placeholders
                $stmt->bind_param("ssssssi", $_POST["new_tittle_km"], $_POST["new_news_type"], $_POST["new_category"], $thumnail, $banner, $_POST["new_description"], $_GET["id"]);

                // Execute the statement
                $query_update = $stmt->execute();

                // Close the statement
                $stmt->close();
            } else {
            // Handle the error
            echo "Error: " . $db->error;
            }

            if ($query_update) {
                echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Success",
                                    text: "News has been Updated",
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
                                    text: "Something went wrong, News cannot update",
                                    icon: "error",
                                });
                            })
                        </script>
                    ';
            }
        }
    }
    update_news_post();

    // accept remove post'
    function delete_news_post(){
        global $db;
        if(isset($_POST['accept_remove_post'])){
            $remove_id = $_POST['remove_id'];

            $sql = "DELETE FROM tbl_news WHERE id='$remove_id'";

            $result = $db->query($sql);
            
            if($result){
                echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Success",
                                    text: "News has been removed",
                                    icon: "success",
                                });
                            })
                        </script>
                    ';
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error",
                                text: "Somethings went wrong.",
                                icon: "error",
                            });
                        })
                    </script>
                    ';
            }
         }
    }
    delete_news_post();

    // add about us info
    function add_about_us_info() {
        global $db;
        if (isset($_POST['btn-add-info'])){
                $publisher_id = $_SESSION['id'];
                
                $sql_query = "INSERT INTO `tbl_about_us`(`description`, `publisher_id`) ";
                $sql_query .= "VALUES ('{$_POST["description"]}', '$publisher_id') ";
                
                $rs_query = $db->query($sql_query);

                if  ($rs_query) {
                    $query_id = "SELECT id FROM tbl_about_us ORDER BY id DESC LIMIT 1";
                    $query_id = $db->query($query_id);

                    $row_id = $query_id->fetch_assoc();

                    $sql_update = "UPDATE tbl_about_us SET status= 1 WHERE id NOT IN ('{$row_id["id"]}')"; 
                    $query_update = $db->query($sql_update);
                    echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Success",
                                    text: "Info has been published",
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
                                    text: "Something went wrong, Info cannot be published",
                                    icon: "error",
                                });
                            })
                        </script>
                    ';
                }
        }
    }
    add_about_us_info();

    // update aobut us info
    function update_about_us_info() {
        global $db;
        if (isset($_POST['btn-update-info'])) {

            $sql_update = "UPDATE tbl_about_us ";
            $sql_update .= "SET description= '{$_POST["description"]}' ";
            $sql_update .= "WHERE id = '{$_GET["id"]}'";
            
            $query_update = $db->query($sql_update);

            if ($query_update) {
                echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Success",
                                    text: "News has been Updated",
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
                                    text: "Something went wrong, News cannot update",
                                    icon: "error",
                                });
                            })
                        </script>
                    ';
            }
        }
    }
    update_about_us_info();

    // accept remove about us info
    function delete_about_us_info(){
        global $db;
        if(isset($_POST['accept_remove_info'])){
            $remove_id = $_POST['remove_id'];

            $sql = "DELETE FROM tbl_about_us WHERE id='$remove_id'";

            $result = $db->query($sql);
            
            if($result){
                echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Success",
                                    text: "About us info has been removed",
                                    icon: "success",
                                });
                            })
                        </script>
                    ';
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error",
                                text: "Somethings went wrong.",
                                icon: "error",
                            });
                        })
                    </script>
                    ';
            }
         }
    }
    delete_about_us_info();

    // accept remove users feedback
    function delete_users_feedback(){
        global $db;
        if(isset($_POST['accept_remove_feedback'])){
            $remove_id = $_POST['remove_id'];

            $sql = "DELETE FROM tbl_feedback WHERE id='$remove_id'";

            $result = $db->query($sql);
            
            if($result){
                echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Success",
                                    text: "Feedback has been removed",
                                    icon: "success",
                                });
                            })
                        </script>
                    ';
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error",
                                text: "Somethings went wrong.",
                                icon: "error",
                            });
                        })
                    </script>
                    ';
            }
         }
    }
    delete_users_feedback();

     // add social 
     function add_social() {
        global $db;
        if (isset($_POST['btn-add-social'])){
                $publisher_id = $_SESSION['id'];
                $logo = handleUploadImage($_FILES['social-logo']["tmp_name"]);
                
                $sql_query = "INSERT INTO `tbl_social`(`social_logo`, `label`, `url`, `publisher_id`, `location`) ";
                $sql_query .= "VALUES ('$logo', '{$_POST["social-name"]}', '{$_POST["social-link"]}', '$publisher_id', '{$_POST["location"]}') ";
                
                $rs_query = $db->query($sql_query);

                if  ($rs_query) {
                    echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Success",
                                    text: "New Social has been added",
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
                                    text: "Something went wrong.",
                                    icon: "error",
                                });
                            })
                        </script>
                    ';
                }
        }
    }
    add_social();

    // update social
    function update_social() {
        global $db;
        if (isset($_POST['btn-update-social'])) {

            if (!empty($_FILES["new-social-logo"]["name"])) $logo = handleUploadImage($_FILES["new-social-logo"]["tmp_name"]);
            else $logo = $_POST["old-social-logo"];

            $sql_update = "UPDATE tbl_social ";
            $sql_update .= "SET social_logo= '$logo', label= '{$_POST["new-social-name"]}', url= '{$_POST["new-social-link"]}', location= '{$_POST["new-location"]}' ";
            $sql_update .= "WHERE id = '{$_GET["id"]}'";
            
            $query_update = $db->query($sql_update);

            if ($query_update) {
                echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Success",
                                    text: "Social has been Updated",
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
                                    text: "Something went wrong",
                                    icon: "error",
                                });
                            })
                        </script>
                    ';
            }
        }
    }
    update_social();

    // accept remove social media
    function delete_social(){
        global $db;
        if(isset($_POST['accept_remove_social'])){
            $remove_id = $_POST['remove_id'];

            $sql = "DELETE FROM tbl_social WHERE id='$remove_id'";

            $result = $db->query($sql);
            
            if($result){
                echo '
                        <script>
                            $(document).ready(function(){
                                swal({
                                    title: "Success",
                                    text: "Social has been removed",
                                    icon: "success",
                                });
                            })
                        </script>
                    ';
            }
            else{
                echo '
                    <script>
                        $(document).ready(function(){
                            swal({
                                title: "Error",
                                text: "Somethings went wrong.",
                                icon: "error",
                            });
                        })
                    </script>
                    ';
            }
         }
    }
    delete_social();