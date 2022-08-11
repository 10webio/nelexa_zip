<?php

namespace PhpZipv3\Tests;

use PhpZipv3\Constants\ZipCompressionMethod;
use PhpZipv3\Constants\ZipOptions;
use PhpZipv3\Exception\ZipException;
use PhpZipv3\ZipFile;
use Symfony\Component\Finder\Finder;

/**
 * @internal
 *
 * @small
 */
class ZipFinderTest extends ZipTestCase
{
    /**
     * @throws ZipException
     */
    public function testFinder()
    {
        $finder = (new Finder())
            ->files()
            ->name('*.php')
            ->in(__DIR__)
        ;
        $zipFile = new ZipFile();
        $zipFile->addFromFinder(
            $finder,
            [
                ZipOptions::COMPRESSION_METHOD => ZipCompressionMethod::DEFLATED,
            ]
        );
        $zipFile->saveAsFile($this->outputFilename);

        static::assertCorrectZipArchive($this->outputFilename);

        static::assertSame($finder->count(), $zipFile->count());
        $zipFile->close();
    }
}
