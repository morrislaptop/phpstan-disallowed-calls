<?php
declare(strict_types = 1);

use Constructor\ClassWithConstructor;
use Waldo\Quux;

$blade = new Quux\Blade();

// disallowed method
$blade->runner();
$blade->runner(42, true, '808');

// allowed by path and only with these params
$blade->runner(42, true, '909');

// not a disallowed method
$blade->server();

$sub = new Inheritance\Sub();

// parent method allowed by path
$sub->x();

// trait methods allowed by path
$testClass = new Traits\TestClass();
$testClass->x();
$testClassToo = new Traits\AnotherTestClass();
$testClassToo->y();
$testClassToo->zZTop();

// object creation allowed by path
new ClassWithConstructor();
// phpcs:ignore PSR12.Classes.ClassInstantiation.MissingParentheses, SlevomatCodingStandard.ControlStructures.NewWithParentheses.MissingParentheses
new Constructor\ClassWithoutConstructor;
$classname = Constructor\ClassWithoutConstructor::class;
new $classname();

// allowed object creation
new stdClass();

// types that support generics
/**
 * @var PhpOption\None<string> $none
 */
$none = PhpOption\None::create();
$none->getIterator();

/**
 * @var PhpOption\Some<string> $some
 */
$some = PhpOption\Some::create('value');
$some->getIterator();

// disallowed value in an otherwise allowed param, allowed by path
(new DateTime())->format('y');
(new DateTime())->format('Y');
new DateTime('tOmOrRoW');

// case-insensitive methods allowed by path
$blade->movie();
$blade->Movie();
$blade->sequel();
$blade->Sequel();
$blade->trinity();
$blade->Trinity();

// not disallowed by path
$blade->andSorcery();

// allowed by path
$blade->runway();

// allowed by path
(new Interfaces\Implementation())->x();
$foo = new class implements Interfaces\BaseInterface {

	public function x(): void
	{
	}


	public static function y(): void
	{
	}

};
$foo->x();

// allowed by path
$foo = new class extends Inheritance\Base {};
$foo->x();
