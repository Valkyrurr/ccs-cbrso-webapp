<?php
    error_reporting(E_ALL);
    set_error_handler("logger_error_handler");

    /**
     * This functions logs all flagged errors
     * @param  int    $errno
     * @param  string $errstr
     * @param  string $errfile
     * @param  int $errline
     * @param  array $errcontext
     * @return void
     */
    function logger_error_handler(
        int $errno,
        string $errstr,
        string $errfile = null,
        int $errline = null,
        array $errcontext = null
    ) {
        $log = date("Y-m-d H:i:s - ");
        $log .= "Error: [". $errno ."], $errstr in $errfile on line $errline, ";
        $log .= "Variables: ". print_r($errcontext, true) ."\r\n";

        error_log($log, 3, "error_log.log");
        die("Error Found!");
    }
?>
