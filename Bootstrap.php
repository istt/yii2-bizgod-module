<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace istt\bizgod;

use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;
use yii\console\Application as ConsoleApplication;
use yii\db\Connection;
use yii\base\Module;

/**
 * Bootstrap class registers module and user application component. It also creates some url rules which will be applied
 * when UrlManager.enablePrettyUrl is enabled.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class Bootstrap implements BootstrapInterface
{

    /** @inheritdoc */
    public function bootstrap($app)
    {
        /** @var $module Module */
        if ($app->hasModule('bizgod') && ($module = $app->getModule('bizgod')) instanceof Module) {
            if ($app instanceof ConsoleApplication) {
                $module->controllerNamespace = 'istt\bizgod\commands';
                $app->get('urlManager')->baseUrl = $module->baseUrl;
            } else {
                $configUrlRule = [
                    'prefix' => $module->urlPrefix,
                    'rules'  => $module->urlRules
                ];

                if ($module->urlPrefix != 'bizgod') {
                    $configUrlRule['routePrefix'] = 'bizgod';
                }

                $app->get('urlManager')->rules[] = new GroupUrlRule($configUrlRule);

            }

            $app->get('i18n')->translations['bizgod*'] = [
                'class'    => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
            ];
        }
    }
}