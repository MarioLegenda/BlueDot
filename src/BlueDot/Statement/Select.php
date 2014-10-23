<?php

/**
 * @author Mario Škrlec <whitepostmail@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */


namespace BlueDot\Statement;


use BlueDot\Config\Config;
use BlueDot\Statement\Exception\StatementException;
use BlueDot\Workers\Evaluator;
use BlueDot\Workers\Factory\Factory;

/**
 * FluentInterface pattern that instantiates all the necessary object for searching the XML file.
 *
 * Final result is an StatementResult object or null
 *
 * @see BlueDot\Config\Config
 * @see BlueDot\Workers\Factory\Factory
 * @see BlueDot\Workers\Evaluator
 * @see BlueDot\Statement\StatementResult
 */

class Select
{
    /**
     * @var string
     */

    private $tagName = null;

    /**
     * @var string
     */
    private $mainTag = null;

    /**
     * @var \BlueDot\Config\Config
     */

    private $config;

    public function __construct(Config $config) {
        $this->config = $config;
    }

    /**
     * @param string $tagName
     * @return $this Just saves the $tagName specified by the client code and return $this object
     * @throws Exception\StatementException
     */

    public function select($tagName) {
        if( ! is_string($tagName) OR $tagName === null ) {
            throw new StatementException('Tag name has to be a string in Select::select($tagName)');
        }

        $this->tagName = $tagName;

        return $this;
    }

    /**
     * @param string $mainTag
     * @return $this Just saves the $mainTag specified by the client code and returns $this object
     * @throws Exception\StatementException
     */

    public function from($mainTag) {
        if( ! is_string($mainTag) OR $mainTag === null ) {
            throw new StatementException('Main tag has to be a string in Select::from($mainTag)');
        }

        $this->mainTag = $mainTag;

        return $this;
    }

    /**
     * First, the query() method creates a worker object ( Factory ) depending on the size of the file. Let's say that Factory creates
     * a FileWorker who is instantiated when the file is larger than 10MB. Worker adds the options (tag name and main tag) searches the
     * file and returns the result. If result exist, array of StatementResult objects is created and returned to the client.
     *
     *
     *
     * @return array|null
     * @throws Exception\StatementException
     */

    public function query() {
        if( $this->tagName === null OR $this->mainTag === null ) {
            throw new StatementException('Select: Tag name or main tag are not specified');
        }

        $fileInfo = $this->config->getFileInfoObject();
        $worker = Factory::createWorker(
            new Evaluator($fileInfo),
            function($workerInstance) use ($fileInfo) {
                $handle = fopen($fileInfo->getLinkTarget(), 'r');
                $workerInstance->addFromClosure('handle', $handle);
            }
        );

        $result = $worker
            ->addOptions(array(
            'tag-name' => $this->tagName,
            'main-tag' => $this->mainTag
            ))
            ->search()
            ->getResult();

        if( $result !== null ) {
            $statements = $this->buildStatementResult($result);

            return $statements;
        }

        return null;
    }

    /**
     * Returns an array of StatementResult objects
     *
     * @param string $result
     * @return array
     */

    private function buildStatementResult($result) {
        $returnResult = array();
        foreach( $result AS $res ) {
            $statementResult = new StatementResult($res);
            $returnResult[] = $statementResult;
        }

        return $returnResult;
    }
} 