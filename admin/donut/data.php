<?php
                  header('Content-Type: application/json');

                  $conn = mysqli_connect("localhost","root","","db_cms_news");

                  $sqlQuery = "SELECT views, news_type FROM tbl_news";

                  $result = mysqli_query($conn,$sqlQuery);

                  $data = array();
                  foreach ($result as $row) {
                    $data[] = $row;
                  }

                  mysqli_close($conn);

                  echo json_encode($data);
 ?>