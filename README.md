# AcademizeWP WordPress plugin

## What is AcademizeWP

AcademizeWP is a free and open-source WordPress plugin that enables publishing courses and training events on any
WordPress website.

## Features
* Create and manage courses
* Categorize course by one or more subject
* Browse courses by subject using Subjects List block

## Post Types and Taxonomies

The plugin installs the following post types and taxonomies:

* **Courses**: ``kmac-course``
    * **Subjects**: ``kmac-subject``
* **Events**: ``kmac-event``
    * **Event Types**: ``kmac-eventtype``

## Blocks

The plugin installs the following blocks:

* **Subjects List**: ``kmac/subjects``

## Build plugin from scratch

``dotnet build && vi -c ":set nobomb" -c ":wq" obj/Rhetos/Source/WordPress/acwp/acwp.php``

``ln -s ~/Dev/AcademizeWP/Build/acwp/ ~/Dev/wordpress/wp-content/plugins/acwp``
