<?php
/* Скрипт удаления разделов и элементов каталога */
set_time_limit(60000);
// включаем вывод ошибочек
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// подключаем prolog bitrix
require $_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/main/include/prolog_before.php';

// подключаем нужные модули
CModule::IncludeModule("iblock");

$infoblock = 16;  // Инфоблок с ID ХХХ (необходимо установить ID нужного инфоблока)
/* Удаляем разделы каталога */
$resSections = CIBlockSection::GetList(array('left_margin' => 'asc'), array('IBLOCK_ID' => $infoblock));
while ($arSection = $resSections->Fetch()) {
    CIBlockElement::Delete($arSection['ID']);
}
/* Удаляем элементы каталога */
$resElements = CIBlockElement::GetList
(
    array("ID" => "ASC"),
    array
    (
        'IBLOCK_ID' => $infoblock,
        'SECTION_ID' => 0,
        'INCLUDE_SUBSECTIONS' => 'N'
    )
);
while ($element = $resElements->Fetch()) {
    CIBlockElement::Delete($element['ID']);
}