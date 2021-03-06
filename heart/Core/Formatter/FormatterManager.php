<?php namespace Qdiscuss\Core\Formatter;

use Illuminate\Container\Container;

class FormatterManager
{
	protected $formatters = [];

	/**
	 * The IoC container instance.
	 *
	 * @var \Illuminate\Container\Container
	 */
	protected $container;

	/**
	 * Create a new formatter manager instance.
	 *
	 * @param  \Illuminate\Container\Container  $container
	 * @return void
	 */
	public function __construct(Container $container = null)
	{
		$this->container = $container ?: new Container;
	}

	public function add($name, $formatter, $priority = 0)
	{
		$this->formatters[$name] = [$formatter, $priority];
	}

	public function remove($name)
	{
		unset($this->formatters[$name]);
	}

	protected function getFormatters()
	{
		$sorted = [];

		foreach ($this->formatters as $array) {
			list($formatter, $priority) = $array;
			$sorted[$priority][] = $formatter;
		}

		ksort($sorted);

		$result = [];

		foreach ($sorted as $formatters) {
			$result = array_merge($result, $formatters);
		}

		return $result;
	}

	public function format($text, $post = null)
	{
		foreach ($this->getFormatters() as $formatter) {
			$text = $this->container->make($formatter)->format($text, $post);
		}

		return $text;
	}

	public function strip($text)
	{
		foreach ($this->getFormatters() as $formatter) {
			$formatter = $this->container->make($formatter);
			if (method_exists($formatter, 'strip')) {
				$text = $formatter->strip($text);
			}
		}

		return $text;
	}
}
