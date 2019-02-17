# Test
Randomiser functions and wheels to create unique values.

## Random

### Integer
```php
\slifin\random\integer( void ) : int
\slifin\random\integer( int $min , int $max ) : int
```

An alias of mt_rand for creating random integers within a range.
### String
```php
\slifin\random\string( array $alphabet, int $length ) : string
```

### DateTime
```php
\slifin\random\datetime( \DateTime $start, \DateInterval $interval, int $max ) : \DateTime
```

## Wheels

Wheels return infinite sets of rotations, defined by the developer

Uses
  - Stateless unique values from a given set
  - Defines a set without realising it entirely into memory

A wheel is created by
  - a starting state
  - a way to rotate to the next value
  - a ending condition

### Examples

### Increment Integer
```php
/**
 * An example of a integer incrementation.
 *
 * @param integer $increment The increment amount.
 * @param integer $end The ending boundary.
 * @param integer $start The starting value.
 *
 * @return \Generator Infinite vector of the given rotation.
 */
function increment_integer_wheel(int $increment, int $start, int $end) : \Generator
{
    $generator = wheel(
        $start,
        function (int $i) use ($increment) : int {
            return $i + $increment;
        },
        function (int $i) use ($end) : bool {
            return $i === $end;
        }
    );

    return $generator;
}
```

### Increment String
```php
/**
 * An example of incrementing a string given PHP's idea of an alphabet.
 *
 * @param string $start The start
 * @param string $end The end
 *
 * @return \Generator An infinite set of alphabet chars from $start.
 */
function increment_string(string $start, string $end) : \Generator
{
    $generator = wheel(
        $start,
        function (string $str) : string {
            return ++$str;
        },
        function (string $str) use ($end) : bool {
            return $str === $end;
        }
    );

    return $generator;
}
```

### Increment String with custom alphabet
```php
/**
 * An example of incrementing a string given a custom alphabet
 *
 * @param string $start The start string.
 * @param array $alphabet Ordered custom alphabet.
 * @param string $end The string that would stop the rotation.
 *
 * @return \Generator An infinite set of specified characters from $start.
 */
function increment_custom_string(string $start, array $alphabet, string $end) : \Generator
{
    array_unshift($alphabet, 1);
    unset($alphabet[0]);

    $generator = wheel(
        $start,
        function (string $string) use ($alphabet) : string {

            $numbers = array_keys($alphabet);
            $numeric = str_replace($alphabet, $numbers, $string);
            $base = count($alphabet) + 1;
            $decimal = base_convert($numeric, $base, 10);
            $string = base_convert(++$decimal, 10, $base);
            strlen($decimal) !== strlen($string)
                and $string = str_replace('0', '1', $string);
            $string = str_replace($numbers, $alphabet, $string);

            return $string;
        },
        function (string $string) use ($end) : bool {
            return $string === $end;
        }
    );

    return $generator;
}
```

### Increment DateTime

When testing you may want two (or more) unique Datetime values between two
dates, create a datetime wheel and ```rotate()``` it two times to get your unique values, to randomise your test make ```$start``` randomised and seeded with ```mt_srand()``` to replicate

If your range has less than two values in it, the wheel will not warn you, it's up to you to ensure the range is large enough or your callee code handles duplicates

```php
/**
 * An infinite set of given date rotation.
 *
 * @param \DateTime $start The starting date
 * @param \DateInterval $interval The interval
 * @param \DateTime $end The end of the rotation
 *
 * @return \Generator An infinite set of the given rotation.
 */
function datetime_wheel(
    \DateTime $start,
    \DateInterval $interval,
    \DateTime $end,
) : \Generator {

    $generator = wheel(
        $start,
        function (\DateTime $datetime) use ($interval) : \DateTime {
            return date_add(clone $datetime, $interval);
        },
        function (\DateTime $datetime) use ($end) : bool {
            return $datetime === $end;
        }
    );

    return $generator;
}
```


