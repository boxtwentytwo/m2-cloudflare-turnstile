<?php
namespace BoxTwentyTwo\CloudflareTurnstile\Block\Adminhtml\System\Config\Form\Field;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Notice extends Field
{
    public function render(AbstractElement $element)
    {
        $html = '<td colspan="4"><p class="' . $element->getId() . '_notice">' . '<strong>' . __('Please note:')
            . ' ' . '</strong>' . ' <span>' . __('You must have either have valid Cloudflare Turnstile keys or Google
            reCAPTCHA keys configured for the widgets to render correctly.') . '</span>' . '</p></td>';

        return $this->_decorateRowHtml($element, $html);
    }
}
