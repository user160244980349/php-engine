<?php

namespace Engine\Command;

/**
 * Session.php
 *
 * Command class intended for manage sessions
 */
class Session
{

    /**
     * Clears user session
     */
    public static function clear()
    {
        print("clearing sessions...\n");
        self::rrmdir(session_save_path());
        print("sessions were cleared.\n");
    }

    /**
     * Recursively removes directory content
     *
     * @access private.
     * @param $directory .
     * @param null $delete_parent .
     */
    private static function rrmdir($directory, $delete_parent = null)
    {
        $files = glob($directory . '/{,.}[!.,!..]*', GLOB_MARK | GLOB_BRACE);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::rrmdir($file, 1);
            } else {
                unlink($file);
            }
        }
        if ($delete_parent) {
            rmdir($directory);
        }
    }

}