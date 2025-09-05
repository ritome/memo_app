<?php

use function Livewire\Volt\{state};
use App\Models\Memo;

state(['memos' => fn() => Memo::orderBy('priority', 'desc')->get()]);

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

// 優先度に応じたCSSクラスを取得する関数
$getPriorityClass = function($priority) {
    return match($priority) {
        1 => 'priority-low',
        2 => 'priority-medium',
        3 => 'priority-high',
        default => '',
    };
};
?>

<div>
    <h1>タイトル一覧</h1>
    <ul>
        @foreach ($memos as $memo)
            <li>
                <a href="{{ route('memos.show', $memo) }}">{{ $memo->id }}</a>
                {{ $memo->title }} [<span class="{{ $this->getPriorityClass($memo->priority) }}">{{ $this->getPriorityText($memo->priority) }}</span>]
            </li>
        @endforeach
    </ul>

    <button wire:click="create">登録する</button>

</div>


