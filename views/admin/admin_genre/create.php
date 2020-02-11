<?php include ROOT . '/views/admin/layouts/header.php'; ?>

<section>
  <div class="container">
    <div class="row">

      <br/>

      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="/admin">Админпанель</a></li>
          <li><a href="/admin/genre">Управление жанрами</a></li>
          <li class="active">Добавить жанр</li>
        </ol>
      </div>


      <h4>Добавить новый жанр</h4>

      <br/>

        <?php if (isset($errors) && is_array($errors)): ?>
          <ul>
              <?php foreach ($errors as $error): ?>
                <li style="color: red; font-weight: bold"> - <?php echo $error; ?></li>
              <?php endforeach; ?>
          </ul>
        <?php endif; ?>

      <div class="col-lg-4">
        <div class="login-form">
          <form action="#" method="post">

            <p>Название</p>
            <input type="text" name="name" placeholder="" value="">
            <br>
            <p>Статус отображения</p>
            <select name="status">
              <option value="1" selected="selected">Отображается</option>
              <option value="0">Скрыт</option>
            </select>

            <br><br><br><br>

            <input type="submit" name="submit" class="btn btn-default checkout" value="Сохранить">
          </form>
        </div>
      </div>

    </div>
  </div>
</section>

<?php include ROOT . '/views/admin/layouts/footer.php'; ?>

