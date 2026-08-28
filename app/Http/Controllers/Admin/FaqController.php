<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faq = Faq::orderBy('order', 'ASC')->get();
        return view('admin.faq', compact('faq'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->order = $request->order ?? 0;
        $faq->status = $request->status ?? 1;
        $faq->save();

        return redirect()->route('faq.index')->with('message', 'FAQ added successfully!')->with('alert-type', 'success');
    }

    public function edit($id)
    {
        $faqData = Faq::findOrFail($id);
        $faq = Faq::orderBy('order', 'ASC')->get();
        return view('admin.faq', compact('faqData', 'faq'));
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->order = $request->order ?? 0;
        $faq->status = $request->status ?? 1;
        $faq->save();

        return redirect()->route('faq.index')->with('message', 'FAQ updated successfully!')->with('alert-type', 'success');
    }

    public function destroy(Request $request)
    {
        $faq = Faq::findOrFail($request->id);
        $faq->delete();
        return response()->json(['success' => true]);
    }
}
