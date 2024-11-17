<?php include('db_connect.php');

// Fetching counts for Alumni, Jobs, Events, and Journals

// Alumni count by batch
$alumniQuery = "SELECT batch, COUNT(*) as count FROM alumnus_bio GROUP BY batch";
$alumniResult = mysqli_query($conn, $alumniQuery);
$alumniData = [];
while ($row = mysqli_fetch_assoc($alumniResult)) {
    $alumniData[$row['batch']] = $row['count'];
}
$alumniCount = array_sum($alumniData);

// Jobs posted count by year
$jobsQuery = "SELECT YEAR(date_created) as year, COUNT(*) as count FROM careers GROUP BY year";
$jobsResult = mysqli_query($conn, $jobsQuery);
$jobsData = [];
while ($row = mysqli_fetch_assoc($jobsResult)) {
    $jobsData[$row['year']] = $row['count'];
}
$jobsCount = array_sum($jobsData);

// Jobs count by location
$jobsByLocationQuery = "SELECT location, COUNT(*) as count FROM careers GROUP BY location";
$jobsByLocationResult = mysqli_query($conn, $jobsByLocationQuery);
$jobsLocationData = [];
while ($row = mysqli_fetch_assoc($jobsByLocationResult)) {
    $jobsLocationData[$row['location']] = $row['count'];
}

// Events count by month and year
$eventsQuery = "SELECT DATE_FORMAT(schedule, '%Y-%m') as month_year, COUNT(*) as count FROM events GROUP BY month_year";
$eventsResult = mysqli_query($conn, $eventsQuery);
$eventsData = [];
while ($row = mysqli_fetch_assoc($eventsResult)) {
    $eventsData[$row['month_year']] = $row['count'];
}
$eventsCount = array_sum($eventsData);

// Events by date
$eventsByDateQuery = "SELECT DATE(schedule) as event_date, COUNT(*) as count FROM events GROUP BY event_date";
$eventsByDateResult = mysqli_query($conn, $eventsByDateQuery);
$eventsDateData = [];
while ($row = mysqli_fetch_assoc($eventsByDateResult)) {
    $eventsDateData[$row['event_date']] = $row['count'];
}

// Journals count by month and year
$journalsQuery = "SELECT DATE_FORMAT(date_created, '%Y-%m') as month_year, COUNT(*) as count FROM forum_topics GROUP BY month_year";
$journalsResult = mysqli_query($conn, $journalsQuery);
$journalsData = [];
while ($row = mysqli_fetch_assoc($journalsResult)) {
    $journalsData[$row['month_year']] = $row['count'];
}
$journalsCount = array_sum($journalsData);

// Journals by date
$journalsByDateQuery = "SELECT DATE(date_created) as journal_date, COUNT(*) as count FROM forum_topics GROUP BY journal_date";
$journalsByDateResult = mysqli_query($conn, $journalsByDateQuery);
$journalsDateData = [];
while ($row = mysqli_fetch_assoc($journalsByDateResult)) {
    $journalsDateData[$row['journal_date']] = $row['count'];
}

// Fetching department-wise alumni count
$departmentQuery = "
    SELECT c.course AS department_name, COUNT(ab.id) as count 
    FROM alumnus_bio ab
    JOIN courses c ON ab.course_id = c.id
    GROUP BY c.id
