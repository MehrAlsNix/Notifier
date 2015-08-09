# Notifier

[![Build Status](https://travis-ci.org/MehrAlsNix/Notifier.svg?branch=develop)](https://travis-ci.org/MehrAlsNix/Notifier) [![Code Climate](https://codeclimate.com/github/MehrAlsNix/Notifier/badges/gpa.svg)](https://codeclimate.com/github/MehrAlsNix/Notifier) [![Test Coverage](https://codeclimate.com/github/MehrAlsNix/Notifier/badges/coverage.svg)](https://codeclimate.com/github/MehrAlsNix/Notifier/coverage)

## Install via composer

Add a dependency on `mehr-als-nix/notifier` to your project's `composer.json` file.

Here is a minimal example of a manually created composer.json file that just defines a dependency on `mehr-als-nix/notifier`
```
{
    "require": {
        "mehr-als-nix/notifier": "~0"
    }
}
```

## Usage

Example:
```
   \MehrAlsNix\Notifier\Notify::getInstance()
       ->sendMessage('Notification', 'This is a desktop message!');
```
