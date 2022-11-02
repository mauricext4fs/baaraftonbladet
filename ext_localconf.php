<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Baaraftonbladet',
        'Baaraftonbladetnyheterf',
        [
            \Mauricext4fs\Baaraftonbladet\Controller\NyheterController::class => 'list, show, new, create, edit, update, downloadcsv',
            \Mauricext4fs\Baaraftonbladet\Controller\TagController::class => 'list, show, downloadcsv'
        ],
        // non-cacheable actions
        [
            \Mauricext4fs\Baaraftonbladet\Controller\NyheterController::class => 'new, create, edit, update, downloadcsv'
        ]
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    baaraftonbladetnyheterf {
                        iconIdentifier = baaraftonbladet-plugin-baaraftonbladetnyheterf
                        title = LLL:EXT:baaraftonbladet/Resources/Private/Language/locallang_db.xlf:tx_baaraftonbladet_baaraftonbladetnyheterf.name
                        description = LLL:EXT:baaraftonbladet/Resources/Private/Language/locallang_db.xlf:tx_baaraftonbladet_baaraftonbladetnyheterf.description
                        tt_content_defValues {
                            CType = list
                            list_type = baaraftonbladet_baaraftonbladetnyheterf
                        }
                    }
                }
                show = *
            }
       }'
    );
})();
