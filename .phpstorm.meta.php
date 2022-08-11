<?php

namespace PHPSTORM_META {

    registerArgumentsSet(
        "bool",
        true,
        false
    );

    registerArgumentsSet(
        "compression_methods",
        \PhpZipv3\Constants\ZipCompressionMethod::STORED,
        \PhpZipv3\Constants\ZipCompressionMethod::DEFLATED,
        \PhpZipv3\Constants\ZipCompressionMethod::BZIP2
    );
    expectedArguments(\PhpZipv3\ZipFile::addFile(), 2, argumentsSet("compression_methods"));
    expectedArguments(\PhpZipv3\ZipFile::addFromStream(), 2, argumentsSet("compression_methods"));
    expectedArguments(\PhpZipv3\ZipFile::addFromString(), 2, argumentsSet("compression_methods"));
    expectedArguments(\PhpZipv3\ZipFile::addDir(), 2, argumentsSet("compression_methods"));
    expectedArguments(\PhpZipv3\ZipFile::addDirRecursive(), 2, argumentsSet("compression_methods"));
    expectedArguments(\PhpZipv3\ZipFile::addFilesFromIterator(), 2, argumentsSet("compression_methods"));
    expectedArguments(\PhpZipv3\ZipFile::addFilesFromIterator(), 2, argumentsSet("compression_methods"));
    expectedArguments(\PhpZipv3\ZipFile::addFilesFromGlob(), 3, argumentsSet("compression_methods"));
    expectedArguments(\PhpZipv3\ZipFile::addFilesFromGlobRecursive(), 3, argumentsSet("compression_methods"));
    expectedArguments(\PhpZipv3\ZipFile::addFilesFromRegex(), 3, argumentsSet("compression_methods"));
    expectedArguments(\PhpZipv3\ZipFile::addFilesFromRegexRecursive(), 3, argumentsSet("compression_methods"));
    expectedArguments(\PhpZipv3\ZipFile::setCompressionMethodEntry(), 1, argumentsSet("compression_methods"));
    expectedArguments(\PhpZipv3\Model\ZipEntry::setCompressionMethod(), 0, argumentsSet("compression_methods"));
    expectedArguments(\PhpZipv3\Model\ZipEntry::setMethod(), 0, argumentsSet("compression_methods"));

    registerArgumentsSet(
        'compression_levels',
        \PhpZipv3\Constants\ZipCompressionLevel::MAXIMUM,
        \PhpZipv3\Constants\ZipCompressionLevel::NORMAL,
        \PhpZipv3\Constants\ZipCompressionLevel::FAST,
        \PhpZipv3\Constants\ZipCompressionLevel::SUPER_FAST
    );
    expectedArguments(\PhpZipv3\ZipFile::setCompressionLevel(), 0, argumentsSet("compression_levels"));
    expectedArguments(\PhpZipv3\ZipFile::setCompressionLevelEntry(), 1, argumentsSet("compression_levels"));
    expectedArguments(\PhpZipv3\Model\ZipEntry::setCompressionLevel(), 0, argumentsSet("compression_levels"));

    registerArgumentsSet(
        'encryption_methods',
        \PhpZipv3\Constants\ZipEncryptionMethod::WINZIP_AES_256,
        \PhpZipv3\Constants\ZipEncryptionMethod::WINZIP_AES_192,
        \PhpZipv3\Constants\ZipEncryptionMethod::WINZIP_AES_128,
        \PhpZipv3\Constants\ZipEncryptionMethod::PKWARE
    );
    expectedArguments(\PhpZipv3\ZipFile::setPassword(), 1, argumentsSet("encryption_methods"));
    expectedArguments(\PhpZipv3\ZipFile::setPasswordEntry(), 2, argumentsSet("encryption_methods"));
    expectedArguments(\PhpZipv3\Model\ZipEntry::setEncryptionMethod(), 0, argumentsSet("encryption_methods"));
    expectedArguments(\PhpZipv3\Model\ZipEntry::setPassword(), 1, argumentsSet("encryption_methods"));

    registerArgumentsSet(
        'zip_mime_types',
        null,
        'application/zip',
        'application/vnd.android.package-archive',
        'application/java-archive'
    );
    expectedArguments(\PhpZipv3\ZipFile::outputAsAttachment(), 1, argumentsSet("zip_mime_types"));
    expectedArguments(\PhpZipv3\ZipFile::outputAsAttachment(), 2, argumentsSet("bool"));

    expectedArguments(\PhpZipv3\ZipFile::outputAsResponse(), 2, argumentsSet("zip_mime_types"));
    expectedArguments(\PhpZipv3\ZipFile::outputAsResponse(), 3, argumentsSet("bool"));

