<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Repositories\Card\CardRepositoryInterface;
use App\Services\Pdf\PdfService;

class CardController extends Controller
{
    public function index(CardRepositoryInterface $cardRepository)
    {
        $activeCards = $cardRepository->getActiveCards();
        $inactiveCards = $cardRepository->getInactiveCards();

        return view('admin.pages.cards.index', [
            'activeCards' => $activeCards,
            'inactiveCards' => $inactiveCards,
        ]);
    }

    public function generate(Card $card)
    {
        $html = view('layouts.card', compact('card'))->render();

        return PdfService::generate($html, 'card');
    }

    public function payback(Card $card)
    {
        $card->payment->update(['type' => 'expense']);
        $html = view('layouts.payback', compact('card'))->render();

        return PdfService::generate($html, 'payback');
    }
}
