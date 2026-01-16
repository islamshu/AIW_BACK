<?php

namespace App\Support;

class SectionRegistry
{
    public static function all(): array
    {
        return [
            'layout' => [
                'label' => 'Grid / Layout',
                'icon' => '🧩',
                'description' => 'تقسيم الصفحة إلى أعمدة (Grid)',
            ],
            'hero' => [
                'label' => 'Hero Section',
                'description' => 'عنوان رئيسي + وصف + زر',
                'icon' => '🎯',
            ],
            'text' => [
                'label' => 'Text Section',
                'description' => 'نص بسيط متعدد اللغات',
                'icon' => '📝',
            ],
            'repeater' => [
                'label' => 'Repeater (Values / Features)',
                'icon' => '🔁',
                'description' => 'مجموعة عناصر متكررة (عنوان/وصف/أيقونة...)',
            ],
        ];
    }

    public static function get(string $type): ?array
    {
        return self::all()[$type] ?? null;
    }
}
