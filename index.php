<!DOCTYPE html>
<html>
<head>
    <title>Google API URL Shortener</title>
    <style>
        .google-api{width:400px;margin:auto;padding:10px 30px 30px;background:#ddd;box-shadow: 3px 3px 5px #888;}
        .input-tbl{padding: 20px 0;}
        input[type="submit"]{padding: 4px 20px;margin-top: 5px;cursor: pointer;}
        input[type="text"]{padding: 4px 5px;}
    </style>
</head>
<body>
    <div class="google-api">
        <h2>Google API URL Shortener</h2>
        <?php

            if(!empty($_POST['url'])){

                $longUrl = $_POST['url'];

                $apiKey  = 'AIzaSyBvaOFhJlGOg6rZ5gHHQwd9-DXB_VIsng4'; 
                
                $postData = array('longUrl' => $longUrl);
                $jsonData = json_encode($postData);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url?key='.$apiKey);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                $response = curl_exec($ch);
                $json = json_decode($response);
                
                // print_r($json);

                curl_close($ch);
                echo '<h4>Shortened URL : <u>'.$json->id.'</u></h4>';
            }

        ?>
        <form action="" method="post" accept-charset="utf-8">
            <table class="input-tbl">
                <tr>
                    <td>Input LongURL: </td>
                    <td><input type="text" name="url"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Submit"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
