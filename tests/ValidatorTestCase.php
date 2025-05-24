<?php

abstract class ValidatorTestCase extends Orchestra\Testbench\TestCase
{
	public function setUp(): void
	{
		parent::setUp();

		$this->app->register(\ValidatorPTBr\ValidatorProvider::class);
	}
}