<?php
/**
 * @author    Jasonvishva http://jasonwebdesign.com/
 * @copyright Copyright (c) 2015 - All rights reserved
 * @license   GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );
      
class plgsystemsubiz extends JPlugin
{
	public function __construct(& $subject, $config)
    {
        parent::__construct($subject, $config);
        $this->loadLanguage();
    }


    function onAfterInitialise()
    {
	   $License_ID	= $this->params->def('License_ID');
	   $idcode		= $this->params->def('idcode');
	
	   if (JFactory::getApplication()->isSite()) : ?>
        <?php if(!empty($License_ID) ){ ?> 
	        <script type='text/javascript'> window._sbzq||function(e){e._sbzq=[];var t=e._sbzq;t.push(["_setAccount",<?php echo $License_ID ?>]);var n=e.location.protocol=="https:"?"https:":"http:";var r=document.createElement("script");r.type="text/javascript";r.async=true;r.src=n+"//static.subiz.com/public/js/loader.js";var i=document.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)}(window); </script>
        <?php } else { ?>
            <script type="text/javascript"><?php  echo $idcode; ?></script>
        <?php } ?>
    <?php endif;
    }
}

?>

