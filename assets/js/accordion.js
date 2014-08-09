/*
Simple JQuery menu.

HTML structure to use:

Notes:  Each menu MUST have a class 'menu' set. If the menu doesn't have this, the JS won't make it dynamic
If you want a panel to be expanded at page load, give the containing LI element the classname 'expand'.
Use this to set the right state in your page (generation) code.

Optional extra classnames for the UL element that holds an accordion:

noaccordion : no accordion functionality
collapsible : menu works like an accordion but can be fully collapsed

----------------------

<ul class="menu [optional class] [optional class]">
<li><a href="#">Sub menu heading</a>
<ul class="acitem">
<li><a href="http://site.com/">Link</a></li>
<li><a href="http://site.com/">Link</a></li>
<li><a href="http://site.com/">Link</a></li>
</ul>

// This item is open at page load time

<li class="expand"><a href="#">Sub menu heading</a>
<ul class="acitem">
<li><a href="http://site.com/">Link</a></li>
<li><a href="http://site.com/">Link</a></li>
<li><a href="http://site.com/">Link</a></li>
</ul>
</ul>
----------------------
Use divs for non list content. You can mix and match.

<ul class="menu [optional class] [optional class]">
<li><a href="#">Sub menu heading</a>
<div class="acitem">
<p>Put your content here</p>
</div>
</li>

<li><a href="#">Sub menu heading 2 </a>
<div class="acitem">
<p>Put your content here</p>
</div>
</li>

<li><a href="#">Sub menu heading</a>
<ul class="acitem">
<li><a href="http://site.com/">Link</a></li>
<li><a href="http://site.com/">Link</a></li>
<li><a href="http://site.com/">Link</a></li>
</ul>
</ul>

*/


jQuery.fn.initMenu = function () {
    return this.each(function () {
        jQuery('.acitem', this).hide();
        jQuery('li.expand > .acitem', this).show();
        jQuery('li.expand > .acitem', this).prev().addClass('active');
        jQuery('li a', this).click(
            function (e) {
                e.stopImmediatePropagation();
                var theElement = jQuery(this).next();
                var parent = this.parentNode.parentNode;
                if (jQuery(parent).hasClass('noaccordion')) {
                    if (theElement[0] === undefined) {
                        window.location.href = this.href;
                    }
                    jQuery(theElement).slideToggle('750', function () {
                        if (jQuery(this).is(':visible')) {
                            jQuery(this).prev().addClass('active');
                            jQuery(this).prev().children().removeClass('el-icon-down').addClass('el-icon-up');
                        } else {
                            jQuery(this).prev().removeClass('active');
                            jQuery(this).prev().children().removeClass('el-icon-up').addClass('el-icon-down');
                        }
                    });
                    return false;
                }
                if (theElement.hasClass('acitem') && theElement.is(':visible')) {
                    if (jQuery(parent).hasClass('collapsible')) {
                        jQuery('.acitem:visible', parent).first().slideUp('750',
                            function () {
                                jQuery(this).prev().removeClass('active');
                                jQuery(this).prev().children().removeClass('el-icon-up').addClass('el-icon-down');
                            }
                            );
                        return false;
                    }
                    return false;
                }
                if (theElement.hasClass('acitem') && !theElement.is(':visible')) {
                    jQuery('.acitem:visible', parent).first().slideUp('750', function () {
                        jQuery(this).prev().removeClass('active');
                        jQuery(this).prev().children().removeClass('el-icon-up').addClass('el-icon-down');
                    });
                    theElement.slideDown('normal', function () {
                        jQuery(this).prev().addClass('active');
                        jQuery(this).prev().children().removeClass('el-icon-down').addClass('el-icon-up');
                    });
                    return false;
                }
            }
        );
    });
};

jQuery(document).ready(function ($) {
    $('.accordion').initMenu();
});