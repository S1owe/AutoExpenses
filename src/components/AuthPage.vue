<template>
	<div class="body">
		<div class="auth-wrapper">
			<img src="../assets/logo.svg" alt="AutoExpenses">
			<div class="auth-form">
				<div class="switch">
					<div class="tab" v-bind:class="{ active: isActive == true }" @click="isActive = true">
						<h1 class="auth">Вход</h1>
					</div>
					<div class="tab" v-bind:class="{ active: isActive == false }" @click="isActive = false">
						<h1 class="auth">Регистрация</h1>
					</div>
				</div>
				<form class="tab-form" v-if="isActive == true">
					<input type="text" placeholder="Электронная почта" style="margin-top: 64px;" v-model="email_login">
					<input type="password" placeholder="Пароль" v-model="password_login">
					<div class="recovery-1">
						<label>
							<input type="checkbox">
							<h5 class="auth grey">Запомнить меня</h5>
						</label>
						<h5 class="auth blue"><a href="#">Не можете войти в систему?</a></h5>
					</div>
					<div class="error_block" v-if="error_active_auth == true">
						<h2 class="error_text">Ошибка: {{ error_text_auth }}</h2>
					</div>
					<div class="info_block" v-if="info_block_auth == true">
						<h2 class="info_text">{{ info_text_auth }}</h2>
					</div>
					<h2 class="auth"><a href="#" class="auth-button text-decoration-none" v-on:click="button_auth">Вход</a></h2>
					<div class="recovery-2">
						<h4 class="auth blue"><a href="#">Забыли пароль?</a></h4>
						<h4 class="auth" style="padding-bottom: 64px;"><a href="#" class="text-decoration-none">Обратитесь в службу поддержки!</a></h4>
					</div>
				</form>
				<form class="tab-form" v-if="isActive == false">
					<input type="text" placeholder="Полное имя" style="margin-top: 64px;" v-model="name_register">
					<input type="text" placeholder="Электронная почта" v-model="email_register">
					<input type="password" placeholder="Пароль" v-model="password_register">
					<input type="password" placeholder="Подтверждение пароля" v-model="password_register_confirm">
					<div class="error_block" v-if="error_active_reg == true">
						<h2 class="error_text">Ошибка: {{ error_text_reg }}</h2>
					</div>
					<h2 class="auth"><a href="#" class="auth-button text-decoration-none" v-on:click="button_reg">Регистрация</a></h2>
					<h4 class="auth" style="margin-top: 25px; padding-bottom: 64px;">Регистрируясь вы принимаете <a href="#" class="blue">Условия<br>использования AutoExpenses</a></h4>
				</form>
			</div>
		</div>
	</div>
</template>
<style scoped>
</style>
<style>
	h2.error_text {font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 19px; color: white; background-color: rgba(220, 20, 60, 0.6);}
	h2.info_text {font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 19px; color: white; background-color: rgba(0, 102, 204, 0.5);}

	* {box-sizing: border-box;}
	body {margin: 0; padding: 0;}
	h1,h2,h3,h4,h5,h6 {margin: 0; padding: 0;}
	a {color: inherit;}

	.body {background-color: #E5E5E5; height: 100vh;}

	h1.auth {font-family: 'Proxima Nova Rg'; font-weight: 600; font-size: 24px; color: rgba(0, 102, 204, 0.5);}
	h2.auth {font-family: 'Proxima Nova Rg'; font-weight: 600; font-size: 20px; color: white;}
	h3.auth {font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 18px; color: #7C8793;}
	h4.auth {font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 16px; text-align: center;}
	h5.auth {font-family: 'Proxima Nova Rg'; font-weight: 300; font-size: 14px;}

	.text-decoration-none {text-decoration: none;}
	.grey {color: #7C8793;}
	.blue {color: #287ED4;}

	.switch {display: flex;}
	.auth-form {width: 500px; margin: 0 auto;}
	.tab-form {padding: 0 48px;}
	.auth-wrapper img {padding-bottom: 40px;}

	.recovery-1 {display: flex; justify-content: space-between;align-items: center; margin-top: 9px;}
	.recovery-1 label {display: flex; align-items: center;}
	.recovery-1 label h5{margin-left: 2px;}
	.recovery-2 {text-align: center; margin-top: 32px;}

	.auth-wrapper {position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);} 
	.tab-form {background-color: white;}

	.tab {width: 250px; height: 76px; position: relative; margin-bottom: -1px;}
	.tab:hover {cursor: pointer;}
	.tab h1 {position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);}
	.tab.active {background-color: white;}
	.tab.active h1 {color: #0066CC;}

	.auth-button {background-color: #0066CC; padding: 14px 92px;border-radius: 6px;}
	h2.auth {text-align: center; margin-top: 53px;}

	input[type="email"],input[type="password"],input[type="text"] {width: 100%; height: 52px; outline: none; border-radius: 2px; border-color: #D7DEE9; border: 2px solid #D7DEE9; font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 18px; color: #7C8793; padding: 0 15px; margin-top: 20px; color: black;}
</style>
<script>
	import axios from 'axios';

	export default {
		data() {
			return {
				isActive: true,
				email_login: '',
				password_login: '',
				name_register: '',
				email_register: '',
				password_register: '',
				password_register_confirm: '',
				error_text_auth: '',
				error_active_auth: false,
				error_text_reg: '',
				error_active_reg: false,
				info_text: '',
				info_block_auth: false
			}
		},
		methods: {
			button_auth() {
				this.error_active_auth = false,
				this.info_block_auth = false
				if (this.email_login != '' && this.password_login != '') {
					axios
	  				.post('http://service.auto.xsph.ru/login', {
	  					email: this.email_login,
	    				password: this.password_login
	  				})
	  				.then(response => {
	  					if (response.data.error != '') {
	  						this.error_active_auth = true,
	  						this.error_text_auth = response.data.error
	  					}
	  					if (response.data.auth == "true") {
	  						console.log(response),
	  						this.$router.push('MapPage')
	  					}
	  				})
	  				.catch(error => {
	  					console.log(error)
	  				})
  				} else {this.error_text_auth = 'Заполните все поля!', this.error_active_auth = true}
			},
			button_reg() {
				this.error_active_reg = false
				if (this.name_register != '' && this.email_register != '' && this.password_register != '' && this.password_register_confirm != '') {
					if (this.password_register == this.password_register_confirm) {
						axios
		  				.post('http://service.auto.xsph.ru/register', {
		  					name: this.name_register,
		    				email: this.email_register,
		    				password: this.password_register
		  				})
		  				.then(response => {
		  					if (response.data.error != '') {
	  							this.error_active_reg = true,
	  							this.error_text_reg = response.data.error
	  						}
	  						if (response.data.auth == "true") {
	  							console.log(response.data),
	  							this.isActive = true,
	  							this.info_text_auth = 'Вы успешно зарегистрировались. Авторизируйтесь',
	  							this.info_block_auth = true
	  						}	
		  				})
		  				.catch(error => {
		  					console.log(error)
		  				})	
	  				} else {this.error_text_reg = 'Поля "Подтвердите пароль" и "Пароль" не совпадают!', this.error_active_reg = true}
	  			} else {this.error_text_reg = 'Заполните все поля!', this.error_active_reg = true}
			}
		}
	}
</script>