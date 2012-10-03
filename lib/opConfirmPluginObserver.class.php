<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

/**
 * base actions class for the opConfirmPlugin.
 *
 * @package    OpenPNE
 * @subpackage opConfirmPlugin
 * @author     Yoshiyuki.tanaka <yosshi1123@gmail.com>
 */
class opConfirmPluginObserver extends sfActions
{
  public function PostListener(sfEvent $event)
  {
    if(sfConfig::get('sf_app') == 'pc_frontend' &&
        ($event['actionName'] != sfConfig::get('sf_login_action') || 
         $event['moduleName'] != sfConfig::get('sf_login_module'))
      )
    {
      if(sfConfig::get('op_jquery_url'))
      {
        $event['actionInstance']->getResponse()->addJavascript(sfConfig::get('op_jquery_url'),'last');
      }
      else
      {
        $event['actionInstance']->getResponse()->addJavascript('jquery.min.js', 'last');
      }
      $event['actionInstance']->getResponse()->addJavascript('/opConfirmPlugin/js/opConfirm','last');
    }
  }
}