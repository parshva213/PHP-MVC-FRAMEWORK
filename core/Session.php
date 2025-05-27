<?php

namespace core;

class Session
{
    protected const FLASH_KEY = 'flash_messages';

    public function __construct()
    {
        session_start();
        if (!isset($_SESSION[self::FLASH_KEY])) {
            $_SESSION[self::FLASH_KEY] = [];
        }
        $flashMessages = &$_SESSION[self::FLASH_KEY];
        foreach ($flashMessages as $key => &$flashMessage) {
            // Mark flash message to be removed
            $flashMessage['remove'] = true;
        }
    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key) {
        return $_SESSION[$key] ?? false;
    }


    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public function remove($key) {
        unset($_SESSION[$key]);
    }

    public function __destruct()
    {
        if (!isset($_SESSION[self::FLASH_KEY])) {
            return;
        }
        $flashMessages = &$_SESSION[self::FLASH_KEY];
        foreach ($flashMessages as $key => $flashMessage) {
            if ($flashMessage['remove'] === true) {
                unset($flashMessages[$key]);
            }
        }
    }
}
?>