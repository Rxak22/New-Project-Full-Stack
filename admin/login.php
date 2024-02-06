<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
    require('db-connect.php');
    session_start();
    if (isset($_POST["btn_login"])){
            $password = md5($_POST["password"]);

            $sql = "SELECT id FROM  tbl_users WHERE email= '{$_POST["name_email"]}' AND password= '$password' ";
            $query = $db->query($sql); 
            
            $result = mysqli_fetch_assoc($query);
            
            if ($result){
                // echo $result["id"];
                // have issues with username
                $_SESSION["id"] = $result['id'];
                header('location: index.php');
                exit();
            } else {
                echo '
                <script>
                    $(document).ready(function() {
                        swal("Failed", "Incorrect email or password", "error");
                    });
                </script>
            ';
            }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Login</title>
    <link rel="stylesheet" href="assets/style/theme.css">
</head>
<style>
    .content {
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 350px;
            padding: 20px;
            border-radius: 20px;
            position: relative;
            background-color: #1a1a1a;
            color: #fff;
            border: 1px solid #333;
        }

    .title {
    font-size: 28px;
    font-weight: 600;
    letter-spacing: -1px;
    position: relative;
    display: flex;
    align-items: center;
    padding-left: 30px;
    color: #00bfff;
    }

    .title::before {
    width: 18px;
    height: 18px;
    }

    .title::after {
    width: 18px;
    height: 18px;
    animation: pulse 1s linear infinite;
    }

    .title::before,
    .title::after {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    border-radius: 50%;
    left: 0px;
    background-color: #00bfff;
    }

    .message, 
    .signin {
    font-size: 14.5px;
    color: rgba(255, 255, 255, 0.7);
    }

    .signin {
    text-align: center;
    }

    .signin a:hover {
    text-decoration: underline royalblue;
    }

    .signin a {
    color: #00bfff;
    }

    .flex {
    display: flex;
    width: 100%;
    gap: 6px;
    }

    .form label {
    position: relative;
    }

    .form label .input {
    background-color: #333;
    color: #fff;
    width: 100%;
    padding: 20px 05px 05px 10px;
    outline: 0;
    border: 1px solid rgba(105, 105, 105, 0.397);
    border-radius: 10px;
    }
    .form label .input + span {
    color: rgba(255, 255, 255, 0.5);
    position: absolute;
    left: 10px;
    top: 0px;
    font-size: 0.9em;
    cursor: text;
    transition: 0.3s ease;
    }

    .form label .input:placeholder-shown + span {
    top: 12.5px;
    font-size: 0.9em;
    }

    .form label .input:focus + span,
    .form label .input:valid + span {
    color: #00bfff;
    top: 0px;
    font-size: 0.7em;
    font-weight: 600;
    }

    .input {
    font-size: medium;
    }

    .submit {
    border: none;
    outline: none;
    padding: 10px;
    border-radius: 10px;
    color: #fff;
    font-size: 16px;
    transform: .3s ease;
    background-color: #00bfff;
    }

    .submit:hover {
    background-color: #00bfff96;
    }
    .btn-donate {
    --clr-font-main: hsla(0 0% 20% / 100);
    --btn-bg-1: hsla(194 100% 69% / 1);
    --btn-bg-2: hsla(217 100% 56% / 1);
    --btn-bg-color: hsla(360 100% 100% / 1);
    --radii: 0.5em;
    cursor: pointer;
    padding: 0.9em 1.4em;
    min-width: 120px;
    min-height: 44px;
    font-size: var(--size, 1rem);
    font-family: "Segoe UI", system-ui, sans-serif;
    font-weight: 500;
    transition: 0.8s;
    background-size: 280% auto;
    background-image: linear-gradient(325deg, var(--btn-bg-2) 0%, var(--btn-bg-1) 55%, var(--btn-bg-2) 90%);
    border: none;
    border-radius: var(--radii);
    color: var(--btn-bg-color);
    box-shadow: 0px 0px 20px rgba(71, 184, 255, 0.5), 0px 5px 5px -1px rgba(58, 125, 233, 0.25), inset 4px 4px 8px rgba(175, 230, 255, 0.5), inset -4px -4px 8px rgba(19, 95, 216, 0.35);
    }

    .btn-donate:hover {
    background-position: right top;
    }

    .btn-donate:is(:focus, :focus-visible, :active) {
    outline: none;
    box-shadow: 0 0 0 3px var(--btn-bg-color), 0 0 0 6px var(--btn-bg-2);
    }

    @media (prefers-reduced-motion: reduce) {
    .btn-donate {
        transition: linear;
    }
    }

    @keyframes pulse {
    from {
        transform: scale(0.9);
        opacity: 1;
    }

    to {
        transform: scale(1.8);
        opacity: 0;
    }
    }
</style>
<body>
    <div class="content bg-dark">
        <form class="form bg-dark" method="post" enctype="multipart/form-data">
            <p class="title">Sign in</p>
            <label>
                <input class="input" type="email" placeholder="" required="" name="name_email">
                <span>Email</span>
            </label> 
                
            <label>
                <input class="input" type="password" placeholder="" required="" name="password">
                <span>Password</span>
            </label>
            <button type="submit" name="btn_login" class="btn-donate">Log in</button>
            <p class="signin">Don't have an acount ? <a href="register.php">Create</a> </p>
        </form>
    </div>
</body>
</html>