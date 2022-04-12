<table class="table">
    <thead>
        <?php
        if ($rows && $columns) {

            echo '<tr>';
            if (isset($columns) && is_array($columns)) {
                foreach ($columns as $column) {
                    echo "<th>$column</th>";
                }
            }
            echo '</tr>';
        ?>
    </thead>
    <tbody>
        <?php
            if (isset($rows)) {
                foreach ($rows as $row) {
                    echo '<tr>';
                    if (is_array($row)) {
                        foreach ($row as $column) {
                            echo "<td>$column</td>";
                        }
                    } else {
                        echo "<td>$row</td>";
                    }
                    echo '</tr>';
                }
            }
        ?>
    </tbody>
<?php } ?>
</table>