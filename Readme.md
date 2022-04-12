# The PHP Race Game 🚀

The game must simulate cars racing on a <mark>track made of curves and straights</mark> A simulation is a series of rounds. On each round, a car occupies a position on the track according to the rules. The goal is to provide the position of each car on each game round at the end of the simulation. The first car to cross the finish line wins and the simulation ends.

## The rules:

1. A <mark>track</mark> is a <mark>random list of straights and curves called elements</mark>. Each <mark>element has the same length</mark>, regardless if it&#39;s a straight or a curve.
2. A <mark>track</mark> is made up of <mark>approximately 50% curves and approximately 50% straights</mark>.
3. A <mark>track has exactly _2000_ elements in total</mark>.
4. The elements on the <mark>track come in multiples of _40_ of the same type</mark>. So the minimum length of a series of elements is _40_. For example, if the first element of a track is a curve, 39 curves must follow it. If element 41 is again a curve, then again 39 curve elements must follow. If element 81 is a straight, then 39 straight elements must follow.
5. <mark>Each car has two types of speeds</mark>:
   1. speed on straight, and
   2. speed on curve.
6. The <mark>speed</mark> is the <mark>number of elements a car can advance per round on a particular element type</mark>.
7. <mark>Each car has a total speed of _22_. The minimum speed of each type, curve and straight, is _4_</mark>. This means that if a car has a curve speed of 10, then it must have a straight speed equal to 12.
   1. <mark>Curve and straight speeds are chosen randomly</mark>, but according to the rule as per point 7.
8. The <mark>outcome of a race is represented by the class **RaceResult** , which in turn contains a list of **RoundResult** objects</mark>.
   1. A <mark>RoundResult is an object with two elements</mark>, a <mark>round number</mark> and a <mark>cars position array</mark>. The cars position array represents the position on the track of each car on a given round.
9. <mark>If a _car starts_ a round on an element type</mark>, it can only <mark>_end_ the round on the _same element type_</mark>, <mark>_or_ on the _first element of the next sequence of elements_, if it has enough speed to reach it</mark>.
   1. So, for example, let&#39;s assume that car1 speed on straight is 18, and that the track starts with straights. Then at round 0, the car is on element 0. At round 1, the car is on element 18, at round 2 the car is on element 36. If element 40 is a straight, then on round 3 the car is on element 54. If element 40 is a curve, then on round 3 the car is on element 40.
10. The <mark>first car that arrives at the last element _wins_. If two or more cars arrive at the last element at the same time, it&#39;s a _draw_</mark>.
11. There are <mark>_5_ cars in total</mark>.
12. <mark>The ultimate goal of this work is to provide a clean and solid solution for the task. You won&#39;t need to store data onto a Database. Frameworks are not allowed, only vanilla PHP 7.x</mark>. The attached folder includes a list of mandatory classes and functions that must be used as part of the solution, but you are free to create additional files to achieve the best result. Just note that the result must be of type RaceResult. This will be used as input of a test function which will validate your solution.

## Production Installation 📦

_Build assets of the project_:

```sh
yarn build
```

_Install composer dependencies:_

```sh
composer install
```

_Run server for production:_

```sh
php -S localhost:80 -t public/ -d display_errors=0
```

## Development Installation 📦

_Build assets of the project_:

```sh
yarn build
```

_Install composer dependencies:_

```sh
composer install
```

_Run server for development:_

```sh
php -S localhost:8000 -t public/
```
