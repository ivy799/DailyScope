<?php

namespace App\Filament\Admin\Resources\CommentResource\Widgets;

use App\Filament\Admin\Resources\CommentResource;
use App\Models\Comment;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestComment extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Comment::whereDate('created_at', '>', now()->subDays(7)->startOfDay())
            )
            ->columns([
                TextColumn::make('user.name'),
                TextColumn::make('comment'),
                TextColumn::make('news.title'),
                TextColumn::make('created_at')->date(),
            ])
            ->actions([
                Action::make('View')
                    ->url(fn(Comment $record): string => CommentResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
