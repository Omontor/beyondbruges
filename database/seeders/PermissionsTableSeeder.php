<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'partner_create',
            ],
            [
                'id'    => 18,
                'title' => 'partner_edit',
            ],
            [
                'id'    => 19,
                'title' => 'partner_show',
            ],
            [
                'id'    => 20,
                'title' => 'partner_delete',
            ],
            [
                'id'    => 21,
                'title' => 'partner_access',
            ],
            [
                'id'    => 22,
                'title' => 'landmark_create',
            ],
            [
                'id'    => 23,
                'title' => 'landmark_edit',
            ],
            [
                'id'    => 24,
                'title' => 'landmark_show',
            ],
            [
                'id'    => 25,
                'title' => 'landmark_delete',
            ],
            [
                'id'    => 26,
                'title' => 'landmark_access',
            ],
            [
                'id'    => 27,
                'title' => 'coupon_create',
            ],
            [
                'id'    => 28,
                'title' => 'coupon_edit',
            ],
            [
                'id'    => 29,
                'title' => 'coupon_show',
            ],
            [
                'id'    => 30,
                'title' => 'coupon_delete',
            ],
            [
                'id'    => 31,
                'title' => 'coupon_access',
            ],
            [
                'id'    => 32,
                'title' => 'qr_code_create',
            ],
            [
                'id'    => 33,
                'title' => 'qr_code_edit',
            ],
            [
                'id'    => 34,
                'title' => 'qr_code_show',
            ],
            [
                'id'    => 35,
                'title' => 'qr_code_delete',
            ],
            [
                'id'    => 36,
                'title' => 'qr_code_access',
            ],
            [
                'id'    => 37,
                'title' => 'blog_create',
            ],
            [
                'id'    => 38,
                'title' => 'blog_edit',
            ],
            [
                'id'    => 39,
                'title' => 'blog_show',
            ],
            [
                'id'    => 40,
                'title' => 'blog_delete',
            ],
            [
                'id'    => 41,
                'title' => 'blog_access',
            ],
            [
                'id'    => 42,
                'title' => 'navigation_access',
            ],
            [
                'id'    => 43,
                'title' => 'itinerary_create',
            ],
            [
                'id'    => 44,
                'title' => 'itinerary_edit',
            ],
            [
                'id'    => 45,
                'title' => 'itinerary_show',
            ],
            [
                'id'    => 46,
                'title' => 'itinerary_delete',
            ],
            [
                'id'    => 47,
                'title' => 'itinerary_access',
            ],
            [
                'id'    => 48,
                'title' => 'prize_create',
            ],
            [
                'id'    => 49,
                'title' => 'prize_edit',
            ],
            [
                'id'    => 50,
                'title' => 'prize_show',
            ],
            [
                'id'    => 51,
                'title' => 'prize_delete',
            ],
            [
                'id'    => 52,
                'title' => 'prize_access',
            ],
            [
                'id'    => 53,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 54,
                'title' => 'redeem_create',
            ],
            [
                'id'    => 55,
                'title' => 'redeem_edit',
            ],
            [
                'id'    => 56,
                'title' => 'redeem_show',
            ],
            [
                'id'    => 57,
                'title' => 'redeem_delete',
            ],
            [
                'id'    => 58,
                'title' => 'redeem_access',
            ],
            [
                'id'    => 59,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 60,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 61,
                'title' => 'notification_create',
            ],
            [
                'id'    => 62,
                'title' => 'notification_edit',
            ],
            [
                'id'    => 63,
                'title' => 'notification_show',
            ],
            [
                'id'    => 64,
                'title' => 'notification_delete',
            ],
            [
                'id'    => 65,
                'title' => 'notification_access',
            ],
            [
                'id'    => 66,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
