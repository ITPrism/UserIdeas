<?php
/**
 * @package      Userideas
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2016 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */
defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
 * Form Field class for the Joomla Framework.
 *
 * @package      Userideas
 * @subpackage   Component
 * @since        1.6
 */
class JFormFieldUiauthor extends JFormFieldList
{
    /**
     * The form field type.
     *
     * @var     string
     * @since   1.6
     */
    protected $type = 'uiauthor';

    /**
     * Method to get the field options.
     *
     * @return  array   The field option objects.
     * @since   1.6
     */
    protected function getOptions()
    {
        $db    = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query
            ->select('DISTINCT a.user_id AS value, b.name AS text')
            ->from($db->quoteName('#__uideas_items', 'a'))
            ->leftJoin($db->quoteName('#__users', 'b') . ' ON a.user_id = b.id')
            ->order('b.name ASC');

        // Get the options.
        $db->setQuery($query);

        $options = $db->loadAssocList();

        // Set a name of the anonymous author.
        foreach ($options as &$option) {
            if ((int)$option['value'] === 0) {
                $option['text'] = JText::_('COM_USERIDEAS_ANONYMOUS');
                break;
            }
        }
        unset($option);

        // Merge any additional options in the XML definition.
        $options = array_merge(parent::getOptions(), $options);

        return $options;
    }
}
