<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class PostForm extends Component implements HasForms
{

    use InteractsWithForms;

    public Post $post;

    public function mount(): void
    {
        $this->form->fill($this->post->toArray());
    }

    protected function getFormModel(): Post
    {
        return $this->post;
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('title')->required(),
            Select::make('category_id')
                ->relationship('category', 'name')
                ->searchable()
                ->preload(),
            Select::make('subcategory_id')
                ->relationship('subcategory', 'name', fn ($query, $get) => $query->where('category_id', $get('category_id')))
                ->searchable()
                ->preload()
                ->reactive()
        ];
    }

    public function render()
    {
        return view('livewire.post-form');
    }
}
