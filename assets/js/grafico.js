let ctx = document.getElementById('myChart').getContext('2d');
let labels = ['Pendientes', 'En curso', 'Finalizadas', 'Vencidas'];
let colorHex = ['#253D5B', '#EFCA08', '#43AA8B', '#FB3640'];

let myChart = new Chart(ctx, {
	type: 'doughnut',
	data: {
		datasets: [{
			data: [30, 10, 40, 20],
			backgroundColor: colorHex
		}],
		labels: labels
	},

options: {
	responsive: true,
	legend: {
		position: 'bottom'
	},
	animation: {
		animateScale: true
	},
	plugins: {
		datalabels: {
			color: '#fff',
			anchor: 'end',
			align: 'start',
			offset: -15,
			borderWidth: 2,
			borderColor: '#fff',
			borderRadius: 25,
			backgroundColor: (context) => {
				return context.dataset.backgroundColor;
			},
			font: {
				weight: 'bold',
				size: '11'
			},
			formatter: (value) => {
				return value + ' %';
			}
		}
	}
}
})