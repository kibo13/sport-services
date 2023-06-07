<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Services\Pdf\PdfService;

class CardController extends Controller
{
    public function index()
    {
        $cards = Card::all();

        return view('admin.pages.cards.index', compact('cards'));
    }

    public function generate(Card $card)
    {
        $html = view('layouts.card', compact('card'))->render();

        return PdfService::generate($html, 'card');
    }
}
