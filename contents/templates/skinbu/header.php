<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title><?= $this->title?></title>
        <meta name="keywords" content="<?= $this->metakeywords; ?>" />
        <meta name="description" content="<?= $this->metadescritpion; ?>" />
        <link rel="stylesheet" href="<?= URIMaker::fromBasePath('contents/templates/skinbu/style.css') ?>" type="text/css" />
        <link rel="shortcut icon" href="<?= URIMaker::fromBasePath('contents/templates/skinbu/images/favicon.ico') ?>" />
        <link rel="alternate" type="application/rss+xml" title="RSS 1.0" href="<?= URIMaker::rssFeed()?>" />
    </head>

    <body>
        <!-- HEADER -->
        <div id="container">

            <div id="header">

                <div id="raccoglitore">
                    <div id="logo"><h1><a href="<?= URIMaker::fromBasePath('index.php') ?>" title="<?= Magazine::getMagazineDescription() ?>"><?= Magazine::getMagazineTitle() ?></a></h1><h2><?= Magazine::getMagazineDescription() ?></h2></div>
                    <div id="rss"><a href="<?= URIMaker::rssFeed()?>" ><img alt="Tieniti sempre aggiornato sulle ultime di Skimbu!" src="<?= URIMaker::fromBasePath('contents/templates/skinbu/images/rss.png') ?>" /></a></div>
                </div>
                <div id="navbar_top"></div>
                <div id="navbar">
                    <ul>
                        <li class="page_item"><a id="linkbutton" href="<?= URIMaker::fromBasePath('index.php') ?>">Home</a></li>
                        <li class="page_item"><a id="linkbutton" href="<?= URIMaker::people() ?>">People</a></li> 
                        <li class="page_item"><a id="linkbutton" href="<?= URIMaker::numberslist() ?>">Numbers</a></li>
                        <?
                        foreach ($this->pages as $page) {
                            echo '<li class="page_item"><a id="linkbutton" href="'.URIMaker::page($page).'">'.$page->getTitle().'</a></li>';
                        }
                        ?>
                    </ul>
                </div>
                <div id="navbar_bottom"></div>
            </div>

            <div id="content">
                <!-- END HEADER -->

