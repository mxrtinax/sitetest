<?php

namespace Drupal\welcome_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
use Drupal\taxonomy\Entity\Term;

class BlogPostForm extends FormBase {
  /**
   * Returns a unique string identifying the form.
   *
   * The returned ID should be a unique string that can be a valid PHP function
   * name, since it's used in hook implementation names such as
   * hook_form_FORM_ID_alter().
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'welcome_module_BlogPostForm';
  }
  /**
   * Form constructor.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   The form structure.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $vids = \Drupal::entityQuery('taxonomy_term') //verificam daca termenul exista deja in vocabular
    ->condition('vid', 'types')
      ->execute();
    $terms = Term::loadMultiple($vids);
    $items = [];
    foreach ($terms as $term){
      $items[$term->id()] = $term -> label();
    }

//    title (textfield)
//    description (textarea)
//    blog post type (select cu toate tipurile de blog post type)
//    image (widget de upload de fisiere)
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Blog post title'),
      '#description' => $this->t('Enter the title of the blog post.'),
      '#required' => TRUE,
    ];
    $form['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Description'),
      '#description' => $this->t('Enter the content of your blog post.'),
      '#required' => TRUE,
    ];
    $form['type'] = [
      '#type' => 'select',
      '#title' => $this->t('Blog post type'),
      '#description' => $this->t('Enter the type of your blog post.'),
      '#options' => $items,
      '#multiple' => TRUE,
      '#required' => TRUE,
    ];
//    $form['accept'] = array(
//      '#type' => 'checkbox',
//      '#title' => $this
//        ->t('I accept the terms of use of the site'),
//      '#description' => $this->t('Please read and accept the terms of use'),
//    );


    // Group submit handlers in an actions element with a key of "actions" so
    // that it gets styled correctly, and so that other modules may add actions
    // to the form. This is not required, but is convention.
    $form['actions'] = [
      '#type' => 'actions',
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;

  }

  /**
   * Validate the title and the checkbox of the form
   *
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    // Display the results.

    // Call the Static Service Container wrapper
    // We should inject the messenger service, but its beyond the scope of this example.
    $title = $form_state->getValue('title');
    $description = $form_state->getValue('description');
    $node = Node::create([
      'type'        => 'blog_post',
      'title'       => $title,
      'body'        => $description,
      'field_blog_post_type' => $form_state->getValue('type'),

      //'field_image' => $file
    ]);
    //dump($form_state->getValue('types'));
    $node->save();
    $messenger = \Drupal::messenger();
    $messenger->addMessage('Title: '.$form_state->getValue('title'));
    $messenger->addMessage('Accept: '.$form_state->getValue('accept'));

    // Redirect to home
    $form_state->setRedirect('welcome_module.welcome');

  }

}
