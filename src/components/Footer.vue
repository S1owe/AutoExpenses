<template>
	<div>
		<div class="footer-up">
			<div class="wrapper">
				<div class="footer-up__flex-up">
					<div class="footer-up__flex">
						<div class="footer-up__align-s">
							<h1>Остались вопросы?</h1>
							<div class="footer-up__p-block">
								<p>Наши специалисты помогут вам решить любой вопрос. Просто позвоните нам или закажите обратный звонок.</p>
							</div>
							<h2><a href="#" class="footer-up__button">Заказать обратный звонок</a></h2>
						</div>
						<div class="footer-up__align">
							<img src="../assets/footer-img.svg">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-down">
			<div class="wrapper">
				<div class="footer-down__flex">
					<div class="footer-down__align">
						<p>© 1990-2021, AutoExpenses <br> г. Пенза, ул. Наметкина, д. 16, корпус 1.</p>
					</div>
					<div class="footer-down__align">
						<a href="#"><p>Подписаться на рассылку</p></a>
						<div class="footer-down__icons">
							<img src="../assets/facebook.svg">
							<img src="../assets/instagram.svg">
							<img src="../assets/youtube.svg">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<style scoped>
	a {text-decoration: none;}
	.footer-down__align a {text-decoration: underline !important; color: white;}
	.wrapper {max-width: 1180px; margin: 0 auto;}
	h1 {font-family: 'Proxima Nova Rg'; font-weight: bold; font-size: 32px; color: #2E2D57; padding-bottom: 12px;}
	p {font-family: 'Proxima Nova Rg'; font-weight: normal; font-size: 18px;}
	h2 {font-family: 'Proxima Nova Rg'; font-weight: bold; font-size: 18px; color: white;}
</style>
<style>
	.footer-up {background-color: #F0F1F4; height: 628px; width: 100%;}
	.footer-up__p-block {max-width: 407px;}
	.footer-up__button {background-color: #0066CC; padding: 20px; border-radius: 4px; color: white;}
	.footer-up__flex {display: flex; justify-content: space-between;}
	.footer-up__flex-up {display: flex; align-items: center; height: 628px;}
	.footer-up__p-block p {color: #2E2D57; padding-bottom: 44px;}

	.footer-down {background-color: #262C40; height: 230px; width: 100%;}
	.footer-down__align p{color: white;}
	.footer-down__icons {margin-top: 12px;}
	.footer-down__flex {display: flex; justify-content: space-between; align-items: center; height: 230px;}
</style>