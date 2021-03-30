<template>
	<div>
		<div class="map_menu">
			<div class="menu_title">
				<h1>Хронология</h1>
				<img src="https://img.icons8.com/plasticine/40/000000/worldwide-location.png"/>
			</div>
			<div class="menu_chart">
				<div class="menu_chart-item">
					<MapMenuChart/>
				</div>
			</div>
			<div class="menu_desc">
				<div class="select_block">
					<select v-model="map_year">
						<option value="2021">2021</option>
						<option value="2022">2022</option>
						<option value="2023">2023</option>
						<option value="2024">2024</option>
						<option value="2025">2025</option>
						<option value="2026">2026</option>
						<option value="2027">2027</option>
					</select>
					<select v-model="map_number">
						<option value="01">01</option>
						<option value="02">02</option>
						<option value="03">03</option>
						<option value="04">04</option>
						<option value="05">05</option>
						<option value="06">06</option>
						<option value="07">07</option>
						<option value="08">08</option>
						<option value="09">09</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>
					</select>
					<select v-model="map_month">
						<option value="Января">Январь</option>
						<option value="Февраля">Февраль</option>
						<option value="Марта">Март</option>
						<option value="Апреля">Апрель</option>
						<option value="Мая">Май</option>
						<option value="Июня">Июнь</option>
						<option value="Июля">Июль</option>
						<option value="Августа">Август</option>
						<option value="Сентября">Сентябрь</option>
						<option value="Октября">Октябрь</option>
						<option value="Ноября">Ноябрь</option>
						<option value="Декабря">Декабрь</option>
					</select>
				</div>
				<div class="description_block">
					<input type="text" placeholder="Введите вашу заметку" v-model="marker_description">
				</div>
				<div class="menu_final">
					<div class="menu_final_button" @click="description_marker_type_method" v-on:click="busMessage">
						<span>Готово</span>
					</div>
					<div class="menu_final_text">
						<p>Нажмите кнопку "Готово" и поставьте маркер на карту левой кнопкой мыши.</p>
					</div>
				</div>
				<div class="error_block_map_menu" v-if="marker_description_error_type == true">
              		<div><h2 class="error_text_map_menu">Ошибка: {{ marker_description_error_text }}</h2></div>
            	</div>
			</div>
		</div>
	</div>
</template>
<style scoped>
	.error_text_map_menu {font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 19px; color: white; background-color: rgba(220, 20, 60, 0.6); text-align: center; margin-right: 15px;}
	.error_block_map_menu div {display: flex; align-items: center; height: 60px;}
	.error_block_map_menu {height: 60px; width: 400px; background-color: white;}
	.menu_final_text p {font-family: 'Proxima Nova Lt', sans-serif; font-weight: normal; font-size: 14px; color: #0066CC;}
	.menu_final_button {padding: 10px 10px;}
	.menu_final_button span{border: 2px solid #0066CC; font-family: 'Proxima Nova Lt', sans-serif; font-weight: normal; font-size: 20px; color: white; background-color: #0066CC; padding: 3px 10px; border-radius: 4px; cursor: pointer;}
	.menu_final {width: 400px; height: 45px; background-color: #FFFAFA; display: flex; align-items: center; justify-content: space-between;}
	.description_block input {padding: 0 10px;}
	.description_block {width: 400px; height: 70px; background-color: white; padding: 0 20px; display: flex; align-items: center; height: 70px;}
	.select_block {display: flex; align-items: center; height: 45px;}
	select {background: none; border: 0; -webkit-appearance: none; appearance: none; font-family: 'Proxima Nova Lt', sans-serif; font-weight: normal; font-size: 20px; color: #0066CC; text-align: center; text-align-last: center; outline: none; padding: 0 40px;}
  	h1 {font-family: 'Proxima Nova Lt', sans-serif; font-weight: 600; font-size: 25px; color: #0066CC;  margin-left: 15px;}
  	h2 {font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 23px; color: white; margin-left: 15px;}
  	.menu_title {width: 400px; height: 45px; background-color: white; display: flex; align-items: center;}
  	.menu_desc {width: 400px; height: 45px; background-color: #FFFAFA; z-index: 19;}
  	.menu_chart {width: 400px !important; min-height: 110px !important; background-color: #eeeeee; z-index: 21;}
  	.menu_chart-item {display: flex; align-items: center; height: 110px; margin-left: -5px;}

  	.desc_title {width: 400px; height: 45px; background-color: #A9A9A9;}
  	input[type="text"] {width: 100%; height: 52px; outline: none; border-radius: 2px; border-color: #D7DEE9; border: 2px solid #D7DEE9; font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 20px; color: #7C8793; padding: 0 15px; color: black;}
</style>
<style>
	
</style>
<script>	
	import { bus } from '../main';

	import MapMenuChart from './MapMenuChart'
	export default {
  		components: {
    		MapMenuChart,
  		},
  		data() {
  			return {
  				map_year: '2021',
  				map_number: '01',
  				map_month: 'Января',
  				marker_description: '',
  				marker_description_type: '',
  				marker_description_error_text: '',
  				marker_description_error_type: false,
  				description_date_type: false
  			}
  		},
  		methods: {
  			busMessage() {
  				this.marker_description_error_type = false
  				if (this.marker_description != '') {
	  				marker_description_type: true
					bus.$emit('marker_description_type', this.marker_description_type);

					bus.$emit('marker_description', this.marker_description);

					bus.$emit('map_year', this.map_year);
					bus.$emit('map_number', this.map_number);
					bus.$emit('map_month', this.map_month);
					this.marker_description = '';
				} else {
					this.marker_description_error_text = 'Необходимо заполнить поле с заметкой',
					this.marker_description_error_type = true
				}
			},
			description_marker_type_method() {
				this.description_marker_type = true,
				bus.$emit('description_marker_type', this.description_marker_type);
				this.description_marker_type = false
				bus.$emit('description_marker_date_number', this.map_number);
				bus.$emit('description_marker_date_month', this.map_month);
				bus.$emit('description_marker_date_year', this.map_year);
				bus.$emit('marker_description', this.marker_description);
			} 
  		}
}
</script>
