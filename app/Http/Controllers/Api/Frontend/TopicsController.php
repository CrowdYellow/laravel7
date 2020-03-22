<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Frontend\TopicRequest;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    public function index()
    {
        //
    }

    public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = $request->user()->id;
        $topic->save();

        return new TopicResource($topic);
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
