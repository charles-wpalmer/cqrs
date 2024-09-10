<?php

namespace Crowdproperty\CQRS\Traits;

use Crowdproperty\CQRS\AggregateRoot;
use Crowdproperty\CQRS\Contracts\Command;
use Illuminate\Http\JsonResponse;

Trait CommandToAggregate
{

    protected abstract function getAggregateRoot(string $uuid);

    abstract protected function getAggregateRootIdFromCommand(Command $command);

    public function handle(Command $command): JsonResponse
    {
        return $this->proxyToAggregate($command);
    }

    protected function proxyToAggregate(Command $command): mixed
    {
        $aggregateRoot = $this->getAggregateRoot($this->getAggregateRootIdFromCommand($command));

        $handleResponse = $aggregateRoot->handle($command);

        $aggregateRoot->persist();

        return $this->proxyResponse($handleResponse, $aggregateRoot, $command);
    }

    protected function proxyResponse(
        mixed $handleResponse,
        AggregateRoot|null $aggregateRoot,
        Command $command
    ): JsonResponse
    {
        return response()->json(
            $this->proxyJson($handleResponse, $aggregateRoot, $command),
            $this->getResponseStatusCode(),
        );
    }

    protected function proxyJson(mixed $handleResponse, AggregateRoot|null $aggregateRoot, Command $command): array
    {
        return [
            'ok',
        ];
    }

    protected function getResponseStatusCode(): int
    {
        return 200;
    }
}
