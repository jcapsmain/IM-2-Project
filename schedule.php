<?php 

    require 'config.php';
    include 'navbar.php';
?>

<!-- Nicezel naay problem sa navbar when ato include so wala pa nako gi add -->
<!-- mag add rakos design after guru -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Schedule</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .table-container {
      margin: 20px;
    }
    th, td {
      text-align: center;
    }
  </style>
</head>
<body class="pt-5 mt-5>
    <div class="container table-container">
        <h2 class="text-center">Schedule</h2>
        <table class="table table-bordered">
        <thead>
            <tr>
            <th>Time</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
            </tr>
        </thead>
            <tbody>
                <tr><td>7:30-8:00 AM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>8:00-8:30 AM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>8:30-9:00 AM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>9:00-9:30 AM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>9:30-10:00 AM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>10:00-10:30 AM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>10:30-11:00 AM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>11:00-11:30 AM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>11:30-12:00 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>12:00-12:30 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>12:30-1:00 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>1:00-1:30 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>1:30-2:00 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>2:00-2:30 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>2:30-3:00 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>3:00-3:30 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>3:30-4:00 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>4:00-4:30 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>4:30-5:00 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>5:00-5:30 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>5:30-6:00 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>6:00-6:30 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>6:30-7:00 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>7:00-7:30 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>7:30-8:00 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>8:00-8:30 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>8:30-9:00 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>9:00-9:30 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>9:30-10:00 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
                <tr><td>10:00-10:30 PM</td><td></td><td></td><td></td><td></td><td></td></tr>
            </tbody>
        </table>
    </div>

    <!-- Modal for Hiring -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#HireModal">Hire</button>

    <div class="modal fade" id="HireModal" tabindex="-1" aria-labelledby="HireModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="HireModalLabel">Hire a Coach</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form id="hireForm">
                <div class="form-group">
                <label for="checkOptions">Options</label><br>
                <div class="form-check"><input class="form-check-input" type="checkbox" value="Monday" id="checkOption1"><label class="form-check-label" for="checkOption1">Monday</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" value="Tuesday" id="checkOption2"><label class="form-check-label" for="checkOption2">Tuesday</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" value="Wednesday" id="checkOption3"><label class="form-check-label" for="checkOption3">Wednesday</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" value="Thursday" id="checkOption4"><label class="form-check-label" for="checkOption4">Thursday</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" value="Friday" id="checkOption5"><label class="form-check-label" for="checkOption5">Friday</label></div>
                </div>
                <div class="form-group">
                <label for="StudentIGN">IGN</label>
                <input type="text" class="form-control" id="StudentIGN" placeholder="Enter text here">
                </div>
                <div class="form-group">
                <label for="StudentUID">UID</label>
                <input type="text" class="form-control" id="StudentUID" placeholder="Enter text here">
                </div>
                <div class="form-group">
                <label for="dropdownBox1">Starting Time</label>
                <select class="form-control" id="dropdownBox1">
                    <?php
                    $start_time = strtotime("7:30 AM");
                    $end_time = strtotime("10:30 PM");
                    while($start_time <= $end_time) {
                        echo '<option>'.date("g:i A", $start_time).'</option>';
                        $start_time = strtotime('+30 minutes', $start_time);
                    }
                    ?>
                </select>
                </div>
                <div class="form-group">
                <label for="dropdownBox2">End Time</label>
                <select class="form-control" id="dropdownBox2">
                    <?php
                    $start_time = strtotime("7:30 AM");
                    $end_time = strtotime("10:30 PM");
                    while($start_time <= $end_time) {
                        echo '<option>'.date("g:i A", $start_time).'</option>';
                        $start_time = strtotime('+30 minutes', $start_time);
                    }
                    ?>
                </select>
                </div>
                <div class="form-group">
                <label for="colorPicker">Choose Color</label>
                <input type="color" class="form-control" id="colorPicker">
                </div>
            </form>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="changeCellColor()">Submit</button>
            </div>
        </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function changeCellColor() {
        let selectedDays = [];
        document.querySelectorAll('.form-check-input:checked').forEach((checkbox) => {
            selectedDays.push(checkbox.value);
        });
        let startTime = document.getElementById('dropdownBox1').value;
        let endTime = document.getElementById('dropdownBox2').value;
        let chosenColor = document.getElementById('colorPicker').value;

        let timeSlots = {
        '7:30-8:00 AM': '7:30 AM',
        '8:00-8:30 AM': '8:00 AM',
        '8:30-9:00 AM': '8:30 AM',
        '9:00-9:30 AM': '9:00 AM',
        '9:30-10:00 AM': '9:30 AM',
        '10:00-10:30 AM': '10:00 AM',
        '10:30-11:00 AM': '10:30 AM',
        '11:00-11:30 AM': '11:00 AM',
        '11:30-12:00 PM': '11:30 AM',
        '12:00-12:30 PM': '12:00 PM',
        '12:30-1:00 PM': '12:30 PM',
        '1:00-1:30 PM': '1:00 PM',
        '1:30-2:00 PM': '1:30 PM',
        '2:00-2:30 PM': '2:00 PM',
        '2:30-3:00 PM': '2:30 PM',
        '3:00-3:30 PM': '3:00 PM',
        '3:30-4:00 PM': '3:30 PM',
        '4:00-4:30 PM': '4:00 PM',
        '4:30-5:00 PM': '4:30 PM',
        '5:00-5:30 PM': '5:00 PM',
        '5:30-6:00 PM': '5:30 PM',
        '6:00-6:30 PM': '6:00 PM',
        '6:30-7:00 PM': '6:30 PM',
        '7:00-7:30 PM': '7:00 PM',
        '7:30-8:00 PM': '7:30 PM',
        '8:00-8:30 PM': '8:00 PM',
        '8:30-9:00 PM': '8:30 PM',
        '9:00-9:30 PM': '9:00 PM',
        '9:30-10:00 PM': '9:30 PM',
        '10:00-10:30 PM': '10:00 PM'
        };


        let table = document.querySelector('.table tbody');
        table.querySelectorAll('tr').forEach((row) => {
            let timeCell = row.cells[0];
            if (startTime <= timeSlots[timeCell.textContent] && timeSlots[timeCell.textContent] < endTime) {
            selectedDays.forEach((day) => {
                let dayIndex = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'].indexOf(day) + 1;
                if (dayIndex > 0) {
                row.cells[dayIndex].style.backgroundColor = chosenColor;
                }
            });
            }
        });

        var myModalEl = document.getElementById('HireModal');
        var modal = bootstrap.Modal.getInstance(myModalEl);
        modal.hide();
        }
    </script>
</body>
</html>