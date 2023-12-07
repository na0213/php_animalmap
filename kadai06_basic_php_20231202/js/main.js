window.onload = function () {
    let labels = Object.values(kindNames);
    let data = Object.values(kindCounts);

    let context = document.querySelector("#pet-chart").getContext('2d');
    new Chart(context, {
        type: 'bar',
        data: {
            labels: labels, // あなたのラベル配列
            datasets: [{
                label: "飼育しているペットの種類",
                data: data, // あなたのデータ配列
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',  // 色1
                    'rgba(54, 162, 235, 0.2)',   // 色2
                    'rgba(255, 206, 86, 0.2)',   // 色3
                    'rgba(75, 192, 192, 0.2)',   // 色4
                    'rgba(153, 102, 255, 0.2)',  // 色5
                    'rgba(255, 159, 64, 0.2)'    // 色6
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',     // 色1
                    'rgba(54, 162, 235, 1)',     // 色2
                    'rgba(255, 206, 86, 1)',     // 色3
                    'rgba(75, 192, 192, 1)',     // 色4
                    'rgba(153, 102, 255, 1)',    // 色5
                    'rgba(255, 159, 64, 1)'      // 色6
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            scales: {
                y: {
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        }
    });
}
