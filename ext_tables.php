<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Baaraftonbladet',
        'site',
        'baaraftonbladetnyheterb',
        '',
        [
            \Mauricext4fs\Baaraftonbladet\Controller\NyheterController::class => 'list, show, new, create, edit, update, downloadcsv, downloadJson, delete',
            \Mauricext4fs\Baaraftonbladet\Controller\TagController::class => 'list, show, new, create, edit, update, downloadcsv, downloadJson, delete',
            
        ],
        [
            'access' => 'user,group',
            'icon'   => 'EXT:baaraftonbladet/Resources/Public/Icons/user_mod_baaraftonbladetnyheterb.svg',
            'labels' => 'LLL:EXT:baaraftonbladet/Resources/Private/Language/locallang_baaraftonbladetnyheterb.xlf',
        ]
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_baaraftonbladet_domain_model_nyheter', 'EXT:baaraftonbladet/Resources/Private/Language/locallang_csh_tx_baaraftonbladet_domain_model_nyheter.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_baaraftonbladet_domain_model_nyheter');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_baaraftonbladet_domain_model_tag', 'EXT:baaraftonbladet/Resources/Private/Language/locallang_csh_tx_baaraftonbladet_domain_model_tag.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_baaraftonbladet_domain_model_tag');
})();
