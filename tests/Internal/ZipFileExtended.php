<?php

namespace PhpZipv3\Tests\Internal;

use PhpZipv3\ZipFile;

/**
 * Class ZipFileExtended.
 */
class ZipFileExtended extends ZipFile
{
    protected function onBeforeSave()
    {
        parent::onBeforeSave();
        $this->deleteFromRegex('~^META\-INF/~i');
    }
}
