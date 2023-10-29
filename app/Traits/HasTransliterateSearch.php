<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasTransliterateSearch
{
    public function scopeSearch(Builder $query, $search, $columns, $transliterateColumns)
    {
        return $query->when($search, function ($q) use ($search, $columns, $transliterateColumns) {
            $q->where(function ($q) use ($search, $columns, $transliterateColumns) {
                foreach ($columns as $column) {
                    if (in_array($column, $transliterateColumns)) {
                        $q->orWhere($column, 'like', '%'.transliterator_transliterate('Latin-Cyrillic', $search).'%')
                            ->orWhere($column, 'like', '%'.transliterator_transliterate('Cyrillic-Latin', $search).'%');
                    } else {
                        if ($column === 'id') {
                            $q->orWhere($column, $search);
                        } else {
                            $q->orWhere($column, 'like', '%'.$search.'%');
                        }
                    }
                }
            });
        });
    }
}
