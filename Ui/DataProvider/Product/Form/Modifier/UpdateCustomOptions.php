<?php


namespace TenxEngineer\ProductCustomizableOption\Ui\DataProvider\Product\Form\Modifier;


use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Framework\Stdlib\ArrayManager;use Magento\Ui\Component\Form\Fieldset;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Checkbox;
use Magento\Ui\Component\Form\Element\DataType\Text;

class UpdateCustomOptions extends AbstractModifier
{

    /**
     * @var ArrayManager
     * @since 101.0.0
     */
    protected $arrayManager;

    /**
     * @var array
     * @since 101.0.0
     */
    protected $meta = [];

    public function __construct(
        ArrayManager $arrayManager
    ){
        $this->arrayManager = $arrayManager;
    }

    public function modifyData(array $data)
    {
        // TODO: Implement modifyData() method.
        return $data;
    }

    public function modifyMeta(array $meta)
    {
        // TODO: Implement modifyMeta() method.

        $this->meta = $meta;

        $this->addCutomOptionField();

        return $this->meta;
    }

    private function addCutomOptionField(){

        $containerCommonPath = $this->arrayManager->findPath(
            'container_common',
            $this->meta,
            null,
            'children'
        );

        if ($containerCommonPath) {
            $this->meta = $this->arrayManager->merge(
                $containerCommonPath,
                $this->meta,
                $this->getCustomOptionStructure()
            );
        }

        return $this;
    }

    private function getCustomOptionStructure(){
        return [
            'children' => [
                'is_frontend_show'=> [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Show/Hide at frontend'),
                                'componentType' => Field::NAME,
                                'formElement' => Checkbox::NAME,
                                'dataScope' => 'is_frontend_show',
                                'dataType' => Text::NAME,
                                'sortOrder' => 45,
                                'value' => '1',
                                'valueMap' => [
                                    'true' => '1',
                                    'false' => '0'
                                ],
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}
