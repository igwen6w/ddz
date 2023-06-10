<?php

namespace Igwen6w\Ddz\Room;

use Igwen6w\Ddz\Validation\BombValidation;
use Igwen6w\Ddz\Validation\PairValidation;
use Igwen6w\Ddz\Validation\QuadPlexSetValidation;
use Igwen6w\Ddz\Validation\RocketValidation;
use Igwen6w\Ddz\Validation\SequenceOfPairValidation;
use Igwen6w\Ddz\Validation\SequenceOfTripletValidation;
use Igwen6w\Ddz\Validation\SequenceOfTripletWithPairValidation;
use Igwen6w\Ddz\Validation\SequenceOfTripletWithSingleValidation;
use Igwen6w\Ddz\Validation\SequenceValidation;
use Igwen6w\Ddz\Validation\SingleValidation;
use Igwen6w\Ddz\Validation\TripletValidation;
use Igwen6w\Ddz\Validation\TripletWithPairValidation;
use Igwen6w\Ddz\Validation\TripletWithSingleValidation;

Enum FightTheLandlordPlayableEnum: string
{
    case Single = 'single';
    case Pair = 'pair';
    case Triplet = 'triplet';
    case TripletSingle = 'triplet_single';
    case TripletPair = 'triplet_pair';
    case Sequence = 'sequence';
    case SequencePair = 'sequence_pair';
    case SequenceTriplet = 'sequence_triplet';
    case SequenceTripletWithSingle = 'sequence_triplet_single';
    case SequenceTripletWithPair = 'sequence_triplet_pair';
    case Bomb = 'bomb';
    case Rocket = 'rocker';
    case QuadPlexSet = 'quad_plex_set';

    public function rule(): string
    {
        return match ($this) {
            self::Single => SingleValidation::class,
            self::Pair => PairValidation::class,
            self::Triplet => TripletValidation::class,
            self::TripletSingle => TripletWithSingleValidation::class,
            self::TripletPair => TripletWithPairValidation::class,
            self::Sequence => SequenceValidation::class,
            self::SequencePair => SequenceOfPairValidation::class,
            self::SequenceTriplet => SequenceOfTripletValidation::class,
            self::SequenceTripletWithSingle => SequenceOfTripletWithSingleValidation::class,
            self::SequenceTripletWithPair => SequenceOfTripletWithPairValidation::class,
            self::Bomb => BombValidation::class,
            self::Rocket => RocketValidation::class,
            self::QuadPlexSet => QuadPlexSetValidation::class,
        };
    }

}