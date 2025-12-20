<?php

declare(strict_types=1);

namespace BoxTwentyTwo\CloudflareTurnstile\Block\Adminhtml\System\Config\Form\Field;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

/**
 * Class for Notice
 */
class Notice extends Field
{

  /**
   * Render text
   *
   * @param AbstractElement $element
   *
   * @return string
   */
  public function render(AbstractElement $element)
  {
    $html = '<td colspan="4"><p class="' . $element->getId() . '_notice">' . '<strong>' . __('Important:')
      . ' ' . '</strong>' . ' <span>' . __('Please note, for reCAPTCHA to be enabled, either have valid Cloudflare Turnstile keys or
         have valid Google reCAPTCHA keys') . '</span>' . '</p></td>';

    return $this->_decorateRowHtml($element, $html);
  }
}
