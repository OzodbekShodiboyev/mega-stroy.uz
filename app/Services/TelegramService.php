<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TelegramService
{
    private string $token;
    private string $chatId;

    public function __construct()
    {
        $this->token  = config('services.telegram.token', '');
        $this->chatId = config('services.telegram.chat_id', '');
    }

    public function send(string $text): void
    {
        if (!$this->token || !$this->chatId) return;

        Http::post("https://api.telegram.org/bot{$this->token}/sendMessage", [
            'chat_id'    => $this->chatId,
            'text'       => $text,
            'parse_mode' => 'HTML',
        ]);
    }

    public function orderNotification(\App\Models\Order $order): void
    {
        $product = $order->product;
        $unitLabel = $product?->unit_label ?? $product?->unit ?? '';
        $total = number_format($order->total_price, 0, '.', ',');
        $unit  = number_format($order->unit_price, 0, '.', ',');

        $text = "🛒 <b>Yangi buyurtma #{$order->id}</b>\n\n"
            . "👤 Mijoz: <b>{$order->name}</b>\n"
            . "📞 Telefon: <b>+{$order->phone}</b>\n"
            . "📦 Mahsulot: <b>" . ($product?->name_uz ?? '—') . "</b>\n"
            . "🎨 Rang: " . ($order->color ?: '—') . "\n"
            . "🔲 Faktura: " . ($order->texture ?: '—') . "\n"
            . "📐 Miqdor: <b>{$order->qty} {$unitLabel}</b>\n"
            . "💰 Narx/birlik: {$unit} UZS\n"
            . "💵 Jami: <b>{$total} UZS</b>\n"
            . ($order->notes ? "📝 Izoh: {$order->notes}\n" : '')
            . "\n📅 " . $order->created_at->format('d.m.Y H:i');

        $this->send($text);
    }
}
