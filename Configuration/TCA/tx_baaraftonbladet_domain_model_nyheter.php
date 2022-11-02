<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:baaraftonbladet/Resources/Private/Language/locallang_db.xlf:tx_baaraftonbladet_domain_model_nyheter',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,text,author,date',
        'iconfile' => 'EXT:baaraftonbladet/Resources/Public/Icons/tx_baaraftonbladet_domain_model_nyheter.gif'
    ],
    'types' => [
        '1' => ['showitem' => 'title, text, author, date, tags, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language, sys_language_uid, l10n_parent, l10n_diffsource, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_baaraftonbladet_domain_model_nyheter',
                'foreign_table_where' => 'AND {#tx_baaraftonbladet_domain_model_nyheter}.{#pid}=###CURRENT_PID### AND {#tx_baaraftonbladet_domain_model_nyheter}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],

        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:baaraftonbladet/Resources/Private/Language/locallang_db.xlf:tx_baaraftonbladet_domain_model_nyheter.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'text' => [
            'exclude' => true,
            'label' => 'LLL:EXT:baaraftonbladet/Resources/Private/Language/locallang_db.xlf:tx_baaraftonbladet_domain_model_nyheter.text',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'author' => [
            'exclude' => true,
            'label' => 'LLL:EXT:baaraftonbladet/Resources/Private/Language/locallang_db.xlf:tx_baaraftonbladet_domain_model_nyheter.author',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'date' => [
            'exclude' => true,
            'label' => 'LLL:EXT:baaraftonbladet/Resources/Private/Language/locallang_db.xlf:tx_baaraftonbladet_domain_model_nyheter.date',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'tags' => [
            'exclude' => true,
            'label' => 'LLL:EXT:baaraftonbladet/Resources/Private/Language/locallang_db.xlf:tx_baaraftonbladet_domain_model_nyheter.tags',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_baaraftonbladet_domain_model_tag',
                'foreign_field' => 'nyheter',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 0,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],

        ],
    
    ],
];
