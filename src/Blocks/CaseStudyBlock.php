<?php

namespace SilverStripe\HandyBlocks;

use DNADesign\Elemental\Models\BaseElement;
use Sheadawson\Linkable\Forms\LinkField;
use Sheadawson\Linkable\Models\Link;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\ORM\FieldType\DBField;

class CaseStudyBlock extends BaseElement
{
    /**
     * @var string
     */
    private static $table_name = 'CaseStudyBlock';

    /**
     * @var string
     */
    private static $singular_name = 'Case study';

    /**
     * @var string
     */
    private static $plural_name = 'Case study blocks';

    /**
     * @var string
     */
    private static $description = 'Case study block';

    /**
     * @var bool
     */
    private static $inline_editable = false;

    /**
     * @var array
     */
    private static $db = [
        'Intro' => 'Text',
        'ImagePosition' => 'Enum(array("Left", "Right"), "Right")',
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'Logo' => Image::class,
        'Image' => Image::class,
        'CaseStudyLink' => Link::class,
        'SecondaryLink' => Link::class,
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Logo',
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

        $fields->dataFieldByName('Image')->setFolderName('CaseStudyImages');
        $fields->dataFieldByName('Logo')->setFolderName('CaseStudyImages');

        $fields->addFieldsToTab(
            'Root.Main',
            [
                LinkField::create('CaseStudyLinkID', 'Link'),
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
        return static::$singular_name;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return DBField::create_field('Text', $this->Intro)->Summary(20);
    }

    /**
     * Insert summary into block schema
     */
    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->getSummary();
        return $blockSchema;
    }
}
