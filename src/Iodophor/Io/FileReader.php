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
 * The Iodophor\Io\FileReader represents a character stream whose source is
 * a file.
 *
 * @author     Sven Vollbehr <sven@vollbehr.eu>
 * @copyright  Copyright (c) 2005-2009 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class FileReader extends Reader
{
    /**
     * Constructs the Iodophor\Io\FileReader class with given path to the file. By
     * default the file is opened in read (rb) mode.
     *
     * @param string $filename The path to the file.
     * @throws Iodophor\Io\Exception if the file cannot be read
     */
    public function __construct($filename, $mode = null)
    {
        if ($mode === null)
            $mode = 'rb';
        if (!file_exists($filename) || !is_readable($filename) ||
            ($fd = fopen($filename, $mode)) === false) {
            throw new IoException
                ('Unable to open file for reading: ' . $filename);
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
