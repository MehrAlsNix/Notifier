<?php
/**
 * Created by PhpStorm.
 * User: said
 * Date: 30.05.2015
 * Time: 15:28
 */

namespace MehrAlsNix\Notifier;


class WindowsDefaultListener extends ListenerBase
{

    /**
     * @param string $title
     * @param string $message
     * @return null
     */
    protected function notify($title, $message)
    {
        exec(__DIR__ . "/../vendor/nels-o/toaster/toast/bin/Release/toast.exe -t \"{$title}}\" -m \"{$message}\"");
    }

    /**
     * @return bool
     */
    public function isAvailable()
    {
        return strtoupper(substr(php_uname('s'), 0, 3)) === 'WIN';
    }
}