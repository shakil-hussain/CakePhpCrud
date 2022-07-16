<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactU $contactU
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $contactU->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $contactU->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Contact Us'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="contactUs form large-9 medium-8 columns content">
    <?= $this->Form->create($contactU) ?>
    <fieldset>
        <legend><?= __('Edit Contact U') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('email');
            echo $this->Form->control('message');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
