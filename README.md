# KM-Academy Wordpress plugin

## What is KM-Academy
KM-Academy enables publishing courses and training events on WordPress websites.

## Taxonomies and Post Types
The plugin installs the following post types and taxonomies:

* Courses: ``kmac-course``
  * Subjects: ``kmac-subject``
* Events: ``kmac-event``
  * Event Types: ``kmac-eventtype``

## Build plugin from scratch
``dotnet build && vi -c ":set nobomb" -c ":wq" obj/Rhetos/Source/WordPress/KMAC/KMAC.php``
