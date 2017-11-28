Yii2 TagEditor
=========
A tag editor wrapper of [jQuery-tagEditor](https://github.com/Pixabay/jQuery-tagEditor) for Yii2.0

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist rogeecn/yii2-tag-editor "*"
```

or add

```
"rogeecn/yii2-tag-editor": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= $form->field($model, "tag")->widget(\rogeecn\TagEditor\EditorWidget::className()) ?>
```
or

```php
<?= \rogeecn\TagEditor\EditorWidget::widget([
    'name'=>'tag',
    'model'=>$model,
    'clientOptions'=>[
        //...    
    ]
]); ?>
```
