<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactU[]|\Cake\Collection\CollectionInterface $contactUs
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Contact Us'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="contactUs index large-9 medium-8 columns content">
    <h3><?= __('Contact Us') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">SI</th>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contactUs as $key=>$contactU): ?>
            <tr>
                <td><?= $this->Number->format(++$key) ?></td>
                <td><?= $this->Number->format($contactU->id) ?></td>
                <td><?= h($contactU->name) ?></td>
                <td><?= h($contactU->email) ?></td>
                <td><?= h($contactU->message) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $contactU->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contactU->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contactU->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contactU->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
