<?php
return array(
    'input_filter_specs' => array(
        'WooodOrder' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend_Validate_StringLength',
                        'options' => array(
                            'min' => '0',
                            'max' => '30',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend_Filter_StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'REFERENTIE',
                'description' => '',
                'field_type' => 'varchar(30)',
                'error_message' => '',
            ),
            1 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend_Validate_StringLength',
                        'options' => array(
                            'min' => '0',
                            'max' => '30',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend_Filter_StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'OMSCHRIJVING',
                'description' => '',
                'field_type' => 'varchar(30)',
                'error_message' => '',
            ),
            2 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend_Validate_StringLength',
                        'options' => array(
                            'min' => '0',
                            'max' => '8',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend_Filter_StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'DEBITEURNR',
                'description' => '',
                'field_type' => 'varchar(8)',
                'error_message' => '',
            ),
            3 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend_Validate_StringLength',
                        'options' => array(
                            'min' => '0',
                            'max' => '2',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend_Filter_StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'SELECTIECODE',
                'description' => '',
                'field_type' => 'char(2)',
                'error_message' => '',
            ),
            4 => array(
                'required' => false,
                'validators' => array(),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend_Filter_StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'ORDERTOELICHTING',
                'description' => '',
                'field_type' => 'text',
                'error_message' => '',
            ),
            5 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend_Validate_Int',
                    ),
                ),
                'filters' => array(),
                'name' => 'ACCEPTATIE_VERZAMELEN',
                'description' => '',
                'field_type' => 'tinyint',
                'error_message' => '',
            ),
            6 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend_Validate_Int',
                    ),
                ),
                'filters' => array(),
                'name' => 'ACCEPTATIE_ORDERKOSTEN',
                'description' => '',
                'field_type' => 'tinyint',
                'error_message' => '',
            ),
            7 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend_Validate_StringLength',
                        'options' => array(
                            'min' => '0',
                            'max' => '50',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend_Filter_StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'DS_NAAM',
                'description' => '',
                'field_type' => 'varchar(50)',
                'error_message' => '',
            ),
            8 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend_Validate_StringLength',
                        'options' => array(
                            'min' => '0',
                            'max' => '10',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend_Filter_StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'DS_AANSPREEKTITEL',
                'description' => '',
                'field_type' => 'varchar(10)',
                'error_message' => '',
            ),
            9 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend_Validate_StringLength',
                        'options' => array(
                            'min' => '0',
                            'max' => '100',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend_Filter_StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'DS_ADRES1',
                'description' => '',
                'field_type' => 'varchar(100)',
                'error_message' => '',
            ),
            10 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend_Validate_StringLength',
                        'options' => array(
                            'min' => '0',
                            'max' => '20',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend_Filter_StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'DS_POSTCODE',
                'description' => '',
                'field_type' => 'varchar(20)',
                'error_message' => '',
            ),
            11 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend_Validate_StringLength',
                        'options' => array(
                            'min' => '0',
                            'max' => '100',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend_Filter_StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'DS_PLAATS',
                'description' => '',
                'field_type' => 'varchar(100)',
                'error_message' => '',
            ),
            12 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend_Validate_StringLength',
                        'options' => array(
                            'min' => '0',
                            'max' => '3',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend_Filter_StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'DS_LAND',
                'description' => '',
                'field_type' => 'varchar(3)',
                'error_message' => '',
            ),
            13 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend_Validate_StringLength',
                        'options' => array(
                            'min' => '0',
                            'max' => '50',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend_Filter_StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'DS_TELEFOON',
                'description' => '',
                'field_type' => 'varchar(50)',
                'error_message' => '',
            ),
            14 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend_Validate_StringLength',
                        'options' => array(
                            'min' => '0',
                            'max' => '128',
                        ),
                    ),
                    1 => array(
                        'name' => 'Zend_Validate_EmailAddress',
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend_Filter_StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'DS_EMAIL',
                'description' => '',
                'field_type' => 'varchar(128)',
                'error_message' => '',
            ),
            15 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend_Validate_Int',
                    ),
                ),
                'filters' => array(),
                'name' => 'PAYMENT_RELEASE_REQUIRED',
                'description' => '',
                'field_type' => 'tinyint',
                'error_message' => '',
            ),
            16 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'item',
                'description' => '',
                'field_type' => 'relationship',
                'error_message' => '',
            ),
        ),
        'WooodOrderLine' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend_Validate_StringLength',
                        'options' => array(
                            'min' => '0',
                            'max' => '100',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend_Filter_StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'ITEMCODE',
                'description' => '',
                'field_type' => 'varchar(100)',
                'error_message' => '',
            ),
            1 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend_Validate_Int',
                    ),
                ),
                'filters' => array(),
                'name' => 'AANTAL',
                'description' => '',
                'field_type' => 'float',
                'error_message' => '',
            ),
            2 => array(
                'required' => false,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend_Validate_StringLength',
                        'options' => array(
                            'min' => '0',
                            'max' => '7',
                        ),
                    ),
                ),
                'filters' => array(
                    0 => array(
                        'name' => 'Zend_Filter_StringTrim',
                        'options' => array(),
                    ),
                ),
                'name' => 'VERZENDWEEK',
                'description' => '',
                'field_type' => 'char(7)',
                'error_message' => '',
            ),
        ),
    ),
);