# slifin\test
_A testing library for generative testing_

Version:
```php
0.1.0
```

## Examples
(currently missing)

## API Reference

### Randomizers

#### Boolean
```php
random\boolean() : bool
```
Returns true or false
#### Integer
```php
random\integer( int $min , int $max ) : int
```
Returns a random integer inclusive of the min and max boundaries
#### String
```php
random\string( array $alphabet , int $length ) : string
```
Returns a random string given characters from a custom alphabet
#### DateTime
```php
random\datetime( \DateTime $start , \DateInterval $interval , \DateTime $end ) : \DateTime
```
Returns a random ```\DateTime``` object between ```$start``` and ```$end``` in successions of ```$interval```
### Incrementers

#### Boolean
```php
incrementer\boolean( bool $bool ) : bool
```
Returns the opposite boolean to ```$bool```
#### Integer
```php
incrementer\integer( int $increment ) : \Closure
```
Returns:
```php
function ( int $i ) use ( $increment ) : int
```
Returns a function that will increment its input ```$i``` by ```$increment```
#### String
```php
incrementer\string( array $alphabet ) : \Closure
```
Returns:
```php
function ( string $string ) use ( $alphabet ) : string
```
Returns a function that will increment its input by the given ```$alphabet```
#### DateTime
```php
incrementer\DateTime( \DateInterval $interval ) : \Closure
```
Returns:
```php
function ( \DateTime $datetime ) use ( $interval ) : \DateTime
```
Returns a function that will increment its input by the given ```$interval```
