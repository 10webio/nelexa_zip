<?php

namespace PhpZipv3\Tests\Internal\CustomZip;

use PhpZipv3\IO\ZipWriter;
use PhpZipv3\ZipFile;

/**
 * Class ZipFileCustomWriter.
 */
class ZipFileCustomWriter extends ZipFile
{
    /**
     * @return ZipWriter
     */
    protected function createZipWriter()
    {
        return new CustomZipWriter($this->zipContainer);
    }
}
