function chart(element, type = 'bar', data){
    const ctx = document.querySelector(element).getContext('2d');
    const options = {
        type: type,
        data: {
          labels: data.labels,
          datasets: data.datasets
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            x: {
              ticks: {
                minRotation: 90,
                maxRotation: 90
              }
            },
            y: {
              beginAtZero: true
            }
          }
        }
    }
    console.log(options)
    new Chart(ctx, options);
}