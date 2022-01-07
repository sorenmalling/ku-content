<?php

defined('TYPO3_MODE') or die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
	'tt_content',
	'CType',
	['Billede med tekst ovenpå', 'image_with_overlay'],
	'textmedia',
	'after'
);

// use the same configuration for visible backend fields as "Textmedia"

if (!isset($GLOBALS['TCA']['tt_content']['defaultTypeConfiguration'])) {
	$showItemParts = explode('--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,', $GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem']);
	$GLOBALS['TCA']['tt_content']['defaultTypeConfiguration']['begin'] = '--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,';
	$GLOBALS['TCA']['tt_content']['defaultTypeConfiguration']['end'] = '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,' . $showItemParts[1];
}


$GLOBALS['TCA']['tt_content']['types']['image_with_overlay'] = [
	'previewRenderer' => \KuKom\Content\ContentPreviewRenderer::class,
	'showitem' => $GLOBALS['TCA']['tt_content']['defaultTypeConfiguration']['begin'] . '
        bodytext,
        image,
        ' . $GLOBALS['TCA']['tt_content']['defaultTypeConfiguration']['end'],
    'columnsOverrides' => [
        'bodytext' => [
            'config' => [
                'enableRichtext' => true,
            ],
        ],
    ],
];

/*
\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\B13\Container\Tca\Registry::class)->configureContainer(
	(
		new \B13\Container\Tca\ContainerConfiguration(
			'three-equal-columns', // CType
			'3 kolonner', // label
			'', // description
			[
				[
					['name' => 'Venstre', 'colPos' => 201],
					['name' => 'Center', 'colPos' => 202],
					['name' => 'Højre', 'colPos' => 203]
				]
			]
		)
	)
);
*/