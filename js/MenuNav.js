$(document).ready(function () {

    var topPositionCode = "01";
    var secondPositionCode = "02";
    var lang = getCurrentLanguage();

    var templateMenuLangLi = '<li><a href="#" id="lang_{code}" data-lang="{code}">{text}</a></li>';
    $("#list-menu-lang").html('');
    $.each(confLang, function(index, value){
        var htmlLi = templateMenuLangLi;
        htmlLi = htmlLi.replace(/{code}/g, value.code);
        htmlLi = htmlLi.replace(/{text}/g, value.text);
        $("#list-menu-lang").append(htmlLi);
    });   

    //render menu lang by lang when first load
    getAndSetTextWhenChangeLang(lang, confLang);
    renderTopMenu(authorDebug, topPositionCode, lang, configMenu, "#infonav");
    renderSecondMenu(authorDebug, secondPositionCode, lang, parentPageId, configMenu, "#menu23");
    addActiveClass(["#infonav", "#menu23"], ownPageId, parentPageId);

    //re render menu when click change lang
    $(document).on('click', "a[id*='lang_']", function(){
        var lang = $(this).attr('data-lang');
        setCookieLang(lang);
        getAndSetTextWhenChangeLang(lang, confLang);
        renderTopMenu(authorDebug, topPositionCode, lang, configMenu, "#infonav");
        renderSecondMenu(authorDebug, secondPositionCode, lang, parentPageId, configMenu, "#menu23");
        addActiveClass(["#infonav", "#menu23"], ownPageId, parentPageId);
    });
});

function addActiveClass(arrEmlm, ownPageId, parentPageId){
    if (ownPageId != '') {
        $.each(arrEmlm, function(index, value){
        $(value).find('a').each(function(){
            var liHref = $(this).attr('href');
            if (liHref.match(ownPageId) || liHref.match(parentPageId)) {
                $(this).parent('li').addClass('active');
            }
        });
    });
    }
}

//set cookie for lang
function setCookieLang(lang){
    $.removeCookie('language', { path: '/' });
    $.cookie('language', lang, { path: '/' });
}
//function get current lang
function getCurrentLanguage() {
    var lang = $.cookie('language');
    if (lang == null) {
        lang = '001';
    }
    return lang;
}

//change text language
function getAndSetTextWhenChangeLang(codeLang, configText){  
    $.each(configText, function(index, value){
        if (value.code == codeLang) {
            $('#lang').html(value.text + '<span class="caret"></span>');
            $('#auth').text(value.auth);
            $('#logout').text(value.logout);
        }
    });      
}

//render top menu
function renderTopMenu(authorCode, positionCode, lang, config, parentElm){
    var topMenuArr = [authorCode, positionCode, lang];
    code = topMenuArr.join("-");
    var listMenu = getMenuByLangPostionAuthor(code, '', config.confMenu);    
    var templateHtmlLi = '<li><a class="aMenu" href="../{link}" id="link_{type}">{title}<span class="sr-only">(current)</span></a></li>';
    $(parentElm).html('<ul class="nav navbar-nav"></ul>');
    //render top menu
    if (listMenu != null) {
        if (typeof(listMenu.Menu) !== 'undefined') {
            $.each(listMenu.Menu, function(index, menuItem){
                var pageCode = menuItem.pagecode;
                var link = menuItem.link;
                var title = menuItem.title;
                var templateLi = templateHtmlLi;

                if (config.menuMode != '') {
                    link = changeFileExtensionName(link, config.menuMode);                    
                }

                templateLi = templateLi.replace(/{link}/g, link);
                templateLi = templateLi.replace(/{pageid}/g, pageCode);
                templateLi = templateLi.replace(/{title}/g, title);
                $(parentElm).find('ul').append(templateLi);
            });
        }
    }
}

