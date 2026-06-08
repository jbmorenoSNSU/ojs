<?php
/**
 * @file classes/components/form/site/PKPSiteInformationForm.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class PKPSiteInformationForm
 *
 * @ingroup classes_controllers_form
 *
 * @brief A preset form for the site information settings.
 */

namespace PKP\components\forms\site;

use PKP\components\forms\FieldRichTextarea;
use PKP\components\forms\FieldText;
use PKP\components\forms\FormComponent;

class PKPSiteInformationForm extends FormComponent
{
    public const FORM_SITE_INFO = 'siteInfo';
    public $id = self::FORM_SITE_INFO;
    public $method = 'PUT';

    /**
     * Constructor
     *
     * @param string $action URL to submit the form to
     * @param array $locales Supported locales
     * @param \PKP\site\Site $site
     */
    public function __construct($action, $locales, $site)
    {
        $this->action = $action;
        $this->locales = $locales;

        $this->addField(new FieldRichTextarea('about', [
            'label' => __('admin.settings.about'),
            'isMultilingual' => true,
            'value' => $site->getData('about'),
            'toolbar' => 'bold italic superscript subscript | link | blockquote bullist numlist | image | code',
            'plugins' => ['link', 'lists', 'image', 'code'],
            'init' => [
                'extended_valid_elements' => 'div[class|id|style],h2[class|id|style],h3[class|id|style],h4[class|id|style],span[class|id|style],ul[class],li[class],p[class|style]',
            ],
        ]))
            ->addField(new FieldText('contactName', [
                'label' => __('admin.settings.contactName'),
                'isRequired' => true,
                'isMultilingual' => true,
                'value' => $site->getData('contactName'),
            ]))
            ->addField(new FieldText('contactEmail', [
                'label' => __('admin.settings.contactEmail'),
                'isRequired' => true,
                'isMultilingual' => true,
                'value' => $site->getData('contactEmail'),
            ]))
            ->addField(new FieldRichTextarea('privacyStatement', [
                'label' => __('manager.setup.privacyStatement'),
                'description' => __('manager.setup.privacyStatement.description'),
                'isMultilingual' => true,
                'value' => $site->getData('privacyStatement'),
            ]));
    }
}
