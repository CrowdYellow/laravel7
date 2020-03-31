<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use function GuzzleHttp\Psr7\uri_for;

class TopicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $btn  = false;
        $user = $request->user();
        if ($user) {
            if ($user->id == $request->user_id) {
                $btn = true;
            }
        }
        $data             = parent::toArray($request);
        $data['user']     = new UserResource($this->whenLoaded('user'));
        $data['category'] = new CategoryResource($this->whenLoaded('category'));
        $data['btn']      = (int) $btn;

        return $data;
    }
}
