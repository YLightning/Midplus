<?php
// This file is part of Ranking block for Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Theme mcc block settings file
 *
 * @package    theme_mcc
 * @copyright  2017 Willian Mano - http://conecti.me
 * @copyright  2020 HSO
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// This is used for performance, we don't need to know about these settings on every page in Moodle, only when
// we are looking at the admin settings pages.
if ($ADMIN->fulltree) {

    // Boost provides a nice setting page which splits settings onto separate tabs. We want to use it here.
    $settings = new theme_boost_admin_settingspage_tabs('themesettingmcc', get_string('configtitle', 'theme_mcc'));

    /*
    * ----------------------
    * General settings tab
    * ----------------------
    */
    $page = new admin_settingpage('theme_mcc_general', get_string('generalsettings', 'theme_mcc'));

    // Logo file setting.
    $name = 'theme_mcc/logo';
    $title = get_string('logo', 'theme_mcc');
    $description = get_string('logodesc', 'theme_mcc');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Favicon setting.
    $name = 'theme_mcc/favicon';
    $title = get_string('favicon', 'theme_mcc');
    $description = get_string('favicondesc', 'theme_mcc');
    $opts = array('accepted_types' => array('.ico'), 'maxfiles' => 1);
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'favicon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset.
    $name = 'theme_mcc/preset';
    $title = get_string('preset', 'theme_mcc');
    $description = get_string('preset_desc', 'theme_mcc');
    $default = 'default.scss';

    $context = context_system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_mcc', 'preset', 0, 'itemid, filepath, filename', false);

    $choices = [];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }
    // These are the built in presets.
    $choices['default.scss'] = 'default.scss';
    $choices['plain.scss'] = 'plain.scss';

    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset files setting.
    $name = 'theme_mcc/presetfiles';
    $title = get_string('presetfiles', 'theme_mcc');
    $description = get_string('presetfiles_desc', 'theme_mcc');

    $setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
        array('maxfiles' => 20, 'accepted_types' => array('.scss')));
    $page->add($setting);

    // Login page background image.
    $name = 'theme_mcc/loginbgimg';
    $title = get_string('loginbgimg', 'theme_mcc');
    $description = get_string('loginbgimg_desc', 'theme_mcc');
    $opts = array('accepted_types' => array('.png', '.jpg', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbgimg', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $brand-color.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_mcc/brandcolor';
    $title = get_string('brandcolor', 'theme_mcc');
    $description = get_string('brandcolor_desc', 'theme_mcc');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $navbar-header-color.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_mcc/navbarheadercolor';
    $title = get_string('navbarheadercolor', 'theme_mcc');
    $description = get_string('navbarheadercolor_desc', 'theme_mcc');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $navbar-bg.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_mcc/navbarbg';
    $title = get_string('navbarbg', 'theme_mcc');
    $description = get_string('navbarbg_desc', 'theme_mcc');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $navbar-bg-hover.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_mcc/navbarbghover';
    $title = get_string('navbarbghover', 'theme_mcc');
    $description = get_string('navbarbghover_desc', 'theme_mcc');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Course format option.
    $name = 'theme_mcc/coursepresentation';
    $title = get_string('coursepresentation', 'theme_mcc');
    $description = get_string('coursepresentationdesc', 'theme_mcc');
    $options = [];
    $options[1] = get_string('coursedefault', 'theme_mcc');
    $options[2] = get_string('coursecover', 'theme_mcc');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_mcc/courselistview';
    $title = get_string('courselistview', 'theme_mcc');
    $description = get_string('courselistviewdesc', 'theme_mcc');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    // Must add the page after definiting all the settings!
    $settings->add($page);

    /*
    * ----------------------
    * Advanced settings tab
    * ----------------------
    */
    $page = new admin_settingpage('theme_mcc_advanced', get_string('advancedsettings', 'theme_mcc'));

    // Raw SCSS to include before the content.
    $setting = new admin_setting_scsscode('theme_mcc/scsspre',
        get_string('rawscsspre', 'theme_mcc'), get_string('rawscsspre_desc', 'theme_mcc'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw SCSS to include after the content.
    $setting = new admin_setting_scsscode('theme_mcc/scss', get_string('rawscss', 'theme_mcc'),
        get_string('rawscss_desc', 'theme_mcc'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Google analytics block.
    $name = 'theme_mcc/googleanalytics';
    $title = get_string('googleanalytics', 'theme_mcc');
    $description = get_string('googleanalyticsdesc', 'theme_mcc');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    /*
    * -----------------------
    * Frontpage settings tab
    * -----------------------
    */
    $page = new admin_settingpage('theme_mcc_frontpage', get_string('frontpagesettings', 'theme_mcc'));

    // Headerimg file setting.
    $name = 'theme_mcc/headerimg';
    $title = get_string('headerimg', 'theme_mcc');
    $description = get_string('headerimgdesc', 'theme_mcc');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'headerimg', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Bannerheading.
    $name = 'theme_mcc/bannerheading';
    $title = get_string('bannerheading', 'theme_mcc');
    $description = get_string('bannerheadingdesc', 'theme_mcc');
    $default = 'Perfect Learning System';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Bannercontent.
    $name = 'theme_mcc/bannercontent';
    $title = get_string('bannercontent', 'theme_mcc');
    $description = get_string('bannercontentdesc', 'theme_mcc');
    $default = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_mcc/displaymarketingbox';
    $title = get_string('displaymarketingbox', 'theme_mcc');
    $description = get_string('displaymarketingboxdesc', 'theme_mcc');
    $default = 1;
    $choices = array(0 => 'No', 1 => 'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $page->add($setting);

    // Marketing1icon.
    $name = 'theme_mcc/marketing1icon';
    $title = get_string('marketing1icon', 'theme_mcc');
    $description = get_string('marketing1icondesc', 'theme_mcc');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing1icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1heading.
    $name = 'theme_mcc/marketing1heading';
    $title = get_string('marketing1heading', 'theme_mcc');
    $description = get_string('marketing1headingdesc', 'theme_mcc');
    $default = 'We host';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1subheading.
    $name = 'theme_mcc/marketing1subheading';
    $title = get_string('marketing1subheading', 'theme_mcc');
    $description = get_string('marketing1subheadingdesc', 'theme_mcc');
    $default = 'your MOODLE';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1content.
    $name = 'theme_mcc/marketing1content';
    $title = get_string('marketing1content', 'theme_mcc');
    $description = get_string('marketing1contentdesc', 'theme_mcc');
    $default = 'Moodle hosting in a powerful cloud infrastructure';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1url.
    $name = 'theme_mcc/marketing1url';
    $title = get_string('marketing1url', 'theme_mcc');
    $description = get_string('marketing1urldesc', 'theme_mcc');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2icon.
    $name = 'theme_mcc/marketing2icon';
    $title = get_string('marketing2icon', 'theme_mcc');
    $description = get_string('marketing2icondesc', 'theme_mcc');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing2icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2heading.
    $name = 'theme_mcc/marketing2heading';
    $title = get_string('marketing2heading', 'theme_mcc');
    $description = get_string('marketing2headingdesc', 'theme_mcc');
    $default = 'Consulting';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2subheading.
    $name = 'theme_mcc/marketing2subheading';
    $title = get_string('marketing2subheading', 'theme_mcc');
    $description = get_string('marketing2subheadingdesc', 'theme_mcc');
    $default = 'for your company';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2content.
    $name = 'theme_mcc/marketing2content';
    $title = get_string('marketing2content', 'theme_mcc');
    $description = get_string('marketing2contentdesc', 'theme_mcc');
    $default = 'Moodle consulting and training for you';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2url.
    $name = 'theme_mcc/marketing2url';
    $title = get_string('marketing2url', 'theme_mcc');
    $description = get_string('marketing2urldesc', 'theme_mcc');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3icon.
    $name = 'theme_mcc/marketing3icon';
    $title = get_string('marketing3icon', 'theme_mcc');
    $description = get_string('marketing3icondesc', 'theme_mcc');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing3icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3heading.
    $name = 'theme_mcc/marketing3heading';
    $title = get_string('marketing3heading', 'theme_mcc');
    $description = get_string('marketing3headingdesc', 'theme_mcc');
    $default = 'Development';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3subheading.
    $name = 'theme_mcc/marketing3subheading';
    $title = get_string('marketing3subheading', 'theme_mcc');
    $description = get_string('marketing3subheadingdesc', 'theme_mcc');
    $default = 'themes and plugins';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3content.
    $name = 'theme_mcc/marketing3content';
    $title = get_string('marketing3content', 'theme_mcc');
    $description = get_string('marketing3contentdesc', 'theme_mcc');
    $default = 'We develop themes and plugins as your desires';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3url.
    $name = 'theme_mcc/marketing3url';
    $title = get_string('marketing3url', 'theme_mcc');
    $description = get_string('marketing3urldesc', 'theme_mcc');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4icon.
    $name = 'theme_mcc/marketing4icon';
    $title = get_string('marketing4icon', 'theme_mcc');
    $description = get_string('marketing4icondesc', 'theme_mcc');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing4icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4heading.
    $name = 'theme_mcc/marketing4heading';
    $title = get_string('marketing4heading', 'theme_mcc');
    $description = get_string('marketing4headingdesc', 'theme_mcc');
    $default = 'Support';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4subheading.
    $name = 'theme_mcc/marketing4subheading';
    $title = get_string('marketing4subheading', 'theme_mcc');
    $description = get_string('marketing4subheadingdesc', 'theme_mcc');
    $default = 'we give you answers';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4content.
    $name = 'theme_mcc/marketing4content';
    $title = get_string('marketing4content', 'theme_mcc');
    $description = get_string('marketing4contentdesc', 'theme_mcc');
    $default = 'MOODLE specialized support';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4url.
    $name = 'theme_mcc/marketing4url';
    $title = get_string('marketing4url', 'theme_mcc');
    $description = get_string('marketing4urldesc', 'theme_mcc');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Enable or disable Slideshow settings.
    $name = 'theme_mcc/sliderenabled';
    $title = get_string('sliderenabled', 'theme_mcc');
    $description = get_string('sliderenableddesc', 'theme_mcc');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    // Enable slideshow on frontpage guest page.
    $name = 'theme_mcc/sliderfrontpage';
    $title = get_string('sliderfrontpage', 'theme_mcc');
    $description = get_string('sliderfrontpagedesc', 'theme_mcc');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_mcc/slidercount';
    $title = get_string('slidercount', 'theme_mcc');
    $description = get_string('slidercountdesc', 'theme_mcc');
    $default = 1;
    $options = array();
    for ($i = 0; $i < 13; $i++) {
        $options[$i] = $i;
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // If we don't have an slide yet, default to the preset.
    $slidercount = get_config('theme_mcc', 'slidercount');

    if (!$slidercount) {
        $slidercount = 1;
    }

    for ($sliderindex = 1; $sliderindex <= $slidercount; $sliderindex++) {
        $fileid = 'sliderimage' . $sliderindex;
        $name = 'theme_mcc/sliderimage' . $sliderindex;
        $title = get_string('sliderimage', 'theme_mcc');
        $description = get_string('sliderimagedesc', 'theme_mcc');
        $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
        $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $opts);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);

        $name = 'theme_mcc/slidertitle' . $sliderindex;
        $title = get_string('slidertitle', 'theme_mcc');
        $description = get_string('slidertitledesc', 'theme_mcc');
        $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_TEXT);
        $page->add($setting);

        $name = 'theme_mcc/slidercap' . $sliderindex;
        $title = get_string('slidercaption', 'theme_mcc');
        $description = get_string('slidercaptiondesc', 'theme_mcc');
        $default = '';
        $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
        $page->add($setting);
    }

    // Enable or disable Slideshow settings.
    $name = 'theme_mcc/numbersfrontpage';
    $title = get_string('numbersfrontpage', 'theme_mcc');
    $description = get_string('numbersfrontpagedesc', 'theme_mcc');
    $default = 1;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    // Enable sponsors on frontpage guest page.
    $name = 'theme_mcc/sponsorsfrontpage';
    $title = get_string('sponsorsfrontpage', 'theme_mcc');
    $description = get_string('sponsorsfrontpagedesc', 'theme_mcc');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_mcc/sponsorstitle';
    $title = get_string('sponsorstitle', 'theme_mcc');
    $description = get_string('sponsorstitledesc', 'theme_mcc');
    $default = get_string('sponsorstitledefault', 'theme_mcc');
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_mcc/sponsorssubtitle';
    $title = get_string('sponsorssubtitle', 'theme_mcc');
    $description = get_string('sponsorssubtitledesc', 'theme_mcc');
    $default = get_string('sponsorssubtitledefault', 'theme_mcc');
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_mcc/sponsorscount';
    $title = get_string('sponsorscount', 'theme_mcc');
    $description = get_string('sponsorscountdesc', 'theme_mcc');
    $default = 1;
    $options = array();
    for ($i = 0; $i < 5; $i++) {
        $options[$i] = $i;
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // If we don't have an slide yet, default to the preset.
    $sponsorscount = get_config('theme_mcc', 'sponsorscount');

    if (!$sponsorscount) {
        $sponsorscount = 1;
    }

    for ($sponsorsindex = 1; $sponsorsindex <= $sponsorscount; $sponsorsindex++) {
        $fileid = 'sponsorsimage' . $sponsorsindex;
        $name = 'theme_mcc/sponsorsimage' . $sponsorsindex;
        $title = get_string('sponsorsimage', 'theme_mcc');
        $description = get_string('sponsorsimagedesc', 'theme_mcc');
        $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
        $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $opts);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);

        $name = 'theme_mcc/sponsorsurl' . $sponsorsindex;
        $title = get_string('sponsorsurl', 'theme_mcc');
        $description = get_string('sponsorsurldesc', 'theme_mcc');
        $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_TEXT);
        $page->add($setting);
    }

    // Enable clients on frontpage guest page.
    $name = 'theme_mcc/clientsfrontpage';
    $title = get_string('clientsfrontpage', 'theme_mcc');
    $description = get_string('clientsfrontpagedesc', 'theme_mcc');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_mcc/clientstitle';
    $title = get_string('clientstitle', 'theme_mcc');
    $description = get_string('clientstitledesc', 'theme_mcc');
    $default = get_string('clientstitledefault', 'theme_mcc');
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_mcc/clientssubtitle';
    $title = get_string('clientssubtitle', 'theme_mcc');
    $description = get_string('clientssubtitledesc', 'theme_mcc');
    $default = get_string('clientssubtitledefault', 'theme_mcc');
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_mcc/clientscount';
    $title = get_string('clientscount', 'theme_mcc');
    $description = get_string('clientscountdesc', 'theme_mcc');
    $default = 1;
    $options = array();
    for ($i = 0; $i < 5; $i++) {
        $options[$i] = $i;
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // If we don't have an slide yet, default to the preset.
    $clientscount = get_config('theme_mcc', 'clientscount');

    if (!$clientscount) {
        $clientscount = 1;
    }

    for ($clientsindex = 1; $clientsindex <= $clientscount; $clientsindex++) {
        $fileid = 'clientsimage' . $clientsindex;
        $name = 'theme_mcc/clientsimage' . $clientsindex;
        $title = get_string('clientsimage', 'theme_mcc');
        $description = get_string('clientsimagedesc', 'theme_mcc');
        $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
        $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $opts);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);

        $name = 'theme_mcc/clientsurl' . $clientsindex;
        $title = get_string('clientsurl', 'theme_mcc');
        $description = get_string('clientsurldesc', 'theme_mcc');
        $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_TEXT);
        $page->add($setting);
    }

    $settings->add($page);

    /*
    * --------------------
    * Footer settings tab
    * --------------------
    */
    $page = new admin_settingpage('theme_mcc_footer', get_string('footersettings', 'theme_mcc'));

    $name = 'theme_mcc/getintouchcontent';
    $title = get_string('getintouchcontent', 'theme_mcc');
    $description = get_string('getintouchcontentdesc', 'theme_mcc');
    $default = 'Conecti.me';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Website.
    $name = 'theme_mcc/website';
    $title = get_string('website', 'theme_mcc');
    $description = get_string('websitedesc', 'theme_mcc');
    $default = 'http://conecti.me';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Mobile.
    $name = 'theme_mcc/mobile';
    $title = get_string('mobile', 'theme_mcc');
    $description = get_string('mobiledesc', 'theme_mcc');
    $default = 'Mobile : +55 (98) 00123-45678';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Mail.
    $name = 'theme_mcc/mail';
    $title = get_string('mail', 'theme_mcc');
    $description = get_string('maildesc', 'theme_mcc');
    $default = 'willianmano@conecti.me';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Facebook url setting.
    $name = 'theme_mcc/facebook';
    $title = get_string('facebook', 'theme_mcc');
    $description = get_string('facebookdesc', 'theme_mcc');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Twitter url setting.
    $name = 'theme_mcc/twitter';
    $title = get_string('twitter', 'theme_mcc');
    $description = get_string('twitterdesc', 'theme_mcc');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Googleplus url setting.
    $name = 'theme_mcc/googleplus';
    $title = get_string('googleplus', 'theme_mcc');
    $description = get_string('googleplusdesc', 'theme_mcc');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Linkdin url setting.
    $name = 'theme_mcc/linkedin';
    $title = get_string('linkedin', 'theme_mcc');
    $description = get_string('linkedindesc', 'theme_mcc');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Youtube url setting.
    $name = 'theme_mcc/youtube';
    $title = get_string('youtube', 'theme_mcc');
    $description = get_string('youtubedesc', 'theme_mcc');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Instagram url setting.
    $name = 'theme_mcc/instagram';
    $title = get_string('instagram', 'theme_mcc');
    $description = get_string('instagramdesc', 'theme_mcc');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Top footer background image.
    $name = 'theme_mcc/topfooterimg';
    $title = get_string('topfooterimg', 'theme_mcc');
    $description = get_string('topfooterimgdesc', 'theme_mcc');
    $opts = array('accepted_types' => array('.png', '.jpg', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'topfooterimg', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Disable bottom footer.
    $name = 'theme_mcc/disablebottomfooter';
    $title = get_string('disablebottomfooter', 'theme_mcc');
    $description = get_string('disablebottomfooterdesc', 'theme_mcc');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);
    $setting->set_updatedcallback('theme_reset_all_caches');

    $settings->add($page);

    // Forum page.
    $settingpage = new admin_settingpage('theme_mcc_forum', get_string('forumsettings', 'theme_mcc'));

    $settingpage->add(new admin_setting_heading('theme_mcc_forumheading', null,
            format_text(get_string('forumsettingsdesc', 'theme_mcc'), FORMAT_MARKDOWN)));

    // Enable custom template.
    $name = 'theme_mcc/forumcustomtemplate';
    $title = get_string('forumcustomtemplate', 'theme_mcc');
    $description = get_string('forumcustomtemplatedesc', 'theme_mcc');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $settingpage->add($setting);

    // Header setting.
    $name = 'theme_mcc/forumhtmlemailheader';
    $title = get_string('forumhtmlemailheader', 'theme_mcc');
    $description = get_string('forumhtmlemailheaderdesc', 'theme_mcc');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $settingpage->add($setting);

    // Footer setting.
    $name = 'theme_mcc/forumhtmlemailfooter';
    $title = get_string('forumhtmlemailfooter', 'theme_mcc');
    $description = get_string('forumhtmlemailfooterdesc', 'theme_mcc');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $settingpage->add($setting);

    $settings->add($settingpage);
}
