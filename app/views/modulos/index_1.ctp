 <section id="main" class="column">
    
    <article class="module width_3_quarter">        
        <header>
            <h3 class="tabs_involved"><?php __('Modulos');?></h3>
            <ul class="tabs">
                <li><a href="#tab1">Posts</a></li>
                <li><a href="#tab2">Comments</a></li>
            </ul>
        </header>   
        <div class="tab_container">
            
            <div id="tab1" class="tab_content">
                <table class="tablesorter" cellspacing="0">
                <thead>
                    <tr>
                                <th><?php echo $this->Paginator->sort('id');?></th>
                                <th><?php echo $this->Paginator->sort('nombre');?></th>
                                <th><?php echo $this->Paginator->sort('descripcion');?></th>
                                <th><?php echo $this->Paginator->sort('esactivo');?></th>
                                <th><?php echo $this->Paginator->sort('created');?></th>
                                <th><?php echo $this->Paginator->sort('modified');?></th>
                                <th><?php echo $this->Paginator->sort('orden');?></th>
                                <th class="actions"><?php __('Actions');?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                foreach ($modulos as $modulo):
                        $class = null;
                        if ($i++ % 2 == 0) {
                                $class = ' class="altrow"';
                        }
                ?>
                    <tr<?php echo $class;?>>
                        <td><?php echo $modulo['Modulo']['id']; ?>&nbsp;</td>
                        <td><?php echo $modulo['Modulo']['nombre']; ?>&nbsp;</td>
                        <td><?php echo $modulo['Modulo']['descripcion']; ?>&nbsp;</td>
                        <td><?php echo $modulo['Modulo']['esactivo']; ?>&nbsp;</td>
                        <td><?php echo $modulo['Modulo']['created']; ?>&nbsp;</td>
                        <td><?php echo $modulo['Modulo']['modified']; ?>&nbsp;</td>
                        <td><?php echo $modulo['Modulo']['orden']; ?>&nbsp;</td>
                        <td class="actions">
                                <?php echo $this->Html->link(__('View', true), array('action' => 'view', $modulo['Modulo']['id'])); ?>
                                <?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $modulo['Modulo']['id'])); ?>
                                <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $modulo['Modulo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $modulo['Modulo']['id'])); ?>
                        </td>
                    </tr>
        <?php endforeach; ?>
                </tbody>
                
                </table>
            
                <footer>
                    <div class="paging">
                        <p>  <?php
                        echo $this->Paginator->counter(array(
                        'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
                        ));
                        ?></p>

                            <?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
                     | 	<?php echo $this->Paginator->numbers();?>
             |
                            <?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
                    </div>
                </footer>
            </div>
            
            <div id="tab2" class="tab_content">
                <header></header>    
                <footer></footer>    
            </div>
            
        </div>        
    </article>
     
    <article class="module width_quarter">
        <header><h3><?php __('Actions'); ?></h3></header>
        <article>
            <ul>
                <li><?php echo $this->Html->link(__('New Modulo', true), array('action' => 'add')); ?></li>
                <li><?php echo $this->Html->link(__('List Submodulos', true), array('controller' => 'submodulos', 'action' => 'index')); ?> </li>
                <li><?php echo $this->Html->link(__('New Submodulo', true), array('controller' => 'submodulos', 'action' => 'add')); ?> </li>
            </ul>
        </article>
    </article> 
    
    <div class="spacer"></div>
</section>