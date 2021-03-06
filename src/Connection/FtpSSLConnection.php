<?php

/**
 * This file is part of the Lazzard/php-ftp-client package.
 *
 * (c) El Amrani Chakir <elamrani.sv.laza@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lazzard\FtpClient\Connection;

use Lazzard\FtpClient\Exception\ConnectionException;

/**
 * FtpSSLConnection represents an -Explicit FTP over TLS/SSL- FTP connection.
 *
 * @since  1.0
 * @author El Amrani Chakir <elamrani.sv.laza@gmail.com>
 */
class FtpSSLConnection extends Connection
{
    /**
     * @inheritDoc
     */
    public function __construct($host, $username, $password, $port = 21, $timeout = 90)
    {
        if (!extension_loaded('openssl')) {
            throw new ConnectionException("The openssl extension is required to establish a secure FTP connection.");
        } elseif (!function_exists('ftp_ssl_connect')) {
            throw new ConnectionException("It seems that either the FTP module or openssl extension are
                not statically built into your PHP. If you have to use an SSL-FTP connection, you must 
                compile your own PHP binaries using the right configuration options.");
        }

        parent::__construct($host, $username, $password, $port, $timeout);
    }


    /**
     * {@inheritDoc}
     * 
     * @throws ConnectionException
     */
    protected function connect()
    {
        if (!$this->stream = $this->wrapper->ssl_connect($this->getHost(), $this->getPort(), $this->getTimeout())) {
            throw new ConnectionException($this->wrapper->getFtpErrorMessage()
                ?: "SSL connection failed to the FTP server.");
        }

        $this->isSecure = true;

        $this->wrapper->setConnection($this);

        return true;
    }
}
