<?php

namespace App\Http\Controllers\Api;

use App\Idea;
use App\Ticket;
use App\Settings;
use App\Requester;
use Illuminate\Http\Response;
use App\Notifications\TicketCreated;

class IdeasController extends ApiController
{
    public function index()
    {
        $requester = Requester::whereName(request('requester'))->orWhere('email', '=', request('requester'))->firstOrFail();
        return $this->respond($requester->ideas);
    }

    public function store()
    {
        $this->validate(request(), [
            'requester' => 'required|array',
            'title'     => 'required|min:3',
        ]);
        $idea = Idea::createAndNotify(
            request('requester'),
            request('title'),
            request('body'),
            request('tags')
        );
        $this->notifyDefault($idea);
        return $this->respond(['id' => $idea->id], Response::HTTP_CREATED);
    }

    public function update(Idea $idea)
    {
        /*$ticket->updateStatus(request('status'));

        return $this->respond(['id' => $ticket->id], Response::HTTP_OK);*/
    }

    private function notifyDefault($ticket)
    {
        $setting = Settings::first();
        if ($setting && $setting->slack_webhook_url) {
            $setting->notify(new IdeaCreated($ticket));
        }
    }
}