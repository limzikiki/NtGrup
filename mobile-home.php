<title>NT Grup - Metala</title>
<meta http-equiv="Cache-Control" content="no-cache">
<!-- перед выклаыванием стоит удаление строку с верху чтобы страница кешировалась-->
<meta name="viewport" content="width=device-width, initial-scale=1, height=device-height">
<link rel="alternate" hreflang="ru" href="ru" />
<link rel="alternate" hreflang="en" href="en" />
<link rel="alternate" hreflang="lv" href="lv" />
<link rel="stylesheet" href="normalize.css">
<script src='./mob-js.js'></script>
<link rel='stylesheet' type='text/css' href='./mob-style.css'>

</head>

<body>
    <div id="main">
        <li id="langs">
            <div id="langform">
                <a href='./lv' class="lang" id="lat">LAT</a>
            </div>
            <div id="langform">
                <a href='./ru' class="lang" id="rus">RUS</a>
            </div>
            <div id="langform">
                <a href='./en' class="lang" id="eng">ENG</a>
            </div>
        </li>
        <div class="marker" id="scrolldown">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                <g>
                    <path d="m88.6,121.3c0.8,0.8 1.8,1.2 2.9,1.2s2.1-0.4 2.9-1.2c1.6-1.6 1.6-4.2 0-5.8l-51-51 51-51c1.6-1.6 1.6-4.2 0-5.8s-4.2-1.6-5.8,0l-54,53.9c-1.6,1.6-1.6,4.2 0,5.8l54,53.9z" />
                </g>
            </svg>
        </div>
        <div id="background">
            <img src="<?php echo './cockpit/storage/uploads' . $background['image']['path']; ?>" id="img">
        </div>
        <div id="about">
            <div id="aboutContent" class="content">
                <span class="text" id="textAbout">
                    <?= $content[0]['text' . $lan] ?>
                </span>
            </div>
        </div>
        <script>
            var creationDate = new Date(2007, 5, 21);
            var date = new Date();
            var thisYear = Math.floor((date.valueOf() - creationDate.valueOf()) / (86400 * 1000 * 365));
            $("#years").html(thisYear);
        </script>
        <div id="companies">
            <div class="logos">
                <img src="./data/mblogo/idl.png" class="lg" id="">
            </div>
            <div class="logos">
                <img src="./data/mblogo/velve.png" class="lg" id="">
            </div>
            <div class="logos">
                <img src="./data/mblogo/lnk.png" class="lg" id="">
            </div>
            <div class="logos">
                <img src="./data/mblogo/laima.png" class="lg" id="">
            </div>
            <div class="logos">
                <img src="./data/mblogo/logo.png" class="lg" id="">
            </div>
            <div class="logos">
                <img src="./data/mblogo/car.png" class="lg" id="">
            </div>
            <div class="logos">
                <img src="./data/mblogo/gut.png" class="lg" id="">
            </div>
        </div>
        <div id="products">
            <div id="prodContent" class="content">
                <div class="prod">
                    <div class="frameProd">
                        <img src="./data/hangar.jpg" class="prodImg">
                        <div class="prodText">
                            <?= $products[0]["content$lan"] ?>
                        </div>
                    </div>
                </div>
                <div class="prod">
                    <div class="frameProd">
                        <img src="./data/welding.jpg" class="prodImg">
                        <div class="prodText">
                            <?= $products[1]["content$lan"] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="gallery">
            <div class="marker" id="scrollGallery">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                    <g>
                        <path d="m88.6,121.3c0.8,0.8 1.8,1.2 2.9,1.2s2.1-0.4 2.9-1.2c1.6-1.6 1.6-4.2 0-5.8l-51-51 51-51c1.6-1.6 1.6-4.2 0-5.8s-4.2-1.6-5.8,0l-54,53.9c-1.6,1.6-1.6,4.2 0,5.8l54,53.9z" />
                    </g>
                </svg>
            </div>
            <div id="galleryInterface">
                <?php
                foreach ($gallery['image'] as $value) {
                    echo '<div class="photoCover"><img class="photo" src="' . $value['path']  . '" ></div>';
                }
                ?>
            </div>
        </div>
        <div id="contacts">
            <div id="emailsender">
                <h1 id="placemessageTitle" class="contTitles"><?= $form_translation[0]['field' . $lan] ?></h1>
                <form id="email">
                    <p>
                        <input type="text" name="name" require placeholder="<?= $form_translation[2]['field' . $lan] ?>" class="inputText topInp" id="name">
                    </p>
                    <p>
                        <input type="email" name="email" require class="inputText topInp" placeholder="<?= $form_translation[3]['field' . $lan] ?>">
                    </p>
                    <p><textarea name="message" rows="5" require cols="27" class="inputText textarea" placeholder="<?= $form_translation[4]['field' . $lan] ?>" height="100px"></textarea></p>
                    <input id="send" type='submit' value="<?= $form_translation[5]['field' . $lan] ?>">
                    <p id='succes'><?= $form_translation[6]['field' . $lan] ?></p>
                    <p id='fail'><?= $form_translation[7]['field' . $lan] ?></p>
                </form>
            </div>
            <br>
            <div class="innerBlock">
                <div id="contactsTitle" class="contTitles blockTitle"><?= $navigation[3]['title' . $lan] ?>
                </div>
                <div id="coverContacts">
                    <?php
                    foreach ($contacts as $contact) {
                    ?>
                        <span class="cont">
                            <?php
                            echo $contact['contact' . $lan]
                            ?>
                        </span>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <footer>
                ntgrup.lv © Copyright NTGrup <?php echo date("Y") ?>
            </footer>
        </div>
    </div>
</body>

</html>