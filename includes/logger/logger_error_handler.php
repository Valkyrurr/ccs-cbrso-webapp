<?php
    error_reporting(E_ALL);
    set_error_handler("logger_error_handler");

    /**
     * function logs all flagged errors to a custom .log file
     * @param $errno
     * @param $errstr
     * @param $errfile
     * @param $errline
     * @param $errcontext
     * @return void
     */
    function logger_error_handler(
        $errno,
        $errstr,
        $errfile = null,
        $errline = null,
        $errcontext = null
    ) {
        $log = date("Y-m-d H:i:s - ");
        $log .= "Error: [". $errno ."], $errstr in $errfile on line $errline, ";
        $log .= "Variables: ". print_r($errcontext['_GET'], true) ."\r\n";

        error_log($log, 3, "error_log.log");
        die("Error Found!");
    }
?>
