<?php
/**
 * Виджет веб-приложения GearMagic.
 * 
 * @link https://gearmagic.ru
 * @copyright Copyright (c) 2015 Веб-студия GearMagic
 * @license https://gearmagic.ru/license/
 */

namespace Gm\Widget\Articles;

use Gm\View\WidgetResourceTrait;
use Gm\View\MarkupViewInterface;
use Gm\Site\View\Widget\ListArticles;

/**
 * Виджет "Список материалов" предназначен для отображения материала сайта с указанными 
 * параметрами.
 * 
 * Пример использования с менеджером виджетов:
 * ```php
 * $articles = Gm::$app->widgets->get('gm.wd.articles', ['sort' => 'date', limit' => 10]);
 * $articles->run();
 * ```
 * 
 * Пример использования в шаблоне:
 * ```php
 * echo $this->widget('gm.wd.articles', [
 *     'mode'       => 'list',
 *     'sort'       => ['default' => 'date,a'],
 *     'pagination' => ['defaultLimit' => 20],
 *     'itemsView'  => '/blog/blog-items',
 *     'pager'      => [
 *         'itemTpl'       => '<li>{link}</li>',
 *         'activeItemTpl' => '<li class="active">{link}</li>',
 *         'options'       => ['class' => 'justify-content-center']
 *      ]
 * ]);
 * ```
 * 
 * Пример использования с namespace:
 * ```php
 * use Gm\Widget\Articles\Widget as List;
 * 
 * echo List::widget(['mode' => 'list', pagination' => ['limit' => 20]]);
 * ```
 * если namespace ранее не добавлен в PSR, необходимо выполнить:
 * ```php
 * Gm::$loader->addPsr4('Gm\Widget\Articles\\', Gm::$app->modulePath . '/gm/gm.wd.articles/src');
 * ```
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Gm\Widget\Articles
 * @since 1.0
 */
class Widget extends ListArticles implements MarkupViewInterface
{
    use WidgetResourceTrait;

    /**
     * {@inheritdoc}
     */
    public function init(): void
    {
        parent::init();

        $this->initTranslations();
    }

    /**
     * {@inheritdoc}
     */
    public function getMarkupOptions(array $options = []): array
    {
        /** @var array $pagination Параметры пагинации */
        $pagination = array_merge($this->defaultPagination, $this->pagination);
        /** @var array $sort Параметры сортировик */
        $sort = array_merge($this->defaultSort, $this->sort);

        // параметры передаваемые в форму настройки разметки
        $itemParams = [
            'id'         => $this->id,
            'calledFrom' => $this->calledFromViewFile,
            // вид интерфейса виджета
            'iv' => $this->itemsView, // шаблон элементов
            // пагинация
            'pp' => $pagination['pageParam'], // параметр страницы
            'lp' => $pagination['limitParam'], // параметр количества
            'dl' => $pagination['defaultLimit'], // элементов на странице
            'lf' => is_array($pagination['limitFilter']) ?  implode(',', $pagination['limitFilter']) :  $pagination['limitFilter'], // фильтр количества
            'ml' => $pagination['maxLimit'], // макс. количество элементов
            // сортировка
            'sp' => $sort['param'], // параметр сортировки
            'sd' => $sort['default'], // по умолчанию
        ];
        return [
            'component'  => 'widget',
            'uniqueId'   => $this->id,
            'dataId'     => 0,
            'registryId' => $this->registry['id'] ?? '',
            'title'      => $this->title ?: $this->t('{description}'),
            'control'    => [
                'text'   =>  $this->title ?: $this->t('{name}'), 
                'route'  => '@backend/site-markup/settings/view/' . ($this->registry['rowId'] ?? 0),
                'params' =>  $itemParams,
                'icon'   => $this->getAssetsUrl() . '/images/icon_small.svg'
            ],
            'menu' => [
                [
                    'text'    => $this->t('Markup settings'),
                    'route'   => '@backend/site-markup/settings/view/' . ($this->registry['rowId'] ?? 0),
                    'params'  => $itemParams,
                    'iconCls' => 'gm-markup__icon-markup-settings'
                ]
            ]
        ];
    }
}