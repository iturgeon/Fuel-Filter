<?
namespace Filter;

class View extends \Fuel\Core\View
{

	protected $_filters = [];

	public function add_filters($filters)
	{
		if ( empty($filters)) return;

		if ( ! is_array($filters)) $filters = [$filters];

		foreach ($filters as $key => $filter)
		{
			if ( ! $filter instanceof ViewFilter)
			{
				throw new \FuelException("View Filter {$key} is not ViewFilter class");
			}
			$this->_filters[get_class($filter)] = $filter;
		}
	}

	public function remove_filters($filters)
	{
		if ( empty($filters)) return;
		if ( ! is_array($filters)) $filters = [$filters];
		foreach ($filters as $key => $filter)
		{
			unset($this->_filters[get_class($filter)]);
		}
		
	}

	public function render($file = null)
	{
		$result = parent::render($file);

		if (is_array($this->_filters))
		{
			foreach ($this->_filters as $filter)
			{
				try
				{
					$result = $filter::process($result);
				}
				catch (\Exception $e)
				{
					throw new \FuelException('View Filter '.get_class($filter).' threw an exception: '.$e->getMessage());
				}
			}
		}

		return $result;
	}

}
