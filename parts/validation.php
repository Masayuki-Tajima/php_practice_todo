<?php if(isset($_SESSION["error_message"])): ?>
    <ul>
        <?php foreach($_SESSION["error_message"] as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>