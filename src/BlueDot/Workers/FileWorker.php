<?php

/**
 * @author Mario Škrlec <whitepostmail@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

namespace BlueDot\Workers;

use BlueDot\Workers\Exception\ClosureDependencyException;
use BlueDot\Workers\Interfaces\ClosureDependencyInterface;
use BlueDot\Workers\Interfaces\WorkerInterface;

/**
 *
 * Does the actuall job of traversing the file with fgets(). Uses FileSearchWorker to find the desired value
 */

class FileWorker implements WorkerInterface, ClosureDependencyInterface
{
    /**
     * @var Resource $handle
     */
    private $handle;

    /**
     * @var array Contains tag-name and main-tag key that the client injected trough Select::select($tagName) and Select::from($mainTag)
     */
    private $options = array();

    /**
     * @var array
     */
    private $result = null;

    public function __construct() {

    }

    /**
     *
     *
     * @param string $variable
     * @param string $value
     * @throws Exception\ClosureDependencyException
     */
    public function addFromClosure($variable, $value) {
        if( ! property_exists($this, $variable) ) {
            throw new ClosureDependencyException("Instance variable " . $variable . " does not exist in FileWorker::addFromClosure()");
        }

        $this->{$variable} = $value;
    }

    /**
     * @param array $options
     * @return $this
     */

    public function addOptions(array $options) {
        $this->options = $options;

        return $this;
    }

    /**
     * Creates FileSearchWorker and traverses trough the xml file, line by line by fgets().
     *
     * @see BlueDot\Workers\FileSearchWorker
     *
     * @return $this
     */

    public function search() {
        $searchWorker = new FileSearchWorker($this->options);

        while( ($buffer = fgets($this->handle)) !== false ) {
            if( $searchWorker->isMainTag($buffer) ) {
                $searchWorker->mark();
                continue;
            }

            if( $searchWorker->isMarked() ) {
                if( $searchWorker->isTag($buffer) ) {
                    $searchWorker->saveValue();
                    $searchWorker->unmark();
                    continue;
                }
            }
        }

        $this->result = $searchWorker->getResult();

        return $this;
    }

    /**
     * @return array
     */

    public function getResult() {
        return $this->result;
    }
} 