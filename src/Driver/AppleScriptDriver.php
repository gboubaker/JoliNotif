<?php

/**
 * This file is part of the JoliNotif project.
 *
 * (c) Loïck Piera <pyrech@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliNotif\Driver;

use JoliNotif\Notification;
use Symfony\Component\Process\ProcessBuilder;

/**
 * This driver can be used on Mac OS X 10.9+.
 */
class AppleScriptDriver extends UnixBasedDriver
{
    /**
     * {@inheritdoc}
     */
    public function getBinary()
    {
        return 'osascript';
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        return static::PRIORITY_HIGH;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureProcess(ProcessBuilder $processBuilder, Notification $notification)
    {
        $script = 'display notification "'.$notification->getBody().'"';

        if ($notification->getTitle()) {
            $script .= ' with title "'.$notification->getTitle().'"';
        }

        $processBuilder->add('-e');
        $processBuilder->add($script);
    }
}
