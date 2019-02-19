# Test
A testing library for generative testing

Namespace: 

```php
\slifin\test\*
```

## Randomizers

### Boolean
```php
random\boolean() : bool
```
Returns true or false
### Integer
```php
random\integer( int $min , int $max ) : int
```
Returns a random integer inclusive of the min and max boundaries
### String
```php
random\string( array $alphabet , int $length ) : string
```

### DateTime
```php
random\datetime( \DateTime $start , \DateInterval $interval , int $max ) : \DateTime
```
## Incrementers

### Boolean
```php
incrementer\boolean( bool $bool ) : bool
```
### Integer
### String
### DateTime

## Wheels

A wheel is a rotation of testing values, a wheel has one
rotation by default but can have many + infinite rotations

Uses
  - Stateless unique values from a unique set
  - Defines a set without realising it entirely into memory

A wheel is created by
  - a starting state
  - a starting boundary
  - a way to rotate to the next value
  - a ending boundary



### Rotatable

### Infinity

### Rotate
