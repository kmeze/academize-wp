# KM-Academy WordPress plugin

## What is KM-Academy

KM-Academy is a free and open-source WordPress plugin that enables publishing courses and training events on any
WordPress website.

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
