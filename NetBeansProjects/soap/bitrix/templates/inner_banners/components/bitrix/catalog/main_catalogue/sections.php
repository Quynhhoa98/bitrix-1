<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!$_REQUEST["ajax"] && @$_REQUEST["ajax"] != "Y"){?>
<div class="b-container clearfix">
<aside class="b-sidebar">
	<?/*$APPLICATION->IncludeComponent("cm:catalog.smart.filter2", ".default", array(
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => "1",
                "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                "FILTER_NAME" => "arrFilter",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "CACHE_GROUPS" => "Y",
                "SAVE_IN_SESSION" => "Y",
                "PRICE_CODE" => array(
                    0 => "price",
                )
            ),
            false
        );
													  */?>
</aside>
<section class="b-content">
<?}?>
<?if(!$_REQUEST["ajax"] && @$_REQUEST["ajax"] != "Y"){?>
    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", array(
                "START_FROM" => "",
                "PATH" => "",
                "SITE_ID" => "s1"
            ),
            false
        );?>
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
                <a href="<?=$APPLICATION->GetCurPageParam('sort='.$key.'&order='.$newSort, 	array('sort', 'order'))?>"  class="b-sort__link <?=$className?>" rel="nofollow"><?=GetMessage('SECT_SORT_'.$key)?><?if ($sort == $val[0]):?><span></span><?endif?></a>
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
    <?}?>
<?$APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        $list_temp,
        Array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
            "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
            "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
            "SHOW_ALL_WO_SECTION" => "Y",
            "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
            "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
            "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
            "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
            "BASKET_URL" => $arParams["BASKET_URL"],
            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
            "PRODUCT_ID_VARIABLE" => false,
            "SECTION_ID_VARIABLE" => false,
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
?>
<?if($arParams["SHOW_TOP_ELEMENTS"]!="N"):?>
    <hr />
    <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.top",
            "",
            Array(
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "ELEMENT_SORT_FIELD" => $arParams["TOP_ELEMENT_SORT_FIELD"],
                "ELEMENT_SORT_ORDER" => $arParams["TOP_ELEMENT_SORT_ORDER"],
                "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                "BASKET_URL" => $arParams["BASKET_URL"],
                "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                "ELEMENT_COUNT" => $arParams["TOP_ELEMENT_COUNT"],
                "LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
                "PROPERTY_CODE" => $arParams["TOP_PROPERTY_CODE"],
                "PRICE_CODE" => $arParams["PRICE_CODE"],
                "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                "PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
                "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                "OFFERS_FIELD_CODE" => $arParams["TOP_OFFERS_FIELD_CODE"],
                "OFFERS_PROPERTY_CODE" => $arParams["TOP_OFFERS_PROPERTY_CODE"],
                "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                "OFFERS_LIMIT" => $arParams["TOP_OFFERS_LIMIT"],
                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
            ),
            $component
        );?>
    <?endif?>