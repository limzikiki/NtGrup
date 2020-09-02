		<script src='./js.js'></script>
		<script src="./splide-init.js"></script>
		<link rel='stylesheet' type='text/css' href='./style.css'>
		<title>NT Grup - Metālkonstrukcijas</title>
		<meta name="theme-color" contents="#9CC2CE">
		<link rel="alternate" hreflang="ru" href="ru/" />
		<link rel="alternate" hreflang="en" href="en" />
		<link rel="alternate" hreflang="lv" href="lv" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
		<link rel="stylesheet" href="./splide-styles.css">
		</head>

		<body>
			<section id="menu">
				<div id='menu-wrap'>
					<li class="menuval logo">
						<img src="./data/logs.png " id="logo">
					</li>
					<li class="menuval">
						<a class="mainlevel js-navLink" href="#aboutus"><?= $navigation[0]['title' . $lan] ?></a>
					</li>
					<li class="menuval">
						<a class="mainlevel js-navLink" href="#products"><?= $navigation[1]['title' . $lan] ?></a>
					</li>
					<li class="menuval">
						<a class="mainlevel js-navLink" href="#gallery"><?= $navigation[2]['title' . $lan] ?></a>
					</li>
					<li class="menuval">
						<a class="mainlevel js-navLink" href="#message_block"><?= $navigation[3]['title' . $lan] ?></a>
					</li>
					<li class="menuval languages">
						<div class="langbox">
							<a href='./lv' class="lang" id="lat">LAT</a>
						</div>
						<div class="langbox">
							<a href='./ru' class="lang" id="rus">RUS</a>
						</div>
						<div class="langbox">
							<a href='./en' class="lang" id="eng">ENG</a>
						</div>
					</li>
				</div>
			</section>
			<img src="<?php echo './cockpit/storage/uploads' . $background['image']['path']; ?>" id="img">
			<div class="premain">
				<div class="main">
					<div id="aboutus" align="justify">
						<div id="ab">
							<div id="abtext">
								<h1 id="abouth1">
									<?= $navigation[0]['title' . $lan] ?>
								</h1>
								<?= $content[0]['text' . $lan] ?>
							</div>
							<script>
								var creationDate = new Date(2007, 5, 21);
								var date = new Date();
								var thisYear = Math.floor((date.valueOf() - creationDate.valueOf()) / (86400 * 1000 * 365));
								$("#years").html(thisYear);
							</script>
						</div>
						<div id="precomp">
							<div class="companies">
								<div id="logocontainer">
									<div class="logos">
										<img src="./data/logos/laima.png" class="lg" id="">
									</div>
									<div class="logos" id="">
										<img src="./data/logos/gut.png" class="lg" id="">
									</div>
									<div class="logos">
										<img src="./data/logos/lnk.png" class="lg" id="">
									</div>
									<div class="logos">
										<img src="./data/logos/idl.png" class="lg" id="">
									</div>
									<div class="logos">
										<img src="./data/logos/velve.svg" class="lg" id="">
									</div>
									<div class="logos">
										<img src="./data/logos/csdd.svg" class="lg" id="">
									</div>
									<div class="logos" id="1logo">
										<img src="./data/logos/stb.png" class="lg" id="">
									</div>
									<div class="logos">
										<img src="./data/logos/logo.png" class="lg" id="">
									</div>
									<div class="logos">
										<img src="./data/logos/car.png" class="lg" id="">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="products">
						<div id="prodText">
							<?php
							foreach ($products as $product) {
							?>
								<div class="prodText">
									<?php
									echo $product["content$lan"];
									?>
								</div>
							<?php
							}
							?>
						</div>
					</div>
					<div id="gallery">
						<h1 id="galleryTitle"><?= $navigation[2]['title' . $lan] ?></h1>
						<div class="splide">
							<div id="galleryMenu" class="splide__track">
								<div class="splide__list">
									<?php
									foreach ($gallery['image'] as $value) {
										echo '
										<div class="ph splide__slide">
											<img class="phImg" src=".' . $value['path'] . '"> 
								    	</div>
									';
									}
									?>
								</div>
							</div>
						</div>
					</div>
					<div id="message_block">
						<div id="blocks">
							<div class="block">
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
							</div>
							<div class="block">
								<div class="innerBlock">
									<span class="blockTitle"><?= $form_translation[0]['field' . $lan] ?></span>
									<br>
									<p id="email_about">
										<?= $form_translation[1]['field' . $lan] ?>
									</p>
									<form id="email">
										<?= $form_translation[2]['field' . $lan] ?>:
										<p>
											<input type="text" name="name" require placeholder="<?= $form_translation[2]['field' . $lan] ?>" class="inputText topInp" id="name">
										</p>
										<?= $form_translation[3]['field' . $lan] ?>:
										<p>
											<input type="email" name="email" require class="inputText topInp" placeholder="<?= $form_translation[3]['field' . $lan] ?>">
										</p>
										<?= $form_translation[4]['field' . $lan] ?>:
										<p><textarea name="message" rows="5" require cols="27" class="inputText textarea" placeholder="<?= $form_translation[4]['field' . $lan] ?>" height="100px"></textarea></p>
										<input id="send" type='submit' value="<?= $form_translation[5]['field' . $lan] ?>">
										<p id='succes'><?= $form_translation[6]['field' . $lan] ?></p>
										<p id='fail'><?= $form_translation[7]['field' . $lan] ?></p>
									</form>
								</div>
							</div>
						</div>
					</div>
					<footer>
						ntgrup.lv © Copyright NTGrup <?php echo date("Y") ?>
					</footer>
				</div>
			</div>
			<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
		</body>

		</HTML>