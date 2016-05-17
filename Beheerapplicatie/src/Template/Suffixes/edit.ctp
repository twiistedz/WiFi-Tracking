<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $suffix->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $suffix->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Suffixes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Locations'), ['controller' => 'Locations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Location'), ['controller' => 'Locations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="suffixes form large-9 medium-8 columns content">
    <?= $this->Form->create($suffix) ?>
    <fieldset>
        <legend><?= __('Edit Suffix') ?></legend>
        <?php
            echo $this->Form->input('suffix');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
