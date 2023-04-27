<?php
declare(strict_types=1);

use Bitrix\Catalog\PriceTable;
use Bitrix\Main\Loader;
use Bitrix\Main\Type\DateTime;
use Luxoft\Dev\Table\LocationTable;

use Bitrix\Iblock\Elements\ElementCertificationTable;
use Bitrix\Iblock\Elements\ElementScheduleCertificationTable;

class CertificationList
extends CBitrixComponent
{
    public function executeComponent()
    {
        $this->prepareResult();
        $this->includeComponentTemplate();
    }

    protected function prepareResult(): void
    {
        Loader::includeModule('iblock');
        $locations = LocationTable::getList(['select' => ['*']])->fetchAll();
        $locations = array_column($locations, 'name', 'code');

        $currentDay = new DateTime();
        $currentDay->setTime(0,0);
        $scheduleCollection = ElementScheduleCertificationTable::getList([
            'order'  => ['date.value' => 'asc', 'id' => 'asc'],
            'select' => ['id', 'active', 'certification', 'location', 'date'],
            'filter' => ['>=date.value' => $currentDay->format('Y-m-d H:i:s'), 'active' => true]
        ])->fetchCollection();

        $schedule = array_map(function ($item) use ($locations) {
            $currentLocations = array_map(function ($item) use ($locations) {
                $code = $item ? $item->getValue() : '';
                return $locations[$code] ?? '';
            }, $item->getLocation()->getAll());
            $currentLocations = implode(', ', $currentLocations);

            $date = $item->getDate() ? $item->getDate()->getValue() : '';
            if ($date) {
                $date = (new DateTime($date, 'Y-m-d H:i:s'))->format('d.m.Y');
            }

            return [
                'id' => $item->getId(),
                'certificationId' => $item->getCertification()
                    ? $item->getCertification()->getValue() : '',
                'locations' => $currentLocations,
                'date' => $date,
                'time' => '10:00 - 13:00',
            ];
        }, $scheduleCollection->getAll());

        $certificationCollection = ElementCertificationTable::getList([
            'select' => ['id', 'active', 'name', 'preview_picture', 'type', 'level', 'duration'],
            'filter' => ['active' => true, 'id' => array_column($schedule, 'certificationId')],
        ])->fetchCollection();

        $certifications = array_reduce($certificationCollection->getAll(), function ($result, $item) {
            $previewPictureId = $item->getPreviewPicture() ?? '';
            $previewPicture = $previewPictureId ? \CFile::GetPath($previewPictureId) : '';

            $result[$item->getId()] = [
                'id' => $item->getId(),
                'logo' => $previewPicture,
                'name' => $item->getName(),
                'type' => $item->getType()
                    ? $item->getType()->getValue() : '',
                'duration' => $item->getDuration()
                    ? $item->getDuration()->getValue() : '',
            ];

            return $result;
        }, []);

        if (!Loader::includeModule('catalog')) {
            return;
        }

        $priceCollection = PriceTable::getList([
            'select' => ['PRODUCT_ID', 'PRICE', 'CURRENCY'],
            'filter' => ['=PRODUCT_ID' => array_column($certifications, 'id')],
        ])->fetchCollection();

        $prices = array_reduce(
            $priceCollection->getAll(),
            function ($result, $item) {
                $result[$item->getProductId()] = [
                    'price' => $item->getPrice(),
                    'currency' => $item->getCurrency(),
                    'priceFormatted' => \CurrencyFormat(
                        $item->getPrice(),
                        $item->getCurrency()
                    ),
                ];
                return $result;
            },
            []
        );

        $this->arResult['items'] = array_map(function ($scheduleItem) use ($certifications, $prices) {
            $certification = $certifications[$scheduleItem['certificationId']] ?? [];
            $price = $prices[$certification['id']];
            $certification['url'] = '/certification/' . $certification['type'] . '/?scheduleId=' . $scheduleItem['id'];
            return array_merge($certification,$price, $scheduleItem);
        }, $schedule);
    }
}