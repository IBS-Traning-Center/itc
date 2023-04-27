<?php
declare(strict_types=1);

namespace Luxoft\Dev\Service;

use Bitrix\Main\Context;
use Bitrix\Main\Error;
use Bitrix\Main\Loader;
use Bitrix\Main\ORM\Data\Result;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Iblock\SectionTable;
use Bitrix\Iblock\Elements\ElementPagesTable;
use Bitrix\Iblock\Elements\ElementArticlesTable;

use Bitrix\Main\LoaderException;

class PageHomeService
{
    protected int $iblockId;
    protected string $dataClass;
    protected string $siteUrl;
    /**
     * @throws \Bitrix\Main\LoaderException
     */
    public function __construct()
    {
        if(!Loader::includeModule('iblock')) {
            throw new LoaderException('Module iblock not found');
        }

        $elementEntity = ElementPagesTable::getEntity();
        $this->iblockId = $elementEntity->getIblock()->getId();
        $this->dataClass = $elementEntity->getDataClass();

        $this->siteUrl = $this->getSiteUrl();
    }

    protected function getSiteUrl(): string
    {
        $result = '';

        $context = Context::getCurrent();
        $server = $context->getServer();

        $host = $context->getRequest()->getHttpHost();
        $port = $context->getRequest()->getServerPort();
        $https = $server->get('HTTPS');
        $result =  ((int) $port === 443 || $https ? 'https://' : 'http://') . $host;

        return $result;
    }

    protected function getSectionIdByCode(string $code): int
    {
        if (!$code) {
            return 0;
        }

        $sectionEntity = SectionTable::getEntity();
        $sectionClass = $sectionEntity->getDataClass();
        $query = $sectionClass::query()
            ->setSelect(['ID', 'CODE', 'ACTIVE', 'IBLOCK_ID'])
            ->where('ACTIVE', 'Y')
            ->where('IBLOCK_ID', $this->iblockId)
            ->where('CODE', $code)
            ->setLimit(1)
            ->exec();

        return (int)$query->fetch()['ID'];
    }

    public function getSlides(): Result
    {
        $result = new Result();
        $sectionId = $this->getSectionIdByCode('ru_home_slider');
        if (!$sectionId) {
            $result->addError(new Error('Section not found'));
            return $result;
        }

        $arList = $this->dataClass::getList([
            'select' => [
                'ID',
                'NAME',
                'PREVIEW_PICTURE',
                'PREVIEW_TEXT',
                'LINK_VALUE' => 'LINK.VALUE',
                'VIDEO_VALUE' => 'VIDEO.VALUE',
                'MOBILE_PICTURE_VALUE' => 'MOBILE_PICTURE.VALUE',
                'TITLE_VALUE' => 'TITLE.VALUE',
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                'IBLOCK_SECTION_ID' => $sectionId,
            ],
        ])->fetchAll();

        $data = array_map(function ($arItem) {
            $image = \CFile::GetPath($arItem['PREVIEW_PICTURE']);
            $mobileImage = $arItem['MOBILE_PICTURE_VALUE']
                ? \CFile::GetPath($arItem['MOBILE_PICTURE_VALUE'])
                : $image;

            $video = $arItem['VIDEO_VALUE'] ? \CFile::GetPath($arItem['VIDEO_VALUE']) : '';

            return [
                'id' => $arItem['ID'],
                'image' => $this->getUrl($image),
                'mobileImage' => $this->getUrl($mobileImage),
                'alt' => $arItem['NAME'],
                'url' => $arItem['LINK_VALUE'] ? $this->getUrl($arItem['LINK_VALUE']) : '',
                'type' => $video ? 'video' : 'image',
                'video' => $video ? $this->getUrl($video) : '',
                'title' => $arItem['TITLE_VALUE'] ?: '',
                'description' => $arItem['PREVIEW_TEXT'] ? $this->getText($arItem['PREVIEW_TEXT']) : '',
            ];
        }, $arList);

        $result->setData($data);
        return $result;
    }

    public function getServices(): Result
    {
        $result = new Result();

        $sectionId = $this->getSectionIdByCode('ru_home_groups-courses');
        if (!$sectionId) {
            $result->addError(new Error('Section not found'));
            return $result;
        }
        $arList = $this->dataClass::getList([
            'select' => [
                'ID',
                'NAME',
                'PREVIEW_PICTURE',
                'PREVIEW_TEXT',
                'LINK_VALUE' => 'LINK.VALUE',
                'MOBILE_PICTURE_VALUE' => 'MOBILE_PICTURE.VALUE',
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                'IBLOCK_SECTION_ID' => $sectionId,
            ],
        ])->fetchAll();
        $data = array_map(function ($arItem) {

            $image = \CFile::GetPath($arItem['PREVIEW_PICTURE']);
            $mobileImage = $arItem['MOBILE_PICTURE_VALUE']
                ? \CFile::GetPath($arItem['MOBILE_PICTURE_VALUE'])
                : $image;

            return [
                'id' => $arItem['ID'],
                'image' => $this->getUrl($image),
                'mobileImage' => $this->getUrl($mobileImage),
                'alt' => $arItem['NAME'],
                'url' => $this->getUrl($arItem['LINK_VALUE']) ?: '',
                'title' => $arItem['NAME'] ?: '',
                'description' => $arItem['PREVIEW_TEXT'] ? $this->getText($arItem['PREVIEW_TEXT']) : '',
            ];
        }, $arList);

        $result->setData($data);
        return $result;
    }

