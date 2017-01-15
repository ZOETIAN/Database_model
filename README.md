# A tiny pelagic_predators_tagging_system

Back to Dalhousie, I did this with my best friend (also, an ocean nerd), Jason Parsons.

PPTS is a theoretical system for tagging marine animal species in order to track movement, temperature, depth, etc. The data is retrieved from the research group of Stanford University. (http://gtopp.org)

Basic Features

Allows user to query the reading table of our database in order to view only the columns they are interested in.
Results presented in a table format and can be ordered by different attribute types and sorted in ascending or descending order.

PPTS Mechanism

PPTS starts with the attachment of radio transmitter tags to a wide variety of marine species.
Tags are detected by a series of buoys in the ocean.
Each buoy transmits their data to stations on land via a satellite network where the data can be organized for analysis.

Tool Sets

Database was created with phpmyadmin within an XAMPP environment with an SQL backbone
Locally hosted web server run using Apache, also under XAMPP.
Web application makes use of the database through a php/html interface.
Challenges We Ran into

Proposed db schema reduces redundancy by taking original datasets and first putting them in 1NF.
After this we further decompose our structure to ensure no function dependencies by non-primary key attributes.
Separate the animal, buoy, and station into individual entities each with their own table as well as a 4th table to house individual data readings.
Connect the front-end and back-end using php

