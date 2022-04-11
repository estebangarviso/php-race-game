<?php

namespace App\Race;

use App\Race\RaceResult;
use App\Race\RoundResult;

class Race
{

    /** @var array $cars */
    public $cars = [];
    /** @var int $totalSpeed */
    public $totalSpeed = 22;
    /** @var int $totalCars */
    public $totalCars = 5;
    /** @var int $lastTrack */
    public $lastTrack;
    /** @var int $nextTrack */
    public $nextTrack;

    // Round Stuff
    public $round = 0;
    public $totalCurved = 0;
    public $totalStraight = 0;

    public $elementsMax = 40;
    public $elementsLow = 36;
    public $multiplier = 1;

    // Nice variables for our arrays
    public $firstPlace;
    public $secondPlace;
    public $thirdPlace;
    public $fourthPlace;
    public $fifthPlace;

    public $firstPlaceCar = "";
    public $secondPlaceCar = "";
    public $thirdPlaceCar = "";
    public $fourthPlaceCar = "";
    public $fifthPlaceCar = "";

    public function runRace(): RaceResult
    {
        return new RaceResult();
    }

    //! VALIDATE CARS SPEEDS
    public function checkSpeeds($i)
    {
        // Generate our random speeds
        $curve = rand(4, 18);
        $straight = rand(4, 18);

        $total = $curve + $straight;
        // if total speed is greater than allowable speed, return speed checl
        if ($total > $this->totalSpeed) {
            return $this->checkSpeeds($i);
        } elseif ($total != $this->totalSpeed) {
            //if curved speed and straight speed doesnt equal total allowable speed, rerun checks
            return $this->checkSpeeds($i);

            // Otherwise speeds are good, return value.
        } else {
            return ['straight' => $straight, 'curve' => $curve, 'elements' => 0];
        }
    }

    // Create Random Cars
    public function randomCar()
    {
        $makes = [
            'Big Dog MUTT',
            'Bombardier TRAXTER 500 4X4 AUTO XT',
            'Panoz ESPERANTE',
            'Ski-Doo MX Z 800R RENEGADE X',
            'Kawasaki KX500',
            'Peterbilt 384',
            'Dodge ATOS',
            'Aprilia SCARABEO 100',
            'Yamaha FX10M FX NYTRO MTX SE 153',
            'Ktm 450 XC-F',
            'Ski-Doo SUMMIT 800 R SPORT',
            'Arctic Cat Z 120 SNO PRO',
            'Arctic Cat PANTHER 570 R',
            'Ducati HYPERMOTARD SP',
            'Honda TRX500FGA FOURTRAX FOREMAN RUBICON',
            'Kawasaki EX500 NINJA 500R',
            'Kia RIO',
            'Yamaha VX1100 WAVERUNNER 1100 SPORT',
            'Volkswagen TOUAREG',
            'Ford IKON',
            'Can-Am OUTLANDER 500 HO 4X4 EFI XT',
            'Bmw F800ST',
            'Honda CBR650F ABS',
            'Mercedes-Benz GL350',
            'Harley Davidson FLHRSE6 CVO ROAD KING',
            'Can-Am RENEGADE 1000',
            'Ktm 250 EXC 4-STROKE',
            'Yamaha SJ700 SUPER JET',
            'Yamaha VK10 VIKING PROFESSIONAL',
            'Arctic Cat T570'
        ];

        return $makes[array_rand($makes)];
    }

    //! Generate all car speeds based on rules for total cars
    public function generateCarSpeeds()
    {
        $car = [];
        for ($i = 0; $i < $this->totalCars; $i++) {
            $car = $this->checkSpeeds($i);
            $car['name'] = 'Car [' . $i . ']';
            $car['model'] = $this->randomCar();
            $car['elements'] = 0;
            array_push($this->cars, $car);
        }
        return $this->cars;
    }

    //! METHOD TO START THE RACE
    public function startRace()
    {
        //Generate our cars
        $this->generateCarSpeeds();
        // random for straight or curve true / false respectively
        $track = rand(0, 1);

        //Push first array values of '0'
        $this->changeTires();

        if ($track) {
            // print "<h1>Straight Track</h1>";
            $this->straightTrack();
        } else {
            // print "<h1>Curved Track</h1>";
            $this->curvedTrack();
        } // if /else track
        return $this->cars;
    } // start race

    //! Curved track method
    public function curvedTrack()
    {
        //change elements value
        for ($i = 0; $i < $this->totalCars; $i++) {
            //First check to see if the element is empty.
            if (empty($this->cars[$i]['elements'])) {
                // Assign intital value
                $this->cars[$i]['elements'] = $this->cars[$i]['curve'];
            } else {
                // assign value + value
                $this->cars[$i]['elements'] += $this->cars[$i]['curve'];
            }
        }
        //set last track and change round
        $this->lastTrack = 0;
        $this->totalCurved++;
        $this->round++;

        //Push to array
        $this->changeTires();

        return $this->continueRace();
    }

