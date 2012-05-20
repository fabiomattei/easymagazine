<?

/*
    Copyright (C) 2009-2010  Fabio Mattei <burattino@gmail.com>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title><?php echo LANG_ADMIN_TITLE; ?>: <?php echo LANG_MENU_SETTINGS; ?></title>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <style media="all" type="text/css">@import "../../resources/css/all.css";</style>
        <style media="all" type="text/css">@import "../../resources/css/messages.css";</style>
    </head>
    <body>
        <div id="main">
            <div id="header">
                <a href="#" class="logo"><img src="../../resources/img/logo_blu_arancio.gif" alt="" /></a>
                <ul id="top-navigation">
                    <li><span><span><a href="dashboard.php"><?php echo LANG_MENU_DASHBOARD; ?></a></span></span></li>
                    <li><span><span><a href="number.php"><?php echo LANG_MENU_NUMBERS; ?></a></span></span></li>
                    <li><span><span><a href="category.php"><?php echo LANG_MENU_CATEGORIES; ?></a></span></span></li>
                    <li><span><span><a href="article.php"><?php echo LANG_MENU_ARTICLES; ?></a></span></span></li>
                    <li><span><span><a href="page.php"><?php echo LANG_MENU_PAGES; ?></a></span></span></li>
                    <li><span><span><a href="comment.php"><?php echo LANG_MENU_COMMENTS; ?></a></span></span></li>
                    <li><span><span><a href="plugin.php"><?php echo LANG_MENU_PLUGIN; ?></a></span></span></li>
                    <li><span><span><a href="template.php"><?php echo LANG_MENU_TEMPLATE; ?></a></span></span></li>
					<li><span><span><a href="mobiletemplate.php"><?php echo LANG_MENU_MOBILE_TEMPLATE; ?></a></span></span></li>
                    <li class="active"><span><span><?php echo LANG_MENU_SETTINGS; ?></span></span></li>
                    <li><span><span><a href="user.php"><?php echo LANG_MENU_USERS; ?></a></span></span></li>
                </ul>
                <div id="logout"><a href="../../logout.php"><?php echo LANG_MENU_LOGOUT; ?></a></div>
            </div>
            <div id="middle">
                <div id="left-column">
                    <h3><?php echo LANG_LEFT_GREETINGS; ?>, <?PHP echo $_SESSION['user']->getName() ?></h3><br />
                    <a href="../../index.php" class="link"><?php echo LANG_LEFT_VIEW_WEBSITE; ?></a>
                </div>
                <div id="center-column">
                    <?
                    foreach ($infoarray as $info) {
                        echo '<div class="message info"><p><strong>'.LANG_MSG_INFO.':</strong>: '.$info.'</p></div>';
                    }
                    foreach ($warningarray as $warning) {
                        echo '<div class="message warning"><p><strong>'.LANG_MSG_WARNING.':</strong>: '.$warning.'</p></div>';
                    }
                    foreach ($questionarray as $question) {
                        echo '<div class="message question"><p><strong>'.LANG_MSG_QUESTION.':</strong>: '.$question.'</p></div>';
                    }
                    foreach ($errorarray as $error) {
                        echo '<div class="message error"><p><strong>'.LANG_MSG_ERROR.':</strong>: '.$error.'</p></div>';
                    }
                    ?>
                    <div class="table">
                        <img src="../../resources/img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
                        <img src="../../resources/img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
                        <form name="form1" enctype="multipart/form-data" method="post" action="settings.php?action=update">
                            <table class="listing form" cellpadding="0" cellspacing="0">
                                <tr>
                                    <th class="full" colspan="2"><?php echo LANG_MENU_SETTINGS; ?></th>
                                </tr>
                                <tr>
                                    <td class="first" width="172"><strong><?php echo LANG_ADMIN_TABLE_LANGUAGE; ?></strong></td>
                                    <td class="last">
                                        <select name="language">
                                            <option value="aa" <?if ($settingsindb['language']->getValue() == 'aa') echo 'selected';?> >Afar</option>
                                            <option value="ab" <?if ($settingsindb['language']->getValue() == 'ab') echo 'selected';?> >Abkhazian</option>
                                            <option value="af" <?if ($settingsindb['language']->getValue() == 'af') echo 'selected';?> >Afrikaans</option>
                                            <option value="ak" <?if ($settingsindb['language']->getValue() == 'ak') echo 'selected';?> >Akan</option>
                                            <option value="sq" <?if ($settingsindb['language']->getValue() == 'sq') echo 'selected';?> >Albanian</option>
                                            <option value="am" <?if ($settingsindb['language']->getValue() == 'am') echo 'selected';?> >Amharic</option>
                                            <option value="ar" <?if ($settingsindb['language']->getValue() == 'ar') echo 'selected';?> >Arabic</option>
                                            <option value="an" <?if ($settingsindb['language']->getValue() == 'an') echo 'selected';?> >Aragonese</option>
                                            <option value="hy" <?if ($settingsindb['language']->getValue() == 'hy') echo 'selected';?> >Armenian</option>
                                            <option value="as" <?if ($settingsindb['language']->getValue() == 'as') echo 'selected';?> >Assamese</option>
                                            <option value="av" <?if ($settingsindb['language']->getValue() == 'av') echo 'selected';?> >Avaric</option>
                                            <option value="ae" <?if ($settingsindb['language']->getValue() == 'ae') echo 'selected';?> >Avestan</option>
                                            <option value="ay" <?if ($settingsindb['language']->getValue() == 'ay') echo 'selected';?> >Aymara</option>
                                            <option value="az" <?if ($settingsindb['language']->getValue() == 'az') echo 'selected';?> >Azerbaijani</option>
                                            <option value="ba" <?if ($settingsindb['language']->getValue() == 'ba') echo 'selected';?> >Bashkir</option>
                                            <option value="bm" <?if ($settingsindb['language']->getValue() == 'bm') echo 'selected';?> >Bambara</option>
                                            <option value="eu" <?if ($settingsindb['language']->getValue() == 'eu') echo 'selected';?> >Basque</option>
                                            <option value="be" <?if ($settingsindb['language']->getValue() == 'be') echo 'selected';?> >Belarusian</option>
                                            <option value="bn" <?if ($settingsindb['language']->getValue() == 'bn') echo 'selected';?> >Bengali</option>
                                            <option value="bh" <?if ($settingsindb['language']->getValue() == 'bh') echo 'selected';?> >Bihari</option>
                                            <option value="bi" <?if ($settingsindb['language']->getValue() == 'bi') echo 'selected';?> >Bislama</option>
                                            <option value="bo" <?if ($settingsindb['language']->getValue() == 'bo') echo 'selected';?> >Tibetan</option>
                                            <option value="bs" <?if ($settingsindb['language']->getValue() == 'bs') echo 'selected';?> >Bosnian</option>
                                            <option value="br" <?if ($settingsindb['language']->getValue() == 'br') echo 'selected';?> >Breton</option>
                                            <option value="bg" <?if ($settingsindb['language']->getValue() == 'bg') echo 'selected';?> >Bulgarian</option>
                                            <option value="my" <?if ($settingsindb['language']->getValue() == 'my') echo 'selected';?> >Burmese</option>
                                            <option value="ca" <?if ($settingsindb['language']->getValue() == 'ca') echo 'selected';?> >Catalan; Valencian</option>
                                            <option value="cs" <?if ($settingsindb['language']->getValue() == 'cs') echo 'selected';?> >Czech</option>
                                            <option value="ch" <?if ($settingsindb['language']->getValue() == 'ch') echo 'selected';?> >Chamorro</option>
                                            <option value="ce" <?if ($settingsindb['language']->getValue() == 'ce') echo 'selected';?> >Chechen</option>
                                            <option value="zh" <?if ($settingsindb['language']->getValue() == 'zh') echo 'selected';?> >Chinese</option>
                                            <option value="cu" <?if ($settingsindb['language']->getValue() == 'cu') echo 'selected';?> >Church Slavic; Old Slavonic; Church Slavonic; Old Bulgarian; Old Church Slavonic</option>
                                            <option value="cv" <?if ($settingsindb['language']->getValue() == 'cv') echo 'selected';?> >Chuvash</option>
                                            <option value="kw" <?if ($settingsindb['language']->getValue() == 'kw') echo 'selected';?> >Cornish</option>
                                            <option value="co" <?if ($settingsindb['language']->getValue() == 'co') echo 'selected';?> >Corsican</option>
                                            <option value="cr" <?if ($settingsindb['language']->getValue() == 'cr') echo 'selected';?> >Cree</option>
                                            <option value="cy" <?if ($settingsindb['language']->getValue() == 'cy') echo 'selected';?> >Welsh</option>
                                            <option value="cs" <?if ($settingsindb['language']->getValue() == 'cs') echo 'selected';?> >Czech</option>
                                            <option value="da" <?if ($settingsindb['language']->getValue() == 'da') echo 'selected';?> >Danish</option>
                                            <option value="de" <?if ($settingsindb['language']->getValue() == 'de') echo 'selected';?> >German</option>
                                            <option value="dv" <?if ($settingsindb['language']->getValue() == 'dv') echo 'selected';?> >Divehi; Dhivehi; Maldivian</option>
                                            <option value="nl" <?if ($settingsindb['language']->getValue() == 'nl') echo 'selected';?> >Dutch; Flemish</option>
                                            <option value="dz" <?if ($settingsindb['language']->getValue() == 'dz') echo 'selected';?> >Dzongkha</option>
                                            <option value="el" <?if ($settingsindb['language']->getValue() == 'el') echo 'selected';?> >Greek, Modern (1453-)</option>
                                            <option value="en" <?if ($settingsindb['language']->getValue() == 'en') echo 'selected';?> >English</option>
                                            <option value="eo" <?if ($settingsindb['language']->getValue() == 'eo') echo 'selected';?> >Esperanto</option>
                                            <option value="et" <?if ($settingsindb['language']->getValue() == 'et') echo 'selected';?> >Estonian</option>
                                            <option value="eu" <?if ($settingsindb['language']->getValue() == 'eu') echo 'selected';?> >Basque</option>
                                            <option value="ee" <?if ($settingsindb['language']->getValue() == 'ee') echo 'selected';?> >Ewe</option>
                                            <option value="fo" <?if ($settingsindb['language']->getValue() == 'fo') echo 'selected';?> >Faroese</option>
                                            <option value="fa" <?if ($settingsindb['language']->getValue() == 'fa') echo 'selected';?> >Persian</option>
                                            <option value="fj" <?if ($settingsindb['language']->getValue() == 'fj') echo 'selected';?> >Fijian</option>
                                            <option value="fi" <?if ($settingsindb['language']->getValue() == 'fi') echo 'selected';?> >Finnish</option>
                                            <option value="fr" <?if ($settingsindb['language']->getValue() == 'fr') echo 'selected';?> >French</option>
                                            <option value="fy" <?if ($settingsindb['language']->getValue() == 'fy') echo 'selected';?> >Western Frisian</option>
                                            <option value="ff" <?if ($settingsindb['language']->getValue() == 'ff') echo 'selected';?> >Fulah</option>
                                            <option value="ka" <?if ($settingsindb['language']->getValue() == 'ka') echo 'selected';?> >Georgian</option>
                                            <option value="de" <?if ($settingsindb['language']->getValue() == 'de') echo 'selected';?> >German</option>
                                            <option value="gd" <?if ($settingsindb['language']->getValue() == 'gd') echo 'selected';?> >Gaelic; Scottish Gaelic</option>
                                            <option value="ga" <?if ($settingsindb['language']->getValue() == 'ga') echo 'selected';?> >Irish</option>
                                            <option value="gl" <?if ($settingsindb['language']->getValue() == 'gl') echo 'selected';?> >Galician</option>
                                            <option value="gv" <?if ($settingsindb['language']->getValue() == 'gv') echo 'selected';?> >Manx</option>
                                            <option value="el" <?if ($settingsindb['language']->getValue() == 'el') echo 'selected';?> >Greek, Modern (1453-)</option>
                                            <option value="gn" <?if ($settingsindb['language']->getValue() == 'gn') echo 'selected';?> >Guarani</option>
                                            <option value="gu" <?if ($settingsindb['language']->getValue() == 'gu') echo 'selected';?> >Gujarati</option>
                                            <option value="ht" <?if ($settingsindb['language']->getValue() == 'ht') echo 'selected';?> >Haitian; Haitian Creole</option>
                                            <option value="ha" <?if ($settingsindb['language']->getValue() == 'ha') echo 'selected';?> >Hausa</option>
                                            <option value="he" <?if ($settingsindb['language']->getValue() == 'he') echo 'selected';?> >Hebrew</option>
                                            <option value="hz" <?if ($settingsindb['language']->getValue() == 'hz') echo 'selected';?> >Herero</option>
                                            <option value="hi" <?if ($settingsindb['language']->getValue() == 'hi') echo 'selected';?> >Hindi</option>
                                            <option value="ho" <?if ($settingsindb['language']->getValue() == 'ho') echo 'selected';?> >Hiri Motu</option>
                                            <option value="hr" <?if ($settingsindb['language']->getValue() == 'hr') echo 'selected';?> >Croatian</option>
                                            <option value="hu" <?if ($settingsindb['language']->getValue() == 'hu') echo 'selected';?> >Hungarian</option>
                                            <option value="hy" <?if ($settingsindb['language']->getValue() == 'hy') echo 'selected';?> >Armenian</option>
                                            <option value="ig" <?if ($settingsindb['language']->getValue() == 'ig') echo 'selected';?> >Igbo</option>
                                            <option value="is" <?if ($settingsindb['language']->getValue() == 'is') echo 'selected';?> >Icelandic</option>
                                            <option value="io" <?if ($settingsindb['language']->getValue() == 'io') echo 'selected';?> >Ido</option>
                                            <option value="ii" <?if ($settingsindb['language']->getValue() == 'ii') echo 'selected';?> >Sichuan Yi</option>
                                            <option value="iu" <?if ($settingsindb['language']->getValue() == 'iu') echo 'selected';?> >Inuktitut</option>
                                            <option value="ie" <?if ($settingsindb['language']->getValue() == 'ie') echo 'selected';?> >Interlingue</option>
                                            <option value="ia" <?if ($settingsindb['language']->getValue() == 'ia') echo 'selected';?> >Interlingua (International Auxiliary Language Association)</option>
                                            <option value="id" <?if ($settingsindb['language']->getValue() == 'id') echo 'selected';?> >Indonesian</option>
                                            <option value="ik" <?if ($settingsindb['language']->getValue() == 'ik') echo 'selected';?> >Inupiaq</option>
                                            <option value="is" <?if ($settingsindb['language']->getValue() == 'is') echo 'selected';?> >Icelandic</option>
                                            <option value="it" <?if ($settingsindb['language']->getValue() == 'it') echo 'selected';?> >Italian</option>
                                            <option value="jv" <?if ($settingsindb['language']->getValue() == 'jv') echo 'selected';?> >Javanese</option>
                                            <option value="ja" <?if ($settingsindb['language']->getValue() == 'ja') echo 'selected';?> >Japanese</option>
                                            <option value="kl" <?if ($settingsindb['language']->getValue() == 'kl') echo 'selected';?> >Kalaallisut; Greenlandic</option>
                                            <option value="kn" <?if ($settingsindb['language']->getValue() == 'kn') echo 'selected';?> >Kannada</option>
                                            <option value="ks" <?if ($settingsindb['language']->getValue() == 'ks') echo 'selected';?> >Kashmiri</option>
                                            <option value="ka" <?if ($settingsindb['language']->getValue() == 'ka') echo 'selected';?> >Georgian</option>
                                            <option value="kr" <?if ($settingsindb['language']->getValue() == 'kr') echo 'selected';?> >Kanuri</option>
                                            <option value="kk" <?if ($settingsindb['language']->getValue() == 'kk') echo 'selected';?> >Kazakh</option>
                                            <option value="km" <?if ($settingsindb['language']->getValue() == 'km') echo 'selected';?> >Central Khmer</option>
                                            <option value="ki" <?if ($settingsindb['language']->getValue() == 'ki') echo 'selected';?> >Kikuyu; Gikuyu</option>
                                            <option value="rw" <?if ($settingsindb['language']->getValue() == 'rw') echo 'selected';?> >Kinyarwanda</option>
                                            <option value="ky" <?if ($settingsindb['language']->getValue() == 'ky') echo 'selected';?> >Kirghiz; Kyrgyz</option>
                                            <option value="kv" <?if ($settingsindb['language']->getValue() == 'kv') echo 'selected';?> >Komi</option>
                                            <option value="kg" <?if ($settingsindb['language']->getValue() == 'kg') echo 'selected';?> >Kongo</option>
                                            <option value="ko" <?if ($settingsindb['language']->getValue() == 'ko') echo 'selected';?> >Korean</option>
                                            <option value="kj" <?if ($settingsindb['language']->getValue() == 'kj') echo 'selected';?> >Kuanyama; Kwanyama</option>
                                            <option value="ku" <?if ($settingsindb['language']->getValue() == 'ku') echo 'selected';?> >Kurdish</option>
                                            <option value="lo" <?if ($settingsindb['language']->getValue() == 'lo') echo 'selected';?> >Lao</option>
                                            <option value="la" <?if ($settingsindb['language']->getValue() == 'la') echo 'selected';?> >Latin</option>
                                            <option value="lv" <?if ($settingsindb['language']->getValue() == 'lv') echo 'selected';?> >Latvian</option>
                                            <option value="li" <?if ($settingsindb['language']->getValue() == 'li') echo 'selected';?> >Limburgan; Limburger; Limburgish</option>
                                            <option value="ln" <?if ($settingsindb['language']->getValue() == 'ln') echo 'selected';?> >Lingala</option>
                                            <option value="lt" <?if ($settingsindb['language']->getValue() == 'lt') echo 'selected';?> >Lithuanian</option>
                                            <option value="lb" <?if ($settingsindb['language']->getValue() == 'lb') echo 'selected';?> >Luxembourgish; Letzeburgesch</option>
                                            <option value="lu" <?if ($settingsindb['language']->getValue() == 'lu') echo 'selected';?> >Luba-Katanga</option>
                                            <option value="lg" <?if ($settingsindb['language']->getValue() == 'lg') echo 'selected';?> >Ganda</option>
                                            <option value="mk" <?if ($settingsindb['language']->getValue() == 'mk') echo 'selected';?> >Macedonian</option>
                                            <option value="mh" <?if ($settingsindb['language']->getValue() == 'mh') echo 'selected';?> >Marshallese</option>
                                            <option value="ml" <?if ($settingsindb['language']->getValue() == 'ml') echo 'selected';?> >Malayalam</option>
                                            <option value="mi" <?if ($settingsindb['language']->getValue() == 'mi') echo 'selected';?> >Maori</option>
                                            <option value="mr" <?if ($settingsindb['language']->getValue() == 'mr') echo 'selected';?> >Marathi</option>
                                            <option value="ms" <?if ($settingsindb['language']->getValue() == 'ms') echo 'selected';?> >Malay</option>
                                            <option value="mk" <?if ($settingsindb['language']->getValue() == 'mk') echo 'selected';?> >Macedonian</option>
                                            <option value="mg" <?if ($settingsindb['language']->getValue() == 'mg') echo 'selected';?> >Malagasy</option>
                                            <option value="mt" <?if ($settingsindb['language']->getValue() == 'mt') echo 'selected';?> >Maltese</option>
                                            <option value="mo" <?if ($settingsindb['language']->getValue() == 'mo') echo 'selected';?> >Moldavian</option>
                                            <option value="mn" <?if ($settingsindb['language']->getValue() == 'mn') echo 'selected';?> >Mongolian</option>
                                            <option value="mi" <?if ($settingsindb['language']->getValue() == 'mi') echo 'selected';?> >Maori</option>
                                            <option value="ms" <?if ($settingsindb['language']->getValue() == 'ms') echo 'selected';?> >Malay</option>
                                            <option value="my" <?if ($settingsindb['language']->getValue() == 'my') echo 'selected';?> >Burmese</option>
                                            <option value="na" <?if ($settingsindb['language']->getValue() == 'na') echo 'selected';?> >Nauru</option>
                                            <option value="nv" <?if ($settingsindb['language']->getValue() == 'nv') echo 'selected';?> >Navajo; Navaho</option>
                                            <option value="nr" <?if ($settingsindb['language']->getValue() == 'nr') echo 'selected';?> >Ndebele, South; South Ndebele</option>
                                            <option value="nd" <?if ($settingsindb['language']->getValue() == 'nd') echo 'selected';?> >Ndebele, North; North Ndebele</option>
                                            <option value="ng" <?if ($settingsindb['language']->getValue() == 'ng') echo 'selected';?> >Ndonga</option>
                                            <option value="ne" <?if ($settingsindb['language']->getValue() == 'ne') echo 'selected';?> >Nepali</option>
                                            <option value="nl" <?if ($settingsindb['language']->getValue() == 'nl') echo 'selected';?> >Dutch; Flemish</option>
                                            <option value="nn" <?if ($settingsindb['language']->getValue() == 'nn') echo 'selected';?> >Norwegian Nynorsk; Nynorsk, Norwegian</option>
                                            <option value="nb" <?if ($settingsindb['language']->getValue() == 'nb') echo 'selected';?> >Bokmål, Norwegian; Norwegian Bokmål</option>
                                            <option value="no" <?if ($settingsindb['language']->getValue() == 'no') echo 'selected';?> >Norwegian</option>
                                            <option value="ny" <?if ($settingsindb['language']->getValue() == 'ny') echo 'selected';?> >Chichewa; Chewa; Nyanja</option>
                                            <option value="oc" <?if ($settingsindb['language']->getValue() == 'oc') echo 'selected';?> >Occitan (post 1500); Provençal</option>
                                            <option value="oj" <?if ($settingsindb['language']->getValue() == 'oj') echo 'selected';?> >Ojibwa</option>
                                            <option value="or" <?if ($settingsindb['language']->getValue() == 'or') echo 'selected';?> >Oriya</option>
                                            <option value="om" <?if ($settingsindb['language']->getValue() == 'om') echo 'selected';?> >Oromo</option>
                                            <option value="os" <?if ($settingsindb['language']->getValue() == 'os') echo 'selected';?> >Ossetian; Ossetic</option>
                                            <option value="pa" <?if ($settingsindb['language']->getValue() == 'pa') echo 'selected';?> >Panjabi; Punjabi</option>
                                            <option value="fa" <?if ($settingsindb['language']->getValue() == 'fa') echo 'selected';?> >Persian</option>
                                            <option value="pi" <?if ($settingsindb['language']->getValue() == 'pi') echo 'selected';?> >Pali</option>
                                            <option value="pl" <?if ($settingsindb['language']->getValue() == 'pl') echo 'selected';?> >Polish</option>
                                            <option value="pt" <?if ($settingsindb['language']->getValue() == 'pt') echo 'selected';?> >Portuguese</option>
                                            <option value="ps" <?if ($settingsindb['language']->getValue() == 'ps') echo 'selected';?> >Pushto</option>
                                            <option value="qu" <?if ($settingsindb['language']->getValue() == 'qu') echo 'selected';?> >Quechua</option>
                                            <option value="rm" <?if ($settingsindb['language']->getValue() == 'rm') echo 'selected';?> >Romansh</option>
                                            <option value="ro" <?if ($settingsindb['language']->getValue() == 'ro') echo 'selected';?> >Romanian</option>
                                            <option value="ro" <?if ($settingsindb['language']->getValue() == 'ro') echo 'selected';?> >Romanian</option>
                                            <option value="rn" <?if ($settingsindb['language']->getValue() == 'rn') echo 'selected';?> >Rundi</option>
                                            <option value="ru" <?if ($settingsindb['language']->getValue() == 'ru') echo 'selected';?> >Russian</option>
                                            <option value="sg" <?if ($settingsindb['language']->getValue() == 'sg') echo 'selected';?> >Sango</option>
                                            <option value="sa" <?if ($settingsindb['language']->getValue() == 'sa') echo 'selected';?> >Sanskrit</option>
                                            <option value="sr" <?if ($settingsindb['language']->getValue() == 'sr') echo 'selected';?> >Serbian</option>
                                            <option value="hr" <?if ($settingsindb['language']->getValue() == 'hr') echo 'selected';?> >Croatian</option>
                                            <option value="si" <?if ($settingsindb['language']->getValue() == 'si') echo 'selected';?> >Sinhala; Sinhalese</option>
                                            <option value="sk" <?if ($settingsindb['language']->getValue() == 'sk') echo 'selected';?> >Slovak</option>
                                            <option value="sk" <?if ($settingsindb['language']->getValue() == 'sk') echo 'selected';?> >Slovak</option>
                                            <option value="sl" <?if ($settingsindb['language']->getValue() == 'sl') echo 'selected';?> >Slovenian</option>
                                            <option value="se" <?if ($settingsindb['language']->getValue() == 'se') echo 'selected';?> >Northern Sami</option>
                                            <option value="sm" <?if ($settingsindb['language']->getValue() == 'sm') echo 'selected';?> >Samoan</option>
                                            <option value="sn" <?if ($settingsindb['language']->getValue() == 'sn') echo 'selected';?> >Shona</option>
                                            <option value="sd" <?if ($settingsindb['language']->getValue() == 'sd') echo 'selected';?> >Sindhi</option>
                                            <option value="so" <?if ($settingsindb['language']->getValue() == 'so') echo 'selected';?> >Somali</option>
                                            <option value="st" <?if ($settingsindb['language']->getValue() == 'st') echo 'selected';?> >Sotho, Southern</option>
                                            <option value="es" <?if ($settingsindb['language']->getValue() == 'es') echo 'selected';?> >Spanish; Castilian</option>
                                            <option value="sq" <?if ($settingsindb['language']->getValue() == 'sq') echo 'selected';?> >Albanian</option>
                                            <option value="sc" <?if ($settingsindb['language']->getValue() == 'sc') echo 'selected';?> >Sardinian</option>
                                            <option value="sr" <?if ($settingsindb['language']->getValue() == 'sr') echo 'selected';?> >Serbian</option>
                                            <option value="ss" <?if ($settingsindb['language']->getValue() == 'ss') echo 'selected';?> >Swati</option>
                                            <option value="su" <?if ($settingsindb['language']->getValue() == 'su') echo 'selected';?> >Sundanese</option>
                                            <option value="sw" <?if ($settingsindb['language']->getValue() == 'sw') echo 'selected';?> >Swahili</option>
                                            <option value="sv" <?if ($settingsindb['language']->getValue() == 'sv') echo 'selected';?> >Swedish</option>
                                            <option value="ty" <?if ($settingsindb['language']->getValue() == 'ty') echo 'selected';?> >Tahitian</option>
                                            <option value="ta" <?if ($settingsindb['language']->getValue() == 'ta') echo 'selected';?> >Tamil</option>
                                            <option value="tt" <?if ($settingsindb['language']->getValue() == 'tt') echo 'selected';?> >Tatar</option>
                                            <option value="te" <?if ($settingsindb['language']->getValue() == 'te') echo 'selected';?> >Telugu</option>
                                            <option value="tg" <?if ($settingsindb['language']->getValue() == 'tg') echo 'selected';?> >Tajik</option>
                                            <option value="tl" <?if ($settingsindb['language']->getValue() == 'tl') echo 'selected';?> >Tagalog</option>
                                            <option value="th" <?if ($settingsindb['language']->getValue() == 'th') echo 'selected';?> >Thai</option>
                                            <option value="bo" <?if ($settingsindb['language']->getValue() == 'bo') echo 'selected';?> >Tibetan</option>
                                            <option value="ti" <?if ($settingsindb['language']->getValue() == 'ti') echo 'selected';?> >Tigrinya</option>
                                            <option value="to" <?if ($settingsindb['language']->getValue() == 'to') echo 'selected';?> >Tonga (Tonga Islands)</option>
                                            <option value="tn" <?if ($settingsindb['language']->getValue() == 'tn') echo 'selected';?> >Tswana</option>
                                            <option value="ts" <?if ($settingsindb['language']->getValue() == 'ts') echo 'selected';?> >Tsonga</option>
                                            <option value="tk" <?if ($settingsindb['language']->getValue() == 'tk') echo 'selected';?> >Turkmen</option>
                                            <option value="tr" <?if ($settingsindb['language']->getValue() == 'tr') echo 'selected';?> >Turkish</option>
                                            <option value="tw" <?if ($settingsindb['language']->getValue() == 'tw') echo 'selected';?> >Twi</option>
                                            <option value="ug" <?if ($settingsindb['language']->getValue() == 'ug') echo 'selected';?> >Uighur; Uyghur</option>
                                            <option value="uk" <?if ($settingsindb['language']->getValue() == 'uk') echo 'selected';?> >Ukrainian</option>
                                            <option value="ur" <?if ($settingsindb['language']->getValue() == 'ur') echo 'selected';?> >Urdu</option>
                                            <option value="uz" <?if ($settingsindb['language']->getValue() == 'uz') echo 'selected';?> >Uzbek</option>
                                            <option value="ve" <?if ($settingsindb['language']->getValue() == 've') echo 'selected';?> >Venda</option>
                                            <option value="vi" <?if ($settingsindb['language']->getValue() == 'vi') echo 'selected';?> >Vietnamese</option>
                                            <option value="vo" <?if ($settingsindb['language']->getValue() == 'vo') echo 'selected';?> >Volapük</option>
                                            <option value="cy" <?if ($settingsindb['language']->getValue() == 'cy') echo 'selected';?> >Welsh</option>
                                            <option value="wa" <?if ($settingsindb['language']->getValue() == 'wa') echo 'selected';?> >Walloon</option>
                                            <option value="wo" <?if ($settingsindb['language']->getValue() == 'wo') echo 'selected';?> >Wolof</option>
                                            <option value="xh" <?if ($settingsindb['language']->getValue() == 'xh') echo 'selected';?> >Xhosa</option>
                                            <option value="yi" <?if ($settingsindb['language']->getValue() == 'yi') echo 'selected';?> >Yiddish</option>
                                            <option value="yo" <?if ($settingsindb['language']->getValue() == 'yo') echo 'selected';?> >Yoruba</option>
                                            <option value="za" <?if ($settingsindb['language']->getValue() == 'za') echo 'selected';?> >Zhuang; Chuang</option>
                                            <option value="zh" <?if ($settingsindb['language']->getValue() == 'zh') echo 'selected';?> >Chinese</option>
                                            <option value="zu" <?if ($settingsindb['language']->getValue() == 'zu') echo 'selected';?> >Zulu</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="bg">
                                    <td class="first" width="172"><strong><?php echo LANG_ADMIN_TABLE_MAGAZINE_TITLE; ?></strong></td>
                                    <td class="last"><input type="text" size="50" name="title" value="<?PHP echo $settingsindb['title']->getValue(); ?>"/></td>
                                </tr>
                                <tr>
                                    <td class="first"><strong><?php echo LANG_ADMIN_TABLE_MAGAZINE_DESCRIPTION; ?></strong></td>
                                    <td class="last"><textarea name="description" rows="4" cols="60"><?PHP echo $settingsindb['description']->getValue(); ?></textarea></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first" width="172"><strong><?php echo LANG_ADMIN_TABLE_URLTYPE; ?></strong></td>
                                    <td class="last">
                                        <select name="urltype">
                                            <option value="standard" <?if ($settingsindb['urltype']->getValue() == 'standard') echo 'selected';?> >PHP standard</option>
                                            <option value="optimized" <?if ($settingsindb['urltype']->getValue() == 'optimized') echo 'selected';?> >SEO optimized (require apache)</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="first" width="172"><strong><?php echo LANG_ADMIN_TABLE_PUBLISHER; ?></strong></td>
                                    <td class="last"><input type="text" size="50" name="publisher" value="<?PHP echo $settingsindb['publisher']->getValue(); ?>"/></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first" width="172"><strong><?php echo LANG_ADMIN_TABLE_RIGHTS; ?></strong></td>
                                    <td class="last"><input type="text" size="50" name="rights" value="<?PHP echo $settingsindb['rights']->getValue(); ?>"/></td>
                                </tr>
                                <tr>
                                    <td class="first" width="172"><strong><?php echo LANG_ADMIN_TABLE_ADMINISTRATION_EMAIL; ?></strong></td>
                                    <td class="last"><input type="text" size="50" name="email" value="<?PHP echo $settingsindb['email']->getValue(); ?>"/></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first" width="172"><strong><?php echo LANG_ADMIN_TABLE_EPUBFILENAME; ?></strong></td>
                                    <td class="last"><input type="text" size="50" name="epubname" value="<?PHP echo $settingsindb['epubname']->getValue(); ?>"/></td>
                                </tr>
                                <tr>
                                    <td class="first" width="172"><strong><?php echo LANG_ADMIN_TABLE_WEBSITEURL; ?></strong></td>
                                    <td class="last"><input type="text" size="50" name="siteurl" value="<?PHP echo $settingsindb['siteurl']->getValue(); ?>"/></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong><?php echo LANG_ADMIN_TABLE_FACEBOOK; ?></strong></td>
                                    <td class="last">
                                        <input type="radio" name="facebookbutton" value="ON" <?PHP if($settingsindb['facebookbutton']->getValue()=='ON') echo 'checked="checked"'; ?> /> <?php echo LANG_ADMIN_TABLE_ON; ?>
                                        <input type="radio" name="facebookbutton" value="OFF" <?PHP if($settingsindb['facebookbutton']->getValue()=='OFF') echo 'checked="checked"'; ?> /> <?php echo LANG_ADMIN_TABLE_OFF; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="first"><strong><?php echo LANG_ADMIN_TABLE_TWITTER; ?></strong></td>
                                    <td class="last">
                                        <input type="radio" name="twitterbutton" value="ON" <?PHP if($settingsindb['twitterbutton']->getValue()=='ON') echo 'checked="checked"'; ?> /> <?php echo LANG_ADMIN_TABLE_ON; ?>
                                        <input type="radio" name="twitterbutton" value="OFF" <?PHP if($settingsindb['twitterbutton']->getValue()=='OFF') echo 'checked="checked"'; ?> /> <?php echo LANG_ADMIN_TABLE_OFF; ?>
                                    </td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>&nbsp;</strong></td>
                                    <td class="last"><input type="submit" value="<?php echo LANG_ADMIN_TABLE_SAVE; ?>" name="save" /></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <div id="right-column">
                    <strong class="h"><?php echo LANG_MSG_INFO; ?></strong>
                    <div class="box"><?php echo LANG_ADMIN_SETTINGS_INFO; ?></div>
                </div>
            </div>
            <div id="footer"></div>
        </div>
    </body>
</html>