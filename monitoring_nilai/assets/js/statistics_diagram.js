/* globals Chart:false, feather:false */

new Chart(document.getElementById("myChart"), {
  type: 'pie',
  data: {
    labels: ["apa itu makan", "bagaimana itu makan", "kenapa bisa begitu", "lalu bagaimana ini", "kenapa makan dan minum"],
    datasets: [{
      label: "Population (millions)",
      backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
      data: [2478,5267,734,784,433]
    }]
  },
  options: {
    plugins: {
      title: {
          display: true,
          text: '10 Pertanyaan Terbanyak Yang Tidak Terjawab',
          padding: {
            top: 10,
            bottom: 20
          },
          font: {
            size: 24
          }
      },
      tooltip: {
        borderWidth: 0,
        backgroundColor: 'rgba(0, 0, 0, 0.8)'
      }
    },
    responsive: false,
  }
});


