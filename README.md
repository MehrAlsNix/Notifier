# Notifier

[![Build Status](https://travis-ci.org/MehrAlsNix/Notifier.svg?branch=develop)](https://travis-ci.org/MehrAlsNix/Notifier) [![Code Climate](https://codeclimate.com/github/MehrAlsNix/Notifier/badges/gpa.svg)](https://codeclimate.com/github/MehrAlsNix/Notifier) [![Test Coverage](https://codeclimate.com/github/MehrAlsNix/Notifier/badges/coverage.svg)](https://codeclimate.com/github/MehrAlsNix/Notifier/coverage) [![Dependency Status](https://www.versioneye.com/user/projects/55c76bc0653762001a003770/badge.svg?style=flat)](https://www.versioneye.com/user/projects/55c76bc0653762001a003770)

## Desktop Notifications

`Notifier` acts as a wrapper for desktop notify applications on different operating systems.
 
 Following notify wrappers are build in and would make checks to chose one of:
 
 * notify-send (Linux)
 * terminal-notifier (Mac)
 * toast.exe (Windows) [nels-o/toaster](https://github.com/nels-o/toaster)

## Install via composer

Add a dependency on `mehr-als-nix/notifier` to your project's `composer.json` file.

Here is a minimal example of a manually created composer.json file that just defines a dependency on `mehr-als-nix/notifier`
```
{
    "require": {
        "mehr-als-nix/notifier": "~1"
    }
}
```

## Usage

Example:
```
   \MehrAlsNix\Notifier\Notify::getInstance()
       ->sendMessage('Notification', 'This is a desktop message!');
```

## Extend

Custom class has to extend from `\MehrAlsNix\Notifier\Notification`

    <?php
    
    namespace \Custom\Notifier;
    
    class GrowlNotifier extends \MehrAlsNix\Notifier\Notification
    {
        /**
         * Notify with `growlnotify`.
         *
         * @param string $title
         * @param string $message
         *
         * @return void
         */
        protected function notify($title, $message)
        {
            $this->execute("growlnotify -t '{$title}' -m '{$message}'");
        }
    
        /**
         * @inheritdoc
         *
         * @return bool
         */
        public function isAvailable()
        {
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                return (bool) $this->execute('where.exe growlnotify');
            }
            
            return (bool) $this->execute('which growlnotify');
        }
    }

And can then be used like:

```
    \MehrAlsNix\Notifier\Notify::getInstance('\Custom\Notifier\GrowlNotifier')
        ->sendMessage('Notification', 'This is a desktop message!');
```
