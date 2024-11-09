<?php
function getDataReady($results) {
    $label = [];  // Initialize empty arrays
    $aantal = [];
    
    foreach ($results as $row) {
        $label[] = $row->naam;     // Store event names
        $aantal[] = $row->aantal;  // Store ticket counts
    }
    
    return [$label, $aantal]; // Return both arrays as an indexed array
}

// Call the function for each dataset and encode the results to JSON
$topEvenementenData = json_encode(getDataReady($topEvenementen));
$topDeelnemersData = json_encode(getDataReady($topDeelnemers));
$topVerdienstenData = json_encode(getDataReady($topVerdiensten));
?>

<h1>Dashboard</h1>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<canvas id="chart1"></canvas>
<canvas id="chart2"></canvas>
<canvas id="chart3"></canvas>

<script>
// Decode the JSON data from PHP to JavaScript variables
const [label1, aantal1] = JSON.parse('<?php echo $topEvenementenData; ?>');
const [label2, aantal2] = JSON.parse('<?php echo $topDeelnemersData; ?>');
const [label3, aantal3] = JSON.parse('<?php echo $topVerdienstenData; ?>');

// Function to create charts dynamically
function createChart(chartId, labels, data, title, backgroundColor, borderColor) {
    const ctx = document.getElementById(chartId).getContext('2d');
    return new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: title,
                data: data,
                backgroundColor: backgroundColor,
                borderColor: borderColor,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Create all charts using the function
createChart('chart1', label1, aantal1, 'Top 5 Events', 'rgba(255, 99, 132, 0.2)', 'rgba(255, 99, 132, 1)');
createChart('chart2', label2, aantal2, 'Number of Events per Organization', 'rgba(54, 162, 235, 0.2)', 'rgba(54, 162, 235, 1)');
createChart('chart3', label3, aantal3, 'Top 3 Participants', 'rgba(255, 206, 86, 0.2)', 'rgba(255, 206, 86, 1)');
</script>
