<?php

use yii\helpers\Html;

$this->title = 'Мои объявления';
?>
<div class="cabinet-default-index">
    <!--<h1><?= $this->context->action->uniqueId ?></h1>-->
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>
</div>
