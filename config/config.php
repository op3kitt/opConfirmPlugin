<?php
$this->dispatcher->connect('op_action.pre_execute', array('opConfirmPluginObserver', 'PreListener'));
$this->dispatcher->connect('form.post_configure', array('opConfirmPluginObserver', 'FormListener'));
$this->dispatcher->connect('form.filter_values', array('opConfirmPluginObserver', 'FormFilter'));
$this->dispatcher->connect('op_action.post_execute', array('opConfirmPluginObserver', 'PostListener'));

