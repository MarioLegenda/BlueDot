<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 23.10.14.
 * Time: 10:50
 */

namespace BlueDot\Statement;


use BlueDot\Config\Config;
use BlueDot\Statement\Exception\StatementException;
use BlueDot\Workers\Evaluator;
use BlueDot\Workers\Factory\Factory;

class Select
{
    private $tagName = null;
    private $mainTag = null;

    private $config;

    public function __construct(Config $config) {
        $this->config = $config;
    }

    public function select($tagName) {
        if( ! is_string($tagName) OR $tagName === null ) {
            throw new StatementException('Tag name has to be a string in Select::select($tagName)');
        }

        $this->tagName = $tagName;

        return $this;
    }

    public function from($mainTag) {
        if( ! is_string($mainTag) OR $mainTag === null ) {
            throw new StatementException('Main tag has to be a string in Select::from($mainTag)');
        }

        $this->mainTag = $mainTag;

        return $this;
    }

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

        echo '<pre>';
        var_dump($result);
        die('kreten');
    }
} 