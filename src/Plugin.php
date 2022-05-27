<?php
namespace aanimation\bdate;

use Craft;
use craft\base\conditions\BaseCondition;
use craft\base\Element;
use craft\base\Model;
use craft\db\Query;
use craft\elements\conditions\ElementCondition;
use craft\elements\db\ElementQuery;
use craft\elements\db\EntryQuery;
use craft\elements\Entry;
use craft\events\DefineBehaviorsEvent;
use craft\events\DefineGqlTypeFieldsEvent;
use craft\events\DefineHtmlEvent;
use craft\events\ModelEvent;
use craft\events\PopulateElementEvent;
use craft\events\RegisterConditionRuleTypesEvent;
use craft\events\RegisterElementTableAttributesEvent;
use craft\events\RegisterGqlQueriesEvent;
use craft\events\SetElementTableAttributeHtmlEvent;
use craft\gql\TypeManager;
use craft\gql\types\DateTime;
use craft\helpers\Cp;
use craft\helpers\DateTimeHelper;
use craft\helpers\Gql as GqlHelper;
use craft\helpers\Html;
use craft\services\Gql;
use craft\web\Request;
use Exception;
use GraphQL\Type\Definition\Type;
use yii\base\Event;

class Plugin extends \craft\base\Plugin
{
    public static Plugin $plugin;

    public string $schemaVersion = '1.0.0';
    public bool $hasCpSettings = false;
    public bool $hasCpSection = false;
    
    public function init()
    {
        parent::init();

        self::$plugin = $this;

        $this->registerNewFieldsHtml();
    }

    private function registerNewFieldsHtml()
    {
        Craft::$app->view->hook('cp.users.edit.content', function(array &$context) {
            $context['foo'] = 'bar';

            $field = Cp::dateFieldHtml([
                'label' => Craft::t('app', 'Birthdate'),
                'id' => 'bdate',
                'name' => 'bdate',
                'value' => '9/16/1994',
                'errors' => null,
                'disabled' => false,
            ]);

            return Html::tag('div', $field, ['id' => 'account', 'class' => 'field']);
        });
    }
}
