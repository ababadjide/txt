<?php 

/* @var $this yii\web\View */

//test deux

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\date\DatePicker;

    $form = ActiveForm::begin([
        'action' => Url::to(['/teacher/checkout-delivery']),
        'options' => [
            'class' => 'checkout-form mui-form',
            'id' => 'checkout-form'
            ],
        'fieldConfig' => [
            'template' => '{input}{hint}{error}{label}',
        ],
    ]); 
?>
        <?php foreach($deliveryForms as $index => $deliveryForm): ?>
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $products[$index]['name'] . " ({$products[$index]['issues']} issues) $" . $products[$index]['base_cost'] . " + taxes" ?></h3>
            </div>
            <div class="box-body">
                <?= $form->field($deliveryForm, "[{$index}]channel")->hiddenInput(['class'=>'channels'])->label(false) ?>
                <?= $form->field($deliveryForm, "[{$index}]_key")->hiddenInput()->label(false) ?>

                <!--<div class="col-md-3 text-center product_info_section">
                 
                    <?= Html::img(Yii::$app->params['productsUrl'] . $products[$index]['image'], ['alt' => $products[$index]['name'], 'class'=>'img-responsive']) ?>
                    <p><?= "({$products[$index]['issues']} issues)" ?><br/><b>$<?= "{$products[$index]['base_cost']} + taxes" ?></b></p>
                </div>-->
                <!-- END: product_info_section -->

                <div class="order-form">
                    <div class="child_info_section">
                        <h4>Delivery information</h4>
                        <div class="row">
                            <?= $form->field($deliveryForm, "[{$index}]child_first_name", [ 'options' => ['class' => 'col-md-6 mui-textfield mui-textfield--float-label'] ])->textInput(['maxlength' => true]) ?>
							

                            <?= $form->field($deliveryForm, "[{$index}]child_last_name", [ 'options' => ['class' => 'col-md-6 mui-textfield mui-textfield--float-label'] ])->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="child_info_extra row">
                            
							<div class="col-md-6">
							
							<div><label class="control-label">Child's Date of Birth (optional)</label></div>
                                <?= $form->field($deliveryForm, "[{$index}]child_birth_month", ['options' =>['class' => 'mui-select col-md-4']])->dropDownList($birthMonths, ['prompt' => 'Month', 'onchange' => "loadBirthDays(this, {$index})", 'data'=>['fetch-link'=>Url::to(['/site/list-days'])] ])->label(false) ?>
								<?= $form->field($deliveryForm, "[{$index}]child_birth_day", ['options' =>['class' => 'mui-select col-md-4']])->dropDownList($birthDays, ['prompt' => 'Day'])->label(false) ?>
								<?= $form->field($deliveryForm, "[{$index}]child_birth_year", ['options' =>['class' => 'mui-select col-md-4']])->dropDownList($birthYears, ['prompt' => 'Year', 'onchange' => "loadBirthDays(this, {$index})", 'data'=>['fetch-link'=>Url::to(['/site/list-days'])]])->label(false) ?>
                                
                            </div>
                            <?= $form->field($deliveryForm, "[{$index}]child_gender", ['options' => ['class' =>'col-md-6'], 'template' => '{label}{input}{hint}{error}'])->radioList(['Male' => 'Boy', 'Female' => 'Girl'], ['class' => 'child-gender-radio']) ?>

                        </div>
                        
                        <?= $form->field($deliveryForm, "[{$index}]child_birthday", ['options' => ['class' =>'col-md-6'], 'template' => '{label}{input}{hint}{error}'])->hiddenInput()->label(false) ?>

                        <div class="child_info_class row">
                            <?= $form->field($deliveryForm, "[{$index}]class_id", ['options' => ['class' => 'col-md-12 mui-select clearfix']])->dropDownList($classes, ['prompt' => 'Please select student\'s class']) ?>
                        </div>
                    </div>
                    <!-- END: child_info_section -->
                    
                    <div class="address_section force-bg-white">
                        <h4>Shipping address</h4>

                        <div class="row">
                            <?= $form->field($deliveryForm, "[{$index}]address_line_1", ['options' => ['class' => 'mui-textfield mui-textfield--float-label col-md-6']])->textInput(['maxlength' => true]) ?>
                            <?= $form->field($deliveryForm, "[{$index}]address_line_2", ['options' => ['class' => 'mui-textfield mui-textfield--float-label col-md-6']])->textInput(['maxlength' => true]) ?>
                        </div>

                        <div class="row">
                            <?= $form->field($deliveryForm, "[{$index}]city", ['options' => ['class' => 'mui-textfield mui-textfield--float-label col-md-6']])->textInput(['maxlength' => true]) ?>
                            <?= $form->field($deliveryForm, "[{$index}]province_state_id", ['options' =>['class' => 'mui-select col-md-6']])->dropDownList($provincesStates[$index], ['prompt' => 'Please select a province/state']) ?>
                        </div>

                        <div class="row">
                            <?= $form->field($deliveryForm, "[{$index}]postal_code", ['options' => ['class' => 'mui-textfield mui-textfield--float-label col-md-6']])->textInput(['maxlength' => true, 'style' => 'text-transform: uppercase']) ?>
                            <?= $form->field($deliveryForm, "[{$index}]country_id", ['options' => ['class' => 'mui-select col-md-6']])->dropDownList($countries, ['onchange' => "loadProvinces(this.value, 'select#deliveryform-" .  $index . "-province_state_id')", 'data'=>['fetch-link'=>Url::to(['/address/list-province-state'])] ]) ?>
                        </div>
                    </div>
                    <!-- END: address_section -->
                    
                    <div class="payment_section">
                        <h4>Payment information <small><span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="popover" data-placement="top" data-html="true" data-content="<b>Order with payment</b><br/><br/>Teachers, please mail the parent\'s payment to:<br/><br/>Owlkids, 400-10 Lower Spadina Ave, Toronto, ON, M5v 2Z2<br />"></span></small></h4>

                        <div class="row">
                            <?= $form->field($deliveryForm, "[{$index}]payment_method", ['options' => ['class' => 'col-md-12'], 'template' => '{label}{input}{hint}{error}'])->radioList(['Invoice' => 'Invoice Parents', 'Paid to Teacher' => 'I am sending Parent\'s payment to Owlkids', 'Credit card / Interac' => 'Credit card / Interac'], ['class' => 'radio-block']) ?>
                        </div>
                    </div>
                    <!-- END: payment_section -->
                </div>
                <!-- END: delivery_form_section -->
            </div>
        </div>
        <?php endforeach; ?>

    <?= Html::a('<i class="fa fa-chevron-left"></i> Back to Cart', ['/teacher/cart'], ['class' => 'btn btn-primary']) ?>

    <?= Html::button('Summary  <i class="fa fa-chevron-right"></i>', ['class' => 'btn btn-success', 'type'=>'submit',  'id'=>'confirm-order']) ?>


<?php ActiveForm::end(); ?>
