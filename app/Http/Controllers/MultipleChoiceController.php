<?php

namespace App\Http\Controllers;

use App\Http\Requests\MultipleChoice\StoreMultipleChoice;
use App\Http\Requests\MultipleChoice\UpdateMultipleChoice;
use App\Models\MultipleChoice;
use Illuminate\Http\Request;

class MultipleChoiceController extends Controller
{
    public function store(StoreMultipleChoice $request, $event_id)
    {
        $multipleChoice = new MultipleChoice();
        $multipleChoice->fill($request->all());
        $multipleChoice->event_id = $event_id;
        $multipleChoice->setChoices($request);
        return redirect()->back();
    }

    public function update(UpdateMultipleChoice $request, $event_id, $id)
    {
        $multipleChoice = MultipleChoice::find($id);
        $multipleChoice->update([
            'question' => $request->question
        ]);
        $multipleChoice->setParams($request);
        $multipleChoice->updateChoices($request);
        $multipleChoice->save();
        return redirect()->back();
    }

    public function destroy($event_id, $id)
    {
        $event = MultipleChoice::find($id);
        $event->delete();
        return redirect()->back();
    }
}
