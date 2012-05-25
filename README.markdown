# Auto-Modeler-Demo

This is a demo app to show how to use AutoModeler v5.

## Specs

This app uses phpspec to drive it's development. If you want to run the specs, do this:

	wget http://getcomposer.org/composer.phar
	php composer.phar install

This will install composer. Run the specs with:

	./phpspec-composer.php spec -f d -b -c --bootstrap specs/bootstrap.php
