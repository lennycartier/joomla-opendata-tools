<?php

// no direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

class plgContentAnnotator extends JPlugin
{
    public function onContentAfterTitle($context, &$row, &$params, $limitstart)
	        {

	    $document = JFactory::getDocument();

	    $document->addScript('/media/jui/js/jquery.js');

		// build local/remote url
		if ( $this->params->get('annotate-source') == 'local') { $source = "/plugins/content/annotator/annotator/v"; } else { $source = "http://assets.annotateit.org/annotator/v"; }
		
		// check annotator options
		if ( $this->params->get('loadallplugins') == '1') { $options = ".annotator('setupPlugins')"; }
		
		// call js & css		
	    if ( $this->params->get('minified-js') == '1' ) { 
	    $document->addScript($source.$this->params->get('annotate-version') ."/annotator-full.min.js"); 
	    	} else { $document->addScript($source.$this->params->get('annotate-version') ."/annotator-full.js"); }

	    if ( $this->params->get('minified-css') == '1' ) {	
	    $document->addStyleSheet($source.$this->params->get('annotate-version') ."/annotator.min.css");
	    	} else { $document->addStyleSheet($source.$this->params->get('annotate-version') ."/annotator.css"); }
	    
		// call annotator	
		$javascript = "<div><script type=\"text/javascript\"> jQuery(function ($) { $('#". $this->params->get('annotate-class') ."').annotator()$options; }); </script></div>";
		return $javascript;
		
		}
}
?>