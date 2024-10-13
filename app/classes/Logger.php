<?php
class Logger {
    private $log_file;
    private $log_level;

    public function __construct() {
        $config = include('../config/log_config.php');
        $this->log_file = $config['log_file'];
        $this->log_level = $config['log_level'];
    }

    public function log($message, $level = 'info') {
        // Check if the log level is sufficient
        if (!$this->isLogLevelSufficient($level)) {
            return;
        }

        $date = date('Y-m-d H:i:s');
        $formatted_message = "[{$date}] - [{$level}] - {$message}\n";
        file_put_contents($this->log_file, $formatted_message, FILE_APPEND);
    }

    private function isLogLevelSufficient($level) {
        $levels = ['debug' => 0, 'info' => 1, 'warning' => 2, 'error' => 3];
        return $levels[$level] >= $levels[$this->log_level];
    }

    public function logDebug($message) {
        $this->log($message, 'debug');
    }

    public function logInfo($message) {
        $this->log($message, 'info');
    }

    public function logWarning($message) {
        $this->log($message, 'warning');
    }

    public function logError($message) {
        $this->log($message, 'error');
    }
}
?>
