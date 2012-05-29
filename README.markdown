# Kohana Demo App

This is a demo app to show how to use various Kohana techniques I use.

## Tech used

 - AutoModeler v5
 - Kostache
 - Kohana 3.2
 - PHPSpec

## Things to do

 - DCI

## Specs

This app uses phpspec to drive it's development. If you want to run the specs, do this:

	wget http://getcomposer.org/composer.phar
	php composer.phar install

This will install composer. Run the specs with:

	./phpspec-composer.php spec -f d -b -c --bootstrap specs/bootstrap.php
