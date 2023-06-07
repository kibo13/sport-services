<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Services\Pdf\PdfService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        $cards = Card::all();

        return view('admin.pages.cards.index', compact('cards'));
    }

    public function create()
    {
        return view('admin.pages.cards.form');
    }

    public function store(Request $request): RedirectResponse
    {
        Card::query()->create($request->all());

        return redirect()
            ->route('cards.index')
            ->with('success', __('_record.added'));
    }

    public function edit(Card $card)
    {
        return view('admin.pages.cards.form', compact('card'));
    }

    public function update(Request $request, Card $card): RedirectResponse
    {
        $card->update($request->all());

        return redirect()
            ->route('cards.index')
            ->with('success', __('_record.updated'));
    }

    public function destroy(Card $card): RedirectResponse
    {
        $card->delete();

        return redirect()
            ->route('cards.index')
            ->with('success', __('_record.deleted'));
    }

    public function generate(Card $card)
    {
        $html = view('layouts.card', compact('card'))->render();

        return PdfService::generate($html, 'card');
    }
}
