```php
# tests/SerializationTest.php

it('is supposed to work', function () {
    /** @var NormalizerInterface $normalizer */
    $normalizer = container()->get(NormalizerInterface::class);
    /** @var DenormalizerInterface $denormalizer */
    $denormalizer = container()->get(DenormalizerInterface::class);

    // Given
    $book = new Book();
    $book->id = new Ulid();
    $book->name = 'Api-Platform for dummies';
    $normalized = $normalizer->normalize($book);

    // When
    /** @var Book $denormalized */
    $denormalized = $denormalizer->denormalize($normalized, Book::class);

    // Then
    expect($denormalized)->toBeInstanceOf(Book::class);
    expect($denormalized->name)->toBe('Api-Platform for dummies');
    expect($denormalized->id)->toBeInstanceOf(Ulid::class); // 👉 Fails
});
```

```bash
vendor/bin/pest
```

👇
> Typed property App\Entity\Book::$id must not be accessed before initialization
