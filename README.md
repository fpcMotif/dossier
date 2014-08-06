Dossier
=======

Created by Steven Frank <stevenf@panic.com> 
August 5, 2014

Overview
--------

This is a rough and early implementation of an idea I had for producing a wiki-like site from a simply structured database of records with freeform key/value pairs.

Conceptually, it’s similar to a relational database, except each record can have any number of fields, and they do not have to be the same fields from record to record. You can even repeat fields on a single record. (Say, for a example if you have a record of a person who has been married multiple times, you could just repeat the “Spouse” property on that record.)

Like a wiki, you do not have to worry about manually creating links between records. Those will be discovered for you automatically based on properties and property values.

Demo
----

You can view a sample installation at:

<http://stevenf.com/dossier-sample/>

Entities and properties
-----------------------

Objects in the database are known as "entities".  An entity could be a person, place, thing, event -- pretty much anything.

Each entity can have 0 or more "properties".  Properties are simply key/value pairs.

An example entity might be "Bill Gates".  This entity might have a property named "Company" containing the value "Microsoft".  As your data set grows, you can follow the "Microsoft" link back to any entity which uses it as a property value to, say, generate a list of Microsoft employees.

Other than this basic schema, the data is completely freeform.

Properties have one additional field, called "extra", which can be used to add a short annotation for the key/value pair.  Going back to our "Bill Gates" entity example, we might add an extra to his "Company" property containing the years he functioned as CEO of the company.  Extras are displayed on the site just below the property value they belong to.

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

Data formatting recommendations
-------------------------------

For dates, use YYYY-MM-DD format.

To-do
-----

There's tons to be done.  Pretty much nothing is here except the core concept.  For example, there's no way currently to edit the database through the web interface -- you have to edit the database directly.

Feel free to fork and pitch in on any feature that seems interesting to you.

Disclaimer
----------

This code was written in a hurry and is not the world's finest PHP code.  I don't guarantee its safety or performance.


