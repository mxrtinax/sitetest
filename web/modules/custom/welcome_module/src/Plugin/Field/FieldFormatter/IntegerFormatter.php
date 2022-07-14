<?php

namespace Drupal\welcome_module\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\node\Entity\Node;


/**
 * Plugin implementation of the 'IntegerFormatter' formatter.
 *
 * @FieldFormatter(
 *   id = "field_id_blogpost_asemanator",
 *   label = @Translation("Id blogpost"),
 *   field_types = {
 *     "integer"
 *   }
 * )
 */
class IntegerFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t('Displays the random string.');
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];
    foreach ($items as $delta => $item) {
      $node = Node::load($item->value);
      // Render each element as markup.
      if ($node){
        $element[$delta] = ['#markup' => $node->getTitle()];
      }
      else
        $element[$delta] = ['#markup' => "Random"];

    }

    return $element;
  }

}
