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

$filtered_hotels = $hotels;
$parking_filter = !empty($_GET['parking_filter']);
$vote_filter = !empty($_GET['vote_filter']);
$vote_value = intval($_GET['vote_filter'] ?? 0);


// Filters
if ($parking_filter) {
    $filtered_hotels = array_filter($filtered_hotels, fn ($hotel) => $hotel['parking'] === true);
}

if ($vote_filter) {
    $filtered_hotels = array_filter($filtered_hotels, fn ($hotel) => $hotel['vote'] >= $vote_value);
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
    <form action="index.php" method="GET" class="w-50 m-3 border border-dark">
        <h4 class="m-2">Filtra: </h4>
        <div class="d-flex">
            <div class="parking m-3">
                <input class="form-check-input" type="checkbox" name="parking_filter" value="1" id="flexCheckDefault" <?php if ($parking_filter) : ?> checked <?php endif; ?>>
                <label class="form-check-label" for="flexCheckDefault">
                    Filtra per parcheggio
                </label>
            </div>
            <div class="vote m-3">
                <input type="number" id="quantity" name="vote_filter" min="1" max="5" <?php if ($vote_filter) : ?> value="<?= $vote_value ?>" <?php endif; ?>>
                <label class="form-check-label" for="quantity">
                    Filtra per voto
                </label>
            </div>
            <button class="m-3 px-2 rounded bg-dark text-light fw-semibold">Invia</button>
        </div>
    </form>

    <?php if (count($filtered_hotels)) : ?>
        <table class="table w-75 m-3">
            <thead class="table-dark">
                <tr>
                    <th scope="col"><?php echo 'Nome' ?></th>
                    <th scope="col"><?php echo 'Descrizione' ?></th>
                    <th scope="col"><?php echo 'Parcheggio' ?></th>
                    <th scope="col"><?php echo 'Voto' ?></th>
                    <th scope="col"><?php echo 'Distanza dal centro' ?></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($filtered_hotels as $hotel) : ?>
                    <tr>
                        <th scope="row"><?php echo $hotel['name'] ?></th>
                        <td><?php echo $hotel['description'] ?></td>
                        <td>
                            <?php # echo $key === 'parking' ? ($element ? '&#10003;' : '&#x2717;') : $element; 
                            if ($hotel['parking'] == true) {
                                $hotel['parking'] = '&#10003;';
                            } else {
                                $hotel['parking'] = '&#x2717;';
                            }
                            echo $hotel['parking'];
                            ?>
                        </td>
                        <td><?php echo $hotel['vote'] ?></td>
                        <td><?php echo $hotel['distance_to_center'] ?> Km</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="alert alert-info" role="alert">
            Nessun hotel trovato
        </div>
    <?php endif; ?>
</body>

</html>