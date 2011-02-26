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
 * @author     kit.t <yosshi1123@mail.com>
 */
class opConfirmPluginActions extends opConfirmPluginObserver
{
  public function postExecute()
  {
    if ($this->getUser()->isAuthenticated())
    {
      sfConfig::set('sf_nav_type', 'default');

      if (!$this->isSecure())
      {
        $security = $this->getSecurityConfiguration();

        $actionName = strtolower($this->getActionName());

        $security[$actionName]['is_secure'] = true;

        $this->setSecurityConfiguration($security);
      }
    }
  }
}