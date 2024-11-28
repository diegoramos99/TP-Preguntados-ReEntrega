// Datos de ejemplo (ampliados para incluir todos los tipos de gráficos)
const data = {
    playerChart: [
        { date: '2023-01', count: 100 },
        { date: '2023-02', count: 150 },
        { date: '2023-03', count: 200 },
        { date: '2023-04', count: 180 },
        { date: '2023-05', count: 220 },
    ],
    gameChart: [
        { date: '2023-01', count: 500 },
        { date: '2023-02', count: 750 },
        { date: '2023-03', count: 1000 },
        { date: '2023-04', count: 900 },
        { date: '2023-05', count: 1100 },
    ],
    questionChart: [
        { status: 'Pendiente', count: 50 },
        { status: 'Aprobada', count: 200 },
        { status: 'Rechazada', count: 30 },
        { status: 'Reportada', count: 20 },
        { status: 'Desactivada', count: 10 },
    ],
    createdQuestionChart: [
        { date: '2023-01', count: 20 },
        { date: '2023-02', count: 30 },
        { date: '2023-03', count: 40 },
        { date: '2023-04', count: 35 },
        { date: '2023-05', count: 50 },
    ],
    newUserChart: [
        { date: '2023-01', count: 50 },
        { date: '2023-02', count: 70 },
        { date: '2023-03', count: 90 },
        { date: '2023-04', count: 80 },
        { date: '2023-05', count: 100 },
    ],
    correctAnswerChart: [
        { user: 'Usuario1', percentage: 75 },
        { user: 'Usuario2', percentage: 80 },
        { user: 'Usuario3', percentage: 70 },
        { user: 'Usuario4', percentage: 85 },
        { user: 'Usuario5', percentage: 78 },
    ],
    countryChart: [
        { name: 'Argentina', value: 150 },
        { name: 'Brasil', value: 100 },
        { name: 'Chile', value: 80 },
        { name: 'Otros', value: 70 },
    ],
    genderChart: [
        { name: 'Masculino', value: 200 },
        { name: 'Femenino', value: 180 },
        { name: 'Otro', value: 20 },
    ],
    ageChart: [
        { name: 'Menores', value: 50 },
        { name: 'Adultos', value: 300 },
        { name: 'Jubilados', value: 50 },
    ],
};

let currentChart = null;
let currentChartType = '';

function showChart(chartType) {
    const chartContainer = document.getElementById('chartContainer');
    chartContainer.style.display = 'block';

    if (currentChart) {
        currentChart.destroy();
    }

    currentChartType = chartType;
    updateChart();
}

function updateChart() {
    const ctx = document.getElementById('chart').getContext('2d');
    const chartData = data[currentChartType];
    const timeFilter = document.getElementById('timeFilter').value;

    // Aquí podrías filtrar los datos según timeFilter
    // Por ahora, usaremos todos los datos disponibles

    let chartConfig;
    if (['countryChart', 'genderChart', 'ageChart'].includes(currentChartType)) {
        chartConfig = {
            type: 'pie',
            data: {
                labels: chartData.map(item => item.name),
                datasets: [{
                    data: chartData.map(item => item.value),
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'
                    ],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: currentChartType.replace('Chart', ''),
                        color: '#ECF0F1'
                    }
                }
            }
        };
    } else {
        chartConfig = {
            type: 'bar',
            data: {
                labels: chartData.map(item => item.date || item.status || item.user),
                datasets: [{
                    label: currentChartType.replace('Chart', ''),
                    data: chartData.map(item => item.count || item.percentage || item.value),
                    backgroundColor: '#3498DB',
                    borderColor: '#2980B9',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#ECF0F1'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#ECF0F1'
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#ECF0F1'
                        }
                    },
                    title: {
                        display: true,
                        text: currentChartType.replace('Chart', ''),
                        color: '#ECF0F1'
                    }
                }
            }
        };
    }

    currentChart = new Chart(ctx, chartConfig);

    // Actualizar la tabla
    updateTable(chartData);
}

function updateTable(data) {
    const tableBody = document.querySelector('#dataTable tbody');
    tableBody.innerHTML = '';
    data.forEach(item => {
        const row = tableBody.insertRow();
        const cell1 = row.insertCell(0);
        const cell2 = row.insertCell(1);
        cell1.textContent = item.date || item.status || item.user || item.name;
        cell2.textContent = item.count || item.percentage || item.value;
    });
}

// Función para generar PDF
document.getElementById('generatePDF').addEventListener('click', async function() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Añadir título
    doc.setFontSize(18);
    doc.text('Reporte de ' + currentChartType.replace('Chart', ''), 14, 15);

    // Capturar el gráfico como imagen
    const canvas = document.getElementById('chart');
    const imgData = canvas.toDataURL('image/png');

    // Añadir la imagen del gráfico al PDF
    doc.addImage(imgData, 'PNG', 10, 20, 190, 100);

    // Añadir la tabla al PDF
    doc.autoTable({
        head: [['Categoría', 'Valor']],
        body: data[currentChartType].map(item => [
            item.date || item.status || item.user || item.name,
            item.count || item.percentage || item.value
        ]),
        startY: 130
    });

    // Guardar el PDF
    doc.save('reporte_' + currentChartType + '.pdf');
});

// GENERAR PDF CON PHP PERO NO FUNCIONA,PARA HACER ESTO INTENTE CREAR UN ARCHIVO .PHP EN LA CARPETA HELPER PERO NO FUNCIONO Y ME INSTALE ALGO EN EL VENDO PARA
// CREAR LOS PDF
/*document.getElementById("generatePDF").addEventListener("click", function () {
    fetch("http://localhost/helper/GenerarPDF\n", {
        method: "POST",
    })
        .then((response) => {
            if (response.ok) {
                return response.blob(); // Recibimos el PDF como blob
            } else {
                throw new Error("Error generando el PDF");
            }
        })
        .then((blob) => {
            // Creamos un enlace para descargar el PDF
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.style.display = "none";
            a.href = url;
            a.download = "documento.pdf";
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        })
        .catch((error) => {
            console.error("Error:", error);
        });
});*/
