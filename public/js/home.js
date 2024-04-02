$(function(){
    // Function to render pie chart
    function renderPieChart(data) {
        var labels = Object.keys(data);
        var counts = Object.values(data);

        var ctx = document.getElementById('equipmentPieChart').getContext('2d');
        var equipmentPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: counts,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                        // Add more colors as needed
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    // Call the function to render pie chart
    renderPieChart(conditionsData);
});
