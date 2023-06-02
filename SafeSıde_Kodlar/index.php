<?php
include 'baglan.php';
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAFESIDE</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="form.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <div class="main">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="navbar">
                        <div class="logo">
                            <a href="#">SAFESIDE</a>
                        </div>
                        <ul>
                            <li><a href="index.php">Ana Sayfa</a></li>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="signup-form">
                        <h1>Sorgulamak İstediğiniz Verileri Giriniz</h1>
                        <form action="index.php" method="GET">
                            <input type="text" maxlength="11" name="tc" placeholder="T.C No" class="txt">
                            <input type="text" maxlength="11" name="tel" placeholder="Telefon Numarası" class="txt">
                            <input type="text" maxlength="100" name="mail" placeholder="E-posta" class="txt">
                            <input type="text" maxlength="16" name="kart" placeholder="Kart Bilgisi" class="txt">
                            <input type="submit" value="Veri İhlali Ara">
                        </form>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8" style="margin-top: 5%;">
                            <?php
                            $matchFound = (isset($_GET["tc"]) && isset($_GET["tel"]) && isset($_GET["mail"]) && isset($_GET["kart"]));
                            if ($matchFound) {
                                echo "
                                <table class='table table-dark'>
                                    <thead>
                                        <tr>
                                            <th>Kullanilan Site</th>
                                            <th>T.C No</th>
                                            <th>Telefon Numarasi</th>
                                            <th>E-posta</th>
                                            <th>Kart Bilgisi</th>
                                        </tr>
                                    </thead>";
                       
                                $sorguString = "SELECT * FROM veriler WHERE";
                                $sorguStatus = 0;

                                if (!empty($_GET['mail'])) {
                                    $sorguString = $sorguString . " mail='" . $_GET["mail"] . "'";
                                    $sorguStatus += 1;
                                }

                                if (!empty($_GET['kart'])) {  
                                    if($sorguStatus > 0){
                                        $sorguString = $sorguString . " OR";
                                    }
                                    $sorguString = $sorguString . " kart='" . $_GET["kart"] . "'";
                                    $sorguStatus += 1;
                                }

                                if (!empty($_GET['tel'])) {
                                    if($sorguStatus > 0){
                                        $sorguString = $sorguString . " OR";
                                    }
                                    $sorguString = $sorguString . " tel='" . $_GET["tel"] . "'";
                                    $sorguStatus += 1;
                                }

                                if (!empty($_GET['tc'])) {
                                    if($sorguStatus > 0){
                                        $sorguString = $sorguString . " OR";
                                    }
                                    $sorguString = $sorguString . " tc='" . $_GET["tc"] . "'";
                                    $sorguStatus += 1;
                                }

                                if ($sorguStatus) {
                                    $sorgu = $db->query($sorguString);

                                    if ($db->errno > 0) {
                                        die("<b>Sorgu Hatası:</b> " . $db->error);
                                    }

                                    while ($cikti = $sorgu->fetch_array()) {
                                        echo "<tr>
                                                    <td>" . $cikti["kullanilan_site"] . "</td>
                                                    <td>" . $cikti["tc"] . "</td>
                                                    <td>" . $cikti["tel"] . "</td>
                                                    <td>" . $cikti["mail"] . "</td>
                                                    <td>" . $cikti["kart"] . "</td>
                                            </tr>";
                                    }

                                    $sorgu->close();
                                    $db->close();
                        
                                }
                                echo "</table>";
                            }
                            ?>
                        </div>
                        <div class="col-sm-2"></div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
</body>

</html>