    public function getCourses(): Result
    {
        $result = new Result();

        $sectionId = $this->getSectionIdByCode('ru_home_teaser-cards');
        if (!$sectionId) {
            $result->addError(new Error('Section not found'));
            return $result;
        }
        $arList = $this->dataClass::getList([
            'select' => [
                'ID',
                'NAME',
                'PREVIEW_PICTURE',
                'PREVIEW_TEXT',
                'LINK_VALUE' => 'LINK.VALUE',
                'MOBILE_PICTURE_VALUE' => 'MOBILE_PICTURE.VALUE',
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                'IBLOCK_SECTION_ID' => $sectionId,
            ],
        ])->fetchAll();
        $data = array_map(function ($arItem) {

            $image = \CFile::GetPath($arItem['PREVIEW_PICTURE']);
            $mobileImage = $arItem['MOBILE_PICTURE_VALUE']
                ? \CFile::GetPath($arItem['MOBILE_PICTURE_VALUE'])
                : $image;

            return [
                'id' => $arItem['ID'],
                'image' => $this->getUrl($image),
                'mobileImage' => $this->getUrl($mobileImage),
                'alt' => $arItem['NAME'],
                'url' => $this->getUrl($arItem['LINK_VALUE']) ?: '',
                'title' => $arItem['NAME'] ?: '',
                'description' => $arItem['PREVIEW_TEXT'] ? $this->getText($arItem['PREVIEW_TEXT']) : '',
            ];
        }, $arList);

        $result->setData($data);
        return $result;
    }

    public function getDirections(): Result
    {
        $result = new Result();

        $sectionId = $this->getSectionIdByCode('ru_home_categories-course');
        if (!$sectionId) {
            $result->addError(new Error('Section not found'));
            return $result;
        }
        $collection = $this->dataClass::getList([
            'select' => [
                'ID',
                'NAME',
                'CATEGORY_COURSE',
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                'IBLOCK_SECTION_ID' => $sectionId,
            ],
        ])->fetchCollection();

        $data = [];
        foreach ($collection as $itemObject) {
            $data[] = [
                'id' => $itemObject->getId(),
                'title' => $itemObject->getName(),
                'items' => array_map(function ($linkObject) {
                    return [
                        'id' => $linkObject->getId(),
                        'text' => $linkObject->getValue(),
                        'url' => $this->getUrl($linkObject->getDescription()),
                    ];
                }, $itemObject->getCategoryCourse()->getAll()),
            ];
        }

        $result->setData($data);
        return $result;
    }

    public function getArticles(): Result
    {
        $result = new Result();

        $entity = ElementArticlesTable::getEntity();
        $class = $entity->getDataClass();
        $collection = $class::getList([
            'order' => ['ACTIVE_FROM' => 'DESC', 'ID' => 'DESC'],
            'select' => [
                'ID',
                'NAME',
                'CODE',
                'ACTIVE_FROM',
                'PREVIEW_PICTURE',
                'PREVIEW_TEXT',
                'PREVIEW_PICTURES_CARD',
                'NOT_SHOW_HOME_PAGE',
            ],
            'filter' => [
                'ACTIVE' => 'Y',
                'NOT_SHOW_HOME_PAGE.VALUE' => null,
            ],
            'limit' => 5,
        ])->fetchCollection();

        $data = array_map(function ($itemObject) {
            $description = $itemObject->get('PREVIEW_TEXT') ? $this->getText($itemObject->get('PREVIEW_TEXT')) : '';
            $description = TruncateText(trim(strip_tags($description)), 140);

            return [
                'id' => $itemObject->getId(),
                'date' => $itemObject->get('ACTIVE_FROM')->format('d.m.Y'),
                'url' => $this->getUrl($itemObject->getCode() ? '/about/news/'.$itemObject->getCode().'/' : ''),
                'title' => $itemObject->getName(),
                'description' => $description,
                'images' => $this->getArticleImages(
                    $itemObject->get('PREVIEW_PICTURE'),
                    $itemObject->get('PREVIEW_PICTURES_CARD')->getAll()
                ),
            ];
        }, $collection->getAll());

        $result->setData($data);
        return $result;
    }

    protected function getArticleImages(int $previewPicture, array $propImages): array
    {
        if (!empty($propImages)) {
            if (count($propImages) === 3) {
                $images = array_map(function ($imageObject) {
                    return $imageObject->getValue();
                }, $propImages);
            } else {
                $images = [
                    $propImages[0]->getValue(),
                    $propImages[0]->getValue(),
                    $propImages[0]->getValue(),
                ];
            }
        } else {
            $images = [
                $previewPicture,
                $previewPicture,
                $previewPicture
            ];
        }

        return [
            '2-1' => $this->getUrl(\CFile::ResizeImageGet($images[0], ['width'=>368, 'height'=>816], BX_RESIZE_IMAGE_EXACT, false)['src']),
            '1-2' => $this->getUrl(\CFile::ResizeImageGet($images[1], ['width'=>802, 'height'=>378], BX_RESIZE_IMAGE_EXACT, false)['src']),
            '1-1' => $this->getUrl(\CFile::ResizeImageGet($images[2], ['width'=>368, 'height'=>378], BX_RESIZE_IMAGE_EXACT, false)['src']),
        ];
    }

    protected function getText(string $text = ''): string
    {
        $textData = unserialize($text);
        if ($textData['text']) {
            return $textData['text'];
        }

        return $text;
    }
    protected function getUrl($url = ''): string
    {
        if (!$url) {
            return '';
        }

        if (strpos($url, 'http') === 0) {
            return $url;
        }

        return $this->siteUrl . $url;
    }
}