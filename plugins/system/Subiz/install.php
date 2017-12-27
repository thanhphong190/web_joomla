<?php
/**
 * @author    Jasonvishva http://jasonwebdesign.com/
 * @copyright Copyright (c) 2015 - All rights reserved
 * @license   GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
/**
 * Script file of HelloWorld component
 */
class plgSystemsubizInstallerScript
{
	/**
	 * method to install the component
	 *
	 * @return void
	 */
	function install($parent) 
	{
		// $parent is the class calling this method
		$query = "SELECT * FROM `#__extensions` WHERE `name` = 'Subiz'";
					$db = JFactory::getDBO();
					$db->setQuery($query);
					$db->Query();
					$Subiz = $db->loadobject();
					
			$query = "UPDATE `#__extensions` SET `enabled` = '1' WHERE `extension_id` = ".$Subiz->extension_id;
			$db->setQuery($query);
			$db->Query();
					
					$application = JFactory::getApplication();			
		$application->redirect('index.php?option=com_plugins&task=plugin.edit&extension_id='.$Subiz->extension_id);
		
	}
 
	/**
	 * method to uninstall the component
	 *
	 * @return void
	 */
	function uninstall($parent) 
	{
		// $parent is the class calling this method
		echo '<p>Subiz Unstalled</p>';
	}
 
	/**
	 * method to update the component
	 *
	 * @return void
	 */
	function update($parent) 
	{
		// $parent is the class calling this method
		$query = "SELECT * FROM `#__extensions` WHERE `name` = 'Subiz'";
					$db = JFactory::getDBO();
					$db->setQuery($query);
					$db->Query();
					$Subiz = $db->loadobject();
			
			$query = "UPDATE `#__extensions` SET `enabled` = '1' WHERE `extension_id` = ".$Subiz->extension_id;
			$db->setQuery($query);
			$db->Query();		
			$application = JFactory::getApplication();			
		
		$application->redirect('index.php?option=com_plugins&task=plugin.edit&extension_id='.$Subiz->extension_id);
		}
 
	/**
	 * method to run before an install/update/uninstall method
	 *
	 * @return void
	 */
	function preflight($type, $parent) 
	{
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
		echo '';
	}
 
	/**
	 * method to run after an install/update/uninstall method
	 *
	 * @return void
	 */
	function postflight($type, $parent) 
	{
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
		echo '';
	}
}