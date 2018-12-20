<?php

/**
 * OutputTextFile
 * 
 * Easily create text files. Pass the filename and extension to the constructor,
 * then assign the output string to $data and call create() to create the text
 * file and download it in the browser.
 *
 * @author Gavin D. Johnsen
 */
class OutputTextFile {

    public $data = NULL;

    /**
     * Starts building the file to output by setting header information.
     * 
     * @param String $filename Name of the file
     * @param String $ext [optional] Extension of the file, default "txt"
     */
    public function __construct($filename = 'untitled', $ext = 'txt') {
        $s_filename = $this->cleanString(filter_var($filename, FILTER_SANITIZE_STRING));
        header('Content-Type: text/txt; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $s_filename . '.' . $ext);
    }

    /**
     * Creates and downloads the file using the string at $this->data
     */
    public function create() {
        $output = fopen('php://output', 'w');
        fwrite($output, $this->data);
    }

    /**
     * String cleaner used for the filename.
     * 
     * @param String $string    Input string
     * @return String
     */
    private function cleanString($string) {
        $s = str_replace(' ', '-', $string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $s);
    }

}
