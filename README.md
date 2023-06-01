# KM-Academy WordPress plugin

## What is KM-Academy
Publish courses and training events on WordPress websites.

## Post Types and Taxonomies
The plugin installs the following post types and taxonomies:

* Courses: ``kmac-course``
  * Subjects: ``kmac-subject``
* Events: ``kmac-event``
  * Event Types: ``kmac-eventtype``

## Blocks
The plugin installs the following blocks:
* Subjects List: ``kmac/subjects``

## Build plugin from scratch
``dotnet build && vi -c ":set nobomb" -c ":wq" obj/Rhetos/Source/WordPress/KMAC/KMAC.php``

``ln -s ~/Dev/km-academy/obj/Rhetos/Source/WordPress/KMAC/ ~/Dev/wordpress/wp-content/plugins/KMAC``
