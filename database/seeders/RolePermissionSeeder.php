<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'Admin',
            'description' => 'This is a Admin Role',
        ]);

        $permissions = [
            [
                'group_name' => 'dashboard permission',
                'permissions' => [
                    'dashboard',
                ],
            ],

            [
                'group_name' => 'Role permission',
                'permissions' => [
                    'role.index',
                    'role.create',
                    'role.edit',
                    'role.destroy',
                ],
            ],
            [
                'group_name' => 'User permission',
                'permissions' => [
                    'user.index',
                    'user.create',
                    'user.edit',
                    'user.destroy',
                ],
            ],
            [
                'group_name' => 'Category permission',
                'permissions' => [
                    'categories.index',
                    'categories.create',
                    'categories.edit',
                    'categories.destroy',
                ],
            ],
            [
                'group_name' => 'Sub Category permission',
                'permissions' => [
                    'sub_categories.index',
                    'sub_categories.create',
                    'sub_categories.edit',
                    'sub_categories.destroy',
                ],
            ],
            [
                'group_name' => 'Sub_subcategories permission',
                'permissions' => [
                    'sub_subcategories.index',
                    'sub_subcategories.create',
                    'sub_subcategories.edit',
                    'sub_subcategories.destroy',
                ],
            ],
            [
                'group_name' => 'Brand permission',
                'permissions' => [
                    'brands.index',
                    'brands.create',
                    'brands.edit',
                    'brands.destroy',
                ],
            ],
            [
                'group_name' => 'Units permission',
                'permissions' => [
                    'units.index',
                    'units.create',
                    'units.edit',
                    'units.destroy',
                ],
            ],
            [
                'group_name' => 'Colors permission',
                'permissions' => [
                    'colors.index',
                    'colors.create',
                    'colors.edit',
                    'colors.destroy',
                ],
            ],
            [
                'group_name' => 'Tags permission',
                'permissions' => [
                    'tags.index',
                    'tags.create',
                    'tags.edit',
                    'tags.destroy',
                ],
            ],
            [
                'group_name' => 'Sizes permission',
                'permissions' => [
                    'sizes.index',
                    'sizes.create',
                    'sizes.edit',
                    'sizes.destroy',
                ],
            ],
            [
                'group_name' => 'Product permission',
                'permissions' => [
                    'products.index',
                    'products.create',
                    'products.edit',
                    'products.show',
                    'products.destroy',
                ],
            ],
            [
                'group_name' => 'Offer product permission',
                'permissions' => [
                    'products_offers.index',
                    'products_offers.create',
                    'products_offers.edit',
                    'products_offers.destroy',
                ],
            ],
            [
                'group_name' => 'Coupon  permission',
                'permissions' => [
                    'coupon.index',
                    'coupon.create',
                    'coupon.edit',
                    'coupon.destroy',
                ],
            ],
            [
                'group_name' => 'Order  permission',
                'permissions' => [
                    'orders.index',
                    'orders.create',
                    'orders.edit',
                    'orders.destroy',
                ],
            ],
            [
                'group_name' => 'Setting  permission',
                'permissions' => [
                    'settings.index',
                    'settings.create',
                    'settings.edit',
                ],
            ],
            [
                'group_name' => 'Carousels  permission',
                'permissions' => [
                    'carousels.index',
                    'carousels.create',
                    'carousels.edit',
                    'carousels.destroy',
                ],
            ],
            [
                'group_name' => 'Couriers  permission',
                'permissions' => [
                    'couriers.index',
                    'couriers.create',
                    'couriers.edit',
                    'couriers.destroy',
                ],
            ],

            [
                'group_name' => 'District  permission',
                'permissions' => [
                    'district.index',
                    'district.create',
                    'district.edit',
                    'district.destroy',
                ],
            ],
            [
                'group_name' => 'Combo Product  permission',
                'permissions' => [
                    'combo_product.index',
                    'combo_product.create',
                    'combo_product.edit',
                    'combo_product.show',
                    'combo_product.destroy',
                ],
            ],
            [
                'group_name' => 'Blog Category  permission',
                'permissions' => [
                    'blog_categories.index',
                    'blog_categories.create',
                    'blog_categories.edit',
                    'blog_categories.destroy',
                ],
            ],
            [
                'group_name' => 'Blog Tag  permission',
                'permissions' => [
                    'blog_tags.index',
                    'blog_tags.create',
                    'blog_tags.edit',
                    'blog_tags.destroy',
                ],
            ],
            [
                'group_name' => 'Blog   permission',
                'permissions' => [
                    'blogs.index',
                    'blogs.create',
                    'blogs.edit',
                    'blogs.show',
                    'blogs.destroy',
                ],
            ],
            [
                'group_name' => 'Rating   permission',
                'permissions' => [
                    'rating.index',
                    'rating.edit',
                ],
            ],
            [
                'group_name' => 'Police station permission',
                'permissions' => [
                    'police_station.index',
                    'police_station.create',
                    'police_station.edit',
                    'police_station.destroy',
                ],
            ],
            [
                'group_name' => 'Product stock management',
                'permissions' => [
                    'stock.index',
                    'stock.edit',
                ],
            ],
            [
                'group_name' => 'Popups permission',
                'permissions' => [
                    'popups.index',
                    'popups.create',
                    'popups.edit',
                    'popups.destroy',
                ],
            ],
            [
                'group_name' => 'Report permission',
                'permissions' => [
                    'sales.report',
                    'daily.sales.report',
                    'monthly.sales.report',
                ],
            ],
            [
                'group_name' => 'Accounts payable report permission',
                'permissions' => [
                    'merchant payable',
                    'merchant pay',
                ],
            ],
            [
                'group_name' => 'Banner permission',
                'permissions' => [
                    'banner.index',
                    'banner.create',
                    'banner.edit',
                    'banner.destroy',

                ],
            ],
            [
                'group_name' => 'Policy permission',
                'permissions' => [
                    'policy.index',
                    'policy.create',
                    'policy.edit',
                    'policy.destroy',

                ],
            ],
            [
                'group_name' => 'Contact message permission',
                'permissions' => [
                    'contact_message.index',
                ],
            ],
            [
                'group_name' => 'About  permission',
                'permissions' => [
                    'abouts.index',
                    'abouts.create',
                    'abouts.edit',
                    'abouts.destroy',
                ],
            ],
            [
                'group_name' => 'Faq  permission',
                'permissions' => [
                    'faq.index',
                    'faq.create',
                    'faq.edit',
                    'faq.destroy',
                ],
            ],
            [
                'group_name' => 'Terms & condition permission',
                'permissions' => [
                    'terms.index',
                    'terms.create',
                    'terms.edit',
                    'terms.destroy',
                ],
            ],
            [
                'group_name' => 'Customer permission',
                'permissions' => [
                    'customers.index',
                    'customers.destroy',
                ],
            ],
             [
                'group_name' => 'Delivery charge permission',
                'permissions' => [
                    'delivery_charge.index',
                    'delivery_charge.create',
                    'delivery_charge.edit',
                    'delivery_charge.destroy',
                ],
            ],


        ];

        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];

            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                Permission::create([
                    'name' => $permissions[$i]['permissions'][$j],
                    'group_name' => $permissionGroup,
                ]);
            }
        }
        $role->syncPermissions(Permission::all());
        $user=User::first();
        $user->assignRole($role);

    }
}
