<?php

namespace App\Interfaces\Http\Controllers\Message;


use App\Domain\Repositories\Contracts\MessageContract;
use App\Interfaces\Http\Requests\CreateMessageRequest;

class CreateMessageController
{
    public function __construct(
        private readonly MessageContract $contract
    ) {}

    public function __invoke(CreateMessageRequest $request): array
    {
        $message = $this->contract->save($request->toArray());

        return $message->toArray();
    }
}
