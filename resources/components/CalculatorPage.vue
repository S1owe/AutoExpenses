<template>
	<div>
    <div class="connect_title_interface">
      <div class="connect-title">
        <h1>Остались вопросы?</h1>
      </div>
      <div class="connect-suptitle">
          <img src="../assets/connect-1.png">
      </div>
    </div>
    <div class="noconnect_title">
  		<Header/>
  		<div class="calc-page__title">
  			<h1>Калькулятор</h1>
  		</div>
  		<div class="calc-page__suptitle">
        		<p> Калькулятор помогает спрогнозировать глобальную стоимость владения автомобилем. Также можно рассчитать цену одного километра с учетом всех расходов (обслуживание, ремонт, кредит и т.д.) и выяснить как изменится стоимость на автомобиль через год.</p>
      	</div>
      	<div class="calculator">
      		<div class="calc__bg">
  	    		<h1>Подсчет расходов на автомобиль</h1>
  	    		<div class="calc__form">
  		    		<form>
  		    			<div v-on:click="mark_click">
                  <v-select :options="options_1" v-model="mark_choosen" class="style-chooser" placeholder="Марка автомобиля"> 
                    <template slot="no-options">
                      Ничего не найдено :\
                    </template>
                  </v-select>
                </div>
  		    			<div v-on:click="model_click">
                  <v-select :options="options_2" v-model="model_choosen" class="style-chooser" style="margin-top: 20px;" placeholder="Модель автомобиля">
                    <template slot="no-options">
                      {{ click_status_text }}
                    </template>
                  </v-select>
                </div>
  		    			<input type="text" placeholder="Год выпуска">
  		    			<input type="text" placeholder="Затраты на обслуживание (в год)" v-model="calc_service">
  		    			<input type="text" placeholder="Расход топлива в месяц (л.)" v-model="calc_fuel" v-on:click="check">
  		    			<input type="text" placeholder="Укажите тип топлива" v-model="calc_fuel_type">
  		    			<input type="text" placeholder="Налог на авто" v-model="calc_tax">
  		    		</form>
              <div class="error_block" v-if="calc_error_type == true">
                <h2 class="error_text">Ошибка: {{ calc_error_text }}</h2>
              </div>
  	    		</div>
  	    		<h2 class="calc-button__link"><a class="calc-button" v-on:click="button_calc">Рассчитать</a></h2>
  	    	</div>
      	</div>
      	<h3>График себестоимости владением авто</h3>
      	<div class="calc-chart">
      		<CalculatorChart/>
      	</div>
      	<div class="calc-footer">
      		<Footer/>
      	</div>
      </div>
    </div>
	</div>
</template>
<script>
    import { bus } from '../main';
    import axios from 'axios';

  	import Header from './Header'
  	import CalculatorChart from './CalculatorChart'
  	import Footer from './Footer'
	export default {
    data() {
      return {
        calc_mark: '',
        calc_model: '',
        calc_service: '',
        calc_fuel: '',
        calc_fuel_type: '',
        calc_tax: '',
        mark_choosen: '',
        model_choosen: '',
        click_status_text: '',
        calc_error_text: '',
        calc_error_type: false,
        options_1: [
        ],
        options_2: [
        ],
        car_response: [],
        car_response_1: []
      }
    },
		components: {
      		Header,
      		CalculatorChart,
      		Footer
		},
    methods: {
      button_calc() {
        this.calc_error_type = false
        if (this.mark_choosen != '' && this.model_choosen != '' && this.calc_service != '' && this.calc_fuel != '' && this.calc_fuel_type != '' && this.calc_tax != '') {
          if (!isNaN(this.calc_service) && !isNaN(this.calc_fuel) && !isNaN(this.calc_fuel_type) && !isNaN(this.calc_tax)) {
            axios
              .get('http://service.auto.xsph.ru/calc?mark=' + this.mark_choosen + '&model=' + this.model_choosen + '&service=' + this.calc_service + '&fuel=' + this.calc_fuel + '&fuel_type=' + this.calc_fuel_type + '&tax=' + this.calc_tax)
              .then(response => {
                this.car_response = response.data,
                this.car_response_1[0] = this.car_response[0].price
                this.car_response_1[1] = this.car_response[1].price
                this.car_response_1[2] = this.car_response[2].price
                this.car_response_1[3] = this.car_response[3].price
                bus.$emit('car_response_1[0]', this.car_response_1[0])
                bus.$emit('car_response_1[1]', this.car_response_1[1])
                bus.$emit('car_response_1[2]', this.car_response_1[2])
                bus.$emit('car_response_1[3]', this.car_response_1[3])
                console.log(this.car_response_1[0])
              })
              .catch(error => {
                console.log(error)
              })
          } else {this.calc_error_type = true, this.calc_error_text = 'Значение в одном из полей некорректно!'}
        } else {this.calc_error_type = true, this.calc_error_text = 'Заполните все поля!'}
      },
      check() {
        if (isNaN(this.calc_service)) {
          console.log('не число')
        } else console.log('число')
      },
      mark_click() {
        if (this.model_choosen != '') {this.model_choosen = ''}
        axios
          .get('http://service.auto.xsph.ru/marks')
          .then(response => {
            this.options_1 = response.data
          })
          .catch(error => {
            console.log(error)
          })
      },
      model_click() {
        if (this.mark_choosen == '') {this.click_status_text= 'Выберите марку автомобиля'}
        axios
          .get('http://service.auto.xsph.ru/models?model=' + this.mark_choosen)
          .then(response => {
            this.options_2 = response.data
          })
          .catch(error => {
            console.log(error)
          })
      }
    }
	}
