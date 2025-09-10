import noUiSlider from 'nouislider';
import 'nouislider/dist/nouislider.css';

document.addEventListener('DOMContentLoaded', function () {
	const slider = document.getElementById('price-slider');
	if (slider) {
		const minPrice = 0;
		const maxPrice = 1000;
		const startMin = parseInt(document.getElementById('price_min').value) || minPrice;
		const startMax = parseInt(document.getElementById('price_max').value) || maxPrice;
		noUiSlider.create(slider, {
			start: [startMin, startMax],
			connect: true,
			range: {
				'min': minPrice,
				'max': maxPrice
			},
			step: 1,
			tooltips: [true, true],
			format: {
				to: value => Math.round(value),
				from: value => Number(value)
			}
		});
		slider.noUiSlider.on('update', function (values, handle) {
			document.getElementById('price_min').value = values[0];
			document.getElementById('price_max').value = values[1];
		});
	}
});
