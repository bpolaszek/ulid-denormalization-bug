<?php

namespace App\Command;

use App\Entity\Book;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Uid\Ulid;

class TestCommand extends Command
{
    public function __construct(private NormalizerInterface $normalizer, private DenormalizerInterface $denormalizer)
    {
        parent::__construct('app:test');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $book = new Book();
        $book->id = new Ulid();
        $book->name = 'Api-Platform for dummies';

        $normalized = $this->normalizer->normalize($book);
        $denormalized = $this->denormalizer->denormalize($normalized, Book::class);
        dump((string) $denormalized->id);

        return Command::SUCCESS;
    }
}
