<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/catalog/general/catalog_import.php");

class CCatalogImport extends CAllCatalogImport
{
	function Add($arFields)
	{
		global $DB;
		global $USER;

		//	"=LAST_USE" => $DB->GetNowFunction()
		$arFields1 = array();
		foreach ($arFields as $key => $value)
		{
			if (substr($key, 0, 1)=="=")
			{
				if ('=LAST_USE' == $key)
				{
					if ($value == $DB->GetNowFunction())
						$arFields1['LAST_USE'] = $DB->GetNowFunction();
				}
				unset($arFields[$key]);
			}
		}

		if (!(!isset($USER) || !(($USER instanceof CUser) && ('CUser' == get_class($USER)))))
		{
			if (!isset($arFields["CREATED_BY"]) || intval($arFields["CREATED_BY"]) <= 0)
				$arFields["CREATED_BY"] = intval(@$USER->GetID());
			if (!isset($arFields["MODIFIED_BY"]) || intval($arFields["MODIFIED_BY"]) <= 0)
				$arFields["MODIFIED_BY"] = intval(@$USER->GetID());
		}
		if (array_key_exists('TIMESTAMP_X', $arFields))
			unset($arFields['TIMESTAMP_X']);
		if (array_key_exists('DATE_CREATE', $arFields))
			unset($arFields['DATE_CREATE']);

		$arFields1['TIMESTAMP_X'] = $DB->GetNowFunction();
		$arFields1['DATE_CREATE'] = $DB->GetNowFunction();

		$arFields["IS_EXPORT"] = "N";

		if (!CCatalogImport::CheckFields("ADD", $arFields))
			return false;

		$arInsert = $DB->PrepareInsert("b_catalog_export", $arFields);

		foreach ($arFields1 as $key => $value)
		{
			if (strlen($arInsert[0])>0)
			{
				$arInsert[0] .= ", ";
				$arInsert[1] .= ", ";
			}
			$arInsert[0] .= $key;
			$arInsert[1] .= $value;
		}

		$strSql =
			"INSERT INTO b_catalog_export(".$arInsert[0].") ".
			"VALUES(".$arInsert[1].")";
		$DB->Query($strSql, false, "File: ".__FILE__."<br>Line: ".__LINE__);

		$ID = intval($DB->LastID());

		return $ID;
	}

	function Update($ID, $arFields)
	{
		global $DB;
		global $USER;

		$ID = intval($ID);

		//	"=LAST_USE" => $DB->GetNowFunction()
		$boolNoUpdate = false;
		$arFields1 = array();
		foreach ($arFields as $key => $value)
		{
			if (substr($key, 0, 1)=="=")
			{
				if ('=LAST_USE' == $key)
				{
					if ($value == $DB->GetNowFunction())
					{
						$arFields1['LAST_USE'] = $DB->GetNowFunction();
						$boolNoUpdate = true;
					}
				}
				unset($arFields[$key]);
			}
		}

		if (array_key_exists('CREATED_BY',$arFields))
			unset($arFields['CREATED_BY']);
		if (array_key_exists('DATE_CREATE',$arFields))
			unset($arFields['DATE_CREATE']);
		if (array_key_exists('TIMESTAMP_X', $arFields))
			unset($arFields['TIMESTAMP_X']);

		if (!$boolNoUpdate)
		{
			if (!(!isset($USER) || !(($USER instanceof CUser) && ('CUser' == get_class($USER)))))
			{
				if (!isset($arFields["MODIFIED_BY"]) || intval($arFields["MODIFIED_BY"]) <= 0)
					$arFields["MODIFIED_BY"] = intval(@$USER->GetID());
			}
			$arFields1['TIMESTAMP_X'] = $DB->GetNowFunction();
		}
		else
		{
			if (array_key_exists('MODIFIED_BY',$arFields))
				unset($arFields['MODIFIED_BY']);
		}

		$arFields["IS_EXPORT"] = "N";

		if (!CCatalogImport::CheckFields("UPDATE", $arFields))
			return false;

		$strUpdate = $DB->PrepareUpdate("b_catalog_export", $arFields);

		foreach ($arFields1 as $key => $value)
		{
			if (strlen($strUpdate)>0) $strUpdate .= ", ";
			$strUpdate .= $key."=".$value." ";
		}

		$strSql =
			"UPDATE b_catalog_export SET ".$strUpdate." WHERE ID = ".$ID." AND IS_EXPORT = 'N'";
		$DB->Query($strSql, false, "File: ".__FILE__."<br>Line: ".__LINE__);

		return $ID;
	}
}
?>