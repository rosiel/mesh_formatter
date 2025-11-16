<?php

namespace Drupal\mesh_formatter\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Url;

/**
 * Plugin implementation of the 'Random_default' formatter.
 *
 * @FieldFormatter(
 *   id = "mesh_formatter",
 *   label = @Translation("MeSH Formatter"),
 *   field_types = {
 *     "string"
 *   }
 * )
 */
class MeshFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    foreach ($items as $delta => $item) {
      // Render each element as a link to NLM.
      $element[$delta] = [
        '#type' => 'link',
        '#title' => $item->value,
        '#url' => Url::fromUri('https://www.ncbi.nlm.nih.gov/mesh/', ['query' => ['term' => $item->value]]),
        '#attributes' => [
          'target' => '_blank'
        ]
      ];
    }

    return $element;
  }
}