    registerArgumentsSet(
        'dos_charset',
        \PhpZipv3\Constants\DosCodePage::CP_LATIN_US,
        \PhpZipv3\Constants\DosCodePage::CP_GREEK,
        \PhpZipv3\Constants\DosCodePage::CP_BALT_RIM,
        \PhpZipv3\Constants\DosCodePage::CP_LATIN1,
        \PhpZipv3\Constants\DosCodePage::CP_LATIN2,
        \PhpZipv3\Constants\DosCodePage::CP_CYRILLIC,
        \PhpZipv3\Constants\DosCodePage::CP_TURKISH,
        \PhpZipv3\Constants\DosCodePage::CP_PORTUGUESE,
        \PhpZipv3\Constants\DosCodePage::CP_ICELANDIC,
        \PhpZipv3\Constants\DosCodePage::CP_HEBREW,
        \PhpZipv3\Constants\DosCodePage::CP_CANADA,
        \PhpZipv3\Constants\DosCodePage::CP_ARABIC,
        \PhpZipv3\Constants\DosCodePage::CP_NORDIC,
        \PhpZipv3\Constants\DosCodePage::CP_CYRILLIC_RUSSIAN,
        \PhpZipv3\Constants\DosCodePage::CP_GREEK2,
        \PhpZipv3\Constants\DosCodePage::CP_THAI
    );
    expectedArguments(\PhpZipv3\Model\ZipEntry::setCharset(), 0, argumentsSet('dos_charset'));
    expectedArguments(\PhpZipv3\Constants\DosCodePage::toUTF8(), 1, argumentsSet('dos_charset'));
    expectedArguments(\PhpZipv3\Constants\DosCodePage::fromUTF8(), 1, argumentsSet('dos_charset'));

    registerArgumentsSet(
        "zip_os",
        \PhpZipv3\Constants\ZipPlatform::OS_UNIX,
        \PhpZipv3\Constants\ZipPlatform::OS_DOS,
        \PhpZipv3\Constants\ZipPlatform::OS_MAC_OSX
    );
    expectedArguments(\PhpZipv3\Model\ZipEntry::setCreatedOS(), 0, argumentsSet('zip_os'));
    expectedArguments(\PhpZipv3\Model\ZipEntry::setExtractedOS(), 0, argumentsSet('zip_os'));
    expectedArguments(\PhpZipv3\Model\ZipEntry::setPlatform(), 0, argumentsSet('zip_os'));

    registerArgumentsSet(
        "zip_gpbf",
        \PhpZipv3\Constants\GeneralPurposeBitFlag::ENCRYPTION |
        \PhpZipv3\Constants\GeneralPurposeBitFlag::DATA_DESCRIPTOR |
        \PhpZipv3\Constants\GeneralPurposeBitFlag::COMPRESSION_FLAG1 |
        \PhpZipv3\Constants\GeneralPurposeBitFlag::COMPRESSION_FLAG2 |
        \PhpZipv3\Constants\GeneralPurposeBitFlag::UTF8
    );
    expectedArguments(\PhpZipv3\Model\ZipEntry::setGeneralPurposeBitFlags(), 0, argumentsSet('zip_gpbf'));

    registerArgumentsSet(
        "winzip_aes_vendor_version",
        \PhpZipv3\Model\Extra\Fields\WinZipAesExtraField::VERSION_AE1,
        \PhpZipv3\Model\Extra\Fields\WinZipAesExtraField::VERSION_AE2
    );
    registerArgumentsSet(
        "winzip_aes_key_strength",
        \PhpZipv3\Model\Extra\Fields\WinZipAesExtraField::KEY_STRENGTH_256BIT,
        \PhpZipv3\Model\Extra\Fields\WinZipAesExtraField::KEY_STRENGTH_128BIT,
        \PhpZipv3\Model\Extra\Fields\WinZipAesExtraField::KEY_STRENGTH_192BIT
    );
    expectedArguments(\PhpZipv3\Model\Extra\Fields\WinZipAesExtraField::__construct(), 0, argumentsSet('winzip_aes_vendor_version'));
    expectedArguments(\PhpZipv3\Model\Extra\Fields\WinZipAesExtraField::__construct(), 1, argumentsSet('winzip_aes_key_strength'));
    expectedArguments(\PhpZipv3\Model\Extra\Fields\WinZipAesExtraField::__construct(), 2, argumentsSet('compression_methods'));
    expectedArguments(\PhpZipv3\Model\Extra\Fields\WinZipAesExtraField::setVendorVersion(), 0, argumentsSet('winzip_aes_vendor_version'));
    expectedArguments(\PhpZipv3\Model\Extra\Fields\WinZipAesExtraField::setKeyStrength(), 0, argumentsSet('winzip_aes_key_strength'));
    expectedArguments(\PhpZipv3\Model\Extra\Fields\WinZipAesExtraField::setCompressionMethod(), 0, argumentsSet('compression_methods'));
}
