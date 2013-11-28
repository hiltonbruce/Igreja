<?php
/**
* Another example of usage for PEAR class HTML_QuickForm using the
* QuickHtml renderer.
*
* This renderer has three main distinctives: an easy way to create
* custom-looking forms, the ability to separate the creation of form
* elements from their display, and being able to use QuickForm in
* widget-based template systems.  See the online documentation for more
* info.
*
* @category    HTML
* @package     HTML_QuickForm
* @author      Jason Rust <jrust@rustyparts.com> 
* @version     CVS: $Id: QuickHtml_example.php,v 1.2 2007/05/29 19:12:26 avb Exp $
* @ignore
*/

require_once ("HTML/QuickForm.php");
require_once ("HTML/QuickForm/Renderer/QuickHtml.php");
$form =& new HTML_QuickForm('tmp_form','GET','./');
$form2 = new HTML_QuickForm($formName, $method, $action, $target, $attributes, $trackSubmit);
// get our render
$renderer =& new HTML_QuickForm_Renderer_QuickHtml();
// create the elements
createElements($form);
// set their values
setValues($form);

// Do the magic of creating the form.  NOTE: order is important here: this must
// be called after creating the form elements, but before rendering them.
$form->accept($renderer);

$tmp_submit = $renderer->elementToHtml('tmp_submit');

// Make our form table using some of the widget functions.
$data = '
<table border="0" cellpadding="0" cellspacing="2" bgcolor="#eeeeee" width="100%">
  <tr style="font-weight: bold;">' . createHeaderCell('Busca por nome do Membro:', 'center', 2) . '</tr>
  
  <tr>' . createFormCell($renderer->elementToHtml('nome'), 'left')  .
		 createFormCell($tmp_submit, 'right'). '</tr>
          
  <tr>' . createFormCell($renderer->elementToHtml('escolha'), 'left') . '</tr>
</table>';

// Wrap the form and any remaining elements (i.e. hidden elements) into the form tags.
echo $renderer->toHtml($data);

// creates all the fields for the form
function createElements(&$form)
{
    $form->addElement('hidden','escolha',null,array('size' => 30));
    
	$list_membro = new membro();
	$todos = $list_membro->nomes();
    $text = $todos;    
    
    $form->addElement('submit','tmp_submit','Listar dados...');
    $form->addElement('autocomplete', 'nome', null , $todos , array('size' => 50));
    //$form->addRule('tmp_text[array]','Text length must be greater than 10','minlength',10,'client');
}

// }}}
// {{{ setValues()

// sets all the default and constant values for the form
function setValues(&$form)
{
   
    $constantValues['escolha'] = 'adm/rest_busca.php';

    $form->setDefaults($defaultValues);
    $form->setConstants($constantValues);
}

// }}}
// {{{ createHeaderCell()

// creates a header cell
function createHeaderCell($text, $align, $colspan = 1)
{
    return '<td align="' . $align . '" width="50%" bgcolor="#cccccc" colspan="' . $colspan . '">' . $text . '</td>';
}

// }}}
// {{{ createFormCell()

// creates a form cell based on the element name
function createFormCell($elementHtml, $align, $colspan = 1)
{
    return '<td align="' . $align . '" width="50%" colspan="' . $colspan . '">' . 
           $elementHtml .
           '</td>';
}

// }}}
?>
