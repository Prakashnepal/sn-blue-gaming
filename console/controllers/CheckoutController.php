<?php

namespace console\controllers;

class CheckoutController extends \yii\web\Controller
{
    public function actionCheckout()
    {
        return $this->render('checkout');
    }

}
