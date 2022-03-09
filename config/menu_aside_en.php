<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/en/home',
            'new-tab' => false,
        ],
        [
            'title' => 'Enterprises',
            'icon' => 'media/svg/icons/Home/Book-open.svg',
            'root' => true,
            'bullet' => 'dot',
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'en/enterprise'
                ],
                [
                    'title' => 'Create',
                    'page' => 'en/enterprise/create'
                ],
            ]
        ],

        [
            'title' => 'Countries',
            'icon' => 'media/svg/icons/Home/Book-open.svg',
            'root' => true,
            'bullet' => 'dot',
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'en/country'
                ],
                [
                    'title' => 'Create',
                    'page' => 'en/country/create'
                ],
            ]
        ],


        [
            'title' => 'Cities',
            'icon' => 'media/svg/icons/Home/Book-open.svg',
            'root' => true,
            'bullet' => 'dot',
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'en/city'
                ],
                [
                    'title' => 'Create',
                    'page' => 'en/city/create'
                ],
            ]
        ],

        [
            'title' => 'Vendor',
            'icon' => 'media/svg/icons/Home/Book-open.svg',
            'root' => true,
            'bullet' => 'dot',
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'en/vendor'
                ],
                [
                    'title' => 'Create',
                    'page' => 'en/vendor/create'
                ],
                [
                    'title'=>'upload-brands',
                    'page'=>'en/upload-brands'
                ]
          
            ]
        ],
        [
            'title' => 'Offer',
            'icon' => 'media/svg/icons/Home/Book-open.svg',
            'root' => true,
            'bullet' => 'dot',
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'en/offers'
                ],
                [
                    'title' => 'Create',
                    'page' => 'en/offers/create'
                ],
            ]
        ],
        [
            'title' => 'currency',
            'icon' => 'media/svg/icons/Home/Book-open.svg',
            'root' => true,
            'bullet' => 'dot',
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'en/currency'
                ],
                [
                    'title' => 'Create',
                    'page' => 'en/currency/create'
                ],
            ]
        ],
        [
            'title' => 'category',
            'icon' => 'media/svg/icons/Home/Book-open.svg',
            'root' => true,
            'bullet' => 'dot',
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'en/category'
                ],
                [
                    'title' => 'Create',
                    'page' => 'en/category/create'
                ],
            ]
        ],
        [
            'title' => 'Subscription',
            'icon' => 'media/svg/icons/Home/Book-open.svg',
            'root' => true,
            'bullet' => 'dot',
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'en/subscription'
                ],
                [
                    'title' => 'Create',
                    'page' => 'en/subscription/create'
                ],
            ]
        ],



        [
            'title' => 'Neighborhood',
            'icon' => 'media/svg/icons/Home/Book-open.svg',
            'root' => true,
            'bullet' => 'dot',
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => 'en/neighborhood'
                ],
                [
                    'title' => 'Create',
                    'page' => 'en/neighborhood/create'
                ],
            ]
        ],
        // Custom
        [
            'section' => 'Custom',
        ],
        [
            'title' => 'Applications',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Users',
                    'bullet' => 'dot',
                    'submenu' => [
                        [
                            'title' => 'List - Default',
                            'page' => 'test',
                        ],
                        [
                            'title' => 'List - Datatable',
                            'page' => 'custom/apps/user/list-datatable'
                        ],
                        [
                            'title' => 'List - Columns 1',
                            'page' => 'custom/apps/user/list-columns-1'
                        ],
                        [
                            'title' => 'List - Columns 2',
                            'page' => 'custom/apps/user/list-columns-2'
                        ],
                        [
                            'title' => 'Add User',
                            'page' => 'custom/apps/user/add-user'
                        ],
                        [
                            'title' => 'Edit User',
                            'page' => 'custom/apps/user/edit-user'
                        ],
                    ]
                ],
                [
                    'title' => 'Profile',
                    'bullet' => 'dot',
                    'submenu' => [
                        [
                            'title' => 'Profile 1',
                            'bullet' => 'line',
                            'submenu' => [
                                [
                                    'title' => 'Overview',
                                    'page' => 'custom/apps/profile/profile-1/overview'
                                ],
                                [
                                    'title' => 'Personal Information',
                                    'page' => 'custom/apps/profile/profile-1/personal-information'
                                ],
                                [
                                    'title' => 'Account Information',
                                    'page' => 'custom/apps/profile/profile-1/account-information'
                                ],
                                [
                                    'title' => 'Change Password',
                                    'page' => 'custom/apps/profile/profile-1/change-password'
                                ],
                                [
                                    'title' => 'Email Settings',
                                    'page' => 'custom/apps/profile/profile-1/email-settings'
                                ]
                            ]
                        ],
                        [
                            'title' => 'Profile 2',
                            'page' => 'custom/apps/profile/profile-2'
                        ],
                        [
                            'title' => 'Profile 3',
                            'page' => 'custom/apps/profile/profile-3'
                        ],
                        [
                            'title' => 'Profile 4',
                            'page' => 'custom/apps/profile/profile-4'
                        ]
                    ]
                ],

            ]
        ],

    ],

];