# yii2-calendarview-widget

Yii2 CalendarView Widget
========================

About
-----

Ever needed to display table records as a calendar display using just a data provider and a date field?
Using Bootstrap 3 and jQuery to create a responsive calendar widget which displays any number of events.

![CalendarView Widget](https://dl.dropboxusercontent.com/u/44806680/yii2-calendarview-widget.png "CalendarView Widget")

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist marekpetras/yii2-calendarview-widget "dev-master"
```

or add

```
"marekpetras/yii2-calendarview-widget": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

To use this widget, you will need a controller and a view:

Lets say you got a table with a standard model and search provider (instanceof [\yii\data\DataProviderInterface](http://www.yiiframework.com/doc-2.0/yii-data-dataproviderinterface.html)) that you use in your [GridView](http://www.yiiframework.com/doc-2.0/yii-grid-gridview.html) for example :

```sql
CREATE TABLE `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date',
  `val` int(11) NOT NULL COMMENT 'Value',
  PRIMARY KEY (`id`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8
```

#### models/Calendar.php ####
just a standard activity record model for instance
```php
class Calendar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calendar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'val'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'val' => 'Value',
        ];
    }
}
```

#### models/search/CalendarSearch.php ####
just a standard search provider
```php
class CalendarSearch extends Calendar
{
    public function search($params)
    {
        $query = Activity::find()->where(['user_id'=>Yii::$app->user->getId()]);

        $dataProvider = new ActiveDataProvider([
             'query' => $query,
             'pagination' => ['pageSize' => 30],
             'sort'=> ['defaultOrder' => ['start'=>SORT_DESC]]
         ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->calories,
            'val' => $this->peak_heartrate,
        ]);

        return $dataProvider;
    }
}
```

then you will need a controller

#### controllers/CalendarController.php ####

```php
class CalendarController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new CalendarSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
                'dataProvider' => $dataProvider
            ]);
    }
}
```

and the view

#### views/calendar/index.php ####
```php
use marekpetras\calendarview\CalendarView;

echo CalendarView::widget(
    [
        // mandatory
        'dataProvider'  => $dataProvider,
        'dateField'     => 'date',
        'valueField'    => 'val',


        // optional params with their defaults
        'weekStart' => 1, // date('w') // which day to display first in the calendar
        'title'     => 'Calendar',

        'views'     => [
            'calendar' => '@vendor/marekpetras/yii2-calendarview-widget/views/calendar',
            'month' => '@vendor/marekpetras/yii2-calendarview-widget/views/month',
            'day' => '@vendor/marekpetras/yii2-calendarview-widget/views/day',
        ],

        'startYear' => date('Y') - 1,
        'endYear' => date('Y') + 1,

        'link' => false,
        /* alternates to link , is called on every models valueField, used in Html::a( valueField , link )
        'link' => 'site/view',
        'link' => function($model,$calendar){
            return ['calendar/view','id'=>$model->id];
        },
        */

        'dayRender' => false,
        /* alternate to dayRender
        'dayRender' => function($model,$calendar) {
            return '<p>'.$model->id.'</p>';
        },
        */

    ]
);
```

