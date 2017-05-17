<?php
namespace PhpOffice\PhpWord\Shared;
use PhpOffice\PhpWord\Element\AbstractContainer;
 
/**
 * Common Html functions
 *
 * @SuppressWarnings(PHPMD.UnusedPrivateMethod) For readWPNode
 */
class Html
{
    /**
     * Add HTML parts.
     *
     * Note: $stylesheet parameter is removed to avoid PHPMD error for unused parameter
     *
     * @param \PhpOffice\PhpWord\Element\AbstractContainer $element Where the parts need to be added
     * @param string $html The code to parse
     * @param bool $fullHTML If it's a full HTML, no need to add 'body' tag
     * @return void
     */
    public static function addHtml($element, $html, $fullHTML = false)
    {
        /*
         * @todo parse $stylesheet for default styles.  Should result in an array based on id, class and element,
         * which could be applied when such an element occurs in the parseNode function.
         */
 
        // Preprocess: remove all line ends, decode HTML entity,
        // fix ampersand and angle brackets and add body tag for HTML fragments
        $html = str_replace(array("\n", "\r"), '', $html);
        $html = str_replace(array('&lt;', '&gt;', '&amp;'), array('_lt_', '_gt_', '_amp_'), $html);
        $html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');
        $html = str_replace('&', '&amp;', $html);
        $html = str_replace(array('_lt_', '_gt_', '_amp_'), array('&lt;', '&gt;', '&amp;'), $html);
 
        if (false === $fullHTML) {
            $html = '<body>' . $html . '</body>';
        }
 
        // Load DOM
        $dom = new \DOMDocument();
        $dom->preserveWhiteSpace = true;
        $dom->loadXML($html);
        $node = $dom->getElementsByTagName('body');
 
        self::parseNode($node->item(0), $element);
    }
 
    /**
     * parse Inline style of a node
     *
     * @param \DOMNode $node Node to check on attributes and to compile a style array
     * @param array $styles is supplied, the inline style attributes are added to the already existing style
     * @return array
     */
    protected static function parseInlineStyle($node, $styles = array())
    {
        if (XML_ELEMENT_NODE == $node->nodeType) {
            $attributes = $node->attributes; // get all the attributes(eg: id, class)
 
            foreach ($attributes as $attribute) {
                switch ($attribute->name) {
                    case 'style':
                        $styles = self::parseStyle($attribute, $styles);
                        break;
                }
            }
        }
    
        return $styles;
    }
 
