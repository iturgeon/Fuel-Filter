<?

namespace Filter;

class NoFollowFilter extends Filter
{

	public static function process($string)
	{
		return preg_replace('/<a(.*?href=[\'"].*?[\'"].*?)>/', '<a$1 rel="nofollow">', $string);
	}

}
