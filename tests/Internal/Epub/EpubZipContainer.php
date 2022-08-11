<?php

namespace PhpZipv3\Tests\Internal\Epub;

use PhpZipv3\Exception\ZipEntryNotFoundException;
use PhpZipv3\Model\ZipContainer;

/**
 * Class EpubZipContainer.
 */
class EpubZipContainer extends ZipContainer
{
    /**
     * @throws ZipEntryNotFoundException
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->getEntry('mimetype')->getData()->getDataAsString();
    }
}
