<?php return [
    '123/:id'  =>
        [
            0 => 'portal/Article/index?cid=1',
            1 =>
                [
                ],
            2 =>
                [
                    'id'  => '\d+',
                    'cid' => '\d+',
                ],
        ],
    '法律法规/:id' =>
        [
            0 => 'portal/Article/index?cid=2',
            1 =>
                [
                ],
            2 =>
                [
                    'id'  => '\d+',
                    'cid' => '\d+',
                ],
        ],
    123        =>
        [
            0 => 'portal/List/index?id=1',
            1 =>
                [
                ],
            2 =>
                [
                    'id' => '\d+',
                ],
        ],
    '法律法规'     =>
        [
            0 => 'portal/List/index?id=2',
            1 =>
                [
                ],
            2 =>
                [
                    'id' => '\d+',
                ],
        ],
    'admin$'   => 'admin/Index/index',
];
