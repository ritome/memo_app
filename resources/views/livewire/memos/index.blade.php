<?php

use function Livewire\Volt\{state};
use App\Models\Memo;

state(['memos' => fn() => Memo::all()]);

$create = function() {
    return redirect()->route('memos.create');
};

// 優先度を文字列に変換する関数
$getPriorityText = function($priority) {
    return match($priority) {
        1 => '低',
        2 => '中',
        3 => '高',
        default => '不明',
    };
};
?>

<div>
    <h1>タイトル一覧</h1>
    <ul>
        @foreach ($memos as $memo)
            <li>
                <a href="{{ route('memos.show', $memo) }}">{{ $memo->id }}</a>
                {{ $memo->title }}[{{ $this->getPriorityText($memo->priority) }}]
            </li>
        @endforeach
    </ul>

    <button wire:click="create">登録する</button>

</div>


