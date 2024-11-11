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
function createChart(chartId, labels, data, title, colors) {
    const ctx = document.getElementById(chartId).getContext('2d');
    return new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: title,
                data: data,
                backgroundColor: colors,  // Use an array of colors for each bar
                borderColor: colors.map(color => color.replace('0.2', '1')),  // Make border colors slightly darker
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

// Define colors for each dataset
const colors1 = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)'];
const colors2 = ['rgba(255, 159, 64, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)'];
const colors3 = ['rgba(255, 206, 86, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)'];

// Create all charts using the function
createChart('chart1', label1, aantal1, 'Top 5 Meest Bezochte Events', colors1);
createChart('chart2', label2, aantal2, 'Top 5 Bezoekers', colors2);
createChart('chart3', label3, aantal3, 'Top 5 Grootste Winstmakers', colors3);

</script>
