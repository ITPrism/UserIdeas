<?php
/**
 * @package      UserIdeas
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2015 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * Default controller
 *
 * @package        UserIdeas
 * @subpackage     Component
 */
class UserIdeasController extends JControllerLegacy
{
    public function display($cachable = false, $urlparams = array())
    {
        $viewName = $this->input->getCmd('view', 'dashboard');
        $this->input->set("view", $viewName);

        parent::display();

        return $this;
    }
}
