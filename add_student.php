<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System – Add Student</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

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
                <li class="nav-item mt-2">Welcome, <?php echo $_SESSION['username']; ?>!</li>
                <li class="nav-item"><a href="home.php" class="nav-link" aria-current="page">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link active">Add student</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
            </ul>
        </header>
    </div>


    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4>Enter Student Data</h4>

                <form id="studentForm" method="post">
                    <div class="row mb-3">
                        <label for="sr_no" class="col-sm-2 col-form-label">Sr. Number:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sr_no" name="sr_no" >
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="class" class="col-sm-2 col-form-label">Class:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="class" name="class">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="grade" class="col-sm-2 col-form-label">Grade:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="grade" name="grade">
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-primary" onclick="javascript:submitStudentData();" >Add</button>
                </form>
                <div id="studentResponse"></div>
            </div>
        </div>
    </div>

    <script>
        function submitStudentData() {
            const data = {
                sr_no: document.getElementById('sr_no').value,
                name: document.getElementById('name').value,
                class: document.getElementById('class').value,
                grade: document.getElementById('grade').value
            };

            console.log(JSON.stringify(data));
            

            fetch('process_student_data_json.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {

                    if (result.success) {

                        window.location.href = "home.php?msg=addSuccesful"; // Redirect on success
                    } else {
                        alert("error");
                        document.getElementById('studentResponse').innerText = result.message;
                    }
                        
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>