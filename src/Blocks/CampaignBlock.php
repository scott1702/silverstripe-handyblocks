<?php

namespace SilverStripe\HandyBlocks;

use SilverStripe\Assets\File;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Validator;
use Sheadawson\Linkable\Models\Link;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\ORM\FieldType\DBField;
use Sheadawson\Linkable\Forms\LinkField;
use DNADesign\Elemental\Models\BaseElement;

class CampaignBlock extends BaseElement
{
    /**
     * @var string
     */
    private static $table_name = 'CampaignBlock';

    /**
     * @var string
     */
    private static $singular_name = 'Campaign';

    /**
     * @var string
     */
    private static $plural_name = 'Campaign blocks';

    /**
     * @var string
     */
    private static $description = 'Campaign block';

    /**
     * @var bool
     */
    private static $inline_editable = false;

    /**
     * @var string
     */
    private static $icon = 'font-icon-block-banner';

    /**
     * @var string
     */
    private static $controller_template = 'HandyElementHolder';

    /**
     * @var array
     */
    private static $db = [
        'UppercaseTitle' => 'Varchar(50)',
        'SummaryText' => 'Text',
        'ImagePosition' => 'Enum(array("Left", "Right"), "Right")',
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'Image' => File::class,
        'ButtonLink' => Link::class,
        'SecondaryLink' => Link::class,
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Image',
    ];

    /**
     * @var array
     */
    private static $defaults = [
        'ShowTitle' => true,
    ];

    /**
     * @return FieldList $fields
     */
    public function getCMSFields(): FieldList
    {
        $fields = parent::getCMSFields();

        $fields->dataFieldByName('Image')
            ->setFolderName('CampaignImages')
            ->setDescription('We recommend to upload a png file.');

        $fields->addFieldsToTab(
            'Root.Main',
            [
                LinkField::create('ButtonLinkID', 'Button'),
                LinkField::create('SecondaryLinkID', 'Secondary Link'),
            ],
            'Logo'
        );

        $fields->addFieldsToTab(
            'Root.Settings',
            [
                OptionsetField::create(
                    'ImagePosition',
                    'Image Position',
                    $this->dbObject('ImagePosition')->enumValues()
                ),
            ]
        );

        return $fields;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->i18n_singular_name();
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return DBField::create_field('Text', $this->SummaryText)->Summary(20);
    }

    /**
     * Insert summary into block schema
     *
     * @return array
     */
    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->getSummary();
        return $blockSchema;
    }

    /**
     * @return RequiredFields
     */
    public function getCMSValidator(): Validator
    {
        return RequiredFields::create([
            'Title',
            'SummaryText',
        ]);
    }
}
