<?php

namespace Drupal\welcome_module\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;
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
        /** @var File $file */
        $file = $node->field_image->entity;
        /** @var \Drupal\Core\Field\FieldItemList $field */
        $field = $node->get('title');

        $node->get('field_blog_post_type')->get(0)->entity;
        foreach ($node->get('field_blog_post_type') as $item) {
//          dump($item->entity);
        }
//        dump($field->getString());
        //die;
        $element[$delta] = ['#theme' => 'movie_card',
          '#title' => $node->get('title')->value,
          '#description' => $node->get('body')->getValue()[0]["value"],
          '#image' => ImageStyle::load('large')->buildUrl($node->field_image->entity->getFileUri()),
          '#date' => date("Y/m/d")];
      }
      else
        $element[$delta] = ['#markup' => "Random"];

    }

    return $element;
  }

}
