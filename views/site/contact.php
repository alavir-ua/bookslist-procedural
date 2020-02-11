<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
	<div class="container">
		<div class="row">

			<div class="col-sm-4 col-sm-offset-4 padding-right">

		  <?php if ($result): ?>
						<h4>Сообщение отправлено! Мы ответим Вам на указанный email.</h4>
		  <?php else: ?>
			  <?php if (isset($errors) && is_array($errors)): ?>
							<ul>
				  <?php foreach ($errors as $error): ?>
										<li style="color: red; font-weight: bold"> - <?php echo $error; ?></li>
				  <?php endforeach; ?>
							</ul>
			  <?php endif; ?>

						<div class="signup-form"><!--sign up form-->
							<h2>Обратная связь</h2>
							<h5>Есть вопрос? Напишите нам</h5>
							<br>
							<form action="#" method="post">
								<p>Ваша почта</p>
								<input type="email" name="userEmail" placeholder="E-mail" value=""/>
								<p>Сообщение</p>
								<textarea name="userText" rows="4"></textarea>
								<br><br><br>
								<input type="submit" name="submit" class="btn btn-default checkout" value="Отправить"/>
							</form>
						</div><!--/sign up form-->
		  <?php endif; ?>
				<br/>
				<br/>
			</div>
		</div>
	</div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>
