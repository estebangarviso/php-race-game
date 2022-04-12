<?php

namespace App\Models\Race;

use App\Models\Vehicle\VehicleInterface;
use App\Core\View;

/**
 * Class RaceResult
 */
class RaceResult
{
    /**
     * The array of the race round results.
     *
     * @var array
     */
    private array $roundResults = [];

    /**
     * The array of the race winners.
     *
     * @var array
     */
    private array $raceWinners = [];

    /**
     * Set the winner.
     *
     * @param VehicleInterface $vehicle
     */
    public function setWinner(VehicleInterface $vehicle): void
    {
        $this->raceWinners[] = $vehicle;
    }

    /**
     * Set the round results.
     *
     * @param array $roundResults
     */
    public function setRoundResults(array $roundResults): void
    {
        $this->roundResults = $roundResults;
    }

    /**
     * Display the race results.
     */
    public function displayRaceResults(): void
    {
        echo '<p><i class="icon icon-notes"></i> <b>Race</b> details:</p>';

        $this->displayWinners();
        $this->displayRoundResults();
    }

    /**
     * Display the winners.
     */
    private function displayWinners(): void
    {
        if (!empty($this->raceWinners)) {
            $table = '<table class="table">';
            $table .= '<thead></thead>';
            $table .= '<tbody>';

            if (count($this->raceWinners) === 1) {
                $table .= '<tr><td colspan="3"><b><i class="icon icon-cup"></i> Winner:</b></td></tr>';
            } else {
                $this->raceWinners = $this->raceWinners[0]->getSortedVehiclesByPosition($this->raceWinners);

                $table .= '<tr><td colspan="3" style="text-align: center"><b><i class="icon icon-draw"></i> THE DRAW</b></td></tr>';
                $table .= '<tr><td colspan="3"><b><i class="icon icon-cup"></i> Winners:</b></td></tr>';
            }

            $table .= $this->buildVehiclesTablePart($this->raceWinners);

            $table .= '</tbody>';
            $table .= '</table>';

            echo $table;

            // //!TODO: Add the winner's details.
            // return View::renderViewOnly('partials/table', [
            //     'rows' => $this->raceWinners,
            //     'columns' => ['<i class="icon icon-cup"></i> Winner', '🤜🤛 THE DRAW'],
            // ]);
        }
    }

    /**
     * Build table part of the vehicles.
     *
     * @param array $vehicles
     * @return string
     */
    private function buildVehiclesTablePart(array $vehicles): string
    {
        $vehicleTablePart = '<tr><td><i>#</i></td><td><i>Name</i></td><td><i>Vehicle Type</i></td></tr>';

        /** @var VehicleInterface $vehicle */
        foreach ($vehicles as $index => $vehicle) {
            $vehicleTablePart .= '<tr>';
            $vehicleTablePart .= '<td>' . ++$index . '</td>';
            $vehicleTablePart .= '<td>' . $vehicle->getName() . '</td>';
            $vehicleTablePart .= '<td>' . $vehicle->getType() . '</td>';
            $vehicleTablePart .= '</tr>';
        }

        return $vehicleTablePart;
    }

    /**
     * Display the round results.
     */
    private function displayRoundResults(): void
    {
        echo '<p><i class="icon icon-notes"></i> <b>Rounds</b> details:</p>';

        $table = '<table class="table">';
        $table .= '<thead></thead>';
        $table .= '<tbody>';

        /** @var RoundResult $round */
        foreach ($this->roundResults as $round) {
            $table .= '<tr><td colspan="3"><b><i class="icon icon-round"></i> Round ' . $round->getRound() . '</b></td></tr>';

            $table .= $this->buildVehiclesTablePart($round->getVehiclePositions());

            $table .= '<tr><td colspan="3">&nbsp;</td></tr>';
        }

        $table .= '</tbody>';
        $table .= '</table>';

        echo $table;
    }
}
