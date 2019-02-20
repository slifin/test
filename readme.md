# slifin\test
_A testing library for generative testing_

Version: 
```php
0.1.0
```

Namespace:

```php
\slifin\test\*
```

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
random\datetime( \DateTime $start , \DateInterval $interval , int $max ) : \DateTime
```
Returns a random ```\DateTime``` object between ```$start``` and ```$max``` many ```$intervals``` in the future
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

### Wheels

### Rotatable
```php
wheel\rotatable( callable $iterate ) : \Closure
```
Returns:
```php 
function ( mixed $start , mixed $initial , mixed $end ) use ( $iterate ) : \Generator
```
- Start the value of the beginning of a rotation
- Initial the value is where the \Generator's iteration will begin
- End describe the end of a rotation

The returned generator will iterate from **initial** up to **end**, reset to **start** then terminate at **initial**
### Infinity
```php
wheel\infinity( callable $generator , ...$args ) : \Generator
```
Returns an infinite generator given a function that can return an iterable
### Rotate
```php
wheel\rotate(\Generator $generator) : mixed
```
Returns the current value of a given generator and moves the iterator forward
