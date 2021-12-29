<?php

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');
$class = ' class="kfirsti"';
if (($this->children[$this->category->id])) {
  foreach ($this->children[$this->category->id] as $id => $child) :
    echo " <div idProducto='$child->id' class = 'unproducto row nivel$child->level' >";
    echo "<h$child->level class='page-header item-title'>
	
	$this->escape($child->title)</h3>";
    if ($child->level != 2) {//si es un año muestra solo el título
      if (3 == $child->level) {//si es fotocopiableo afiches solo el índice
        echo "<div class = 'describeproducto span3'>";
        echo JHtml::_('content.prepare', $child->description, '',
                'com_content.category');
        echo '</div>'; // cierra span4 descrip producto 
      }
      //intentos de pablo
      $model = JModelLegacy::getInstance('Articles', 'ContentModel',
                      array('ignore_request' => true));
      $appParams = JFactory::getApplication()->getParams();
      $model->setState('params', $appParams);
      $model->setState('filter.category_id', $child->id); //change that to your Category ID
      $model->setState('list.ordering', 'title');
      $model->setState('list.direction', 'ASC');
      //echo $this->category .$this->category->id;
      $this->items = $model->getItems();
      echo "<div class='span8 indice'>";
      echo $this->loadTemplate('articles');
    }
    $usu = JFactory::getUser();
    $permitidas = $usu->getAuthorisedCategories('com_content', 'core.create');
//var_dump($permitidas);
    if (in_array($this->category->id, $permitidas) & $this->category->level > 1) {
//if(!$usu->guest){
      $uri = & JFactory::getURI();
      $pageURL = $uri->toString();
      $urlCodificada = base64_encode($pageURL);
      $enlace = "index.php?option=com_content&task=article.add&catid=$child->id&a_id=0&return=$urlCodificada";
      $letra = "<a class='btn btn-primary' href='$enlace'>mandar nuevo a $child->title</a>";
      echo $letra;
    }
//echo '</div>';//cierra índice más botón
    if (count($child->getChildren()) > -10 && $this->maxLevel > 0) {
      $this->children[$child->id] = $child->getChildren();
      $this->category = $child;
      $this->maxLevel--;
      echo $this->loadTemplate('children');
      $this->category = $child->getParent();
      $this->maxLevel++;
    }
    echo "</div>"; //cierra div indice span8//fin intentos de pablo
    echo "</div><hr>"; //cierra div categoría (row de butstrap)
  endforeach;
}
//http://localhost/34/index.php?option=com_content&task=article.add&return=aHR0cDovL2xvY2FsaG9zdC8zNC9pbmRleC5waHA/b3B0aW9uPWNvbV9jb250ZW50JnZpZXc9Y2F0ZWdvcnkmaWQ9NDk3Jkl0ZW1pZD00MDAwOTA=&a_id=0&catid=497&Itemid=400090