<?php

/**
 * @file field.tpl.php
 * Default template implementation to display the value of a field.
 *
 * This file is not used and is here as a starting point for customization only.
 * @see theme_field()
 *
 * Available variables:
 * - $items: An array of field values. Use render() to output them.
 * - $label: The item label.
 * - $label_hidden: Whether the label display is set to 'hidden'.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - field: The current template type, i.e., "theming hook".
 *   - field-name-[field_name]: The current field name. For example, if the
 *     field name is "field_description" it would result in
 *     "field-name-field-description".
 *   - field-type-[field_type]: The current field type. For example, if the
 *     field type is "text" it would result in "field-type-text".
 *   - field-label-[label_display]: The current label position. For example, if
 *     the label position is "above" it would result in "field-label-above".
 *
 * Other variables:
 * - $element['#object']: The entity to which the field is attached.
 * - $element['#view_mode']: View mode, e.g. 'full', 'teaser'...
 * - $element['#field_name']: The field name.
 * - $element['#field_type']: The field type.
 * - $element['#field_language']: The field language.
 * - $element['#field_translatable']: Whether the field is translatable or not.
 * - $element['#label_display']: Position of label display, inline, above, or
 *   hidden.
 * - $field_name_css: The css-compatible field name.
 * - $field_type_css: The css-compatible field type.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 *
 * @see template_preprocess_field()
 * @see theme_field()
 *
 * @ingroup themeable
 
 <?php if (!$label_hidden): ?>
    <div class="field-label"<?php print $title_attributes; ?>><?php print $label ?>:&nbsp;</div>
  <?php endif; ?>
  <div class="field-items"<?php print $content_attributes; ?>>
    <?php foreach ($items as $delta => $item): ?>
      <div class="field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>><?php print render($item); ?></div>
    <?php endforeach; ?>
  </div>
  
  
  <?php if (!$label_hidden): ?>
    <h2 class="field-label"<?php print $title_attributes; ?>><a name="<?php print $element['#field_name'] ?>"><?php print $label ?></a></h2>
  <?php endif; ?>
  <div<?php if(count($element['#items']) > 3) { print(' id="smoothdivscroll"'); } ?>>
    <?php 
    foreach($element['#items'] as $item) {
      $node = node_load($item['nid']);
      $title = $node->field_image['und'][0]['title'];
      $title .= ' - &copy; ' . $node->field_iptc_copyright_notice['und'][0]['safe_value'];
      $title .= ' &amp photographed by: ' . $node->field_iptc_by_line['und'][0]['safe_value'];
      print '<a title="' . $title . '" class="fancybox" href="' . image_style_url('extra_large', $node->field_image['und'][0]['uri']) . '" data-fancybox-group="gallery"><img src="' . image_style_url('medium', $node->field_image['und'][0]['uri']) . '" alt="' . $node->field_image['und'][0]['alt'] . '" title="' . $title . '"></a>';
    }
    ?>
  
 */
?>

<?php 
    // Unfortunately we have to phpifhy this whole thing, above is what we had previously.
    $map_src = '/sites/default/files/seakey-map-data/img/' . $element['#object']->nid . '.jpg';                
    $map_exists = file_exists(getcwd() . str_replace('/', '\\', $map_src));
    $output = '';

    if($map_exists) {
        $output .= '<div class="row"><div class="col-sm-9" id="smallsmoothdivscrollwrapper">';
    }

    $output .= '<div class="' . $classes . '"' . $attributes . '>';

    if(!$label_hidden) {
        $output .= '<h2 class="field-label"' . $title_attributes . '><a name="' . $element['#field_name'] . '">' . $label . '</a></h2>';
    }
    $output .= '<div';
    if(count($element['#items']) > 3) { 
        $output .= ' id="smoothdivscroll"'; 
    }
    $output .= '>';

    foreach($element['#items'] as $item) {
      $node = node_load($item['nid']);
      $title = $node->field_image['und'][0]['title'];
      $title .= ' - &copy; ' . $node->field_iptc_copyright_notice['und'][0]['safe_value'];
      $title .= ' &amp photographed by: ' . $node->field_iptc_by_line['und'][0]['safe_value'];
      $output .= '<a title="' . $title . '" class="fancybox" href="' . image_style_url('extra_large', $node->field_image['und'][0]['uri']) . '" data-fancybox-group="gallery"><img src="' . image_style_url('medium', $node->field_image['und'][0]['uri']) . '" alt="' . $node->field_image['und'][0]['alt'] . '" title="' . $title . '"></a>';
    }

    $output .= '</div></div>';

    if($map_exists) {
        $output .= '</div><div class="col-sm-3" id="map"><h2 class="field-label"><a name="field_map">Map</a></h2><a title="Distribution map. Right click and click save image to download" href="' . $map_src .'" class="fancybox"><img src="' . $map_src . '"></a></div></div>';
    }

    print $output;
?>
