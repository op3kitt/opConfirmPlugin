<?php
if(count($form->getErrorSchema()) == 1 && !$modify)
{
  foreach($form as $key => $field)
  {
    if($field->getWidget() instanceof sfWidgetFormSchemaDecorator)
    {
      $form->setWidget($key, opConfirmPluginToolkit::getEmbedFormWidget($field->getWidget()));
    }
    elseif(!$field->getWidget() instanceof sfWidgetFormInputHidden)
    {
      $widget = new opWidgetFormConfirm();
      $widget->setOriginalWidget($field->getWidget());
      $form->setWidget($key, $widget);
    }
  }
}
$options = array(
  'button' => __('submit'),
  'form' => $form,
  'isMultipart' => true,
  'isValid' => count($form->getErrorSchema()) == 1 && !$modify,
);
op_include_parts('form Preview','ConfirmForm',$options);
?>