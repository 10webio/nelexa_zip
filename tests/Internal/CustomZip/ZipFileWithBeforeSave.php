<?php

namespace PhpZipv3\Tests\Internal\CustomZip;

use PhpZipv3\Model\Extra\Fields\NewUnixExtraField;
use PhpZipv3\Model\Extra\Fields\NtfsExtraField;
use PhpZipv3\ZipFile;

/**
 * Class ZipFileWithBeforeSave.
 */
class ZipFileWithBeforeSave extends ZipFile
{
    /**
     * Event before save or output.
     */
    protected function onBeforeSave()
    {
        $now = new \DateTimeImmutable();
        $ntfsTimeExtra = NtfsExtraField::create($now, $now->modify('-1 day'), $now->modify('-10 day'));
        $unixExtra = new NewUnixExtraField();

        foreach ($this->zipContainer->getEntries() as $entry) {
            $entry->addExtraField($ntfsTimeExtra);
            $entry->addExtraField($unixExtra);
        }
    }
}
