<?php require_once __DIR__ . '/../header.php'; ?>

<div class="block_main">
    <?php if (isset($user)) :?>
    <p>Спасибо что вошли, <?=$user->getEmail()?>
    </p>
    <div class="add_record">
        <button type="button" class="btn btn-danger" role="boss" <?= $user->getRole()!=='boss'?'disabled':''?>
            >Boss</button>
        <button type="button" class="btn btn-danger" role="manager" <?= $user->getRole()=='performer'?'disabled':''?>
            >Manager</button>
        <button type="button" class="btn btn-danger" role="performer" id="click">Performer</button>
    </div>
    <div class="container">
        <div class="block_record row row-cols-4 justify-content-center">

        </div>
    </div>
    <div id="r_tpl" style="display: none;">
        <div class="card col m-2" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{TITLE}</h5>
                <p class="card-text">{BODY}</p>
            </div>
        </div>
    </div>
    <button class="btn btn-primary" id="save_button" type="button">Сохранить все записи</button>
    <?php else :?>
    <div class="block_welcome">
        <p>Пожалуйста
            <a href="login">войдите</a>
            или
            <a href="register">зарегистрируйтесь</a>
        </p>
    </div>
    <?php endif ;?>

</div>

<?php require_once __DIR__ . '/../footer.php';
