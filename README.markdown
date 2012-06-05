# Kohana Demo App

This is a demo app to show how to use various Kohana techniques I use.

## Tech used

 - AutoModeler v5
 - Kostache
 - Kohana 3.2
 - PHPSpec
 - DCI Pattern

### DCI

[DCI](http://en.wikipedia.org/wiki/Data,_context_and_interaction) is a pattern for describing behavior of use cases. The use of DCI is recommended to decouple your business logic from your application layer (in this case, Kohana). As a result, it makes your controller layer simpler, more streamlined and easier to test (it also makes it easier to migrate between frameworks).

Because you are abstracting your business logic away from your controller, you can also easily reuse those use cases in other systems, like cron jobs, desktop applications, or any other delivery mechanism.

Most of the logic that goes in a DCI context classically is mixed between a controller and model.

The use of roles in DCI is one major benefit. It keeps your domain models (like your user model) clean, focused and easy to maintain. Since you aren't muddling up your domain models with use case specific behavior (for example, logging a user in, completing an e-commerce checkout procedure or a user replying to another user's message) it means your code becomes easier to maintain and test.

There currently aren't any use cases complex enough to warrant the use of roles, but stay tuned, they are coming as soon as the domain gets fleshed out!

## Examples/How-tos

One of the main points in this repo is to show you how to effectively solve problems using Kohana. Here's some things that are complete:

 - Kostache
  - Recursive Menu
   - [class](https://github.com/zombor/Auto-Modeler-Demo/blob/master/application/classes/view/layout.php#L14-L48)
   - [template](https://github.com/zombor/Auto-Modeler-Demo/blob/master/application/templates/partials/menu.mustache)
  - [Layout](https://github.com/zombor/Auto-Modeler-Demo/blob/master/application/classes/view/layout.php#L3)
 - AutoModeler v5
  - [Simple Gateway](https://github.com/zombor/Auto-Modeler-Demo/blob/master/application/classes/automodeler/gateway/users.php)
  - [Simple Model](https://github.com/zombor/Auto-Modeler-Demo/blob/master/application/classes/model/user.php)

I'm building up the domain in this app slowly, so if it seems like some things are overly simple, it's because they are (for now). :)

If you have any requests, file an issue in this repository, and I'll see what I can do on implementing it.

## Specs

This app uses phpspec to drive it's development. If you want to run the specs, do this:

	wget http://getcomposer.org/composer.phar
	php composer.phar install

This will install composer. Run the specs with:

	./phpspec-composer.php spec -f d -b -c --bootstrap spec/bootstrap.php
