<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfYaml offers convenience methods to load and dump YAML.
 *
 * @package    symfony
 * @subpackage yaml
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfYaml.class.php 8988 2008-05-15 20:24:26Z fabien $
 */
class sfYaml
{
  static protected
    $spec = '1.1';

  /**
   * Sets the YAML specification version to use.
   *
   * @param string $version The YAML specification version
   */
  static public function setSpecVersion($version)
  {
    if ($version !== '1.2')
    {
      throw new InvalidArgumentException(sprintf('Version %s of the YAML specifications is not supported', $version));
    }

    self::$spec = $version;
  }

  /**
   * Gets the YAML specification version to use.
   *
   * @return string The YAML specification version
   */
  static public function getSpecVersion()
  {
    return self::$spec;
  }

  /**
   * Loads YAML into a PHP array.
   *
   * The load method, when supplied with a YAML stream (string or file),
   * will do its best to convert YAML in a file into a PHP array.
   *
   *  Usage:
   *  <code>
   *   $array = sfYaml::load('config.yml');
   *   print_r($array);
   *  </code>
   *
   * @param string $input Path of YAML file or string containing YAML
   *
   * @return array The YAML converted to a PHP array
   *
   * @throws InvalidArgumentException If the YAML is not valid
   */
  public static function load($input)
  {
    // if input is a file, process it
    if (strpos($input, "\n") === false && is_file($input))
    {
      return yaml_parse_file($input, -1);
    }

    // if an array is returned by the config file assume it's in plain php form else in YAML
    if (is_array($input))
    {
      return $input;
    }

    return yaml_parse($input);
  }

  /**
   * Dumps a PHP array to a YAML string.
   *
   * The dump method, when supplied with an array, will do its best
   * to convert the array into friendly YAML.
   *
   * @param array   $array PHP array
   * @param integer $inline The level where you switch to inline YAML
   *
   * @return string A YAML string representing the original PHP array
   */
  public static function dump($array, $inline = null)
  {
    return yaml_emit($array);
  }
}