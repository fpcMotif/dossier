Dossier
=======

Created by Steven Frank <stevenf@panic.com> 
August 5, 2014

Overview
--------

This is a rough and early implementation of an idea I had for producing a wiki-like site from a simply structured database.

Demo
----

You can view a sample installation at:

<http://stevenf.com/dossier-sample/>

Entities and properties
-----------------------

Objects in the database are known as "entities".  An entity could be a person, place, thing, event -- pretty much anything.

Each entity can have 0 or more "properties".  Properties are simply key/value pairs.

An example entity might be "Bill Gates".  This entity might have a property named "Company" containing the value "Microsoft".

Other than this basic schema, the data is completely freeform.

Usage
-----

The index page will show you a list of all entities in the system.

Clicking an entity will show you all of its properties.

Where things get interesting is when you click on a property's value.  You'll be shown what would be called "backlinks" in wiki parlance -- other entities who have the same value for the same property, and entities whose name matches.

Installation
------------

1. Put all the PHP files in a folder somewhere web-accessible.
1. Create a database and import the contents of dossier-sample.sql into it (if you want sample data).
1. Edit db.php to reflect your database configuration.
1. Visit in a web browser

To-do
-----

There's tons to be done.  Pretty much nothing is here except the core concept.  For example, there's no way currently to edit the database through the web interface -- you have to edit the database directly.

Feel free to fork and pitch in on any feature that seems interesting to you.

Disclaimer
----------

This code was written in a hurry and is not the world's finest PHP code.  I don't guarantee its safety or performance.


