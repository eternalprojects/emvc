<?php require_once './utility/view_helper.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>SimpleMVC Framework Demo</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/2.5.1/build/reset-fonts-grids/reset-fonts-grids.css" type="text/css">
        <link rel="stylesheet" href="<?php ViewHelper::createStaticUrl('css/global.css'); ?>" type="text/css">
    </head>
    <body>
        <div id="doc" class="yui-t2">
            <div id="hd"><h1>SimpleMVC Framework Demo</h1></div>
            <div style="text-align: right;"><a href="<?php ViewHelper::createLinkUrl('home', 'index'); ?>">Home</a> | <a href="<?php ViewHelper::createLinkUrl('article', 'index'); ?>">Article</a> | <a href="<?php ViewHelper::createLinkUrl('about', 'index'); ?>">About</a></div>
            <?php require_once 'subpage_template.php'; ?>
            <div id="ft">
                <div style="border-top: solid 1px; padding-top: 5px;">
                    <a rel="license" href="http://creativecommons.org/licenses/by/3.0/us/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by/3.0/us/80x15.png" /></a><br /><span xmlns:dc="http://purl.org/dc/elements/1.1/" href="http://purl.org/dc/dcmitype/Text" property="dc:title" rel="dc:type">SimpleMVC Framework</span> by <span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName">Max Indelicato</span> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by/3.0/us/">Creative Commons Attribution 3.0 United States License</a>.
                </div>
            </div>
        </div>
    </body>
</html>
