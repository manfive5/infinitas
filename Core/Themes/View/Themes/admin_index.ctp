<?php
    /**
     * Comment Template.
     *
     * @todo -c Implement .this needs to be sorted out.
     *
     * Copyright (c) 2009 Carl Sutton ( dogmatic69 )
     *
     * Licensed under The MIT License
     * Redistributions of files must retain the above copyright notice.
     *
     * @filesource
     * @copyright     Copyright (c) 2009 Carl Sutton ( dogmatic69 )
     * @link          http://infinitas-cms.org
     * @package       sort
     * @subpackage    sort.comments
     * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
     * @since         0.5a
     */

    echo $this->Form->create('Theme', array('action' => 'mass'));
        $massActions = $this->Infinitas->massActionButtons(
            array(
                'install',
                'add',
                'edit',
                'toggle',
                'delete'
            )
        );
	echo $this->Infinitas->adminIndexHead($filterOptions, $massActions);
?>
<div class="table">
    <table class="listing" cellpadding="0" cellspacing="0">
        <?php
            echo $this->Infinitas->adminTableHeader(
                array(
                    $this->Form->checkbox('all') => array(
                        'class' => 'first',
                        'style' => 'width:25px;'
                    ),
                    $this->Paginator->sort('name'),
                    $this->Paginator->sort('default_layout'),
                    $this->Paginator->sort('licence') => array(
                        'style' => 'width:100px;'
                    ),
                    $this->Paginator->sort('author') => array(
                        'style' => 'width:100px;'
                    ),
                    $this->Paginator->sort('core') => array(
                        'style' => 'width:50px;'
                    ),
                    $this->Paginator->sort('active') => array(
                        'style' => 'width:50px;'
                    )
                )
            );

            foreach($themes as $theme) {
                ?>
                	<tr class="<?php echo $this->Infinitas->rowClass(); ?>">
                        <td><?php echo $this->Infinitas->massActionCheckBox($theme); ?>&nbsp;</td>
                		<td>
                			<?php echo $this->Html->link(Inflector::humanize($theme['Theme']['name']), array('action' => 'edit', $theme['Theme']['id'])); ?>&nbsp;
                		</td>
                		<td>
                			<?php echo Inflector::humanize($theme['Theme']['default_layout']); ?>&nbsp;
                		</td>
                		<td>
                			<?php echo $theme['Theme']['licence'] ? $theme['Theme']['licence'] : sprintf('&copy; %s', $theme['Theme']['author']); ?>&nbsp;
                		</td>
                		<td>
                			<?php
								$auth = $theme['Theme']['author'];
                				if (!empty($theme['Theme']['url'])) {
                					$auth = $this->Html->link($theme['Theme']['author'], $theme['Theme']['url'], array('target' => '_blank'));
                				}
								
								echo $auth;
							?>&nbsp;
                		</td>
                		<td>
                			<?php echo $this->Infinitas->status($theme['Theme']['core']); ?>&nbsp;
                		</td>
                		<td>
                			<?php echo $this->Infinitas->status($theme['Theme']['active']); ?>&nbsp;
                		</td>
                	</tr>
                <?php
            }
        ?>
    </table>
    <?php echo $this->Form->end(); ?>
</div>
<?php echo $this->element('pagination/admin/navigation'); ?>