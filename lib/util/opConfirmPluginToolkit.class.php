<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * opConfirmPluginToolkit
 *
 * @package    OpenPNE
 * @subpackage opConfirmPlugin
 * @author     kit.t <yosshi1123@mail.com>
 */
class opConfirmPluginToolkit
{
  public static function getEmbedFormWidget($schemaDecorator)
  {
    $widgetSchema = new sfWidgetFormSchema();
    foreach($schemaDecorator->getFields() as $key => $widget)
    {
      if($widget instanceof sfWidgetFormSchemaDecorator)
      {
        $widgetSchema[$key] = opConfirmPluginToolkit::getEmbedFormWidget($widget->getWidget());
      }
      elseif($widget instanceof sfWidgetFormInputHidden)
      {
        $widgetSchema[$key] = $widget;
      }
      else
      {
        $previewWidget = new opWidgetFormConfirm();
        $previewWidget->setOriginalWidget($widget);
        $widgetSchema[$key] = $previewWidget;
      }
    };
    return new sfWidgetFormSchemaDecorator($widgetSchema, null);
  }
}