</script>
<style scoped>
	a {text-decoration: none; cursor: pointer;}
	h1 {font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 24px; color: #262C40; text-align: center;}
	h3 {font-family: 'Roboto Condensed', sans-serif; font-weight: 700; font-size: 38px; color: #0066CC; text-align: center; padding: 60px 0;}
  .connect_title_interface {display: flex; align-items: center; transition: all 0.1s linear; cursor: pointer; z-index: 10; position: fixed; bottom:4%; right: 3%;}
    .connect_title_interface:hover {transform: scale(1.05);}
    .connect-title {margin-right: 5px;}
    .connect-title h1 {font-family: 'Proxima Nova Rg'; font-weight: bold; font-size: 24px; color: #0066CC;}
    .noconnect_title {z-index: 5;}
</style>
<style>
  .style-chooser .vs__dropdown-toggle,
  .style-chooser .vs__dropdown-menu {
    border: 0;
    min-height: 52px;
    border-radius: 2px; 
    font-family: 'Proxima Nova Rg'; 
    font-weight: normal; 
    font-size: 18px; 
    color: #7C8793;
    border: 2px solid #D7DEE9;
    padding: 0 5px;
  }
  .style-chooser .vs__search::placeholder {color: #7C8793;}
	@import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap');

	.calc-chart {max-width: 1478px; margin: 0 auto; box-shadow: 0 0 7px rgba(0,0,0,0.5); padding: 50px;}
	.calc-footer {margin-top: 136px;}

	.calc-page__title h1{font-family: 'Proxima Nova Rg'; font-weight: bold; font-size: 48px; color: #0066CC; text-align: center;}
  	.calc-page__title {margin-top: 104px;}
  	.calc-page__suptitle p{font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 18px; color: #262C40; text-align: justify;}
  	.calc-page__suptitle {max-width: 819px; margin: 0 auto; margin-top: 29px; padding-bottom: 67px;}
  	.calc-button {background-color: #0066CC; padding: 14px 63px;border-radius: 6px; color: white;}
	h2.calc-button__link {text-align: center; font-family: 'Proxima Nova Rg'; font-weight: bold; font-size: 20px; margin-top: 44px; padding-bottom: 60px;}
  	.calc__bg {width: 500px; margin: 0 auto; background-color: white; padding: 0 48px;}
  	.calculator h1 {padding-top: 34px; padding-bottom: 26px;}
  	.calculator {background-color: #F0F1F4; padding-top: 40px; padding-bottom: 40px;}
  	.calc__form {width: 100%;}
  	input[type="text"], .selector {width: 100%; height: 52px; outline: none; border-radius: 2px; border-color: #D7DEE9; border: 2px solid #D7DEE9; font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 18px; color: #7C8793; padding: 0 15px; margin-top: 20px; color: black;}
  	input[type="text"]:first-child {margin-top: 0;}
  	.calc-connect {display: flex; align-items: center; margin-right: 40px; float: right; transition: all 0.1s linear; cursor: pointer; padding: 32px;}
  	.calc-connect:hover {transform: scale(1.05);}
  	.calc-connect__title {font-family: 'Proxima Nova Rg'; font-weight: bold; font-size: 24px; color: #0066CC; margin-right: 5px;}
</style>