<?php 
    session_set_cookie_params(7*24*60*60);
    session_start();
    ini_set('display_errors', 0);
    if (!$_SESSION["id"]){
        header('location: login.php');
        exit();
    }
    include('sidebar.php');
    require('db-connect.php');


    // handle new post and total views
    $sql_query ="SELECT views FROM tbl_news"; 
    $result = mysqli_query($db, $sql_query);    

    $count_post = 0;
    $views = 0;
    while ($row = mysqli_fetch_assoc($result)){
      $count_post +=1;
      $views += $row['views'];
    }

    // fetch value total admin count
    $sql_admin ="SELECT id FROM tbl_users"; 
    $result_admin = mysqli_query($db, $sql_admin);    

    $count_admin = 0;
    while ($row = mysqli_fetch_assoc($result_admin)){
      $count_admin +=1;
    }
?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .sumarize {
        width: 100%;
        height: auto;
        display: flex;
        justify-content: space-between;
        gap: 1.5rem;
        /* border: 1px solid #A9A9A9; */
    }
    .sumarize .item {
        width: calc(100%/3);
        box-shadow: 1px 1px 5px #A9A9A9;
        display: flex;
        justify-content: space-between;
        padding: 0.3rem 0.5rem;
        background: white;
        border-radius: 0.2rem;
    }
    .sumarize .item .left-side h6 {
      font-weight: bold;
      padding: 0;
      margin: 0;
      font-family: 'tahoma';
      color: #000080;
    }
    .sumarize .item .left-side p {
      font-size: 3rem;
      font-weight: bold;
      height: 55px;
      padding: 0;
      margin: 0;
    }
    .sumarize .item .left-side  span{
      color: #32CD32;
      font-weight: bold;
    }
    #chart-container {
                        width: 100%;
                        height: auto;
                      }
                      .card {
                        position: relative;
                        display: -webkit-box;
                        display: -ms-flexbox;
                        display: flex;
                        -webkit-box-orient: vertical;
                        -webkit-box-direction: normal;
                        -ms-flex-direction: column;
                        flex-direction: column;
                        min-width: 0;
                        word-wrap: break-word;
                        background-color: #fff;
                        background-clip: border-box;
                        border: 1px solid rgba(0, 0, 0, 0.125);
                        border-radius: 0.25rem;
                      }
                      .card-body {
                        -webkit-box-flex: 1;
                        -ms-flex: 1 1 auto;
                        flex: 1 1 auto;
                        padding: 1.25rem;
                      }
  .table-chart { 
    display:flex;
    justify-content: space-between;
   }
  .table-chart .tbl{
    width: 60%;
  }
  .table-chart .chart{
    width: 35%;
  }
</style>

                <div class="col-10">
                    <div class="content-right">
                        <div class="top">
                            <h3 class="text-center">Admin Dashboard</h3>
                        </div>
                        <div class="bottom view-post">
                                <div class="sumarize mb-5">
                                    <div class="item">
                                        <div class="left-side">
                                            <h6>Admin</h6>
                                            <p><?php echo $count_admin; ?></p>
                                            <span>person</span>                                        
                                        </div>
                                        <img width="70px" src="assets/icon/user1.svg" alt="">
                                    </div>
                                    <div class="item">
                                        <div class="left-side">
                                            <h6>News post</h6>
                                            <p><?php echo $count_post; ?></p>    
                                            <span>post</span>                                    
                                        </div>
                                        <img width="65px" src="assets/icon/post.svg" alt="">
                                    </div>
                                    <div class="item">
                                        <div class="left-side">
                                            <h6>Total Views</h6>
                                            <p><?php echo $views; ?></p>
                                            <span>view</span>                                        
                                        </div>
                                        <img width="100px" src="assets/icon/chart.svg" alt="">
                                    </div>
                                </div>
                                <!-- display chart -->
                                <div class="table-chart">
                                  <div class="tbl mt-5">
                                    <table class="table-hover table-dark table table-striped">
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Cetegory</th>
                                        <th scope="col">Views</th>
                                      </tr>
                                      <?php
                                        $sql = "SELECT tittle_km, id, news_type, category, views FROM tbl_news ORDER BY views DESC LIMIT 5";
                                        $query = mysqli_query($db, $sql);
                                        while ($row = mysqli_fetch_assoc($query)){
                                      ?>
                                      <tr class="table-row table-secondary">
                                        <th scope="row"><?php echo $row["id"]; ?></th>
                                        <td><p style="overflow: hidden;
                                                      display: -webkit-box;
                                                      -webkit-line-clamp: 1; /* number of lines to show */
                                                              line-clamp: 1; 
                                                      -webkit-box-orient: vertical;">
                                                <?php echo $row["tittle_km"]; ?></p></td>
                                        <td><?php echo $row["news_type"]; ?></td>
                                        <td><?php echo $row["category"]; ?></td>
                                        <td><?php echo $row["views"]; ?></td>
                                      </tr>
                                      <?php
                                        }
                                        mysqli_close($db);
                                      ?>
                                    </table>
                                  </div>
                                  <div class="chart">
                                      <div class="card-body">
                                        <div class="card"  id="chart-container">
                                            <canvas id="graphCanvas"></canvas>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script type="text/javascript">
                      $(document).ready(function(){
                        $.ajax({
                          url: "donut/data.php",
                          method: "GET",
                          success: function(data){
                            console.log(data);
                            var sport = 0;
                            var social = 0;
                            var intertainment = 0;
                            for (var i in data){
                              if (data[i].news_type == "sport")
                                sport = sport + parseInt(data[i].views);
                              else if (data[i].news_type == "social") 
                                social = social + parseInt(data[i].views);
                              else if (data[i].news_type == "intertainment") 
                                intertainment = intertainment + parseInt(data[i].views);
                            }
                            var views = [
                              sport,
                              social,
                              intertainment
                            ];

                            console.log(views);
                            var chartdata = {
                              labels: ["Sport", "Social", "Intertainment"],
                              datasets: [{
                                label: 'Total Views',
                                backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                                hoverBackgroundColor: 'rgba(230, 236, 235, 0.75)',
                                hoverBorderColor: 'rgba(230, 236, 235, 0.75)',
                                data: views

                              }]
                            };

                            var graphTarget = $("#graphCanvas");
                            var barGraph = new Chart(graphTarget, {
                              type: 'doughnut',
                              data: chartdata
                            });
                          },
                          error: function(data) {
                            console.log(data);
                          }

                        });
                      });
                    </script>
</html>