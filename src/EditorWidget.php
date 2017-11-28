<?php
namespace rogeecn\TagEditor;

use yii\bootstrap\InputWidget;
use yii\helpers\Html;
use yii\helpers\Json;

class EditorWidget extends InputWidget
{
    /**
     * editor options
     *
     * @var array
     */
    public $clientOptions = [];

    /**
     * Renders the widget.
     */
    public function run()
    {
        if ($this->hasModel()) {
            $this->name = empty($this->options['name']) ?
                Html::getInputName($this->model, $this->attribute) :
                $this->options['name'];

            $this->value = Html::getAttributeValue($this->model, $this->attribute);
        }

        echo Html::textarea($this->name, $this->value, $this->options);
        $this->registerClientScript();
    }

    protected function registerClientScript()
    {
        $view = $this->getView();
        EditorAsset::register($view);

        $id = $this->options['id'];

        $clientOptions = $this->initClientOptions();
        $clientOptions = Json::htmlEncode($clientOptions);
        $clientOptions = str_replace('\/', "/", $clientOptions);
        $js            = sprintf("$('#%s').tagEditor(%s);", $id, $clientOptions);
        $view->registerJs($js);
    }

    protected function initClientOptions()
    {
        $options = [
            'autocomplete'     => [
                'source'    => '/manage/post/tag',
                'minLength' => 2,
            ],
            'initialTags'      => explode(",", $this->value),
            'maxTags'          => 5,
            'maxLength'        => 20,
            'delimiter'        => ', ',
            "placeholder"      => "Enter tags...",
            "forceLowercase"   => false,
            "removeDuplicates" => true,
            "clickDelete"      => false,
            "animateDelete"    => 50,
            "sortable"         => false,
        ];

        return array_merge($options, $this->clientOptions);
    }
}