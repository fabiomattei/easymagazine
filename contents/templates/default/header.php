<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head profile="http://gmpg.org/xfn/11">

        <title>Easy Magazine</title>

        <link rel="stylesheet" href="<?= URIMaker::fromBasePath() ?>contents/templates/default/style.css" type="text/css" media="screen" />

    </head>

    <body>

        <div ><a name='up' id='up'></a></div>
        <div id="wrapper">

            <div id="header">

                <ul id="nav">

                    <li class="page_item"><a href="index.php">Home</a></li>

                    <?
                    foreach (Page::findAllOrdered() as $page) {
                         echo '<li class="page_item"><a href="'.URIMaker::page($page).'">'.$page->getTitle().'</a></li>';
                    }
                    ?>

                </ul>

                <p class="description">
                    Little Magazine Description
                </p>

                <h1><a href="info.html">Magazine Title</a></h1>

            </div>