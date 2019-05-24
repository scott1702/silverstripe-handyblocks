<?php

namespace SilverStripe\HandyBlocks;

use SilverStripe\Forms\FieldList;
use SilverStripe\HandyBlocks\Model\Logo;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;

class LogoBlock extends BaseElement
{
    /**
     * @var string
     */
    private static $icon = 'font-icon-dot-3';

    /**
     * @var string
     */
    private static $table_name = 'LogoBlock';

    /**
     * @var string
     */
    private static $singular_name = 'Logo roll';

    /**
     * @var string
     */
    private static $plural_name = 'Logo rolls';

    /**
     * @var string
     */
    private static $description = 'Block for displaying different client logos in a row';

    /**
     * @var bool
     */
    private static $inline_editable = false;

    /**
     * @var string
     */
    private static $controller_template = 'HandyElementHolder';

    /**
     * @var array
     */
    private static $has_many = [
        'Logos' => Logo::class,
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Logos',
    ];

    /**
     * @return FieldList $fields
     */
    public function getCMSFields(): FieldList
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Logos');

        $fields->addFieldsToTab(
            'Root.Main',
            [
                GridField::create(
                    'Logos',
                    'Logos',
                    $this->Logos(),
                    $config = GridFieldConfig_RecordEditor::create()
                )
            ]
        );

        $config->addComponent(GridFieldOrderableRows::create());

        // Limit Logos to 5 per block
        if ($this->Logos()->count() >= 5) {
            $config->removeComponentsByType(GridFieldAddNewButton::class);
            $config->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
        }

        return $fields;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->singular_name();
    }
}
