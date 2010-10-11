<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//<?PHP echo Magazine::getMagazineLanguage() ?>" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head profile="http://gmpg.org/xfn/11">

        <meta name="keywords" content="<?PHP echo $this->metakeywords; ?>" />
        <meta name="description" content="<?PHP echo $this->metadescritpion; ?>" />

        <title><?PHP echo $this->title?></title>

        <link rel="stylesheet" href="<?PHP echo URIMaker::templatePath('style.css') ?>" type="text/css" media="screen" />

        </style>
    </head>

    <body>

        <div id="header">
            <a href="<?PHP echo URIMaker::index() ?>"><?PHP echo Magazine::getMagazineTitle() ?></a><br />
	<?PHP echo Magazine::getMagazineDescription() ?>
        </div>

        <div id="navbar">
            <ul>
                <li><a href="<?PHP echo URIMaker::index() ?>">Home</a></li>
                <li><a href="<?PHP echo URIMaker::people() ?>">People</a></li>
                <li><a href="<?PHP echo URIMaker::numberslist() ?>">Numbers</a></li>
                <?
                foreach ($this->pages as $page) {
                    echo '<li><a href="'.URIMaker::page($page).'">'.$page->getTitle().'</a></li>';
                }
                ?>
            </ul>
        </div>

        <div id="wrap">