<section id="main" class="column">

    <article class="module width_full">
            <header><h3>Login</h3></header>
            <div class="module_content">
<?php
echo $this->Session->flash('auth');
echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'login')));
echo $this->Form->input('User.username');
echo $this->Form->input('User.password');
echo $this->Form->end('Login');
?>
            </div>
    </article>

    <div class="spacer"></div>
</section>