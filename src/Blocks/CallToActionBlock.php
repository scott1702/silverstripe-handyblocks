<?php

namespace SilverStripe\HandyBlocks;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Validator;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TreeDropdownField;
use DNADesign\Elemental\Models\BaseElement;

class CallToActionBlock extends BaseElement
{
    /**
     * @var string
     */
    private static $icon = 'font-icon-rocket';

    /**
     * @var string
     */
    private static $table_name = 'CallToActionBlock';

    /**
     * @var string
     */
    private static $singular_name = 'CTA Block';

    /**
     * @var string
     */
    private static $plural_name = 'CTA Blocks';

    /**
     * @var string
     */
    private static $description = 'CTA Block';

    private static $db = [
        'LinkContent' => 'Varchar(255)',
    ];

    private static $has_one = [
        'LinkedPage' => SiteTree::class,
    ];

    public function getCMSFields(): FieldList
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('ShowTitle');
        $fields->fieldByName('Root.Main.Title')->setTitle('Title');

        $fields->addFieldToTab('Root.Main', TreeDropdownField::create(
            'LinkedPageID',
            'Page to link to',
            SiteTree::class
        ), 'Title');

        // Add additional space to provide better experience for TreeDropdownField
        $fields->addFieldToTab('Root.Main', LiteralField::create(
            'ExtraSpace',
            '<div style="margin-bottom: 40px;"></div>'
        ));

        return $fields;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return static::$singular_name;
    }

    public function getCMSValidator(): Validator
    {
        return RequiredFields::create([
            'Title',
            'LinkedPageID',
            'LinkContent',
        ]);
    }
}
