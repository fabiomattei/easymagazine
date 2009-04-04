<?php

define('BASEDIR', '../');
define('OUTDIR', BASEDIR.'../');
define('STARTPATH', '../');

require_once(BASEDIR.'admin/datamodel/library/strfunction.php');
require_once(OUTDIR.'simpletest/autorun.php');

require_once(BASEDIR.'costants.php');
require_once(BASEDIR.'admin/datamodel/article.php');
require_once('dummyDBCreator.php');
require_once(OUTDIR.'simpletest/autorun.php');


require_once('admin/datamodel/library/tstrfunction.php');
require_once('admin/datamodel/tarticle.php');
require_once('admin/datamodel/library/tdb.php');


/**
require_once('../../simpletest/autorun.php');

class AllTests extends TestSuite {
    function AllTests() {
        $this->TestSuite('All tests');
        $this->addFile('../easymagazine/test/admin/datamodel/library/tstrfunction.php');
        $this->addFile('test/admin/datamodel/library/tstrfunction.php');
    }
}
*/


?>
