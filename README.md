# <img src="https://raw.githubusercontent.com/gearmagicru/gm-wd-articles/refs/heads/master/assets/images/icon.svg" width="64px" height="64px" align="absmiddle"> Виджет "Список материалов" 

[![Latest Stable Version](https://img.shields.io/packagist/v/gearmagicru/gm-wd-articles.svg)](https://packagist.org/packages/gearmagicru/gm-wd-articles)
[![Total Downloads](https://img.shields.io/packagist/dt/gearmagicru/gm-wd-articles.svg)](https://packagist.org/packages/gearmagicru/gm-wd-articles)
[![Author](https://img.shields.io/badge/author-anton.tivonenko@gmail.com-blue.svg)](mailto:anton.tivonenko@gmail)
[![Source Code](https://img.shields.io/badge/source-gearmagicru/gm--wd--articles-blue.svg)](https://github.com/gearmagicru/gm-wd-articles)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/gearmagicru/gm-wd-articles/blob/master/LICENSE)
![Component type: widget](https://img.shields.io/badge/component%20type-widget-green.svg)
![Component ID: gm-wd-articles](https://img.shields.io/badge/component%20id-gm.wd.articles-green.svg)
![php 8.2+](https://img.shields.io/badge/php-min%208.2-red.svg)

Виджет предназначен для вывода списка материалов (статей) из базы данных с указанными параметрами.

## Пример применения
### с менеджером виджетов:
```
$list = Gm::$app->widgets->get('gm.wd.articles',  ['sort' => 'date', limit' => 10]);
$list->run();
```
### в шаблоне:
```
$this->widget('gm.wd.articles', [
    'mode'       => 'list',
    'sort'       => ['default' => 'date,a'],
    'pagination' => ['defaultLimit' => 20],
    'itemsView'  => '/blog/blog-items',
    'pager'      => [
        'itemTpl'       => '<li>{link}</li>',
        'activeItemTpl' => '<li class="active">{link}</li>',
        'options'       => ['class' => 'justify-content-center']
    ]
]);
```
### с namespace:
```
use Gm\Widget\Articles\Widget as List;
echo List::widget(['mode' => 'list', pagination' => ['limit' => 20]]);
```
если namespace ранее не добавлен в PSR, необходимо выполнить:
```
Gm::$loader->addPsr4('Gm\Widget\Articles\\', Gm::$app->modulePath . '/gm/gm.wd.articles/src');
```

## Установка

Для добавления виджета в ваш проект, вы можете просто выполнить команду ниже:

```
$ composer require gearmagicru/gm-wd-articles
```

или добавить в файл composer.json вашего проекта:
```
"require": {
    "gearmagicru/gm-wd-articles": "*"
}
```

После добавления виджета в проект, воспользуйтесь Панелью управления GM Panel для установки его в редакцию вашего веб-приложения.
