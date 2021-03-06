## FtpConnectionInterface

`FtpConnectionInterface` provides an easy way to manipulate an FTP connection instance, however you can use this too types of connections :

 * `FtpConnection`    : Regular FTP connection (Not secure). 
 * `FtpSSLConnection` : FTP over TLS/SSL connection (Secure).

**Example:**

```php
// Create an FTP connection instance
$connection = new FtpConnection('localhost', 'foo', '1234');

// Open the FTP connection
$connection->open();

// Close the connection
$connection->close();

// You can use the following getters 
$connection->getStream();
$connection->getHost();
$connection->getPort();
$connection->getTimeout();
$connection->getTimeout();
$connection->getUsername();
$connection->getPassword();
$connection->isSecure();
$connection->isConnected();
```
