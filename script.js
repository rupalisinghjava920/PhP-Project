
// <!-- JavaScript for Progress Circles -->

function createProgressChart(canvasId, percent, color) {
    const ctx = document.getElementById(canvasId).getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [percent, 100 - percent],
                backgroundColor: [color, "#E5E7EB"],
                borderWidth: 0
            }]
        },
        options: {
            cutout: '75%', 
            responsive: true,
            maintainAspectRatio: false
        }
    });
}


createProgressChart("progress1", 60,"#4CAF50");
createProgressChart("progress2", 78,"#4CAF50");
createProgressChart("progress3", 45,"#4CAF50");
createProgressChart("progress4", 90,"#4CAF50");
createProgressChart("progress5", 90,"#4CAF50");