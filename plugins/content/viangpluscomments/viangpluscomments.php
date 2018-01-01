<?php
/**
 * @Copyright
 * @package     Bình luận google+ for joomla3
 * @author      VIAN
 * @version     3.0
 * @date        2013-05-30
 * @link        Project Site {http://vian.vn}
 *
 * @license GNU/GPL
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version. 
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
defined('_JEXEC') or die('Restricted access');

class plgContentvianGPlusComments extends JPlugin
{

    
    /**
     * Use trigger onContentPrepare instead onContentAfterDisplay to avoid sorting problems with other plugins which use this (wrong!)
     * trigger. Actually this trigger should only be used to manipulate the output and not to add data to the output!
     *
     * @param string $context
     * @param object $row
     * @param string $params
     * @param integer $page
     */
    function onContentPrepare($context, &$row, &$params, $page = 0)
    {
        // Chỉ sử dụng được trong component com_content
        if(JFactory::getApplication()->input->getWord('view') == 'article' AND $context == 'com_content.article')
        {
            $this->renderGPlusCommentsBox($row, true);
        }
    }

    /**
     * This trigger (hien thi phia duoi bai viet) và hien thi dem comment.
     *
     * @param string $context
     * @param object $row
     * @param string $params
     * @param integer $page
     * @return string
     */
    public function onContentAfterDisplay($context, &$row, &$params, $page = 0)
    {
        // Only show the counter if it is activated in the settings
        if($this->params->get('counter', 1))
        {
            // This trigger (hien thi phia duoi bai viet) và hien thi dem comment.
            if(JFactory::getApplication()->input->getWord('view') != 'article' AND ($context == 'com_content.featured' OR $context == 'com_content.category'))
            {
                return $this->renderGPlusCommentsBox($row, false);
            }
        }
    }

    /**
     * Render the Google Plus Comments Box
     *
     * @param array $row
     * @param string $view
     * @return
     */
    public function renderGPlusCommentsBox(&$row, $view)
    {
        // Check whether the loaded article is excluded
        $exclude_article = $this->excludeArticles($row->id, $row->catid);

        if(empty($exclude_article))
        {
            // Load Google Plus Api JS in the head with language recognition
            $document = JFactory::getDocument();
            $lang = JFactory::getLanguage();
            $document->addCustomTag('<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>');
			$noscript = base64_decode("PGEgaHJlZj0iaHR0cDovL3ZpYW4udm4iIHRhcmdldD0iX2JsYW5rIiBhbHQ9IlRoaWV0IGtlIHdlYiI+VGhp4bq/dCBr4bq/IHdlYjwvYT4=");

            // Get URI object for the current URL of the article
            $uri = JFactory::getURI();

            // If view is article, then the comments box is loaded else a counter of the corresponding article
            if($view == 'article')
            {
                // Create the output of the box
                $output = '<!-- Google Plus Comments Plugin for Joomla! 3.0 - VIAN.VN -->';
                $output .= '<div class="g-comments" style="height:auto"
                        data-href="'.$uri->toString().'"
                        data-width="'.$this->params->get('width', 650).'"
                        data-first_party_property="BLOGGER"
                        data-view_type="FILTERED_POSTMOD">
                    </div>
					<noscript>'.$noscript.'</noscript>';

                if($this->params->get('link', 1))
                {
                    // Add needed CSS instruction for the link in the head
                    $document->addStyleDeclaration('.gpc_small{font-size: 0.85em; text-align: center;}');

                    // Add the link to the project page
                    $output .= '<div class="gpc_small"><a  href="http://vian.vn/" target="_blank" title="Google+ bình luận for joomla">Google Plus Comments</a></div>';
                }

                // Add the comments box to the article's content
                $row->text .= $output;
            }
            else
            {
                // Generate the correct URL of the article
                require_once(JPATH_ROOT.'/components/com_content/helpers/route.php');
                $link = $uri->toString(array('scheme', 'host')).JRoute::_(ContentHelperRoute::getArticleRoute($row->id, $row->catid));

                // Create the output and return it to the trigger
                $output = '<div class="g-commentcount" data-href="'.$link.'"></div>';

                return $output;
            }
        }
    }

    /**
     * Check whether the loaded article should be excluded
     *
     * @param integer $catid
     * @return boolean
     */
    private function excludeArticles($id, $catid)
    {
        // Exclude articles via their IDs
        $exclude_articles_ids = $this->params->get('exclude_articles_ids');

        if(!empty($exclude_articles_ids))
        {
            $exclude_articles_ids = array_map('trim', explode(',', $exclude_articles_ids));

            if(in_array($id, $exclude_articles_ids))
            {
                return true;
            }
        }

        // Exclude articles via their category IDs
        $exclude_articles_categories = $this->params->get('exclude_articles_categories');

        if(!empty($exclude_articles_categories))
        {
            $exclude_articles_categories = array_map('trim', explode(',', $exclude_articles_categories));

            if(in_array($catid, $exclude_articles_categories))
            {
                return true;
            }
        }

        return false;
    }

}
