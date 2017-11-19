5.1.0
-----

**New features**

1. Add a chunked collection. ie: Takes care of splitting Urls into 50,000 chunks.

**Improvements**

1. Increase coverage to 100%.
2. Changes to the gitlab build process. Coverage is now published.
3. Update README badges, remove scrutinizer, add devkit.net ones.
4. Replace phpSpec with phpunit.

**Bug fixes**

1. The "Link" extension didn't write the correct attributes.
3. Attributes weren't being written correctly.

5.0.1
-----

Fixed a bug with the collection validation, was always throwing an exception.

5.0.0
-----

**Breaking changes**

1. PHP 5.6 support dropped.
2. Structure for generating sitemaps has changed.
3. Dropped support for indenting and formatting the output.

**Improvements**

1. Moved the XML logic out of the value objects.
2. Anything that resembles a date has to be an instance of a DateTimeInterface.
3. Update the README.

With this release I also migrated the project to GitLab because of the built in CI.