    /**
     * Parse a node and add a corresponding element to the parent element.
     *
     * @param \DOMNode $node node to parse
     * @param \PhpOffice\PhpWord\Element\AbstractContainer $element object to add an element corresponding with the node
     * @param array $styles Array with all styles
     * @param array $data Array to transport data to a next level in the DOM tree, for example level of listitems
     * @return void
     */
    protected static function parseNode($node, $element, $styles = array(), $data = array())
    {
        // Populate styles array
        $styleTypes = array('font', 'paragraph', 'list', 'table');
        foreach ($styleTypes as $styleType) {
            if (!isset($styles[$styleType])) {
                $styles[$styleType] = array();
            }
        }
 
        // Node mapping table
        $nodes = array(
            //                   $method        $node   $element    $styles     $data   $argument1      $argument2
            'p'         => array('Paragraph',   $node,  $element,   $styles,    null,   null,           null),
            'h1'        => array('Heading',     null,   $element,   $styles,    null,   'Heading1',     null),
            'h2'        => array('Heading',     null,   $element,   $styles,    null,   'Heading2',     null),
            'h3'        => array('Heading',     null,   $element,   $styles,    null,   'Heading3',     null),
            'h4'        => array('Heading',     null,   $element,   $styles,    null,   'Heading4',     null),
            'h5'        => array('Heading',     null,   $element,   $styles,    null,   'Heading5',     null),
            'h6'        => array('Heading',     null,   $element,   $styles,    null,   'Heading6',     null),
            '#text'     => array('Text',        $node,  $element,   $styles,    null,    null,          null),
            'span'      => array('Span',        $node,  null,       $styles,    null,    null,          null), //to catch inline span style changes
            'strong'    => array('Property',    null,   null,       $styles,    null,   'bold',         true),
            'em'        => array('Property',    null,   null,       $styles,    null,   'italic',       true),
            'sup'       => array('Property',    null,   null,       $styles,    null,   'superScript',  true),
            'sub'       => array('Property',    null,   null,       $styles,    null,   'subScript',    true),
            'table'     => array('Table',       $node,  $element,   $styles,    null,   'addTable',     true),
            'tbody'     => array('Table',       $node,  $element,   $styles,    null,   'skipTBody',    true),
            'thead'     => array('Table',       $node,  $element,   $styles,    null,   'skipTHead',    true),
            'tr'        => array('Table',       $node,  $element,   $styles,    null,   'addRow',       true),
            'td'        => array('Table',       $node,  $element,   $styles,    null,   'addCell',      true),
            'th'        => array('Table',       $node,  $element,   $styles,    null,   'addCell',      true),
            'ul'        => array('List',        null,   null,       $styles,    $data,  3,              null),
            'ol'        => array('List',        null,   null,       $styles,    $data,  7,              null),
            'li'        => array('ListItem',    $node,  $element,   $styles,    $data,  null,           null),
            'img'       => array('Image',       $node,  $element,   $styles,    $data,  null,           null),
        );
 
        $newElement = null;
        $keys = array('node', 'element', 'styles', 'data', 'argument1', 'argument2');
 
        if (isset($nodes[$node->nodeName])) {
            // Execute method based on node mapping table and return $newElement or null
            // Arguments are passed by reference
            $arguments = array();
            $args = array();
            list($method, $args[0], $args[1], $args[2], $args[3], $args[4], $args[5]) = $nodes[$node->nodeName];
            for ($i = 0; $i <= 5; $i++) {
                if ($args[$i] !== null) {
                    $arguments[$keys[$i]] = &$args[$i];
                }
            }
            $method = "parse{$method}";
            $newElement = call_user_func_array(array(self::class, $method), $arguments);
 
            // Retrieve back variables from arguments
            foreach ($keys as $key) {
                if (array_key_exists($key, $arguments)) {
                    $$key = $arguments[$key];
                }
            }
        }
 
        if ($newElement === null) {
            $newElement = $element;
        }
 
        self::parseChildNodes($node, $newElement, $styles, $data);
    }
 
    /**
     * Parse child nodes.
     *
     * @param \DOMNode $node
     * @param \PhpOffice\PhpWord\Element\AbstractContainer $element
     * @param array $styles
     * @param array $data
     * @return void
     */
    private static function parseChildNodes($node, $element, $styles, $data)
    {
        if ($node->nodeName != 'li') {
            $cNodes = $node->childNodes;
            if (count($cNodes) > 0) {
                foreach ($cNodes as $cNode) {
                    // Added to get tables to work
                    $htmlContainers = array(
                        'thead',
                        'tbody',
                        'tr',
                        'td',
                        'th',
                    );
                    if (in_array($cNode->nodeName, $htmlContainers)) {
                        self::parseNode($cNode, $element, $styles, $data);
                    }
                    // All other containers as defined in AbstractContainer
                    if ($element instanceof AbstractContainer) {
                        self::parseNode($cNode, $element, $styles, $data);
                    }
                }
            }
        }
    }
 
    /**
     * Parse paragraph node
     *
     * @param \DOMNode $node
     * @param \PhpOffice\PhpWord\Element\AbstractContainer $element
     * @param array &$styles
     * @return \PhpOffice\PhpWord\Element\TextRun
     */
    private static function parseParagraph($node, $element, &$styles)
    {
        $styles['paragraph'] = self::parseInlineStyle($node, $styles['paragraph']);
        $newElement = $element->addTextRun($styles['paragraph']);
        echo "<pre>";
		print_r($newElement); 
		dd($newElement); 
        return $newElement;
    }
 
    /**
     * Parse heading node
     *
     * @param \PhpOffice\PhpWord\Element\AbstractContainer $element
     * @param array &$styles
     * @param string $argument1 Name of heading style
     * @return \PhpOffice\PhpWord\Element\TextRun
     *
     * @todo Think of a clever way of defining header styles, now it is only based on the assumption, that
     * Heading1 - Heading6 are already defined somewhere
     */
    private static function parseHeading($element, &$styles, $argument1)
    {
        $styles['paragraph'] = $argument1;
        $newElement = $element->addTextRun($styles['paragraph']);
 
        return $newElement;
    }
 
