<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 23.10.14.
 * Time: 13:59
 */

namespace BlueDot\Workers;


use BlueDot\Workers\Exception\WorkerException;

class FileSearchWorker
{
    private $options = array();

    private $mark = false;
    private $tempSave = null;

    private $saved = array();

    public function __construct(array $options) {
        if( array_key_exists('tag-name', $options) === false OR
            array_key_exists('main-tag', $options) === false ) {

            throw new WorkerException('Invalid options in FileSearchWorker');
        }

        $this->options = $options;
    }

    public function isMainTag($fileLine) {
        //var_dump(htmlspecialchars($fileLine));

        $mainTag = $this->options['main-tag'];
        $regex = "#<" . $mainTag . ">#";
        if( preg_match($regex, $fileLine) ) {
            return true;
        }

        return false;
    }

    public function mark() {
        $this->mark = true;
    }

    public function isMarked() {
        return $this->mark;
    }

    public function isTag($fileLine) {
        $tagName = $this->options['tag-name'];
        $regex = "#<" . $tagName . ">#";

        if( preg_match($regex, $fileLine) ) {
            $regex = "#<" . $tagName . ">(.*)<\/" . $tagName . ">#";
            preg_match($regex, $fileLine, $matches);

            if( isset($matches[1]) ) {
                $this->tempSave = $matches[1];
                return true;
            }

            return false;
        }

        return false;
    }

    public function saveValue() {
        if( $this->tempSave !== null ) {
            $tagName = $this->options['tag-name'];
            $this->saved[][$tagName] = $this->tempSave;

            $this->tempSave = null;
        }
        else {
            $this->tempSave = null;
            return false;
        }
    }

    public function unmark() {
        $this->mark = false;
    }

    public function getResult() {
        return $this->saved;
    }
} 