<?php

namespace PhpZipv3\Tests\Internal\Epub;

use PhpZipv3\IO\ZipReader;

/**
 * Class EpubReader.
 */
class EpubReader extends ZipReader
{
    /**
     * @return bool
     *
     * @see https://github.com/w3c/epubcheck/issues/334
     */
    protected function isZip64Support()
    {
        return false;
    }
}