    //! Straight track method
    public function straightTrack()
    {
        //change elements value
        for ($i = 0; $i < $this->totalCars; $i++) {
            if (empty($this->cars[$i]['elements'])) {
                // Assign intital value
                $this->cars[$i]['elements'] = $this->cars[$i]['straight'];
            } else {
                // assign value + value
                $this->cars[$i]['elements'] += $this->cars[$i]['straight'];
            }
        }
        //set last track change rounds
        $this->lastTrack = 1;
        $this->totalStraight++;
        $this->round++;

        $this->changeTires();

        return $this->continueRace();
    }

    //! CONTINUE RACE METHOD
    public function continueRace()
    {
        // Find out if any car is near the 40 elements of that track type
        $newMultipler = false;
        $nextTrack = rand(0, 1);
        for ($i = 0; $i < $this->totalCars; $i++) {
            if ($this->cars[$i]['elements'] >= ($this->elementsLow * $this->multiplier)) {
                // A car is close to our minimum distance, What is the next tracK?
                if ($nextTrack === $this->lastTrack) {
                    // Tracks are the same
                    if ($this->lastTrack) {
                        //track is straight assign that value
                        $this->cars[$i]['elements'] += $this->cars[$i]['straight'];
                    } else {
                        // Curved track
                        $this->cars[$i]['elements'] += $this->cars[$i]['curve'];
                    }
                } else {
                    // Tracks are different, assign minimum value to car.
                    $this->cars[$i]['elements'] = ($this->elementsMax * $this->multiplier);
                    $newMultipler = true;
                } // IF $nextTrack === $this->lastTrack
            } else {
                //Car isn't close to the minimum continue with last track
                if ($this->lastTrack) {
                    //straight track
                    $this->cars[$i]['elements'] += $this->cars[$i]['straight'];
                } else {
                    //curved track
                    $this->cars[$i]['elements'] += $this->cars[$i]['curve'];
                }
            }
        } // for loop


        if ($newMultipler) {
            $this->multiplier++;
        }

        //send
        return $this->pitStop();
    }


    // Change Tires method will submit values to RoundResult Class
    public function changeTires()
    {

        $cars = array_column($this->cars, 'elements');
        array_multisort($cars, SORT_DESC, $this->cars);


        $this->firstPlace = $this->cars[0]['elements'];
        $this->firstPlaceCar = $this->cars[0]['model'];

        $this->secondPlace = $this->cars[1]['elements'];
        $this->secondPlaceCar = $this->cars[1]['model'];

        $this->thirdPlace = $this->cars[2]['elements'];
        $this->thirdPlaceCar = $this->cars[2]['model'];

        $this->fourthPlace = $this->cars[3]['elements'];
        $this->fourthPlaceCar = $this->cars[3]['model'];

        $this->fifthPlace = $this->cars[4]['elements'];
        $this->fifthPlaceCar = $this->cars[4]['model'];


        //Push to our RoundResult Class
        $carPositions = [
            '1st ' . $this->firstPlaceCar => $this->firstPlace,
            '2nd ' . $this->secondPlaceCar => $this->secondPlace,
            '3rd ' . $this->thirdPlaceCar => $this->thirdPlace,
            '4th ' . $this->fourthPlaceCar => $this->fourthPlace,
            '5th ' . $this->fifthPlaceCar => $this->fifthPlace,
        ];
        $result = new RoundResult($this->round, $carPositions);

        // $result->pushRound();
        // Clear values
        unset($carPositions);

        return $result;
    }

    //Verify elements
    public function finalLap()
    {
        $finalLap = false;
        foreach ($this->cars as $car) {
            if ($car['elements'] > 1999) {
                $finalLap = true;
            }
        }
        return $finalLap;
    }


    //! CARS PITSTOP

    // validate variables
    public function pitStop()
    {

        $result = $this->changeTires();
        $checkPoint = $this->finalLap();

        // First check to see if any cars have
        if ($checkPoint) {
            // Race is over, send results
            $result->pushRound();
            return $result->theResults();

            exit(); // Shutdown script
        } elseif (!$checkPoint) {
            $result->pushRound();
            // No one is at 2000 elements, continue race
            // Have we hit 1000 elements of straight tracks?
            if (($this->totalStraight >= 40) || ($this->totalCurved >= 40)) {
                if ($this->totalStraight >= 40) {
                    return $this->curvedTrack();
                } else {
                    return $this->straightTrack();
                }
            } else {
                if ($this->lastTrack) {
                    return $this->straightTrack();
                } else {
                    return $this->curvedTrack();
                }
            } // 50/50 lap types
        } else {
            die("Something broke?");
        } // Final Lap
    } // method EOL
}
