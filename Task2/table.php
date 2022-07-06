<?php
// dynamic table
// dynamic rows //4
// dynamic columns // 4
// check if gender of user == m ==> male // 1
// check if gender of user == f ==> female // 1

$users = [
    (object)[
        'id' => 1,
        'name' => 'ahmed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'football', 'swimming', 'running'
        ],
        'activities' => [
            "school" => 'drawing',
            'home' => 'painting'
        ],
    ],
    (object)[
        'id' => 2,
        'name' => 'mohamed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'swimming', 'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
    ],
    (object)[
        'id' => 3,
        'name' => 'menna',
        "gender" => (object)[
            'gender' => 'f'
        ],
        'hobbies' => [
            'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ]
    ],
    (object)[
        'id' => 4,
        'name' => 'Omar',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
    ],
];

?>


<!doctype html>
<html lang="en">

<head>
    <title>Products</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center display-3 text-dark mt-5 mb-3"> User Data </div>
            <hr>
            <table class=" table table-striped text-center ">
                <thead>
                    <tr>
                        <?php if (empty($users)) {
                            echo "
                            <th>id<th/>
                            <th>name<th/>
                            <th>gender<th/>
                            <th>hobbies<th/>
                            <th>activities<th/>
                            ";
                        };
                        ?>
                        <!-- to get a dynamic table head -->
                        <?php
                        $tableHeads = array_keys((array)$users[0]);
                        foreach ($tableHeads as $head) {
                            echo "<th> {$head} </th>";
                        };
                        ?>
                    </tr>
                </thead>

                <tbody class="table-group-divider">
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <td><?= $user->id ?></td>
                            <td><?= $user->name ?></td>

                            <td><?php
                                if ($user->gender->gender == 'm') echo 'male';
                                elseif ($user->gender->gender == 'f') echo 'female';
                                else echo '';
                                ?></td>
                            <td><?php foreach ($user->hobbies as $hobby) {
                                    echo $hobby . '<br/>';
                                }
                                ?></td>
                            <td><?php foreach ($user->activities as $activity) {
                                    echo $activity . '<br/>';
                                } ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>