<?php

if($rows && $columns) {
    echo '<thead class="table">';
    echo '<tr>';
    foreach ($columns as $column) {
        echo "<th>$column</th>";
    }
    echo '</tr>';
    echo '</thead>';

    echo '<tbody class="table">';
    foreach ($rows as $row) {
        echo '<tr>';
        foreach ($row as $column) {
            echo "<td>$column</td>";
        }
        echo '</tr>';
    }
}



