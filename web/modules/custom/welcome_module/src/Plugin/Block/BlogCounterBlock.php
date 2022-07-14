<?php

namespace Drupal\welcome_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Provides a block to display the page title.
 *
 * @Block(
 *   id = "blog_counter",
 *   admin_label = @Translation("Blog counter"),
 * )
 */


class BlogCounterBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */

  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    foreach ($terms as $term) {
      $options[$term->id()] = $term->label();
    }

    $form['hello_block_name'] = [
      '#type' => 'select',
      '#title' => $this->t('Blog post type'),
      '#options' => ['3'=>'term1','4'=>'term2'],
      '#description' => $this->t('Choose one'),
      '#default_value' => $config['hello_block_name'] ?? '',
    ];

    return $form;
  }
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['hello_block_name'] = $values['hello_block_name'];
  }

  public function build() {
    $nids = \Drupal::entityQuery('node')
      ->condition('type', 'blog_post')
      ->condition('field_blog_post_type', $this->configuration['hello_block_name'])
      ->execute();
    return [
      '#type' => 'markup',
      '#markup' => count($nids),
    ];
  }



}
