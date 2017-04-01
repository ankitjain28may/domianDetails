<?php
$domain = "";
if (isset($_POST['submit'])) {
    $domain = $_POST['domain'];
    $token = "usemeforfree";
    $url = "http://api.bulkwhoisapi.com/whoisAPI.php";
    $data = "?domain=".$domain."&type=whois&token=".$token;
    $headr = array();
    $headr[] = 'Accept: application/json';

    // $data = array("To" => "Mobile-No", "From" => "Twilio-Mobile-No" , "Body" => "Message");
    // $post = http_build_query($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url.$data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    $result = curl_exec($ch);

    $result = json_decode($result);
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
      <title>Bootstrap Example</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <style type="text/css">
          footer {
                background-color: #2d2d30;
                color: #f5f5f5;
                position: relative;
                padding: 10px;
                width: 100%;
                height: 40px;
                font-size: 14px;
            }
            footer a {
                color: #f5f5f5;
            }
            footer a:hover {
                color: #777;
                text-decoration: none;
            }
      </style>
    </head>

    <body>

        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Domain Details</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <!-- <li class="active"><a href="#">Home</a></li> -->
               <!--  <li><a href="#">Page 1</a></li>
               <li><a href="#">Page 2</a></li>
               <li><a href="#">Page 3</a></li> -->
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <!-- <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li> -->
                <!-- <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->
              </ul>
            </div>
          </div>
        </nav>


        <div class="container">
            <h2>Get Domain Information</h2>
            <br>
            <form method="post" action="">
                <div class="form-group">
                    <label for="domain">Enter the name of the Domain or IP:</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="domain" name="domain" value="<?php echo $domain; ?>">
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-success" name="submit">Success</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
              <table class="table .table-condensed table-hover">
                <tbody>
            <?php
                if (@$result->response_code == "success") {
                $info = $result->formatted_data;
                foreach ($info as $key => $value) {
            ?>

                      <tr>
                        <td><?php echo $key.":"; ?></td>
                        <td><?php echo $value; ?></td>
                      </tr>

            <?php
                    }
            ?>
                    </tbody>
              </table>
            </div>
            <?php
                } else {
            ?>
            <div> This domain is not found </div>
            <?php
            }
            ?>

        </div>

        <!-- Footer -->
        <footer class="text-center">
          <p>&copy; Made by - <a href="https://ankitjain28may.github.io" data-toggle="tooltip" title="Visit w3schools">Ankit Jain</a></p>
        </footer>
    </body>
</html>