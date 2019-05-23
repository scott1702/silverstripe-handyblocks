# SilverStripe handy blocks

This module it used to provide a few handy blocks to get a project up and running with some useful functionality quickly

## How to use

### Picking blocks to use

By default, installing this module enables all of the blocks within the module. Certain blocks can be disabled via yml configuration if they are not necessary

```yaml
Page:
  disallowed_elements:
    - SilverStripe\HandyBlocks\CallToActionBlock
```

### Templates

This module provides a base template for each block. Partial caching is also applied to the template of each block. If you want to use a custom template or do not want partial caching at a block level, simply override the template to use your own

### CSS

This module also provides a css file for each block. If you want to use these, there are a few ways you can include these css files:

#### Requiring the main dist file

This is the recommended approach if you want get something up and running quick:

```php
// PageController.php

protected function init()
{
    Requirements::css('scott1702/silverstripe-handyblocks:client/dist/bundle.css');
}
```

#### Importing the main.scss file

This is a good way of pulling the css into your own build chain, as it results in only one css file and allows you to override any variables used to fit your project

```scss
// Your main.scss file in your project
@import 'variables'; // Import your own variables first to override handyblocks variables

@import '../vendor/scott1702/silverstripe-handyblocks/client/src/main';
```


#### Importing each block's scss file independently

```scss
// Your main.scss file in your project
@import 'variables'; // Your own variables/mixins will have to match the values used in each scss file

@import '../vendor/scott1702/silverstripe-handyblocks/client/src/blocks/cta-block';
```
