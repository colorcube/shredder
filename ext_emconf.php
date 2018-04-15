<?php


$EM_CONF[$_EXTKEY] = [
    'title' => 'Shredder',
    'description' => 'Improve your site design by magic.',
    'category' => 'fe',
    'author' => 'René Fritz',
    'author_email' => 'r.fritz@colorcube.de',
    'author_company' => 'Colorcube',
    'version' => '1.0.0',
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'modify_tables' => '',
    'constraints' => [
        'depends' => [
            'typo3' => '6.2.0-9.9.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'Colorcube\\Shredder\\' => 'Classes'
        ]
    ]
];