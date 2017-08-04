<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 text-center">
    <a href="<?= 'profile.php?' . $list[$u]["permalink"] ?>">
        <div class="widget-user-image">
            <img class="img-circle" width="128" height="128" src="<?= ( empty( $list[$u]["ruta"] ) )? 'images/profile-default.jpg' : $list[$u]["ruta"] ?>">
        </div>
        <h5><?= $list[$u]["nombre"] . ' ' . $list[$u]["apellido"] ?></h5>
        <h5><?= $list[$u]["email"] ?></h5>
    </a>
</div>