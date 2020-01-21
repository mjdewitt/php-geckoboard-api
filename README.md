CarlosIO\Geckoboard
===================

[![Build Status](https://travis-ci.org/carlosbuenosvinos/php-geckoboard-api.svg?branch=master)](http://travis-ci.org/carlosbuenosvinos/php-geckoboard-api) [![Code Coverage](https://scrutinizer-ci.com/g/carlosbuenosvinos/php-geckoboard-api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/carlosbuenosvinos/php-geckoboard-api/?branch=master) [![Latest Stable Version](https://poser.pugx.org/carlosio/geckoboard/v/stable.svg)](https://packagist.org/packages/carlosio/geckoboard) [![Total Downloads](https://poser.pugx.org/carlosio/geckoboard/downloads.svg)](https://packagist.org/packages/carlosio/geckoboard) [![Latest Unstable Version](https://poser.pugx.org/carlosio/geckoboard/v/unstable.svg)](https://packagist.org/packages/carlosio/geckoboard) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/carlosbuenosvinos/php-geckoboard-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/carlosbuenosvinos/php-geckoboard-api/?branch=master) [![License](https://poser.pugx.org/carlosio/geckoboard/license.svg)](https://packagist.org/packages/carlosio/geckoboard)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/cde19e73-6d4c-4e04-ac39-e746a8333d23/mini.png)](https://insight.sensiolabs.com/projects/cde19e73-6d4c-4e04-ac39-e746a8333d23)

A PHP library for pushing data into Geckoboard custom widgets (http://www.geckoboard.com/developers/custom-widgets/widget-types)

Installation
============

The best way to install the library is by using [Composer](http://getcomposer.org). Add the following to `composer.json` in the root of your project:

``` javascript
{
    "require": {
        "carlosio/geckoboard": "1.*"
    }
}
```

Then, on the command line:

``` bash
curl -s http://getcomposer.org/installer | php
php composer.phar install
```

Use the generated `vendor/autoload.php` file to autoload the library classes.

Usage
=====

```php
require __DIR__ . '/vendor/autoload.php'; //locate accordingly

use CarlosIO\Geckoboard\Widgets\NumberAndSecondaryStat;
use CarlosIO\Geckoboard\Client; //Client is only needed for push

$widget = new NumberAndSecondaryStat();
$widget->setId('<your widget id>');
$widget->setMainValue(123);
$widget->setSecondaryValue(238);
$widget->setMainPrefix('EUR');

$geckoboardClient = new Client();
$geckoboardClient->setApiKey('<your token>');
$geckoboardClient->push($widget); 
/* if polling, remove/comment ^^^ the previous line and add these lines:
    $widget_return =$widget->getData();
    echo json_encode($widget_return);
*/

```

Widget: Number and optional secondary stat
==========================================
[![Number and optional secondary stat](https://developer-custom.geckoboard.com/images/number-d01cb958.png)](https://developer-custom.geckoboard.com/#number-and-secondary-stat)

```php
use CarlosIO\Geckoboard\Widgets\NumberAndSecondaryStat;
use CarlosIO\Geckoboard\Client;

$widget = new NumberAndSecondaryStat();
$widget->setId('<your widget id>');
$widget->setMainValue(123);
$widget->setSecondaryValue(238);
$widget->setMainPrefix('EUR');

$geckoboardClient = new Client();
$geckoboardClient->setApiKey('<your token>');
$geckoboardClient->push($widget);
```

Widget: RAG numbers only
========================
[![RAG numbers only](https://developer-custom.geckoboard.com/images/rag-bd722029.png)](https://developer-custom.geckoboard.com/#rag)

```php
use CarlosIO\Geckoboard\Data\Entry;
use CarlosIO\Geckoboard\Widgets\RagNumbers;
use CarlosIO\Geckoboard\Client;

$widget = new RagNumbers();
$widget->setId('<your widget id>');

$redData = new Entry();
$redData->setValue(132)->setText('This is the red description');
$widget->setRedData($redData);

$amberData = new Entry();
$amberData->setValue(134)->setText('This is the amber description');
$widget->setAmberData($amberData);

$greenData = new Entry();
$greenData->setValue(34)->setText('This is the green description');
$widget->setGreenData($greenData);

$geckoboardClient->push($widget);
```

Widget: RAG column and numbers
==============================
[![RAG column and numbers](https://developer-custom.geckoboard.com/images/rag-column-24560f60.png)](https://developer-custom.geckoboard.com/#rag)

```php
use CarlosIO\Geckoboard\Data\Entry;
use CarlosIO\Geckoboard\Widgets\RagColumnAndNumbers;
use CarlosIO\Geckoboard\Client;

$widget = new RagColumnAndNumbers();
$widget->setId('<your widget id>');

$redData = new Entry();
$redData->setValue(132)->setText('This is the red description');
$widget->setRedData($redData);

$amberData = new Entry();
$amberData->setValue(13)->setText('This is the amber description');
$widget->setAmberData($amberData);

$greenData = new Entry();
$greenData->setValue(3)->setText('This is the green description');
$widget->setGreenData($greenData);

$geckoboardClient->push($widget);
```

Widget: Text
============
[![Text](https://developer-custom.geckoboard.com/images/text-cfb71151.png)](https://developer-custom.geckoboard.com/#text)

```php
use CarlosIO\Geckoboard\Widgets\Text;
use CarlosIO\Geckoboard\Data\Text\Item;
use CarlosIO\Geckoboard\Client;

$widget = new Text();
$widget->setId('<your widget id>');

$firstItem = new Item();
$secondItem = new Item();

$firstItem->setText('Test message 1');

$secondItem->setText('Test message 2');
$secondItem->setType(Item::TYPE_ALERT);

$widget->addItem($firstItem);
$widget->addItem($secondItem);

$geckoboardClient->push($widget);
```

Widget: Funnel
==============
[![Funnel](https://developer-custom.geckoboard.com/images/funnel-5bbf21de.png)](https://developer-custom.geckoboard.com/#funnel/)

```php
use CarlosIO\Geckoboard\Data\Funnel\Entry;
use CarlosIO\Geckoboard\Widgets\Funnel;

$widget = new Funnel();
$widget->setId('<your widget id>');
$widget->setType('reversed');
$widget->setShowPercentage(false);

$error = new Entry();
$error->setLabel('Step 1')->setValue(87809);
$widget->addEntry($error);

$error = new Entry();
$error->setLabel('Step 2')->setValue(70022);
$widget->addEntry($error);

$error = new Entry();
$error->setLabel('Step 3')->setValue(63232);
$widget->addEntry($error);

$error = new Entry();
$error->setLabel('Step 4')->setValue(53232);
$widget->addEntry($error);

$error = new Entry();
$error->setLabel('Step 5')->setValue(32123);
$widget->addEntry($error);

$error = new Entry();
$error->setLabel('Step 6')->setValue(23232);
$widget->addEntry($error);

$error = new Entry();
$error->setLabel('Step 7')->setValue(12232);
$widget->addEntry($error);

$error = new Entry();
$error->setLabel('Step 8')->setValue(2323);
$widget->addEntry($error);

$geckoboardClient->push($widget);
```

Widget: PieChart
==============
[![PieChart](https://developer-custom.geckoboard.com/images/pie-c39c7884.png)](https://developer.geckoboard.com/#pie-chart)

```php
use CarlosIO\Geckoboard\Data\PieChart\Entry;
use CarlosIO\Geckoboard\Widgets\PieChart;

$widget = new PieChart();
$widget->setId('<your widget id>');

$entry = new Entry();
$entry->setLabel('May')->setValue(100)->setColor('ffff10');
$widget->addEntry($entry);

$entry = new Entry();
$entry->setLabel('June')->setValue(160)->setColor('ffaa0a');
$widget->addEntry($entry);

$entry = new Entry();
$entry->setLabel('July')->setValue(300)->setColor('ff5505');
$widget->addEntry($entry);

$entry = new Entry();
$entry->setLabel('August')->setValue(140)->setColor('ff0000');
$widget->addEntry($entry);

$geckoboardClient->push($widget);
```

Widget: Geck-o-Meter
==================
[![Geck-o-Meter](https://developer-custom.geckoboard.com/images/geckometer-39fcd0de.png)](https://developer-custom.geckoboard.com/#geck-o-meter)

```php
use CarlosIO\Geckoboard\Data\Entry;
use CarlosIO\Geckoboard\Widgets\GeckoMeter;

$widget = new GeckoMeter();
$widget->setId('<your widget id>');

$widget->setMinData((new Entry())->setValue(0));
$widget->setMaxData((new Entry())->setValue(100));
$widget->setValue($data);

$geckoboardClient->push($widget);
```

Widget: Map
===========
[![Map](https://developer-custom.geckoboard.com/images/map-7861b656.png)](https://developer-custom.geckoboard.com/#map)

```php
use CarlosIO\Geckoboard\Data\Point;
use CarlosIO\Geckoboard\Widgets\Map;

$widget = new Map();
$widget->setId('<your widget id>');

$point = new Point();
$point->setSize(10)->setColor('FF0000')->setLatitude('40.416775')->setLongitude('-3.70379');
$widget->addPoint($point);

$geckoboardClient->push($widget);
```
Widget: LineChart2 Polling (version 2)
=================
[![Line Chart](https://developer-custom.geckoboard.com/images/linechart-976e0b94.png)](https://developer-custom.geckoboard.com/#line-chart)

```php
require '../gecko/vendor/autoload.php'; //locate accordingly

use CarlosIO\Geckoboard\Data\LineChart2\Entry;
use CarlosIO\Geckoboard\Widgets\LineChart2;


$widget = new LineChart2();

$entry = new Entry();
$entry->setFormatyAxis('currency');
$entry->setUnityAxis('USD');
$entry->setLabelsxAxis("Jan");
$entry->setLabelsxAxis("Feb");
$entry->setLabelsxAxis("Mar");
$entry->setLabelsxAxis("Apr");
$entry->setLabelsxAxis("May");
$entry->setLabelsxAxis("Jun");
$entry->setLabelsxAxis("Jul");
$entry->setLabelsxAxis("Aug");
$entry->setLabelsxAxis("Sep");
$entry->setLabelsxAxis("Oct");
$entry->setLabelsxAxis("Nov");
$entry->setLabelsxAxis("Dec");

//add 1st series data. data is stored/grouped by the series name
$seriesName = 'GBP -> USD'; //setting this makes life easier
$entry->addSeries($seriesName);
$entry->addSeriesValue($seriesName,1.62529);
$entry->addSeriesValue($seriesName,1.56991);
$entry->addSeriesValue($seriesName,1.50420);
$entry->addSeriesValue($seriesName,1.52265);
$entry->addSeriesValue($seriesName,1.55356);
$entry->addSeriesValue($seriesName,1.51930);
$entry->addSeriesValue($seriesName,1.52148);
$entry->addSeriesValue($seriesName,1.51173); 
$entry->addSeriesValue($seriesName,1.52148);
$entry->addSeriesValue($seriesName,1.55170);
$entry->addSeriesValue($seriesName,1.61966);
$entry->addSeriesValue($seriesName,1.59255);
$entry->addSeriesValue($seriesName,1.63762);

//add 2nd series data.
$seriesName = 'USD -> GBP';
$entry->addSeries($seriesName);
$entry->addSeriesValue($seriesName,1.42529);
$entry->addSeriesValue($seriesName,1.46991);
$entry->addSeriesValue($seriesName,1.40420);
$entry->addSeriesValue($seriesName,1.42265);
$entry->addSeriesValue($seriesName,1.45356);
$entry->addSeriesValue($seriesName,1.41930);
$entry->addSeriesValue($seriesName,1.42148);
$entry->addSeriesValue($seriesName,1.41173); 
$entry->addSeriesValue($seriesName,1.42148);
$entry->addSeriesValue($seriesName,1.45170);
$entry->addSeriesValue($seriesName,1.51966);
$entry->addSeriesValue($seriesName,1.49255);
$entry->addSeriesValue($seriesName,1.53762);
$widget->addEntry($entry);

$widget_return =$widget->getData();
echo json_encode($widget_return);
```

Widget: LineChart2 Polling  Datetime example (version 2)
=================
[![Line Chart](https://developer-custom.geckoboard.com/images/linechart-datetime-b82b91ae.png)](https://developer-custom.geckoboard.com/#line-chart)

It seems that a series of type, datetime is considered a scatter series and so X-Axis labels are not allowed.
Setting incomplete will change the solid plot-line to a broken plot-line

```php
require '../gecko/vendor/autoload.php'; //locate accordingly

use CarlosIO\Geckoboard\Data\LineChart2\Entry;
use CarlosIO\Geckoboard\Widgets\LineChart2;


$widget = new LineChart2();
//$widget->setId('<your widget id>');
//$widget->setId('769871-62cd28d0-1af1-0138-447b-0e571bc713b0');

$entry = new Entry();
$entry->setFormatyAxis('currency');
$entry->setUnityAxis('USD');
$seriesName = 'GBP -> USD';
$entry->setSeriesType('datetime'); //Geckoboard will expect some form of date/datetime data on the X axis.
$entry->setSeriesIncomplete('2019-12'); //value given has to match an X value in the series data.
$entry->addSeries($seriesName);
//$entry->addSeriesValue($seriesName,$valueX,$valueY); // $valueX is optional, valuex maybe a datetime if series type is defined as datetime and xlabels are not set

$entry->addSeriesValue($seriesName,'2019-01',1.56991);
$entry->addSeriesValue($seriesName,'2019-02',1.50420);
$entry->addSeriesValue($seriesName,'2019-03',1.52265);
$entry->addSeriesValue($seriesName,'2019-04',1.55356);
$entry->addSeriesValue($seriesName,'2019-05',1.51930);
$entry->addSeriesValue($seriesName,'2019-06',1.52148);
$entry->addSeriesValue($seriesName,'2019-07',1.51173); 
$entry->addSeriesValue($seriesName,'2019-08',1.52148);
$entry->addSeriesValue($seriesName,'2019-09',1.55170);
$entry->addSeriesValue($seriesName,'2019-10',1.61966);
$entry->addSeriesValue($seriesName,'2019-11',1.59255);
$entry->addSeriesValue($seriesName,'2019-12',1.63762);

$widget->addEntry($entry);

$widget_return =$widget->getData();

echo json_encode($widget_return);
```

Widget: LineChart2 Push (version 2)
=================
[![Line Chart](https://developer-custom.geckoboard.com/images/linechart-976e0b94.png)](https://developer-custom.geckoboard.com/#line-chart)

```php
require '../gecko/vendor/autoload.php'; //locate accordingly

use CarlosIO\Geckoboard\Data\LineChart2\Entry;
use CarlosIO\Geckoboard\Widgets\LineChart2;
use CarlosIO\Geckoboard\Client;

$widget = new LineChart2();
$widget->setId('<your widget id>'); //get this from the setup of dashboard tile

$entry = new Entry();
$entry->setFormatyAxis('currency');
$entry->setUnityAxis('USD');
$entry->setLabelsxAxis("Jan");
$entry->setLabelsxAxis("Feb");
$entry->setLabelsxAxis("Mar");
$entry->setLabelsxAxis("Apr");
$entry->setLabelsxAxis("May");
$entry->setLabelsxAxis("Jun");
$entry->setLabelsxAxis("Jul");
$entry->setLabelsxAxis("Aug");
$entry->setLabelsxAxis("Sep");
$entry->setLabelsxAxis("Oct");
$entry->setLabelsxAxis("Nov");
$entry->setLabelsxAxis("Dec");

//add 1st series data. data is stored/grouped by the series name
$seriesName = 'GBP -> USD'; //setting this makes life easier
$entry->addSeries($seriesName);
$entry->addSeriesValue($seriesName,1.62529);
$entry->addSeriesValue($seriesName,1.56991);
$entry->addSeriesValue($seriesName,1.50420);
$entry->addSeriesValue($seriesName,1.52265);
$entry->addSeriesValue($seriesName,1.55356);
$entry->addSeriesValue($seriesName,1.51930);
$entry->addSeriesValue($seriesName,1.52148);
$entry->addSeriesValue($seriesName,1.51173); 
$entry->addSeriesValue($seriesName,1.52148);
$entry->addSeriesValue($seriesName,1.55170);
$entry->addSeriesValue($seriesName,1.61966);
$entry->addSeriesValue($seriesName,1.59255);
$entry->addSeriesValue($seriesName,1.63762);

//add 2nd series data.
$seriesName = 'USD -> GBP';
$entry->addSeries($seriesName);
$entry->addSeriesValue($seriesName,1.42529);
$entry->addSeriesValue($seriesName,1.46991);
$entry->addSeriesValue($seriesName,1.40420);
$entry->addSeriesValue($seriesName,1.42265);
$entry->addSeriesValue($seriesName,1.45356);
$entry->addSeriesValue($seriesName,1.41930);
$entry->addSeriesValue($seriesName,1.42148);
$entry->addSeriesValue($seriesName,1.41173); 
$entry->addSeriesValue($seriesName,1.42148);
$entry->addSeriesValue($seriesName,1.45170);
$entry->addSeriesValue($seriesName,1.51966);
$entry->addSeriesValue($seriesName,1.49255);
$entry->addSeriesValue($seriesName,1.53762);
$widget->addEntry($entry);

$geckoboardClient = new Client();
$geckoboardClient->setApiKey('<your token>'); //get this from your dashboard account settings
$geckoboardClient->push($widget);
```

Widget: LineChart (version 1 legacy)
=================
[![Line Chart](https://developer-custom.geckoboard.com/images/linechart-976e0b94.png)](https://gist.github.com/leocassarani/be2e76e41fd0c3330c78)

```php
use CarlosIO\Geckoboard\Widgets\LineChart;

$widget = new LineChart();
$widget->setId('<your widget id>');
$widget->setItems(array(1, 1.23));
$widget->setColour("ff0000");
$widget->setAxis(LineChart::DIMENSION_X, array("min", "max"));
$widget->setAxis(LineChart::DIMENSION_Y, array("bottom", "top"));

$geckoboardClient->push($widget);
```

Widget: List
============
[![List](https://developer-custom.geckoboard.com/images/list-7040bbcd.png)](https://developer-custom.geckoboard.com/#list)

```php
use CarlosIO\Geckoboard\Data\ItemList\Label;
use CarlosIO\Geckoboard\Data\ItemList\Title;
use CarlosIO\Geckoboard\Widgets\ItemList;

$widget = new ItemList();
$widget->setId('<your widget id>');

$title = new Title();
$title->setText("Title text");
$title->setHighlight(true);

$title2 = new Title();
$title2->setText("Title2 text");
$title2->setHighlight(false);

$label = new Label();
$label->setName("Label name");
$label->setColor("red");

$label2 = new Label();
$label2->setName("Label2 name");
$label2->setColor("blue");

$widget->addItem($title, $label, 'description1');
$widget->addItem($title2, $label2, 'description2');

$geckoboardClient->push($widget);
```

Widget: Monitoring
==================
[![Monitoring](https://developer-custom.geckoboard.com/images/monitoring-5641d6ed.png)](https://developer-custom.geckoboard.com/#monitoring)

```php
$widget = (new Monitoring())
    ->setId('<your widget id>')
    ->setStatus('Up')
    ->setDownTime('3 days ago')
    ->setResponseTime('100 ms');

$geckoboardClient()->push($widget);
```

Widget: LeaderBoard
==================
[![Monitoring](https://developer-custom.geckoboard.com/images/leaderboard-834d9e04.png)](https://developer-custom.geckoboard.com/#leaderboard)

```php
$widget = new LeaderBoard();
$widget->setId('<your widget id>')

$item = new Item();
$item->setLabel("Title text")
    ->setValue(10)
    ->setPreviousRank(2);
$widget->addItem($item);

$item = new Item();
$item->setLabel("Title text 2")
    ->setValue(7)
    ->setPreviousRank(1);
$widget->addItem($item);

$geckoboardClient()->push($widget);
```

Push more than one widget at the same time
===========================================

```php
$widgets = array();
$widget = new LineChart();
// Fill your line chart...
$widgets[] = $widget;

$widget = new Map();
// Fill your map...
$widgets[] = $widget;

$geckoboardClient->push($widgets);
```

Set timeout for pushing widgets
===========================================
Use `setGuzzleConfig()` to pass config options directly to Guzzle.
```php
$geckoboardClient = new Client();
$geckoboardClient->setApiKey('<your token>');
$geckoboardClient->setGuzzleConfig(array('timeout' => 30, 'connect_timeout' => 3));
$geckoboardClient->push($widget);
```

Testing
=======

In order to run the test, install all dependencies: ```php composer.phar install```

    $ bin/phpunit --coverage-text
