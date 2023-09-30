# Gawain rides on Gringolet

Gringolet is the name of the router, and is the absolute core of Gawain. Every thing in Gawain is based on the current route  - Gringolet parses the route (i.e URL) as the very first thing, and anything after that is based on your instructions, i.e what to do with that particular route in the routes/*.routes files or as defined in your PHP.

## What is a route?
A route is any valid / legal path to a website, i.e an URL. A route can contain wildcards so you can have dynamic routing based on rational rules, and by that Gawain is designed for RESTful URL's, but you are not limited to do so, or encuraged to be slave of a RESTful URL-pattern. 

Som examples of routes that could work saide by side in the same project:

/:int/::string/edit 
this-is-my-awesome-url.html
hello world 42
abc/123/:float
abc/123/:string
abc/:string/:string
abc-123/:string/qwerty-qwerty/test/:float

And so on...Please raise an issue if you discover an impossible pattern. So far I have not seen any. 

## Dynamic URL's
As mentioned you can have wildcards in a URL path. Possible wildcards are

/:int
/:float
/:bool
/:string

The meaning should be obvoius.  You can combine those wildscards in any way you want. 

example.com/:int/:string/:string

will match 

example.com/42/arthur/dent

but not

example.com/42.0/arthur/dent
example.com/42/arthur/
example.com/true/arthur/dent

There are no distinction between :string and :int, but distinction between :int and :string. Consider :int, :float and :bool as refinements of a :string. 42 match both a string and an :int, but it does not match a float.  true match a :string and a :bool and so on. 

## Defining routes via .routes files
Upon pageload Gawain will look for .routes files in the /routes directory.  All .routes-files are loaded and parsed, and a route that mathes Gringolets findings are "executed".  A .routes file is a very simple JSON file that follow the scheme 

{ "routes": [ { route }, { route } ... ] }

A route can contain the following properties 

### Why multiple .routes files?
It can seem odd and resource-consuming that you are encouraged to maintain multiple .routes files. The reason is simple: *It is easier to maintain smaller pirces of JSON, and it is easier to group routes in logical chunks. For example, you will probably not need to have admin available for end-users in production, and then you simply just not want to ship the admin.routes file.  

## You do not need .routes files
The .routes files are just convenient templates that automatizes what you could do in plain PHP.  You have the global $app or $gawain object available, the you can add a new route (or page) with

$app->




you could do by runtime in code.  After including lib/Gawain.php you can 









. 
