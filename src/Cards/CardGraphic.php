<?php

namespace App\Cards;

class CardGraphic extends Card
{
    private $representation = [
        '🃑',
        '🃒',
        '🃓',
        '🃔',
        '🃕',
        '🃖',
        '🃗',
        '🃘',
        '🃙',
        '🃚',
        '🃛',
        '🃝',
        '🃞',
        '🃟',
        '🂡',
        '🂢',
        '🂣',
        '🂤',
        '🂥',
        '🂦',
        '🂧',
        '🂨',
        '🂩',
        '🂪',
        '🂫',
        '🂭',
        '🂮',
        '🂱',
        '🂲',
        '🂳',
        '🂴',
        '🂵',
        '🂶',
        '🂷',
        '🂸',
        '🂹',
        '🂺',
        '🂻',
        '🂽',
        '🂾',
        '🂿',
        '🃁',
        '🃂',
        '🃃',
        '🃄',
        '🃅',
        '🃆',
        '🃇',
        '🃈',
        '🃉',
        '🃊',
        '🃋',
        '🃍',
        '🃎',
        '🃏'
    ];
    private $newArray;

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllCardsAsString(): string
    {
        $card = '';
        $arrayLength = count($this->representation);
        for ($i = 0; $i <= $arrayLength-1; $i++) {
            $card .= $this->representation[$i];
        }
        return $card;
    }

    public function roll(): void
    {
        shuffle($this->representation);
    }

    public function randomCard(): string
    {
        $this->newArray = $this->representation;
        $cardsLength = count($this->newArray);
        $randomIndex = random_int(0, $cardsLength-1);
        $randomCard = $this->newArray[$randomIndex];
        return $randomCard;
    }

    public function cardsArrayCount($randomCard): string
    {
        $key = array_search($randomCard, $this->newArray);
        unset($this->newArray[$key]);
        return count($this->newArray);
    }

    public function chosenCards($number): array
    {
        $this->newArray = $this->representation;
        $cardsLength = count($this->newArray);
        $chosenCards=[];
        for($i=0; $i<$number; $i++) {
            $randomIndex = random_int(0, $cardsLength-1);
            $randomCard = $this->newArray[$randomIndex];
            $chosenCards[] .= $randomCard;
        }
        return $chosenCards;
    }

    public function cardsNumberArrayCount($chosenCards): string
    {
        foreach($chosenCards as $card) {
            $key = array_search($card, $this->newArray);
            unset($this->newArray[$key]);
        }
        return count($this->newArray);
    }
}