";
$departmentResult = mysqli_query($conn, $departmentQuery);
$departments = [];
while ($row = mysqli_fetch_assoc($departmentResult)) {
    $departments[] = [
        'name' => $row['department_name'],
        'count' => $row['count']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .dashboard {
            display: flex;
            justify-content: space-between;
            flex-wrap: nowrap; /* Prevent cards from wrapping */
            overflow-x: auto; /* Allow horizontal scrolling if necessary */
            gap: 20px; /* Space between the cards */
        }
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px; /* Fixed width for square shape */
            height: 300px; /* Fixed height for square shape */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        h3 {
            margin: 0 0 10px;
            font-size: 20px;
            text-align: center;
        }
        .count {
            font-size: 16px;
            color: #666;
            margin-left: 10px;
        }
        canvas {
            max-width: 100%; /* Ensure the chart takes up full width */
            height: auto; /* Maintain the chart's aspect ratio */
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            font-size: 16px;
            color: #333;
            margin-bottom: 8px;
        }


    /* style */
    
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }
    .dashboard {
        display: flex;
        justify-content: space-between;
        flex-wrap: nowrap; /* Prevent cards from wrapping */
        overflow-x: auto; /* Allow horizontal scrolling if necessary */
        gap: 20px; /* Space between the cards */
    }
    .card {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 300px; /* Fixed width for square shape */
        height: 300px; /* Fixed height for square shape */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition for hover effects */
    }
    .card:hover {
        transform: translateY(-5px); /* Lift effect */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Stronger shadow on hover */
    }
    h3 {
        margin: 0 0 10px;
        font-size: 20px;
        text-align: center;
    }
    .count {
        font-size: 16px;
        color: #666;
        margin-left: 10px;
    }
    canvas {
        max-width: 100%; /* Ensure the chart takes up full width */
        height: auto; /* Maintain the chart's aspect ratio */
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
    li {
        font-size: 16px;
        color: #333;
        margin-bottom: 8px;
    }
    </style>
</head>
<body>

<div class="dashboard">
    <div class="card">
        <h3>Alumni <span class="count">(<?php echo $alumniCount; ?>)</span></h3>
        <canvas id="alumniChart"></canvas>
    </div>

    <div class="card">
        <h3>Posted Jobs <span class="count">(<?php echo $jobsCount; ?>)</span></h3>
        <canvas id="jobsChart"></canvas>
    </div>

    <div class="card">
        <h3>Events <span class="count">(<?php echo $eventsCount; ?>)</span></h3>
        <canvas id="eventsChart"></canvas>
    </div>

    <div class="card">
        <h3>Journals <span class="count">(<?php echo $journalsCount; ?>)</span></h3>
        <canvas id="journalsChart"></canvas>
    </div>
</div>

<div class="dashboard">
    <div class="card">
        <h3>Alumni by Department</h3>
        <ul>
            <?php foreach ($departments as $department): ?>
                <li><?php echo htmlspecialchars($department['name']); ?>: <?php echo $department['count']; ?> alumni</li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="card">
        <h3>Jobs by Location</h3>
        <ul>
            <?php foreach ($jobsLocationData as $location => $count): ?>
                <li><?php echo htmlspecialchars($location); ?>: <?php echo $count; ?> jobs</li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="card">
        <h3>Events by Date</h3>
        <ul>
            <?php foreach ($eventsDateData as $eventDate => $count): ?>
                <li><?php echo htmlspecialchars($eventDate); ?>: <?php echo $count; ?> events</li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="card">
        <h3>Journals by Date</h3>
        <ul>
            <?php foreach ($journalsDateData as $journalDate => $count): ?>
                <li><?php echo htmlspecialchars($journalDate); ?>: <?php echo $count; ?> journals</li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<script>
// Alumni Chart (Bar Graph)
var alumniCtx = document.getElementById('alumniChart').getContext('2d');
var alumniChart = new Chart(alumniCtx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode(array_keys($alumniData)); ?>,
        datasets: [{
            label: 'Number of Alumni',
            data: <?php echo json_encode(array_values($alumniData)); ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 2 // Set the step size to 2
                }
            }
        }
    }
});

// Jobs Chart (Line Graph)
var jobsCtx = document.getElementById('jobsChart').getContext('2d');
var jobsChart = new Chart(jobsCtx, {
    type: 'line',
    data: {
        labels: <?php echo json_encode(array_keys($jobsData)); ?>,
        datasets: [{
            label: 'Jobs Posted',
            data: <?php echo json_encode(array_values($jobsData)); ?>,
            fill: false,
            borderColor: 'rgba(255, 99, 132, 1)',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Events Chart (Pie Chart)
var eventsCtx = document.getElementById('eventsChart').getContext('2d');
var eventsChart = new Chart(eventsCtx, {
    type: 'pie',
    data: {
        labels: <?php echo json_encode(array_keys($eventsData)); ?>,
        datasets: [{
            label: 'Events Count',
            data: <?php echo json_encode(array_values($eventsData)); ?>,
            backgroundColor: [
                'rgba(255, 206, 86, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 206, 86, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true
    }
});

// Journals Chart (Radar Chart)
var journalsCtx = document.getElementById('journalsChart').getContext('2d');
var journalsChart = new Chart(journalsCtx, {
    type: 'radar',
    data: {
        labels: <?php echo json_encode(array_keys($journalsData)); ?>,
        datasets: [{
            label: 'Journals Count',
            data: <?php echo json_encode(array_values($journalsData)); ?>,
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true
    }
});
</script>

</body>
</html>
