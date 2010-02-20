<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//<?= Magazine::getMagazineLanguage() ?>" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head profile="http://gmpg.org/xfn/11">

        <meta name="keywords" content="<?= $this->metakeywords; ?>" />
        <meta name="description" content="<?= $this->metadescritpion; ?>" />

        <title><?= $this->title?></title>

        <link rel="stylesheet" href="<?= URIMaker::templatePath('style.css') ?>" type="text/css" media="screen" />

        </style>
    </head>

    <body>

        <div id="header">
            <a href="<?= URIMaker::index() ?>"><?= Magazine::getMagazineTitle() ?></a><br />
	<?= Magazine::getMagazineDescription() ?>
        </div>

        <div id="navbar">
            <ul>
                <li><a href="<?= URIMaker::index() ?>">Home</a></li>
                <li><a href="<?= URIMaker::people() ?>">People</a></li>
                <li><a href="<?= URIMaker::numberslist() ?>">Numbers</a></li>
                <?
                foreach ($this->pages as $page) {
                    echo '<li><a href="'.URIMaker::page($page).'">'.$page->getTitle().'</a></li>';
                }
                ?>
            </ul>
        </div>

        <div id="wrap">