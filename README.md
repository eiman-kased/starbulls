# StarBulls

## Creating a concept company called StarBulls where you can get both your wings and coffee fix

It's a 5 page site

- Home
- Menu
- Specials of the Week
- About us
- Apply Page

## Set up and configuration

### Create a configuration within your local server environment

This can be done with either nginx or apache, the choice is yours. Be wary of what you set as the server name (ie starbulls.com) as some links may not work well or some functionality my not behave as expected.

### Create the starbulls database

- Be sure you're always using the latest db schema.
- run the contents of starbulls.down.sql _then_ starbulls.up.sql to get the latest schema
- add some basic info to both the reviews and user tables

### Update dependencies

Run `composer update` from the root directory of the project