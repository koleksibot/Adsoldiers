<?php

namespace App\App\Console\Commands\Notifications;

use ReflectionClass;
use Illuminate\Console\Command;
use App\App\Domain\Notifications\Models\DatabaseNotification;

class RestructureNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:restructure';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restructure database notifications';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $notifiactions = DatabaseNotification::query();

        $bar = $this->output->createProgressBar($notifiactions->count());

        $notifiactions->chunk(100, function ($notifiactions) use ($bar) {
            $notifiactions->each(function ($notifiaction) use ($bar) {
                $recreated = $this->recreateNotifications(
                    $notifiaction,
                    $this->resolveModels($notifiaction->models)
                );

                $notifiaction->update([
                    'data' => $recreated->toArray($notifiaction->notifiable)
                ]);

                $bar->advance();
            });
        });

        $bar->finish();
    }

    public function resolveModels(array $models)
    {
        return array_map(function ($model) {
            return $model->class::find($model->id);
        }, $models);
    }

    public function recreateNotifications(DatabaseNotification $notifiaction, $args)
    {
        return (new ReflectionClass($notifiaction->type_class))->newInstanceArgs($args);
    }
}
