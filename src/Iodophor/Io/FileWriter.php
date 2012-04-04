<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @copyright  Copyright (c) 2005-2009 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Iodophor\Io;

use Iodophor\Io\Exception as IoException;

/**
 * The Iodophor\Io\FileWriter represents a character stream whose source is
 * a file.
 *
 * @author     Sven Vollbehr <sven@vollbehr.eu>
 * @copyright  Copyright (c) 2005-2009 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class FileWriter extends Writer
{
    /**
     * Constructs the Iodophor\Io\FileWriter class with given path to the file. By
     * default the file is opened in write mode without altering its content
     * (ie r+b mode if the file exists, and wb mode if not).
     *
     * @param string $filename The path to the file.
     * @throws Iodophor\Io\Exception if the file cannot be written
     */
    public function __construct($filename, $mode = null)
    {
        if ($mode === null)
            $mode = file_exists($filename) ? 'r+b' : 'wb';
        if (($fd = fopen($filename, $mode)) === false) {
            throw new IoException
                ('Unable to open file for writing: ' . $filename);
        }
        parent::__construct($fd);
    }

    /**
     * Closes the file descriptor.
     */
    public function __destruct()
    {
        $this->close();
    }
}
