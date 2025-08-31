<?php

use function Livewire\Volt\{state, mount, rules};
use App\Models\Memo;

state(['memo', 'title', 'body']);

mount(function(Memo $memo) {
    $this->memo = $memo;
    $this->title = $memo->title;
    $this->body = $memo->body;
});

rules([
    'title' => 'required|string|max:50',
    'body' => 'required|string|max:2000',
]);

$update = function() {
    $this->validate();
    $this->memo->update($this->all());
    return redirect()->route('memos.show', $this->memo);
};


?>

<div>
    <a href="{{ route('memos.index') }}">戻る</a>
    <h1>更新</h1>
    <form wire:submit="update">
        <p>
            <label for="title">タイトル</label>
            @error('title')
                <span class="error">({{ $message }})</span>
            @enderror
            <br>
            <input type="text" wire:model="title" id="title">
        </p>
        <p>
            <label for="body">本文</label>
            @error('body')
                <span class="error">({{ $message }})</span>
            @enderror
            <br>
            <textarea wire:model="body"id="body"></textarea>
        </p>
        <button type="submit">更新</button>
    </form>
</div>
