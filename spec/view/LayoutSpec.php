<?php

class DescribeLayout extends \PHPSpec\Context
{
	public function before()
	{
		$this->subject = new View_Layout;
	}

	public function itHasATitle()
	{
		$this->spec($this->subject->title())->should->beString();
	}

	public function itHasStylesheets()
	{
		$stylesheets = $this->subject->stylesheets();
		$this->spec(count($stylesheets))->should->beGreaterThan(0);
		$this->spec(is_array(current($stylesheets)))->should->beTrue();

		$css = current($stylesheets);
		$this->spec($css['href'])->should->beString();
		$this->spec($css['media'])->should->beString();
	}

	public function itHasScripts()
	{
		$scripts = $this->subject->scripts();
		$this->spec(count($scripts))->should->beGreaterThan(0);
		$this->spec(is_array(current($scripts)))->should->beTrue();

		$css = current($scripts);
		$this->spec($css['src'])->should->beString();
	}

	public function itHasAMenu()
	{
		$menu = $this->subject->menu();
		$this->spec(count($menu))->should->beGreaterThan(0);

		$first = current($menu);
		$this->spec($first['name'])->should->beString();
		$this->spec($first['href'])->should->beString();
		$this->spec(array_key_exists('submenu', $first))->should->beTrue();
	}
}
