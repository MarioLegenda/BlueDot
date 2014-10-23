<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 23.10.14.
 * Time: 10:08
 */

namespace BlueDot\Config;


use BlueDot\Config\Exception\ConfigException;

class Config
{
    private $fileInfo;

    public function __construct($pathToXml) {
        $fileInfo = new \SplFileInfo($pathToXml);

        var_dump($fileInfo->getSize());

        if( $fileInfo->getExtension() !== 'xml' ) {
            throw new ConfigException('File needs to be an .xml file. .' . $fileInfo->getExtension() . ' given');
        }

        if( $fileInfo->isFile() === false ) {
            throw new ConfigException('File doesn\' exist in Config::__construct()');
        }

        if( $fileInfo->isReadable() === false ) {
            throw new ConfigException('File is not readable in Config::__construct()');
        }

        if( $fileInfo->isWritable() === false ) {
            throw new ConfigException('File is not writable in Config::__construct()');
        }

        if( $fileInfo->isExecutable() === true ) {
            throw new ConfigException('Get the fuck out of here with your executable');
        }

        $this->fileInfo = $fileInfo;
    }

    public function getFileInfoObject() {
        return $this->fileInfo;
    }
} 