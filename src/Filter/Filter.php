<?

namespace Filter;

class Filter
{

	protected static $_instance;

	public static function forge()
	{
		if ( ! self::$_instance) self::$_instance = new static();
		return self::$_instance;
	}

	public function __construct()
	{
		trace('NEW FILTER');
	}

	public static function process($string)
	{
		return $string;
	}

}
