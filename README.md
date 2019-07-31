# [Sector](https://veronalabs.com/products/)
A WordPress Starter Theme

![Sector](https://veronalabs.com/wp-content/uploads/2018/12/sector-logo.png "Sector")

## Features

* SASS for stylesheets.
* PHP Namespace.
* Clean up `wp_head()`.
  * Remove unnecessary `<link>`'s.
  * Remove inline CSS and JS from WP emoji support.
  * Remove inline CSS used by Recent Comments widget.
  * Remove inline CSS used by posts with galleries.
  * Remove self-closing tag.
  * Remove the WordPress version from RSS feeds.
  * Clean up `language_attributes()` used in `<html>` tag.
  * Clean up output of stylesheet `<link>` tags.
  * Clean up output of `<script>` tags.
  * Add and remove `body_class()` classes.
  * Wrap embedded media as suggested by Readability.
  * Remove unnecessary self-closing tags.
  * Don't return the default description in the RSS feed if it hasn't been changed.
* A just right amount of lean, well-commented, modern, HTML5 templates.
* A helpful 404 template.
* A custom header implementation in `inc/custom-header.php` just add the code snippet found in the comments of `inc/custom-header.php` to your `header.php` template.
* Custom template tags in `inc/template-tags.php` that keep your templates clean and neat and prevent code duplication.
* Some small tweaks in `inc/template-functions.php` that can improve your theming experience.
* A script at `assets/js/navigation.js` that makes your menu a toggled dropdown on small screens (like your phone), ready for CSS artistry. It's enqueued in functions.php.
* 2 sample CSS layouts in `layouts/` for a sidebar on either side of your content. Note: .no-sidebar styles are not automatically loaded.
* Smartly organized starter CSS in style.css that will help you to quickly get your design off the ground.
* Full support for WooCommerce plugin integration with hooks in inc/woocommerce.php, styling override `assets/css/woocommerce.css` with product gallery features (zoom, swipe, lightbox) enabled.
* Licensed under GPLv2 or later. :) Use it to make something cool.


## Requirements

Make sure all dependencies have been installed before moving on:

* [WordPress](https://wordpress.org/) >= 4.7
* [PHP](https://secure.php.net/manual/en/install.php) >= 5.4
* [Node.js](http://nodejs.org/) >= 6.9.x
* [npm](https://www.npmjs.com/) >= 5.x

## Theme installation
First of all [download](https://github.com/veronalabs/sector/archive/master.zip) the latest version of Sector and extract that in `wp-conent/themes`.

### Theme branding
1. Change the folder name from `sector-master` to `your-theme-name`
2. Change the `SECTOR_DOMAIN_NAME` define in the `functions.php` for your language text domain name.
3. [Optional] You can change the namespace in the files.

### Compile the SASS
Then install the `node-sass` with below command:

```
npm install node-sass
```

To compile the SASS files, you should use the below command:

```
npm run scss
```


## Theme folder structure

```
sector
├── assets  
│   ├── css                 # → sas compiled path.
│   │   └── style.css
│   │   └── woocommerce.css
│   ├── js
│   └── sass                # → sass files.
├── inc
├── languages
├── layouts
└── template-parts                  
```

## Development
To start develop your own theme with sector, Follow steps below:
1. Open your command line
2. Go to your project folder ``` cd path/to/your/project ```
3. Run ``` npm install ```
4. Edit your proxy setting in Browser-Sync task in ```gulpfile.js```
5. Run ``` gulp ```


## Community

Keep track of development and community news.

* Follow [@veronalabs on Twitter](https://twitter.com/veronalabs)
* Subscribe to the [Veronalabs Newsletter](https://veronalabs.com/)
