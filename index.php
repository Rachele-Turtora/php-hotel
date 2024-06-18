<?php

// Variables
$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ]
];

$filtered_hotels = [];
$parking_filter = $_GET['parking_filter'];
$vote_filter = $_GET['vote_filter'];


// Filters
if ($parking_filter && $vote_filter) {
    foreach ($hotels as $hotel) {
        if ($hotel['parking'] == true && $hotel['vote'] >= $vote_filter) {
            array_push($filtered_hotels, $hotel);
        }
    }
} elseif ($parking_filter) {
    foreach ($hotels as $hotel) {
        if ($hotel['parking'] == true) {
            array_push($filtered_hotels, $hotel);
        }
    }
} elseif ($vote_filter) {
    foreach ($hotels as $hotel) {
        if ($hotel['vote'] >= $vote_filter) {
            array_push($filtered_hotels, $hotel);
        }
    }
} else {
    $filtered_hotels = $hotels;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Hotels</title>
</head>

<body>
    <form action="index.php" method="GET">
        <div class="parking">
            <input class="form-check-input" type="checkbox" name="parking_filter" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Filtra per parcheggio
            </label>
        </div>
        <div class="vote">
            <input type="number" id="quantity" name="vote_filter" min="1" max="5">
            <label class="form-check-label" for="quantity">
                Filtra per voto
            </label>
        </div>
        <button>Invia</button>
    </form>

    <table class="table m-3">
        <thead>
            <tr>
                <?php foreach ($hotels[0] as $key => $hotel) : ?>
                    <th scope="col"><?php echo $key ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($filtered_hotels as $hotel) : ?>
                <tr>
                    <th scope="row"><?php echo $hotel['name'] ?></th>
                    <?php foreach (array_slice($hotel, 1) as $key => $element) : ?>
                        <td>
                            <?php # echo $key === 'parking' ? ($element ? '&#10003;' : '&#x2717;') : $element; 
                            if ($key === 'parking') {
                                if ($element == true) {
                                    $element = '&#10003;';
                                } else {
                                    $element = '&#x2717;';
                                }
                            }
                            echo $element;
                            ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>