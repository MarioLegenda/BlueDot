<?php

/**
 * @author Mario Škrlec <whitepostmail@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @api
 */

namespace BlueDot\Config;


use BlueDot\Config\Exception\ConfigException;

/**
 *  Wrapper around path to xml file. Does regular checks.
 */

class Config
{
    /**
     * @var \SplFileInfo
     */
    private $fileInfo;

    /**
     *
     *
     * @param string $pathToXml
     * @throws BlueDot\Config\Exception\ConfigException
     */

    public function __construct($pathToXml) {
        $fileInfo = new \SplFileInfo($pathToXml);

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