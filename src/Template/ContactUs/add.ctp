<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ContactU $contactU
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Contact Us'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="contactUs form large-9 medium-8 columns content">
    <form method="post"  accept-charset="utf-8"  id="contactForm">
        <fieldset>
            <legend><?= __('Add ContactUs') ?></legend>
            <?php
                echo $this->Form->control('name',["id"=>"name"]);
                echo $this->Form->control('email',["id"=>"email"]);
                echo $this->Form->control('message',["id"=>"message"]);
            ?>
        </fieldset>
        <button type="submit">Submit</button>
    </form>
</div>
