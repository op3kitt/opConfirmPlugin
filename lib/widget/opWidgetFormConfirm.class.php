<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * PreviewWidget for the opConfirmPlugin.
 *
 * @package    OpenPNE
 * @subpackage opConfirmPlugin
 * @author     kit.t <yosshi1123@gmail.com>
 */
class opWidgetFormConfirm extends sfWidgetForm
{
  protected $choices = array();
  protected $type;
  protected $org;
  
  public function __construct($options = array(), $attributes = array())
  {
    parent::__construct($options, $attributes);
    $this->addOption('needs_multipart', false);
  }
  
  public function setOriginalWidget($original_widget)
  {
    $this->type = "string";

    if(method_exists($original_widget, "getChoices"))
    {
      $this->choices = $original_widget->getChoices();
      $this->type = "choice";
    }
    elseif(($original_widget instanceof sfWidgetFormDate)
        || ($original_widget instanceof opWidgetFormDate))
    {
      $this->type = "date";
    }
    elseif($original_widget instanceof sfWidgetFormTime)
    {
      $this->type = "time";
    }
    elseif($original_widget instanceof opWidgetFormRichTextarea)
    {
      $this->type = "tinymce";
    }
    elseif($original_widget instanceof sfWidgetFormTextarea)
    {
      $this->type = "textarea";
    }
    elseif($original_widget instanceof sfWidgetFormInputFileEditable)
    {
      $this->org = $original_widget;
      $this->type = "file";
    }
  }
  
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $output = parent::renderTag('input',array('type' => 'hidden', 'name' => $name, 'value' => $value));
    if($this->type=="date" && is_array($value))
    {
      //FIXME...date_format??
      $output .= implode("/", $value);
    }
    if($this->type=="time" && is_array($value))
    {
      $output .= sprintf('%02d', $value['hour']).':'.sprintf('%02d', $value['minute']);
    }
    elseif($this->type=="choice")
    {
      if(is_array($value))
      { 
        $_values = array();
        foreach($value as $v)
        {
          if(isset($this->choices[$v])) $_values[] = $this->choices[$v];
        }
        $output .= count($_values)>0?implode(",", $_values):"-";
      }
      else
      {
        $output .= isset($this->choices[$value])?$this->choices[$value]:"-";
      }
    }
    elseif($this->type=="textarea")
    {
      $output .= nl2br($value);
    }
    elseif($this->type=="tinymce")
    {
      $output .= op_url_cmd(op_decoration(nl2br($value)));
    }
    elseif($this->type=="file")
    {
      $options = $this->org->getOptions();
      $output .= $options['file_src'].$value;
    }
    else
    {
      $output .= $value;
    }
    
    return $output;
  }
}