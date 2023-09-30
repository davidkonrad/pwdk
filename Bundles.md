# Bundles
A "bundle" is Gawains take on plugins, packages, libraries or whatever you would like to call it.  Bundles are the next level after a route, before rendering the template, if any, and your content.  Everything you want to include in your website, except the actual page content itself, should be defined via bundles. 

So a bundle can be used to include CSS, javascript, frameworks, middleware scripts or whatever.  Bundles are defined and registered by a `.bundle` file, and thats how you can automatically import external resources to your Gawain website.  

#### Example
Even here in the year 2021 many people are using jQuery.  This heroic script still survives as first choice for manipulating the DOM, even though it is not so much needed anymore, since we now have better standards and growned up browsers.  A bundle to include the latest version of jQuery could look like this (`bundles/samples/jQuery 3.3.1 slim.bundle`)

```json
{
  "bundle": {
     "name": "jQuery 3.3.1 slim",
     "enabled": "false",
     "description":  "The good old cargo cult script",
     "category": "CDN",
     "head": [
        {
          "tagtype": "script",
          "src": "https:\/\/code.jquery.com\/jquery-3.3.1.slim.min.js",
          "integrity": "sha384-q8i\/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo",
          "crossorigin": "anonymous"
        }
     ]
  }
}
```
	
Go to `/admin-bundles` and register that bundle, if it not already is imported. Check enabled and you have now imported jQuery to all your pages. 

The admin-tool are actually using jQuery because it is using jQuery DataTables to show the bundles in a more nicely way, but you can just disable the use of jQuery and DataTables with no harm. 




 in fact you can using some bundles itself. 
Import that 

But what the heck? It is also today still more many peroples 

2012 
The simpliest type of a bundle 

Gawain is born with many co