    /**
     * Parse text node
     *
     * @param \DOMNode $node
     * @param \PhpOffice\PhpWord\Element\AbstractContainer $element
     * @param array &$styles
     * @return null
     */
    private static function parseText($node, $element, &$styles)
    {
        $styles['font'] = self::parseInlineStyle($node, $styles['font']);
 
        // Commented as source of bug #257. `method_exists` doesn't seems to work properly in this case.
        // @todo Find better error checking for this one
        // if (method_exists($element, 'addText')) {
        $element->addText($node->nodeValue, $styles['font'], $styles['paragraph']);
        // }
 
        return null;
    }
 
    /**
     * Parse property node
     *
     * @param array &$styles
     * @param string $argument1 Style name
     * @param string $argument2 Style value
     * @return null
     */
    private static function parseProperty(&$styles, $argument1, $argument2)
    {
        $styles['font'][$argument1] = $argument2;
 
        return null;
    }
 
    /**
     * Parse table node
     *
     * @param \DOMNode $node
     * @param \PhpOffice\PhpWord\Element\AbstractContainer $element
     * @param array &$styles
     * @param string $argument1 Method name
     * @return \PhpOffice\PhpWord\Element\AbstractContainer $element
     *
     * @todo As soon as TableItem, RowItem and CellItem support relative width and height
     */
   private static function parseTable($node, $element, &$styles, $argument1)
    {
        switch ($argument1) {
            case 'addTable':                        
                $styles['paragraph'] = self::parseInlineStyle($node, $styles['paragraph']); 
                $newElement = $element->addTable('table', array('width' => 90));
                break;
            case 'skipTbody':                        
                $newElement = $element;
                break;
            case 'addRow':                        
                $newElement = $element->addRow();
                break;
            case 'addCell':                        
                $newElement = $element->addCell(1750);
                break;
        }

        // $attributes = $node->attributes;
        // if ($attributes->getNamedItem('width') !== null) {
            // $newElement->setWidth($attributes->getNamedItem('width')->value);
        // }

        // if ($attributes->getNamedItem('height') !== null) {
            // $newElement->setHeight($attributes->getNamedItem('height')->value);
        // }
        // if ($attributes->getNamedItem('width') !== null) {
            // $newElement=$element->addCell($width=$attributes->getNamedItem('width')->value);
        // }

        return $newElement;
    }
    
 
    /**
     * Parse image node
     *
     * @param \DOMNode $node
     * @param \PhpOffice\PhpWord\Element\AbstractContainer $element
     * @param array &$styles
     * @return \PhpOffice\PhpWord\Element\TextRun
     *
     **/
    private static function parseImage($node, $element, &$styles, $data)
    {
        $style = array();
        $src = null;
        foreach ($node->attributes as $attribute) {
            switch ($attribute->name) {
                case 'src':
                    $src = $attribute->value;
                    if (self::isBase64Image($src)) {
                        $src = self::createImage($src);
                    }
                    break;
                case 'width':
                    $width = $attribute->value;
                    $style['width'] = $width;
                    break;
                case 'height':
                    $height = $attribute->value;
                    $style['height'] = $height;
                    break;
                case 'style':
                    $styleAttr = explode(';', $attribute->value);
                    foreach ($styleAttr as $attr) {
                        if (strpos($attr, ':')) {
                            list($k, $v) = explode(':', $attr);
                            switch ($k) {
                                case 'float':
                                    if (trim($v) == 'right') {
                                        $style['hPos'] = \PhpOffice\PhpWord\Style\Image::POS_RIGHT;
                                        $style['hPosRelTo'] = \PhpOffice\PhpWord\Style\Image::POS_RELTO_PAGE;
                                        $style['pos'] = \PhpOffice\PhpWord\Style\Image::POS_RELATIVE;
                                        $style['wrap'] = \PhpOffice\PhpWord\Style\Image::WRAP_TIGHT;
                                        $style['overlap'] = true;
                                    }
                                    if (trim($v) == 'left') {
                                        $style['hPos'] = \PhpOffice\PhpWord\Style\Image::POS_LEFT;
                                        $style['hPosRelTo'] = \PhpOffice\PhpWord\Style\Image::POS_RELTO_PAGE;
                                        $style['pos'] = \PhpOffice\PhpWord\Style\Image::POS_RELATIVE;
                                        $style['wrap'] = \PhpOffice\PhpWord\Style\Image::WRAP_TIGHT;
                                        $style['overlap'] = true;
                                    }
                                    break;
                            }
                        }
                    }
                    break;
            }
        }
 
        if ($src) {
            $element->addImage($src, $style);
        }
 
        return null;
    }
 
