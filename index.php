<?php

defined('_JEXEC') or die;

$doc = JFactory::getDocument();

$doc->addStyleSheet('templates/'.$this->template.'/css/template.css');
//JHtml::_('jquery.framework');

// Add current user information
$user = JFactory::getUser();
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<jdoc:include type="head" />
</head>

<body >
<jdoc:include type="component" />
</html>
