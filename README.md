# The Big Phone Store

This is a PHP assessment for a job interview.
The purpose of the application is to parse various types of data files and group the data displaying a count of all unique items.

## Description

When the above is run the parser should display row by row each product object representation of the row. And create a file with a grouped count for each unique combination i.e. make, model, colour, capacity, network, grade, condition.

## Getting Started

### Dependencies

* PHP 7+

### Installing

* Clone the project to your local environment
* Make sure the **parser.php** and **testParser.php** have executable permissions

```
chmod a+x parser.php testParser.php
```

### Executing program

* Run the following command
```
./parser.php -f products_comma_separated.csv -u=unique-combinations.csv
```
### Options
* **-f, --filename** - [required] the input file you would like to parse
* **-u, --unique-combinations** - [optional] the output file to write the unique combinations

### Unit Tests

* Run the following command
```
./testParser.php
```

A successful test should display the following:
```
>>> Run CSV tests:
>>> testHeader
7 columns in config
>>> testRead
5 unique rows read from sample file
>>> testWrite
6 lines written
>>> assertColumnOrder
Column order matches
>>> CSV TESTS COMPLETE!
>>> Run TSV tests:
>>> testHeader
7 columns in config
>>> testRead
5 unique rows read from sample file
>>> testWrite
6 lines written
>>> assertColumnOrder
Column order matches
>>> TSV TESTS COMPLETE!
```
## Authors

Trevor Schuil
