<?php
// echo password_hash('pass', PASSWORD_BCRYPT);
// die();


include("test_connection.php");
$query = " SELECT * FROM students;";

$result = mysqli_query($con, $query);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
// print_r($rows);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="manifest" href="/manifest.json">
</head>

<body>

    <body>
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
                <a href="/"
                    class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="40" height="32">
                        <use xlink:href="#bootstrap" />
                    </svg>
                    <span class="fs-4">Student Management System</span>
                </a>

                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>
                    <li class="nav-item"><a href="add_student.php" class="nav-link">Add student</a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
                </ul>
            </header>
            <?php if (isset($_GET['msg']) && $_GET['msg'] == 'addSuccesful') { ?>
                <div class="alert alert-success" role="alert">
                    Student added successfully
                </div>
            <?php } ?>

            <?php if (isset($_GET['msg']) && $_GET['msg'] == 'deletesuccesful') { ?>
                <div class="alert alert-success" role="alert">
                    Student deleted successfully
                </div>
            <?php } ?>

            <h2> Students <h2>

                    <div id="message"></div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Class</th>
                                <th scope="col">Grade</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $row) { ?>
                                <tr>
                                    <td> <?php echo $row['sr_no']; ?> </td>
                                    <td><?php echo $row['name']; ?> </td>
                                    <td><?php echo $row['class']; ?> </td>
                                    <td><?php echo $row['grade']; ?> </td>
                                    <td><a href="#" onclick="javascript:deleteStudent(<?php echo $row['id']; ?>);">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-dash text-danger" viewBox="0 0 16 16">
                                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M11 12h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m0-7a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                                <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                            </svg>
                            </a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
        </div>
        <script>
            function deleteStudent(sid) {
                const data = {
                    student_id: sid
                };

                console.log(JSON.stringify(data));


                fetch('delete_student.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(result => {

                        if (result.success) {
                            document.getElementById('message').innerText = result.message;
                            window.location = "home.php?msg=deletesuccesful";

                            // window.location.href = "home.php"; // Redirect on success
                        } else {
                            alert("error");
                            document.getElementById('message').innerText = result.message;
                        }

                    })
                    .catch(error => console.error('Error:', error));

            }


            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('/service-worker.js')
                        .then(reg => console.log('Service Worker registered!', reg))
                        .catch(err => console.log('Service Worker registration failed!', err));
                });
            }
        </script>
        <script src="js/bootstrap.bundle.min.js">
        </script>
    </body>

</html>