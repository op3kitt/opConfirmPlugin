<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * opConfirmPluginObserver
 *
 * @package    OpenPNE
 * @subpackage opConfirmPlugin
 * @author     kit.t <yosshi1123@gmail.com>
 */
class opConfirmPluginObserver extends sfActions
{
  protected static
    $mod, $act, $valid, $complete, $modify, $form, $user,
    $flist = array();
  public static function PreListener(sfEvent $event)
  {
    $list = array('diary' => array('update' => array('model' => 'Diary', 'form' => 'DiaryForm'),
                                   'create' => array('model' => 'Diary', 'form' => 'DiaryForm')),
                  'diaryComment' => array('update' => array('model' => 'diary_comment', 'form' => 'DiaryCommentForm'),
                                   'create' => array('model' => 'diary_comment', 'form' => 'DiaryCommentForm')));
    if(array_key_exists($event['moduleName'], $list))
    {
      if(array_key_exists($event['actionName'],$list[$event['moduleName']]))
      {
        self::$flist[$list[$event['moduleName']][$event['actionName']]['form']] = $list[$event['moduleName']][$event['actionName']]['form'];
        self::$mod = $event['moduleName'];
        self::$act = $event['actionName'];
        self::$complete = !!$event['actionInstance']->getRequest()->getParameter('complete');
        self::$modify = !!$event['actionInstance']->getRequest()->getParameter('modify');
        self::$user = $event['actionInstance']->getUser();
      }
    }
  }

  static function FormListener(sfEvent $event)
  {
    $form = $event->getSubject();
    foreach(self::$flist as $key)
    {
      if($form instanceof $key)
      {
        if(!self::$complete)
        {
          self::$form = $form;
          $form->setValidator('complete', new opValidatorConfirm());
        }
      }
    }
  }

  static function FormFilter(sfEvent $event, $parameters)
  {
    $form = $event->getSubject();
    foreach(self::$flist as $key)
    {
      if($form instanceof $key)
      {
        if(!self::$complete && !self::$modify)
        {
          foreach($parameters as $akey => $value)
          {
            if(is_array($value) && array_key_exists('photo', $value))
            {
              if($value['photo']['size'] > 0)
              {
                if(!file_exists(sfConfig::get('sf_cache_dir').'/opConfirmPlugin'))
                {
                  mkdir(sfConfig::get('sf_cache_dir').'/opConfirmPlugin', 666);
                }
                move_uploaded_file($value['photo']['tmp_name'], sfConfig::get('sf_cache_dir').'/opConfirmPlugin/'.basename($value['photo']['tmp_name']));
                $parameters[$akey]['photo']['tmp_name'] = sfConfig::get('sf_cache_dir').'/opConfirmPlugin/'.basename($value['photo']['tmp_name']);
              }
            }
          }
          self::$user->setAttribute('opConfirmPluginParameters', $parameters);
        }
        elseif(self::$modify)
        {
          $parameters = self::$user->getAttribute('opConfirmPluginParameters');
        }
        else
        {
          $parameters = self::$user->getAttribute('opConfirmPluginParameters');
        }
      }
    }
    return $parameters;
  }

  static function PostListener(sfEvent $event)
  {
    if(self::$mod == $event['moduleName'] && self::$act == $event['actionName'] && !self::$complete){
      $event['actionInstance']->forward('default','preview');
    }
  }

  public function executePreview(opWebRequest $request)
  {
    $this->modify = $request->getParameter('modify');
    $this->form = self::$form;
  }
}