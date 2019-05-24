<?php

namespace SilverStripe\HandyBlocks\Model;

use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;
use Sheadawson\Linkable\Models\Link;
use SilverStripe\Security\Permission;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\HandyBlocks\LogoBlock;
use Sheadawson\Linkable\Forms\LinkField;

class Logo extends DataObject
{
    /**
     * @var string
     */
    private static $table_name = 'Logo';

    /**
     * @var array
     */
    private static $db = [
        'Sort' => 'Int',
        'Title' => 'Varchar(255)',
    ];

    private static $has_one = [
        'Parent' => LogoBlock::class,
        'Link' => Link::class,
        'Image' => Image::class,
    ];

    private static $owns = [
        'Image',
    ];

    private static $default_sort = 'Sort';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['Sort', 'ParentID']);
        $fields->addFieldToTab('Root.Main', LinkField::create('LinkID', 'Link'));
        $fields->dataFieldByName('Image')
            ->setFolderName('Logos');

        return $fields;
    }

    public function getCMSValidator()
    {
        return RequiredFields::create([
            'Title',
            'Image',
        ]);
    }

    protected function onBeforeWrite()
    {
        if (!$this->Sort) {
            $this->Sort = Logo::get()->max('Sort') + 1;
        }

        parent::onBeforeWrite();
    }

    /**
     * {@inheritdoc}
     */
    public function canCreate($member = null, $context = [])
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    /**
     * {@inheritdoc}
     */
    public function canEdit($member = null)
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    /**
     * {@inheritdoc}
     */
    public function canDelete($member = null)
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    /**
     * {@inheritdoc}
     */
    public function canView($member = null)
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }
}
