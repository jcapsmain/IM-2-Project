<?php
    require 'config.php';
    include 'navbar.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Table</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Pickr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/@simonwep/pickr/2.0.7/pickr.min.css" integrity="sha512-G48OBoB7D+5X1M4f7I9C7M2JWZI8nUJ2OTdx6fsHrhKbZvslXPAOK4y2YIsqUHkWx1xR05R5mZlJ3G43d4JrVA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        th, td {
            text-align: left;
        }
        .center-text {
            text-align: center;
        }
        .highlight {
            background-color: yellow; /* Default highlight color */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Coach Schedules</h1>
        <div class="mb-4">
            <form id="planForm">
                <div class="form-group">
                    <label>Day:</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="monday" value="1">
                        <label class="form-check-label" for="monday">Monday</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="tuesday" value="2">
                        <label class="form-check-label" for="tuesday">Tuesday</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="wednesday" value="3" checked>
                        <label class="form-check-label" for="wednesday">Wednesday</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="thursday" value="4">
                        <label class="form-check-label" for="thursday">Thursday</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="friday" value="5">
                        <label class="form-check-label" for="friday">Friday</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="startTime">Start Time:</label>
                    <input type="time" class="form-control" id="startTime" value="07:30">
                </div>
                <div class="form-group">
                    <label for="endTime">End Time:</label>
                    <input type="time" class="form-control" id="endTime" value="09:30">
                </div>
                <!-- Color picker button -->
                <div class="form-group">
                    <label for="highlightColor">Highlight Color:</label>
                    <input type="color" class="form-control" id="highlightColorPicker" value="#ffff00">
                </div>
                <button type="button" class="btn btn-primary" onclick="highlightPlan()">Highlight Plan</button>
            </form>
        </div>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th class="center-text">Time</th>
                    <th class="center-text">Monday</th>
                    <th class="center-text">Tuesday</th>
                    <th class="center-text">Wednesday</th>
                    <th class="center-text">Thursday</th>
                    <th class="center-text">Friday</th>
                </tr>
            </thead>
            <tbody id="dynamicTableBody">
                <!-- Rows will be inserted here by JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Pickr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/@simonwep/pickr/2.0.7/pickr.min.js" integrity="sha512-YNrX70hFJdCtH5XFRHhMNW6i4Y1GYYv7J66I1UaHLO3s0J2h9/8Z4Ac8/ggCAw+bktZy8x0EX7xKiP7m4yRzGg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tableBody = document.getElementById("dynamicTableBody");

            const formatTimeRange = (startHour, startMinute, endHour, endMinute) => {
                const formatTime = (hours, minutes) => {
                    const ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12; // the hour '0' should be '12'
                    minutes = minutes < 10 ? '0' + minutes : minutes;
                    return hours + ':' + minutes + ' ' + ampm;
                };

                const startTime = formatTime(startHour, startMinute);
                const endTime = formatTime(endHour, endMinute);
                return startTime + '-' + endTime;
            };

            for (let i = 0; i < 48; i++) { // Changed to 48 rows
                const newRow = tableBody.insertRow();
                const startHour = Math.floor(i / 2);
                const startMinute = (i % 2) * 30;
                const endHour = Math.floor((i + 1) / 2);
                const endMinute = ((i + 1) % 2) * 30;
                const timeRange = formatTimeRange(startHour, startMinute, endHour, endMinute);
                
                const timeCell = newRow.insertCell(0);
                timeCell.appendChild(document.createTextNode(timeRange));
                timeCell.dataset.time = timeRange;

                for (let j = 1; j < 6; j++) {
                    const newCell = newRow.insertCell(j);
                    newCell.dataset.day = j;
                    newCell.dataset.time = timeRange;
                    newCell.appendChild(document.createTextNode(''));
                }
            }

            // Initialize Pickr for color selection
            const pickr = Pickr.create({
                el: '#highlightColorPicker',
                theme: 'classic', // Choose your preferred theme
                default: document.getElementById('highlightColorPicker').value,
                swatches: [
                    'rgba(244, 67, 54, 1)',
                    'rgba(233, 30, 99, 0.95)',
                    'rgba(156, 39, 176, 0.9)',
                    'rgba(103, 58, 183, 0.85)',
                    'rgba(63, 81, 181, 0.8)',
                    'rgba(33, 150, 243, 0.75)',
                    'rgba(3, 169, 244, 0.7)',
                    'rgba(0, 188, 212, 0.7)',
                    'rgba(0, 150, 136, 0.75)',
                    'rgba(76, 175, 80, 0.8)',
                    'rgba(139, 195, 74, 0.85)',
                    'rgba(205, 220, 57, 0.9)',
                    'rgba(255, 235, 59, 0.95)',
                    'rgba(255, 193, 7, 1)'
                ],
                components: {
                    preview: true,
                    opacity: true,
                    hue: true,

                    interaction: {
                        hex: true,
                        rgba: true,
                        hsla: true,
                        hsva: true,
                        input: true,
                        clear: true,
                        save: true
                    }
                }
            });
        });

        function highlightPlan() {
        const days = [];
        if (document.getElementById('monday').checked) days.push(1);
        if (document.getElementById('tuesday').checked) days.push(2);
        if (document.getElementById('wednesday').checked) days.push(3);
        if (document.getElementById('thursday').checked) days.push(4);
        if (document.getElementById('friday').checked) days.push(5);

        const startTime = document.getElementById('startTime').value;
        const endTime = document.getElementById('endTime').value;
        const highlightColor = document.getElementById('highlightColorPicker').value;
        const rows = document.querySelectorAll('#dynamicTableBody tr');

        const startHour = parseInt(startTime.split(':')[0], 10);
        const startMinute = parseInt(startTime.split(':')[1], 10);
        const endHour = parseInt(endTime.split(':')[0], 10);
        const endMinute = parseInt(endTime.split(':')[1], 10);

        const startTimeTotal = startHour * 60 + startMinute;
        const endTimeTotal = endHour * 60 + endMinute;

        rows.forEach(row => {
            const timeRange = row.cells[0].dataset.time;
            const [start, end] = timeRange.split('-');
            let [startHourCell, startMinuteCell] = start.split(':');
            let [endHourCell, endMinuteCell] = end.split(':');
            // Convert startHourCell and endHourCell to integers
            startHourCell = parseInt(startHourCell);
            endHourCell = parseInt(endHourCell);

            // Adjust for PM times in 12-hour format
            if (start.includes('PM') && startHourCell !== 12) {
                startHourCell += 12;
            }
            if (end.includes('PM') && endHourCell !== 12) {
                endHourCell += 12;
            }

            const rowStartTimeTotal = startHourCell * 60 + parseInt(startMinuteCell, 10);
            const rowEndTimeTotal = endHourCell * 60 + parseInt(endMinuteCell, 10);

            days.forEach(day => {
                if (
                    (startTimeTotal >= rowStartTimeTotal && startTimeTotal < rowEndTimeTotal) ||
                    (endTimeTotal > rowStartTimeTotal && endTimeTotal <= rowEndTimeTotal) ||
                    (startTimeTotal <= rowStartTimeTotal && endTimeTotal >= rowEndTimeTotal)
                ) {
                    row.cells[day].style.backgroundColor = highlightColor;
                } else {
                    row.cells[day].style.backgroundColor = ''; // Reset background color
                }
            });
        });
    }

    </script>
</body>
</html>
