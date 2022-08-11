<?php

namespace PhpZipv3\Tests\SlowTests;

use PhpZipv3\Constants\ZipCompressionMethod;
use PhpZipv3\Exception\ZipException;
use PhpZipv3\Tests\ZipTestCase;
use PhpZipv3\Util\FilesUtil;
use PhpZipv3\ZipFile;

/**
 * @internal
 *
 * @large
 */
class Zip64Test extends ZipTestCase
{
    /**
     * @throws ZipException
     */
    public function testCreateLargeZip64File()
    {
        if (\PHP_INT_SIZE === 4) { // php 32 bit
            static::markTestSkipped('Only php-64 bit.');

            return;
        }

        if (!self::existsProgram('fallocate')) {
            static::markTestSkipped('Cannot find the program "fallocate" for the test');

            return;
        }

        $basedir = \dirname($this->outputFilename);
        $tmpLargeFile = $basedir . '/large_bin_file.bin';

        $sizeLargeBinFile = (int) (4.2 * 1024 * 1024 * 1024);
        $needFreeSpace = $sizeLargeBinFile * 4;
        $diskFreeSpace = disk_free_space($basedir);

        if ($needFreeSpace > $diskFreeSpace) {
            static::markTestIncomplete(
                sprintf(
                    'Not enough disk space for the test. Need to free %s',
                    FilesUtil::humanSize($needFreeSpace - $diskFreeSpace)
                )
            );

            return;
        }

        try {
            $commandCreateLargeBinFile = 'fallocate -l ' . escapeshellarg($sizeLargeBinFile) . ' ' . escapeshellarg($tmpLargeFile);

            exec($commandCreateLargeBinFile, $output, $returnCode);

            if ($returnCode !== 0) {
                static::markTestIncomplete('Cannot create large file. Error code: ' . $returnCode);

                return;
            }

            $zipFile = new ZipFile();
            $zipFile
                ->addFile($tmpLargeFile, 'large_file1.bin', ZipCompressionMethod::STORED)
                ->addFile($tmpLargeFile, 'large_file2.bin', ZipCompressionMethod::DEFLATED)
                ->saveAsFile($this->outputFilename)
                ->close()
            ;

            if (is_file($tmpLargeFile)) {
                unlink($tmpLargeFile);
            }

            self::assertCorrectZipArchive($this->outputFilename);

            if (!is_dir($this->outputDirname)) {
                static::assertTrue(mkdir($this->outputDirname, 0755, true));
            }

            $zipFile->openFile($this->outputFilename);
            $zipFile->extractTo($this->outputDirname);

            static::assertTrue(is_file($this->outputDirname . '/large_file1.bin'));
            static::assertTrue(is_file($this->outputDirname . '/large_file2.bin'));

            $zipFile->deleteFromName('large_file1.bin');
            $zipFile->saveAsFile($this->outputFilename);

            self::assertCorrectZipArchive($this->outputFilename);
        } finally {
            if (is_file($tmpLargeFile)) {
                unlink($tmpLargeFile);
            }
        }
    }
}
