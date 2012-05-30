# Kohana Demo App

This is a demo app to show how to use various Kohana techniques I use.

## Tech used

 - AutoModeler v5
 - Kostache
 - Kohana 3.2
 - PHPSpec
 - DCI Pattern

### DCI

DCI is a pattern for describing behavior of use cases. The use of DCI is recommended to decouple your business logic from your application layer (in this case, Kohana). As a result, it makes your controller layer simpler, more streamlined and easier to test (it also makes it easier to migrate between frameworks).

Because you are abstracting your business logic away from your controller, you can also easily reuse those use cases in other systems, like cron jobs, desktop applications, or any other delivery mechanism.

Most of the logic that goes in a DCI context classically is mixed between a controller and model.

## Specs

This app uses phpspec to drive it's development. If you want to run the specs, do this:

	wget http://getcomposer.org/composer.phar
	php composer.phar install

This will install composer. Run the specs with:

	./phpspec-composer.php spec -f d -b -c --bootstrap spec/bootstrap.php
