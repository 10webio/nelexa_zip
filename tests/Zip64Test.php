<?php

namespace PhpZipv3\Tests;

use PhpZipv3\Constants\ZipCompressionMethod;
use PhpZipv3\Exception\ZipException;
use PhpZipv3\ZipFile;

/**
 * Class Zip64Test.
 *
 * @internal
 *
 * @medium
 */
class Zip64Test extends ZipTestCase
{
    /**
     * Test support ZIP64 ext (slow test - normal).
     * Create > 65535 files in archive and open and extract to /dev/null.
     *
     * @throws ZipException
     */
    public function testOver65535FilesInZip()
    {
        if (\PHP_INT_SIZE === 4) { // php 32 bit
            static::markTestSkipped('Only php-64 bit.');

            return;
        }

        $countFiles = 0xffff + 1;

        $zipFile = new ZipFile();
        for ($i = 0; $i < $countFiles; $i++) {
            $zipFile->addFromString($i . '.txt', (string) $i, ZipCompressionMethod::STORED);
        }
        $zipFile->saveAsFile($this->outputFilename);
        $zipFile->close();

        static::assertCorrectZipArchive($this->outputFilename);

        $zipFile->openFile($this->outputFilename);
        static::assertSame($zipFile->count(), $countFiles);
        $i = 0;

        foreach ($zipFile as $entry => $content) {
            static::assertSame($entry, $i . '.txt');
            static::assertSame($content, (string) $i);
            $i++;
        }
        $zipFile->close();
    }
}
