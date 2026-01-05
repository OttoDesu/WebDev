<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "expenditureDB";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* ======================
   FETCH TABLE 1 (BAR)
   ====================== */
$sql1 = "SELECT component, expenditure_2010, expenditure_2011
         FROM visitors_expenditure
         ORDER BY id ASC";
$res1 = $conn->query($sql1);

$t1_labels = [];
$t1_2010   = [];
$t1_2011   = [];

while ($row = $res1->fetch_assoc()) {
    $t1_labels[] = $row["component"];
    $t1_2010[]   = (int)$row["expenditure_2010"];
    $t1_2011[]   = (int)$row["expenditure_2011"];
}

/* ======================
   FETCH TABLE 2 (LINE)
   ====================== */
$sql2 = "SELECT component, expenditure_2010, expenditure_2011
         FROM tourists_expenditure
         ORDER BY id ASC";
$res2 = $conn->query($sql2);

$t2_labels = [];
$t2_2010   = [];
$t2_2011   = [];

while ($row = $res2->fetch_assoc()) {
    $t2_labels[] = $row["component"];
    $t2_2010[]   = (int)$row["expenditure_2010"];
    $t2_2011[]   = (int)$row["expenditure_2011"];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Expenditure Graphs</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .chart-wrap { height: 360px; }
        @media (max-width: 768px) { .chart-wrap { height: 320px; } }
    </style>
</head>
<body>
<div class="container mt-5">

    <!-- TABLE 1 BAR -->
    <div class="card mb-4">
        <div class="card-header text-center">
            <h4 class="mb-0">Table 1 (Domestic Visitors): Expenditure 2010 vs 2011 — Bar Graph</h4>
        </div>
        <div class="card-body">
            <div class="chart-wrap">
                <canvas id="barChart"></canvas>
            </div>
        </div>
    </div>

    <!-- TABLE 2 LINE -->
    <div class="card mb-4">
        <div class="card-header text-center">
            <h4 class="mb-0">Table 2 (Domestic Tourists): Expenditure 2010 vs 2011 — Line Graph</h4>
        </div>
        <div class="card-body">
            <div class="chart-wrap">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>

</div>

<script>
/* ============
   TABLE 1 BAR
   ============ */
const t1Labels = <?php echo json_encode($t1_labels); ?>;
const t1_2010  = <?php echo json_encode($t1_2010); ?>;
const t1_2011  = <?php echo json_encode($t1_2011); ?>;

new Chart(document.getElementById('barChart').getContext('2d'), {
    type: 'bar',
    data: {
        labels: t1Labels,
        datasets: [
            {
                label: '2010',
                data: t1_2010,
                backgroundColor: 'rgba(54, 162, 235, 0.25)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: '2011',
                data: t1_2011,
                backgroundColor: 'rgba(255, 99, 132, 0.25)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: (value) => 'RM ' + value
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: (ctx) => `${ctx.dataset.label}: RM ${ctx.raw}`
                }
            }
        }
    }
});

/* =============
   TABLE 2 LINE
   ============= */
const t2Labels = <?php echo json_encode($t2_labels); ?>;
const t2_2010  = <?php echo json_encode($t2_2010); ?>;
const t2_2011  = <?php echo json_encode($t2_2011); ?>;

new Chart(document.getElementById('lineChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: t2Labels,
        datasets: [
            {
                label: '2010',
                data: t2_2010,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.15)',
                fill: true,
                tension: 0.3,
                pointRadius: 4,
                pointHoverRadius: 6
            },
            {
                label: '2011',
                data: t2_2011,
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.15)',
                fill: true,
                tension: 0.3,
                pointRadius: 4,
                pointHoverRadius: 6
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: (value) => 'RM ' + value
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: (ctx) => `${ctx.dataset.label}: RM ${ctx.raw}`
                }
            }
        }
    }
});
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
