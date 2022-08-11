<?php

namespace PhpZipv3\Tests\Internal\CustomZip;

use PhpZipv3\IO\ZipWriter;
use PhpZipv3\Model\Extra\Fields\NewUnixExtraField;
use PhpZipv3\Model\Extra\Fields\NtfsExtraField;
use PhpZipv3\Model\ZipContainer;

/**
 * Class CustomZipWriter.
 */
class CustomZipWriter extends ZipWriter
{
    /**
     * ZipWriter constructor.
     *
     * @param ZipContainer $container
     */
    public function __construct(ZipContainer $container)
    {
//        dump($container);
        parent::__construct($container);
//        dd($this->zipContainer);
    }

    protected function beforeWrite()
    {
        parent::beforeWrite();
        $now = new \DateTimeImmutable();
        $ntfsTimeExtra = NtfsExtraField::create($now, $now->modify('-1 day'), $now->modify('-10 day'));
        $unixExtra = new NewUnixExtraField();

        foreach ($this->zipContainer->getEntries() as $entry) {
            $entry->addExtraField($ntfsTimeExtra);
            $entry->addExtraField($unixExtra);
        }
    }
}