//render second menu
function renderSecondMenu(authorCode, positionCode, lang, parentPageId, config, parentElm){
    var menuArrInforId = [authorCode, positionCode, lang];
    code = menuArrInforId.join("-");    
    var listMenu = getMenuByLangPostionAuthor(code, parentPageId, config.confMenu);
    var idParentPageId = parentPageId;
    var templateHtmlLi = '<li class="list-group-item menu {cssClass}"><a href="../{link}" data-menu-type="{type}">{title}</a></li>';
    var templateHtmlLiNotLink = '<li class="list-group-item {cssClass}" data-type="{type}">{title}</li>';
    $(parentElm).html('<div id="leftmenu"><ul class="list-group"></ul></div>');
    var parentUlObj = $(parentElm).find('ul');

    //render second menu
    if (listMenu != null) {
        if (typeof(listMenu.Menu) !== 'undefined') {
            $.each(listMenu.Menu, function(index, menuItem){
                if (typeof(menuItem.link) !== 'undefined') {
                    var link = menuItem.link;
                    var title = menuItem.title;
                    var templateLi = templateHtmlLi;

                    if (config.menuMode != '') {
                        link = changeFileExtensionName(link, config.menuMode);                    
                    }

                    //add title menu
                    templateLi = templateLi.replace(/{link}/g, link);
                    templateLi = templateLi.replace(/{title}/g, title);
                    templateLi = templateLi.replace(/{cssClass}/g, '');
                    templateLi = templateLi.replace(/{type}/g, idParentPageId);             
                    parentUlObj.append(templateLi);
                } else {
                    var title = menuItem.title;
                    var templateLi = templateHtmlLiNotLink;

                    //add title menu
                    templateLi = templateLi.replace(/{title}/g, title);
                    templateLi = templateLi.replace(/{cssClass}/g, '');    
                    templateLi = templateLi.replace(/{type}/g, idParentPageId);         
                    parentUlObj.append(templateLi);
                }

                if (typeof(menuItem.list) !== 'undefined'){
                    $.each(menuItem.list, function(key, subMenuItem){
                        var linkItm = subMenuItem.link;
                        var titleItm = subMenuItem.title;
                        var templateLi = templateHtmlLi;

                        if (config.menuMode != '') {
                            linkItm = changeFileExtensionName(linkItm, config.menuMode);                    
                        }

                        //add title menu
                        templateLi = templateLi.replace(/{link}/g, linkItm);
                        templateLi = templateLi.replace(/{title}/g, titleItm);
                        templateLi = templateLi.replace(/{cssClass}/g, 'sub-menu-item'); 
                        templateLi = templateLi.replace(/{type}/g, idParentPageId);            
                        parentUlObj.append(templateLi);
                    });    
                }
                       
            });
        }
    }
}

//get menu by code and pageid, if pageId == "" get lastest menu match search condition
function getMenuByLangPostionAuthor(code, pageId, config) {
    var menuTarget = null;
    $.each(config, function(index, menu){
        if (code == menu.code) {
            if (pageId != '') {
                if (menu.pageid == pageId) {
                     menuTarget = menu;
                 }               
            } else {
                menuTarget = menu;
            }            
        }              
    });   
    return menuTarget;
}

//get extension from url
function changeFileExtensionName(url, menuMode) {
    var link = url;
    "use strict";
    if (url === null) {
        return "";
    }
    var index = url.lastIndexOf("/");
    if (index !== -1) {
        url = url.substring(index + 1);
    }
    index = url.indexOf("?");
    if (index !== -1) {
        url = url.substring(0, index);
    }
    index = url.indexOf("#");
    if (index !== -1) {
        url = url.substring(0, index);
    }
    var lastPath = url;
    index = url.lastIndexOf(".");

    var extension = (index !== -1 )? url.substring(index + 1): "";

    if (extension != "") {
        if (extension.toLowerCase() != menuMode.toLowerCase()) {
            link = link.replace("." + extension, "." + menuMode.toLowerCase());
        }
    } else {
        link = link.replace(lastPath, lastPath + "." + menuMode.toLowerCase());
    }
    return link;
};