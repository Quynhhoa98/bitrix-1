<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arElements = $APPLICATION->IncludeComponent(
    "bitrix:search.page",
    ".default",
    Array(
        "RESTART" => $arParams["RESTART"],
        "NO_WORD_LOGIC" => $arParams["NO_WORD_LOGIC"],
        "USE_LANGUAGE_GUESS" => $arParams["USE_LANGUAGE_GUESS"],
        "CHECK_DATES" => $arParams["CHECK_DATES"],
        "arrFILTER" => array("iblock_".$arParams["IBLOCK_TYPE"]),
        "arrFILTER_iblock_".$arParams["IBLOCK_TYPE"] => array($arParams["IBLOCK_ID"]),
        "USE_TITLE_RANK" => "N",
        "DEFAULT_SORT" => "rank",
        "FILTER_NAME" => "",
        "SHOW_WHERE" => "N",
        "arrWHERE" => array(),
        "SHOW_WHEN" => "N",
        "PAGE_RESULT_COUNT" => 50,
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "N",
    ),
    $component
);
if (is_array($arElements) && !empty($arElements))
{
        global $searchFilter;
        $searchFilter = array(
            "=ID" => $arElements,
        );
        
        
        
        //$APPLICATION->IncludeComponent(
//        "bitrix:catalog.section",
//        "grid",
//        array(
//            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
//            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
//            "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
//            "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
//            "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
//            "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
//            "PROPERTY_CODE" => $arParams["PROPERTY_CODE"],
//            "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
//            "OFFERS_FIELD_CODE" => $arParams["OFFERS_FIELD_CODE"],
//            "OFFERS_PROPERTY_CODE" => $arParams["OFFERS_PROPERTY_CODE"],
//            "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
//            "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
//            "OFFERS_LIMIT" => $arParams["OFFERS_LIMIT"],
//            "SECTION_URL" => $arParams["SECTION_URL"],
//            "DETAIL_URL" => $arParams["DETAIL_URL"],
//            "BASKET_URL" => $arParams["BASKET_URL"],
//            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
//            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
//            "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
//            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
//            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
//            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
//            "CACHE_TIME" => $arParams["CACHE_TIME"],
//            "DISPLAY_COMPARE" => $arParams["DISPLAY_COMPARE"],
//            "PRICE_CODE" => $arParams["PRICE_CODE"],
//            "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
//            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
//            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
//            "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
//            "USE_PRODUCT_QUANTITY" => $arParams["USE_PRODUCT_QUANTITY"],
//            "CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
//            "CURRENCY_ID" => $arParams["CURRENCY_ID"],
//            "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
//            "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
//            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
//            "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
//            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
//            "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
//            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
//            "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
//            "FILTER_NAME" => "searchFilter",
//            "SECTION_ID" => "",
//            "SECTION_CODE" => "",
//            "SECTION_USER_FIELDS" => array(),
//            "INCLUDE_SUBSECTIONS" => "Y",
//            "SHOW_ALL_WO_SECTION" => "Y",
//            "META_KEYWORDS" => "",
//            "META_DESCRIPTION" => "",
//            "BROWSER_TITLE" => "",
//            "ADD_SECTIONS_CHAIN" => "N",
//            "SET_TITLE" => "N",
//            "SET_STATUS_404" => "N",
//            "CACHE_FILTER" => "N",
//            "CACHE_GROUPS" => "N",
//        ),
//        $arResult["THEME_COMPONENT"]
//    );

//if(!$_REQUEST["ajax"] && @$_REQUEST["ajax"] != "Y"){?>
                <hr class="b-hr" />
<?  // Elements sort
$arAvailableSort = array(
    "name" => Array("name", "asc"),
    "price" => Array('PROPERTY_MINIMUM_PRICE', "asc"),
);

$sort = array_key_exists("sort", $_REQUEST) && array_key_exists(ToLower($_REQUEST["sort"]), $arAvailableSort) ? $arAvailableSort[ToLower($_REQUEST["sort"])][0] : "name";
$sort_order = array_key_exists("order", $_REQUEST) && in_array(ToLower($_REQUEST["order"]), Array("asc", "desc")) ? ToLower($_REQUEST["order"]) : $arAvailableSort[$sort][1];
?>
                <div class="b-tab-head clearfix">
                    <div class="b-sort-wrapper">
                        <span class="b-sort__text"><?=GetMessage('SECT_SORT_LABEL')?>:</span>
    <?foreach ($arAvailableSort as $key => $val):
        $className = ($sort == $val[0]) ? ' current' : '';
        if ($className)
            $className .= ($sort_order == 'asc') ? ' asc' : ' desc';
        $newSort = ($sort == $val[0]) ? ($sort_order == 'desc' ? 'asc' : 'desc') : $arAvailableSort[$key][1];
        ?>
        <a href="<?=$APPLICATION->GetCurPageParam('sort='.$key.'&order='.$newSort,     array('sort', 'order'))?>"  class="b-sort__link <?=$className?>" rel="nofollow"><?=GetMessage('SECT_SORT_'.$key)?><?if ($sort == $val[0]):?><span></span><?endif?></a>
    <?endforeach;?>
                    </div>
        <?
        if($_REQUEST["temp"] == "grid"){
            $list_temp = "grid";
        }else{
            $list_temp = "";
        }
        ?>
                    <div class="b-sort-view">
                        <a href="?temp" class="b-view__link <?if($list_temp==""){echo "active";}?>"></a>
                        <a href="?temp=grid" class="b-view__link m-grid <?if($list_temp=="grid"){echo "active";}?>"></a>
                    </div>
                </div>
<?//}?>
<?$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    $list_temp,
    Array(
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
        "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
      "CATALOG_LIST_VIEW_MODE" => "FULL",
        "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
        "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
        "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
        "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
        "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
        "BASKET_URL" => $arParams["BASKET_URL"],
        "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
        "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
        "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
        "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
        "FILTER_NAME" => $arParams["FILTER_NAME"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_FILTER" => $arParams["CACHE_FILTER"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "SET_TITLE" => $arParams["SET_TITLE"],
        "SET_STATUS_404" => $arParams["SET_STATUS_404"],
        "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
        "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
        "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
        "PRICE_CODE" => $arParams["PRICE_CODE"],
        "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
        "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
        "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],

        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
        "PAGER_TITLE" => $arParams["PAGER_TITLE"],
        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
        "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],

        "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
        "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
        "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
        "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
        "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
        "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
        "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
    ),
    $component
);



}
else
{
    echo GetMessage("CT_BCSE_NOT_FOUND");
}
?>