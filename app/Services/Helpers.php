<?php


function getOtherLang() {
    return app()->getLocale() === 'ar' ? 'en' : 'ar';
}

function isRtl() {
    return app()->getLocale() === 'ar';
}
