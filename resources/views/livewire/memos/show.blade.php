<?php

use function Livewire\Volt\{state};
use App\Models\Memo;

//ルートモデルバインディング
state(['memo' => fn(Memo $memo) => $memo]);

//編集ページにリダイレクト
$edit = function() {
    //編集ページにリダイレクト
    return redirect()->route('memos.edit', $this->memo);
};

//削除ページにリダイレクト
$destroy = function() {
    $this->memo->delete();
    return redirect()->route('memos.index');
};

//優先度を文字列に変換する関数
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
    <a href="{{ route('memos.index') }}">戻る</a>
    <h1>{{ $memo->title }}</h1>
    <p><strong>優先度:</strong> {{ $this->getPriorityText($memo->priority) }}</p>
    <p>{!! nl2br(e($memo->body)) !!}</p>

    <button wire:click="edit">編集する</button>
    <button wire:click="destroy" wire:confirm="本当に削除しますか？">削除する</button>
</div>




