<?php

/**
 * @author Mario Škrlec <whitepostmail@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 *
 */

namespace BlueDot\Workers;


use BlueDot\Workers\Exception\WorkerException;

/**
 *
 * This object is created in FileWorker and its methods are called on every occurrance of a line in the xml file
 *
 * When the main-tag, specified by Select::from($mainTag), is found, this object marks the spot so it know that the search
 * for the desired tag is going to happen inside $mainTag e.i. After it finds $tagName, it extracts the value of that tag
 * and temporarily saves the value in $tempSave. After that, FileSearchWorker::saveValue() is called and the value is saved
 * in a numericly indexed array with the $tagName key. It then, unmarks the current position so it could stop searching for
 * the $tagName.
 * */

class FileSearchWorker
{
    /**
     * @var array
     */
    private $options = array();

    /**
     * @var bool
     */
    private $mark = false;
    /**
     * @var null
     */
    private $tempSave = null;

    /**
     * @var array Saved found values
     */
    private $saved = array();

    public function __construct(array $options) {
        if( array_key_exists('tag-name', $options) === false OR
            array_key_exists('main-tag', $options) === false ) {

            throw new WorkerException('Invalid options in FileSearchWorker');
        }

        $this->options = $options;
    }

    /**
     * @param string $fileLine File line gotten from fgets(). If $mainTag is found, returns true
     * @return bool
     */
    public function isMainTag($fileLine) {
        //var_dump(htmlspecialchars($fileLine));

        $mainTag = $this->options['main-tag'];
        $regex = "#<" . $mainTag . ">#";
        if( preg_match($regex, $fileLine) ) {
            return true;
        }

        return false;
    }

    /**
     * Marks the position of the $mainTag.
     */

    public function mark() {
        $this->mark = true;
    }

    /**
     * @return bool Checks if $mainTag is found and marked
     */

    public function isMarked() {
        return $this->mark;
    }

    /**
     * Checks if the desired $tagName is found and saves it in $this::tempSave
     *
     * @param string $fileLine
     * @return bool
     */

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

    /**
     * Saves the value to $this::$saved
     *
     * @return bool
     */

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

    /**
     * Unmarks the position after fgets() has passed the $mainTag
     */

    public function unmark() {
        $this->mark = false;
    }

    /**
     * Returns the result
     *
     * @return array
     */

    public function getResult() {
        return $this->saved;
    }
} 