<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Table</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        th, td {
            text-align: left;
        }
        .center-text {
            text-align: center;
        }
        .hidden {
            display: none;
        }
        .color-icon {
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
        .no-background-border {
            background-color: transparent;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Interactive Table with 6 Columns</h1>
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

            for (let i = 0; i < 24; i++) {
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

                    const colorButton = document.createElement("img");
                    colorButton.src = "resources/Colorwheel.png"; // Replace with your color palette icon URL
                    colorButton.classList.add("color-icon", "mr-2");
                    colorButton.onclick = function() {
                        const colorInput = document.createElement("input");
                        colorInput.type = "color";
                        colorInput.classList.add("hidden");
                        colorInput.oninput = function() {
                            newCell.style.backgroundColor = colorInput.value;
                            textInput.classList.remove("hidden");
                        };
                        colorInput.click();
                    };

                    const textInput = document.createElement("input");
                    textInput.type = "text";
                    textInput.classList.add("form-control", "form-control-sm", "hidden", "no-background-border");
                    textInput.placeholder = "Enter text";

                    newCell.appendChild(colorButton);
                    newCell.appendChild(textInput);
                }
            }
        });
    </script>
</body>
</html>