    /**
     * Parse list node
     *
     * @param array &$styles
     * @param array &$data
     * @param string $argument1 List type
     * @return null
     */
    private static function parseList(&$styles, &$data, $argument1)
    {
        if (isset($data['listdepth'])) {
            $data['listdepth']++;
        } else {
            $data['listdepth'] = 0;
        }
        $styles['list']['listType'] = $argument1;
 
        return null;
    }
 
    /**
     * Parse list item node
     *
     * @param \DOMNode $node
     * @param \PhpOffice\PhpWord\Element\AbstractContainer $element
     * @param array &$styles
     * @param array $data
     * @return null
     *
     * @todo This function is almost the same like `parseChildNodes`. Merged?
     * @todo As soon as ListItem inherits from AbstractContainer or TextRun delete parsing part of childNodes
     */
    private static function parseListItem($node, $element, &$styles, $data)
    {
        $cNodes = $node->childNodes;
        if (count($cNodes) > 0) {
            $listRun = $element->addListItemRun($data['listdepth'], $styles['list'], $styles['paragraph']);
            foreach ($cNodes as $cNode) {
                self::parseNode($cNode, $listRun, $styles, $data);
            }
        }
 
        return null;
    }
 
    /**
     * Parse span
     *
     * Changes the inline style when a Span element is found.
     *
     * @param \DOMNode $node
     * @param array $styles
     * @return null
     */
    private static function parseSpan($node, &$styles)
    {
        $styles['font'] = self::parseInlineStyle($node, $styles['font']);
 
        return null;
    }
 
   /**
     * Parse style
     *
     * @param \DOMAttr $attribute
     * @param array $styles
     * @return array
     */
    private static function parseStyle($attribute, $styles)
    { 
        $properties = explode(';', trim($attribute->value, " \t\n\r\0\x0B;"));
        foreach ($properties as $property) {
            list($cKey, $cValue) = explode(':', $property, 2);
            $cValue = trim($cValue);
            switch (trim($cKey)) {
                case 'text-decoration':
                    switch ($cValue) {
                        case 'underline':
                            $styles['underline'] = 'single';
                            break;
                        case 'line-through':
                            $styles['strikethrough'] = true;
                            break;
                    }
                    break;
                case 'text-align':
                    $styles['alignment'] = $cValue; // todo: any mapping?
                    break;
                // added to handled inline Span style font size changes.
                case 'font-size':
                    $styles['size'] = substr($cValue, 0, -2); // substr used to remove the px from the html string size string
                    break;
                case 'font-family':
                    $names = array_map(function($v){
                        return trim($v, " '\"\t");
                    }, explode(',', $cValue));
 
                    $styles['name'] = current($names);
                    break;
                // added to handled inline Span color changes.
                case 'color':
                    $styles['color'] = trim($cValue, "#");
                    break;
                case 'background':
                    if (($colorPos = strpos($cValue, '#')) === false) {
                        break;
                    }
                    $cValue = substr($cValue, $colorPos);
                case 'background-color':
                    $styles['bgColor'] = trim($cValue, "#");
                    break;
                case 'border':
                    if (($colorPos = strpos($cValue, '#')) === false) {
                        break;
                    }
                    $cValue = substr($cValue, $colorPos);
                case 'border-color':
                    $borderColor = trim($cValue, "#");
                    $styles['borderTopColor'] = $borderColor;
                    $styles['borderRightColor'] = $borderColor;
                    $styles['borderBottomColor'] = $borderColor;
                    $styles['borderLeftColor'] = $borderColor;
                    break;
            }
        }
 
        return $styles;
    }
    

    /**
     * @param $src
     * @return int
     */
    private static function isBase64Image($src)
    {
        return preg_match('#data:image\/(.*?);base64,#', $src);
    }
 
    /**
     * @param $src
     * @return null|string
     */
    private static function createImage($src)
    {
        list($data, $base64) = explode(',', $src);
 
        $imageContent = base64_decode($base64);
 
        if ($imageContent === false) {
            return null;
        }
        $tempFilename = tempnam(sys_get_temp_dir(), uniqid('PHPWordImage_'));
        file_put_contents($tempFilename, $imageContent);
 
        return $tempFilename;
    }
}