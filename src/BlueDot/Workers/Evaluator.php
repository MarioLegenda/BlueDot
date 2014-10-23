<?php

/**
 * @author Mario Škrlec <whitepostmail@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

namespace BlueDot\Workers;

use BlueDot\Workers\Interfaces\EvaluatorInterface;

/**
 * Factory helper. Evaluates the size of the file and return the appropiratte constant for the Worker to be built in the Factory
 *
 * @see BlueDot\Workers\Factory\Factory
 */

class Evaluator implements EvaluatorInterface
{
    CONST FILE_WORKER = 1;
    CONST OBJECT_WORKER = 2;

    /**
     * @var \SplFileInfo $fileInfo
     */
    private $fileInfo;

    /**
     * @param \SplFileInfo $fileInfo
     */

    public function __construct(\SplFileInfo $fileInfo) {
        $this->fileInfo = $fileInfo;
    }

    /**
     * Determines files size and return the appropriatte constant
     *
     * @return int
     */

    public function evaluate() {
        $size = filesize($this->fileInfo->getLinkTarget());

        return Evaluator::FILE_WORKER;

        /*if( $size < 10000000 ) {
            return Evaluator::OBJECT_WORKER;
        } else if( $size > 10000000 ) {
            return Evaluator::FILE_WORKER;
        }*/
    }
} 