<?php

class Ltsv
{
	const VERSION = '0.0.1';

	/**
	 * Array or String to LTSV format
	 *
	 * @param  mixed $params string or array parameter
   * @param  array $options
	 * @return mixed (string or array)
	 */
	public static function encode($params, $options = array())
	{
		$result = array();
		foreach($params as $key => $value)
		{
      if (array_key_exists('encoding', $options))
      {
        $key = mb_convert_encoding($key, $options['encoding']);
        $value = mb_convert_encoding($value, $options['encoding']);
      }
      $key = preg_replace('/[^0-9A-Za-z_.-]/', '', $key);
      $value = preg_replace('/[^\x01-\x08\x0B\x0C\x0E-\xFF]/', '', $value);
			$result[] = $key . ':' . $value;
		}

		return implode("\t", $result);
	}

	/**
	 * LTSV format to Array
	 * @param  mixed $ltsv_data string or array parameter
   * @param  array $options
	 * @return mixed (string or array)
	 */
	public static function decode($ltsv_data, $options = array())
	{
		if(is_string($ltsv_data))
		{
			$result = static::parse_string($ltsv_data, $options);
		}
		elseif(is_array($ltsv_data))
		{
			$result = static::parse_array($ltsv_data, $options);
		}
		else
		{
			return FALSE;
		}
		return $result;
	}

	protected static function parse_string($string, $options = array())
	{
		$string = array_key_exists('encoding', $options) ? mb_convert_encoding($string, $options['encoding']) : $string;
		$params = explode("\t", $string);
		if(!is_array($params))
		{
			return FALSE;
		}

		$result = array();
		foreach($params as $split_var)
		{
			list($key, $value) = explode(':', $split_var, 2);
			$result[$key] = $value;
		}
		return $result;
	}

	protected static function parse_array($array, $options = array())
	{
		return array_map(array('Ltsv', 'parse_string'), $array, array($options));
	}

}
