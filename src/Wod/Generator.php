<?php

namespace Wod;

use Wod\Repository\ParticipantRepository;
use Wod\Service\OutputWodService;
use Wod\Service\WodService;

class Generator
{
    /**
     * @var WodService
     */
    private $wodService;

    /**
     * @var OutputWodService
     */
    private $outputWodService;

    /**
     * @var ParticipantRepository
     */
    private $participantRepository;

    /**
     * Generator constructor.
     * @param WodService $wodService
     * @param OutputWodService $outputWodService
     * @param ParticipantRepository $participantRepository
     */
    public function __construct(
        WodService $wodService,
        OutputWodService $outputWodService,
        ParticipantRepository $participantRepository
    ) {
        $this->wodService = $wodService;
        $this->outputWodService = $outputWodService;
        $this->participantRepository = $participantRepository;
    }

    public function generate(): void
    {
        $participants = $this->participantRepository->findAll();
        foreach ($participants as $participant) {
            $this->wodService->generate($participant);
        }

        $this->outputWodService->output($participants);
    }
}
