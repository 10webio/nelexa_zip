<?php

namespace PhpZipv3\Tests\Internal\Epub;

use PhpZipv3\Constants\ZipCompressionMethod;
use PhpZipv3\Constants\ZipPlatform;
use PhpZipv3\Exception\ZipUnsupportMethodException;
use PhpZipv3\IO\ZipWriter;
use PhpZipv3\Model\Data\ZipNewData;
use PhpZipv3\Model\ZipEntry;

/**
 * Class EpubWriter.
 *
 * @property EpubZipContainer $zipContainer
 */
class EpubWriter extends ZipWriter
{
    /**
     * @throws ZipUnsupportMethodException
     */
    protected function beforeWrite()
    {
        parent::beforeWrite();

        if (!$this->zipContainer->hasEntry('mimetype')) {
            $zipEntry = new ZipEntry('mimetype');
            $zipEntry->setCreatedOS(ZipPlatform::OS_DOS);
            $zipEntry->setExtractedOS(ZipPlatform::OS_DOS);
            $zipEntry->setCompressionMethod(ZipCompressionMethod::STORED);
            $zipEntry->setData(new ZipNewData($zipEntry, 'application/epub+zip'));
            $this->zipContainer->addEntry($zipEntry);
        }

        $this->sortEntries();
    }

    private function sortEntries()
    {
        $this->zipContainer->sortByEntry(
            static function (ZipEntry $a, ZipEntry $b) {
                if (strcasecmp($a->getName(), 'mimetype') === 0) {
                    return -1;
                }

                if (strcasecmp($b->getName(), 'mimetype') === 0) {
                    return 1;
                }

                if ($a->isDirectory() && $b->isDirectory()) {
                    return strcmp($a->getName(), $b->getName());
                }

                if ($a->isDirectory()) {
                    return -1;
                }

                if ($b->isDirectory()) {
                    return 1;
                }

                return strcmp($a->getName(), $b->getName());
            }
        );
    }
}
