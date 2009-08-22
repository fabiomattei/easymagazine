<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head profile="http://gmpg.org/xfn/11">

        <meta name="keywords" content="<?= $this->metakeywords; ?>" />

        <meta name="description" content="<?= $this->metadescritpion; ?>" />

        <title>My magazine</title>
        <!-- leave this for stats please -->

        <link rel="stylesheet" href="<?= URIMaker::fromBasePath('contents/templates/easy/style.css') ?>" type="text/css" media="screen" />

        </style>
    </head>

    <body>

        <div id="header">
            <a href="<?= URIMaker::fromBasePath('index.php') ?>/">My magazine</a><br />
	A little something about the magazine and the authors. Nothing lengthy, just an overview.
        </div>

        <div id="navbar">
            <ul>
                <li><a href="<?= URIMaker::fromBasePath('index.php') ?>">Home</a></li>
                <li><a href="<?= URIMaker::people() ?>">People</a></li>

                <?
                foreach (Page::findAllPublishedOrdered() as $page) {
                    echo '<li><a href="'.URIMaker::page($page).'">'.$page->getTitle().'</a></li>';
                }
                ?>
            </ul>
        </div>

        <div id="wrap">