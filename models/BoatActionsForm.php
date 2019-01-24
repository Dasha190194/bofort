<?php
/**
 * Created by PhpStorm.
 * User: dasha
 * Date: 24.01.19
 * Time: 20:01
 */

namespace app\models;


use yii\base\Model;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

class BoatActionsForm extends Model
{
    public function getFormAttribs() {
        return [
            'id'=>['type'=>TabularForm::INPUT_TEXT],
//            'action_id'=>['type'=>TabularForm::INPUT_TEXT],
//            'datetime'=>[
//                'type' => function($model, $key, $index, $widget) {
//                    return ($key % 2 === 0) ? TabularForm::INPUT_HIDDEN : TabularForm::INPUT_WIDGET;
//                },
////                'widgetClass'=>\kartik\widgets\DatePicker::classname(),
////                'options'=> function($model, $key, $index, $widget) {
////                    return ($key % 2 === 0) ? [] :
////                        [
////                            'pluginOptions'=>[
////                                'format'=>'yyyy-mm-dd',
////                                'todayHighlight'=>true,
////                                'autoclose'=>true
////                            ]
////                        ];
////                },
//                'columnOptions'=>['width'=>'170px']
//            ],
        ];
    }

}