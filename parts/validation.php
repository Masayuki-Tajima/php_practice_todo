<?php if(isset($error_message)): ?>
    <ul>
        <?php foreach($error_message as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach ?>
    </ul>
<?php endif ?>