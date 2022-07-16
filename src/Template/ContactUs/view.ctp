<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactU $contactU
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Contact U'), ['action' => 'edit', $contactU->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Contact U'), ['action' => 'delete', $contactU->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactU->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Contact Us'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Contact U'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="contactUs view large-9 medium-8 columns content">
    <h3><?= h($contactU->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($contactU->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($contactU->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($contactU->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Mesage') ?></h4>
        <?= $this->Text->autoParagraph(h($contactU->mesage)); ?>
    </div>
</div>
