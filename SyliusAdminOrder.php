<?php
/**
 * This code is generated by the config converter under https://github.com/mamazu/grid-config-converter
 * Feel free to modify the code as you see fit.
 */
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Builder\Filter\Filter;
use Sylius\Bundle\GridBundle\Builder\Field\Field;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\BulkActionGroup;
use Sylius\Bundle\GridBundle\Config\GridConfig;
use Sylius\Bundle\GridBundle\Builder\GridBuilder;
use Sylius\Bundle\GridBundle\Builder\Action\Action;
use Sylius\Bundle\GridBundle\Builder\Action\ShowAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Field\DateTimeField;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\Field\TwigField;
class SyliusAdminOrder extends AbstractGrid
{
    public static function getName() : string
    {
        return 'sylius_admin_order';
    }
    public static function getResourceClass() : string
    {
        return '%sylius.model.order.class%';
    }
    public function buildGrid(GridBuilderInterface $gridBuilder) : void
    {
        $gridBuilder
            ->setDriver('doctrine/orm')
            ->setRepositoryMethod('createListQueryBuilder')
            ->setDriverOption('class', '%sylius.model.order.class%')
            ->addOrderBy('number', 'desc')
            ->setLimits([
                30,
                12,
                48,
            ])
            ->addField(
                DateTimeField::create('date')
                ->setLabel('sylius.ui.date')
                ->setPath('checkoutCompletedAt')
                ->setSortable(true, 'checkoutCompletedAt')
                ->setOptions([
                    'format' => 'd-m-Y H:i:s',
                ])
            )
            ->addField(
                TwigField::create('number', '@SyliusAdmin/Order/Grid/Field/number.html.twig')
                ->setLabel('sylius.ui.number')
                ->setPath('.')
                ->setSortable(true)
                ->setOptions([
                    'template' => '@SyliusAdmin/Order/Grid/Field/number.html.twig',
                ])
            )
            ->addFilter(
                Filter::create('number', 'string')
                ->setLabel('sylius.ui.number')
            )
            ->addFilter(
                Filter::create('shipping_method', 'entity')
                ->setLabel('sylius.ui.shipping_method')
                ->setOptions([
                    'fields' => [
                        'shipments.method',
                    ],
                ])
                ->setFormOptions([
                    'class' => '%sylius.model.shipping_method.class%',
                ])
            )
            ->addActionGroup(
                ItemActionGroup::create(ShowAction::create())
            )
        ;
    }
}
